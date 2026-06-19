# PHPStan No Safe

PHPStan extension that detects and blocks any usage of [`thecodingmachine/safe`](https://github.com/thecodingmachine/safe)

# ReactPHP Extension for PHPStan

![Continuous Integration](https://github.com/WyriHaximus/phpstan-no-safe/workflows/Continuous%20Integration/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/phpstan-no-safe/v/stable.png)](https://packagist.org/packages/WyriHaximus/phpstan-no-safe)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/phpstan-no-safe/downloads.png)](https://packagist.org/packages/WyriHaximus/phpstan-no-safe)
[![License](https://poser.pugx.org/WyriHaximus/phpstan-no-safe/license.png)](https://packagist.org/packages/WyriHaximus/phpstan-no-safe)

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/phpstan-no-safe
```

# Why

Main reason for this package is to prevent usage of [`thecodingmachine/safe`](https://github.com/thecodingmachine/safe)
in your codebase. And in my personal specific situation: I'm removing all usage of
[`thecodingmachine/safe`](https://github.com/thecodingmachine/safe) from my packages. This is something I started back
when the packages wasn't maintained for a while and the decision was made to remove it. This package is purely a way to
ensure there is nothing lingering around. It's the counterpart of
[`thecodingmachine/phpstan-safe-rule`](https://github.com/thecodingmachine/phpstan-safe-rule). Also would like to note
that I don't think [`thecodingmachine/safe`](https://github.com/thecodingmachine/safe) is a bad package.

# Usage

The rules in this package are automatically loaded by PHPStan when [`phpstan/extension-installer`](https://github.com/phpstan/extension-installer) is installed.

Alternatively including the extension file from the root of this package will do the same:

```neon
includes:
	- vendor/wyrihaximus/phpstan-no-safe/extension.neon
```

# License

The MIT License (MIT)

Copyright (c) 2026 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

