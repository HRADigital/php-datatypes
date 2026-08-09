/**
 * Conventional Commits rules for the semantic-commits CI gate.
 *
 * The release workflow derives the next version from these types:
 *   a "BREAKING CHANGE:" footer                  -> major
 *   feat                                         -> minor
 *   build / fix / perf / refactor / revert       -> patch
 *   chore / ci / docs / style / test             -> no release
 *
 * Only changes to shipped code earn a version: a docs-only or CI-only push
 * must not burn one, which is why those types cut nothing. Keep this list in
 * sync with `patchList` / `minorList` in .github/workflows/release.yml.
 *
 * Note: the release action reads breaking changes from the footer only - a "!"
 * suffix (feat!: ...) does NOT cut a major. See .github/workflows/release.yml.
 *
 * This is a .mjs file on purpose: the project has no package.json, so a plain
 * .js config would be loaded as CommonJS and the ESM export below would fail.
 */
export default {
    extends: ['@commitlint/config-conventional'],
    rules: {
        'header-max-length': [2, 'always', 120],
    },
};
