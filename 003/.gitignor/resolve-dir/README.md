# resolve-dir [![NPM version](https://img.shields.io/npm/v/resolve-dir.svg?style=flat)](https://www.npmjs.com/package/resolve-dir) [![NPM downloads](https://img.shields.io/npm/dm/resolve-dir.svg?style=flat)](https://npmjs.org/package/resolve-dir) [![Build Status](https://img.shields.io/travis/jonschlinkert/resolve-dir.svg?style=flat)](https://travis-ci.org/jonschlinkert/resolve-dir)

Resolve a directory that is either local, global or in the user's home directory.

## Install

Install with [npm](https://www.npmjs.com/):

```sh
$ npm install --save resolve-dir
```

## Usage

```js
var resolve = require('resolve-dir');
```

Returns a local directory path unchanged

```js
resolve('a')
//=> 'a'
```

Resolves the path to user home

```js
resolve('~')
//=> '/Users/jonschlinkert'
resolve('~/foo')
//=> '/Users/jonschlinkert/foo'
```

Resolves the path to global npm modules

```js
resolve('@')
//=> '/usr/local/lib/node_modules'
resolve('@/foo')
//=> '/usr/local/lib/node_modules/foo'
```

## About

### Related projects

* [expand-tilde](https://www.npmjs.com/package/expand-tilde): Bash-like tilde expansion for node.js. Expands a leading tilde in a file path to the… [more](https://github.com/jonschlinkert/expand-tilde) | [homepage](https://github.com/jonschlinkert/expand-tilde "Bash-like tilde expansion for node.js. Expands a leading tilde in a file path to the user home directory, or `~+` to the cwd.")
* [findup-sync](https://www.npmjs.com/package/findup-sync): Find the first file matching a given pattern in the current directory or the nearest… [more](https://github.com/cowboy/node-findup-sync) | [homepage](https://github.com/cowboy/node-findup-sync "Find the first file matching a given pattern in the current directory or the nearest ancestor directory.")
* [resolve-modules](https://www.npmjs.com/package/resolve-modules): Resolves local and global npm modules that match specified patterns, and returns a configuration object… [more](https://github.com/jonschlinkert/resolve-modules) | [homepage](https://github.com/jonschlinkert/resolve-modules "Resolves local and global npm modules that match specified patterns, and returns a configuration object for each resolved module.")

### Contributing

Pull requests and stars are always welcome. For bugs and feature requests, [please create an issue](../../issues/new).

### Building docs

_(This document was generated by [verb-generate-readme](https://github.com/verbose/verb-generate-readme) (a [verb](https://github.com/verbose/verb) generator), please don't edit the readme directly. Any changes to the readme must be made in [.verb.md](.verb.md).)_

To generate the readme and API documentation with [verb](https://github.com/verbose/verb):

```sh
$ npm install -g verb verb-generate-readme && verb
```

### Running tests

Install dev dependencies:

```sh
$ npm install -d && npm test
```

### Author

**Jon Schlinkert**

* [github/jonschlinkert](https://github.com/jonschlinkert)
* [twitter/jonschlinkert](http://twitter.com/jonschlinkert)

### License

Copyright © 2016, [Jon Schlinkert](https://github.com/jonschlinkert).
Released under the [MIT license](https://github.com/jonschlinkert/resolve-dir/blob/master/LICENSE).

***

_This file was generated by [verb-generate-readme](https://github.com/verbose/verb-generate-readme), v0.1.28, on July 29, 2016._