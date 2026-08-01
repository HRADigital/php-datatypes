.PHONY: help lint lint-scope-check lint-fix cs validate test test-unit

SHELL := /bin/bash

# Per-run path ($$ = PID of the shell make spawns). Fixed path = parallel runs clobber
# each other. Sub-makes must get this value on the command line.
PHPCS_SCOPE_JSON := /tmp/phpcs-scope-$(shell echo $$$$).json

# Prefix every PHP tool invocation goes through. This is a standalone library with no
# container, so it defaults to empty (tools run natively against vendor/). Override it
# (e.g. `make lint EXEC="docker exec somebox"`) to run the same gate elsewhere; keeping
# one definition means a CI gate can never drift from the gate a developer runs locally.
EXEC :=

# PHPCS standard. There is no phpcs.xml in this project - the ruleset lives inline in
# composer.json's `test-cs` script, and these flags mirror it.
PHPCS_STANDARD := --standard=PSR2 --exclude=Squiz.WhiteSpace.ControlStructureSpacing
PHPCS_FILES := $(if $(FILES),$(FILES),src/)

# On a QUIET test run we still want the verdict, just not the per-test roll call.
TEST_SUMMARY := grep -E '^[[:space:]]*(Tests|Duration):|^OK|^OK \(|^FAILURES!|^ERRORS!|^WARNINGS!|^No tests executed'

# QUIET=1 mutes the decorative per-target banners; the static gates AND the test
# targets additionally go SILENT-ON-SUCCESS - they emit output ONLY when the
# underlying tool fails. Default (QUIET unset) keeps banners and streams output live.
# NOTE: silent-on-success buffers the whole run, so QUIET=1 shows no live progress
# until the command finishes or fails. Drop QUIET on long suites you want to watch.
ifeq ($(QUIET),1)
BANNER := @true
else
BANNER := @echo
endif

help:
	@echo "Available commands:"
	@echo "  make lint                   - PHPCS code-style check (report only)"
	@echo "  make lint-scope-check       - warn when PHPCS skipped requested FILES"
	@echo "  make lint-fix               - apply PHPCBF code-style fixes"
	@echo "  make cs                     - alias of lint"
	@echo "  make validate               - run every report gate concurrently"
	@echo "  make test                   - run the full PHPUnit suite"
	@echo "  make test-unit              - run the Unit testsuite"
	@echo "  (FILES=\"a.php b.php\" scopes the file-based gates; FILTER=Foo narrows a test run)"
	@echo "  (append QUIET=1 to any target for silent-on-success: gates print only on"
	@echo "   failure, test targets print only their final summary; drop QUIET to watch a long run)"

# FILES (optional) scopes the file-based gates to a list of paths; empty = src/.
lint:
ifeq ($(QUIET),1)
	@out="$$($(EXEC) vendor/bin/phpcs -q $(PHPCS_STANDARD) --report=full --report-json=$(PHPCS_SCOPE_JSON) $(PHPCS_FILES) 2>&1)" || { printf '%s\n' "$$out"; $(MAKE) --no-print-directory lint-scope-check FILES="$(FILES)" PHPCS_SCOPE_JSON="$(PHPCS_SCOPE_JSON)"; $(EXEC) rm -f $(PHPCS_SCOPE_JSON); exit 1; }
	@$(MAKE) --no-print-directory lint-scope-check FILES="$(FILES)" PHPCS_SCOPE_JSON="$(PHPCS_SCOPE_JSON)"
	@$(EXEC) rm -f $(PHPCS_SCOPE_JSON)
else
	@echo "Linting (PHPCS, report-only)..."
	@$(EXEC) vendor/bin/phpcs $(PHPCS_STANDARD) --report=full --report-json=$(PHPCS_SCOPE_JSON) $(PHPCS_FILES)
	@$(MAKE) --no-print-directory lint-scope-check FILES="$(FILES)" PHPCS_SCOPE_JSON="$(PHPCS_SCOPE_JSON)"
	@$(EXEC) rm -f $(PHPCS_SCOPE_JSON)
endif

# PHPCS silently ignores requested paths that fall outside its include scope, so a
# clean exit can mean "checked 8 of 38" rather than "all 38 clean". Compare what PHPCS
# actually scanned against what was requested and say so. Warning only - out-of-scope
# files are a known gap, not a failure.
lint-scope-check:
	@if [ -n "$(FILES)" ]; then \
	  scanned="$$($(EXEC) php -r '$$d = json_decode(@file_get_contents("$(PHPCS_SCOPE_JSON)"), true); echo (is_array($$d) && isset($$d["files"])) ? count($$d["files"]) : 0;' 2>/dev/null)"; \
	  requested=$(words $(FILES)); \
	  if [ -n "$$scanned" ] && [ "$$scanned" -lt "$$requested" ]; then \
	    printf 'WARNING: PHPCS scanned %s of %s requested files - %s outside the PHPCS scope, NOT style-checked.\n' \
	      "$$scanned" "$$requested" "$$(( requested - scanned ))"; \
	  fi; \
	fi

# phpcbf exit codes: 0 = nothing to fix, 1 = fixes applied OK, >=2 = real error. Both 0
# and 1 are success, so the non-QUIET form needs a leading "-" to stay green, and the
# QUIET form stays silent for rc<=1 and only surfaces output on a genuine error.
lint-fix:
ifeq ($(QUIET),1)
	@out="$$($(EXEC) vendor/bin/phpcbf $(PHPCS_STANDARD) $(PHPCS_FILES) 2>&1)"; rc=$$?; [ $$rc -le 1 ] || { printf '%s\n' "$$out"; exit 1; }
else
	@echo "Applying PHPCBF code-style fixes..."
	-@$(EXEC) vendor/bin/phpcbf $(PHPCS_STANDARD) $(PHPCS_FILES)
endif

# Coding-standards gate. Alias of lint - PHPCS is the only style tool installed.
cs: lint

# Runs the independent static gates concurrently (own sub-make with -j).
validate:
ifeq ($(QUIET),1)
	@$(MAKE) --no-print-directory -j lint FILES="$(FILES)" QUIET=1
else
	@echo "Running the static gates concurrently..."
	@$(MAKE) --no-print-directory -j lint FILES="$(FILES)"
endif

test:
ifeq ($(QUIET),1)
	@out="$$($(EXEC) php -d memory_limit=-1 vendor/bin/phpunit 2>&1)" || { printf '%s\n' "$$out"; exit 1; }; printf '%s\n' "$$out" | $(TEST_SUMMARY) || true
else
	@echo "Running full test suite (raised memory limit)..."
	@$(EXEC) php -d memory_limit=-1 vendor/bin/phpunit
endif

# FILTER (optional) narrows a suite run to matching test class names; FILES (optional)
# scopes it to a list of paths; both empty = whole suite.
test-unit:
ifeq ($(QUIET),1)
	@out="$$($(EXEC) php -d memory_limit=-1 vendor/bin/phpunit --testsuite=Unit $(if $(FILTER),--filter="$(FILTER)") $(FILES) 2>&1)" || { printf '%s\n' "$$out"; exit 1; }; printf '%s\n' "$$out" | $(TEST_SUMMARY) || true
else
	@echo "Running Unit suite..."
	@$(EXEC) php -d memory_limit=-1 vendor/bin/phpunit --testsuite=Unit $(if $(FILTER),--filter="$(FILTER)") $(FILES)
endif
