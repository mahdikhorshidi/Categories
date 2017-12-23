# MahdiKhorshidi Categories

**MahdiKhorshidi Categories** is a polymorphic Laravel package, for category management. You can categorize any eloquent model with ease, and utilize the power of **[Nested Sets](https://github.com/lazychaser/laravel-nestedset)**, and the awesomeness of **[Sluggable](https://github.com/spatie/laravel-sluggable)**, and **[Translatable](https://github.com/spatie/laravel-translatable)** models out of the box.

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require mahdikhorshidi/categories
```

## Usage

``` php
$skeleton = new mahdikhorshidi\categories();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mahdikhorshidi@gmail.com instead of using the issue tracker.

## Credits

- [Mahdi Khorshidi][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mahdikhorshidi/categories.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/mahdikhorshidi/categories/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/mahdikhorshidi/categories.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/mahdikhorshidi/categories.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mahdikhorshidi/categories.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/mahdikhorshidi/categories
[link-travis]: https://travis-ci.org/mahdikhorshidi/categories
[link-scrutinizer]: https://scrutinizer-ci.com/g/mahdikhorshidi/categories/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/mahdikhorshidi/categories
[link-downloads]: https://packagist.org/packages/mahdikhorshidi/categories
[link-author]: https://github.com/mahdikhorshidi
[link-contributors]: ../../contributors
