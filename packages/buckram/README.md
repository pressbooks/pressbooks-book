# Buckram

[![License](https://badgen.net/github/license/pressbooks/buckram)](https://github.com/pressbooks/buckram/blob/production/LICENSE)
[![Build Status](https://badgen.net/github/checks/pressbooks/buckram)](https://github.com/pressbooks/buckram/actions)
[![Latest Release](https://badgen.net/npm/v/buckram)](https://www.npmjs.com/package/buckram)

Opinionated SCSS components for books (web, EPUB and PDF).

[Read the docs.](https://buckram.pressbooks.org/)

## Testing

Install dependencies:

```bash
npm install
composer install
```

Run tests:

```bash
npm test
```

## Releasing

Buckram uses [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/), enforced with [commitlint](https://commitlint.js.org/).
This facilitates releasing new versions of the package via [Release Please](https://github.com/googleapis/release-please).
Release notes will be automatically added to a PR based on commits to `dev`.

To cut a release, merge the current [release pull request](https://github.com/google-github-actions/release-please-action#whats-a-release-pr).
This will tag a new GitHub release and update [CHANGELOG.md](CHANGELOG.md).

Then, run `npm publish` from the root of the package and enter your one-time password when prompted. For more
information on publishing to npm, see the [npm publish documentation](https://docs.npmjs.com/cli/publish).
