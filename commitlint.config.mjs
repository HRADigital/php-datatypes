/**
 * Conventional Commits rules for the semantic-commits CI gate.
 *
 * The release workflow derives the next version from these types. EVERY commit
 * that lands on master ships a version - the version identifies the state of
 * the project:
 *   a "BREAKING CHANGE:" footer                  -> major
 *   feat                                         -> minor
 *   every other type                             -> patch
 *
 * Keep this list in sync with `minorList` / `patchAll` in
 * .github/workflows/release.yml.
 *
 * The release action reads breaking changes from the footer only - a "!"
 * suffix (feat!: ...) does NOT cut a major. See .github/workflows/release.yml.
 * `breaking-change-footer` below rejects a "!" header that carries no footer,
 * so a commit meant as breaking can never ship as a minor or a patch.
 *
 * This is a .mjs file on purpose: the project has no package.json, so a plain
 * .js config would be loaded as CommonJS and the ESM export below would fail.
 */
const BANG_HEADER = /^\w+(\([^)]*\))?!:/;
const BREAKING_FOOTER = /^BREAKING CHANGE: \S/m;

export default {
    extends: ['@commitlint/config-conventional'],
    plugins: [
        {
            rules: {
                'breaking-change-footer': ({ header, raw }) => [
                    !BANG_HEADER.test(header ?? '') || BREAKING_FOOTER.test(raw ?? ''),
                    'a "!" header needs a "BREAKING CHANGE: <what broke>" footer - the release '
                        + 'action ignores the "!" suffix, so without the footer the commit ships as '
                        + 'a minor or a patch instead of a major',
                ],
            },
        },
    ],
    rules: {
        'header-max-length': [2, 'always', 120],
        'breaking-change-footer': [2, 'always'],
    },
};
