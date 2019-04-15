# Changelog

## 2.8.2

### Patches

* Trigger a window resize to fix H5P display issue (#492): #531

## 2.8.1

### Patches

* Add 'if-map-get' to dt-color variable to fix parse error (#527): #528

## 2.8.0

### Upgrade Notice

* McLuhan 2.8.0 requires [Pressbooks 5.7.0](https://github.com/pressbooks/pressbooks/releases/tag/5.7.0). 

### Minor Changes

* Book download tracking: #526 
* Improve display of source comparison tool for cloned books: #512, #514
* Disable scroll animation for webbook anchors (#488): #511
* Only load Hypothesis pane resize script when Hypothesis is enabled (#505): #509
* Remove unused jQuery UI dependency (#506): #508
* Add metadata to support Zotero citation of webbooks (#435): #499
* Add JSON-LD (Linked Data) book metadata to webbook (#434): #498
* Clarify language of chapter license statements: #472

### Buckram Changes

* Update pressbooks-build-tools to 1.4.4: #526 
* Update to [Buckram 1.4.0](https://github.com/pressbooks/pressbooks-book/blob/af3c81f/packages/buckram/CHANGELOG.md#140): af3c81f

## 2.7.3

### Patches

- Suppress unused Gutenberg block styles: [#500](https://github.com/pressbooks/pressbooks-book/pull/500)
- [Buckram 1.3.3](https://github.com/pressbooks/pressbooks-book/blob/baafe9075dde8d2f6e4e67ac2e0a24dc13b984aa/packages/buckram/CHANGELOG.md#133): [#497](https://github.com/pressbooks/pressbooks-book/pull/497)

## 2.7.2

### Patches

- Prevent pagination links from being included in collapsed sections ([#489](https://github.com/pressbooks/pressbooks-book/issues/489)): [#491](https://github.com/pressbooks/pressbooks-book/pull/491)
- Update to Buckram 1.3.2: [13199bb](https://github.com/pressbooks/pressbooks-book/commit/13199bb612b4f1a3c9b04704a8bed72af69213ba)

## 2.7.1

### Patches

- Buckram 1.3.1: [b72e3d6](https://github.com/pressbooks/pressbooks-book/commit/b72e3d6b77f0080ffff26e3330dbd1367434c6a8)


## 2.7.0

### Minor Changes

- Open sections when linking to anchors within them (props [@josieg](https://github.com/josieg) for the bug report): [#425](https://github.com/pressbooks/pressbooks-book/pull/425), [#452](https://github.com/pressbooks/pressbooks-book/pull/452)
- Update SCSS compilation method: [#388](https://github.com/pressbooks/pressbooks-book/pull/388)
- Buckram 1.3.0: [1623cb0](https://github.com/pressbooks/pressbooks-book/commit/1623cb0e55a627f08d3d6f81880d47da434c0ffe)

## 2.6.1

### Patches

- Improve focus style for webbook TOC dropdown button ([#399](https://github.com/pressbooks/pressbooks-book/issues/399)): [#401](https://github.com/pressbooks/pressbooks-book/pull/401)
- Ensure that Hypothesis highlights are shown as expected ([#392](https://github.com/pressbooks/pressbooks-book/issues/392)): [#400](https://github.com/pressbooks/pressbooks-book/pull/400)
- Use short title in navigation cues ([#396](https://github.com/pressbooks/pressbooks-book/issues/396)): [#397](https://github.com/pressbooks/pressbooks-book/pull/397)

## 2.6.0

### Minor Changes

- Improve focus styles ([#189](https://github.com/pressbooks/pressbooks-book/issues/189)): [#369](https://github.com/pressbooks/pressbooks-book/pull/369)
- Add styling for glossary term lists ([#320](https://github.com/pressbooks/pressbooks-book/issues/320)): [#361](https://github.com/pressbooks/pressbooks-book/pull/361)
- Differentiate link styles between print and digital PDF ([#317](https://github.com/pressbooks/pressbooks-book/issues/317)): [#359](https://github.com/pressbooks/pressbooks-book/pull/359), [#371](https://github.com/pressbooks/pressbooks-book/pull/371)
- Include Buckram 1.2.0 as subpackage ([#278](https://github.com/pressbooks/pressbooks-book/issues/278), [#307](https://github.com/pressbooks/pressbooks-book/issues/307)): [#308](https://github.com/pressbooks/pressbooks-book/pull/308), [#357](https://github.com/pressbooks/pressbooks-book/pull/357), [#358](https://github.com/pressbooks/pressbooks-book/pull/358)
- Use short title for webbook navigation: [#296](https://github.com/pressbooks/pressbooks-book/pull/296), [#376](https://github.com/pressbooks/pressbooks-book/pull/376)
- Display book and section Digital Object Identifiers (DOIs): [#294](https://github.com/pressbooks/pressbooks-book/pull/294), [#295](https://github.com/pressbooks/pressbooks-book/pull/295)
- Resize webbook contents when Hypothesis annotation pane is expended (props [@steelwagstaff](https://github.com/steelwagstaff) for the suggestion): [#292](https://github.com/pressbooks/pressbooks-book/pull/292), [#381](https://github.com/pressbooks/pressbooks-book/pull/381)
- Rebuild Table of Contents for improved usability ([#153](https://github.com/pressbooks/pressbooks-book/issues/153), [#225](https://github.com/pressbooks/pressbooks-book/issues/225), [#378](https://github.com/pressbooks/pressbooks-book/issues/378) props [@lucwrite](https://github.com/lucwrite) and [@josiegray](https://github.com/josiegray) for the bug reports): [#292](https://github.com/pressbooks/pressbooks-book/pull/292), [#293](https://github.com/pressbooks/pressbooks-book/pull/293), [#379](https://github.com/pressbooks/pressbooks-book/pull/379), [#382](https://github.com/pressbooks/pressbooks-book/pull/382)
- Update [sharer.js](https://www.npmjs.com/package/sharer.js) to 0.3.4: [#289](https://github.com/pressbooks/pressbooks-book/pull/289)
- Improve header type scale ([#260](https://github.com/pressbooks/pressbooks-book/issues/260), props [@pbstudent](https://github.com/pbstudent) for the suggestion): [#287](https://github.com/pressbooks/pressbooks-book/pull/287)
- Update [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit) to 6.5.13: [#290](https://github.com/pressbooks/pressbooks-book/pull/290)
- Update [composer/installers](https://packagist.org/packages/composer/installers) to 1.6.0: [#283](https://github.com/pressbooks/pressbooks-book/pull/283)
- Differentiate CC0 and public domain licenses ([pressbooks/pressbooks#1331](https://github.com/pressbooks/pressbooks/issues/1331), props [@philbarker](https://github.com/philbarker) for the suggestion): [#277](https://github.com/pressbooks/pressbooks-book/pull/277)
- Add Bengali, Kannada, Malayalam, Odia, and Telugu languages (props [@johnpeterm](https://github.com/johnpeterm) for the suggestion): [#276](https://github.com/pressbooks/pressbooks/pull/276), [#281](https://github.com/pressbooks/pressbooks/pull/281)
- Add RSS link to `<head>` (props [@baldurbjarnason](https://github.com/baldurbjarnason) for the suggestion): [#272](https://github.com/pressbooks/pressbooks-book/pull/272)
- Use HTML5 markup for images ([pressbooks/pressbooks#342](https://github.com/pressbooks/pressbooks/issues/342), [#193](https://github.com/pressbooks/pressbooks-book/issues/193), props [@jhung](https://github.com/jhung) for the suggestion): [#243](https://github.com/pressbooks/pressbooks-book/pull/243)

### Patches

- Fix floating image margins for Buckram themes ([#236](https://github.com/pressbooks/pressbooks-book/issues/236), props [@beckej13820](https://github.com/beckej13820) for the bug report): [#374](https://github.com/pressbooks/pressbooks-book/pull/374)
- Fix license icon size in webbook reading footer ([#372](https://github.com/pressbooks/pressbooks-book/issues/372)): [#373](https://github.com/pressbooks/pressbooks-book/pull/373), [#377](https://github.com/pressbooks/pressbooks-book/pull/377)
- Fix 401 errors when making authenticated REST requests: [#291](https://github.com/pressbooks/pressbooks-book/pull/291)
- Fix failure of cloned content comparison tool when source book is missing ([#285](https://github.com/pressbooks/pressbooks-book/issues/285)): [#288](https://github.com/pressbooks/pressbooks-book/pull/288)
