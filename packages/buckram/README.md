# Buckram

[![License](https://badgen.net/github/license/pressbooks/buckram)](https://github.com/pressbooks/buckram/blob/main/LICENSE) [![Build Status](https://badgen.net/github/status/pressbooks/buckram)](https://github.com/pressbooks/buckram/actions) [![Latest Release](https://badgen.net/npm/v/buckram)](https://www.npmjs.com/package/buckram)

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

[release-please](https://github.com/googleapis/release-please) will generate release notes in a PR automatically based on commits to `dev`.

Merging the PR to tag a new GitHub release and update [CHANGELOG.md](CHANGELOG.md).

Then, run `npm publish`.
