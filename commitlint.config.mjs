/**
 * Conventional Commits rules for the semantic-commits CI gate.
 *
 * The release workflow derives the next version from these types:
 *   feat -> minor
 *   build / chore / ci / docs / fix / perf /
 *   refactor / revert / style / test -> patch
 *   a "BREAKING CHANGE:" footer -> major
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
