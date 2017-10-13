# portable-game-notation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A PHP library to parse and write chess games in the portable game notation (PGN) format.

## Installation

Via composer

```
composer require chesszebra/portable-game-notation
```

## Usage

### Reading

#### From a string

Reading a single PGN game from a string:

```php
use ChessZebra\PortableGameNotation\Reader\StringReader;

$reader = new StringReader('1. e4 e5');

$tokenIterator = $reader->read();
```

#### From a stream

Reading a single PGN game from a stream:

```php
use ChessZebra\PortableGameNotation\Reader\StringReader;

$reader = new StreamReader(fopen('games.pgn', 'r'));

$tokenIterator = $reader->read();
```

### Writing

#### To a string

Wriring a PGN game to a string:

```php
use ChessZebra\PortableGameNotation\TokenIterator;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Writer\StringWriter;
use ChessZebra\StandardAlgebraicNotation\Notation;

$tokenIterator = new TokenIterator([
    new MoveNumber(1),
    new StandardAlgebraicNotation(new Notation('e4')),
]);

$writer = new StringWriter();
$writer->write($tokenIterator);

$pgn = $writer->getPgn();
```

#### To a stream

Wriring a PGN game to a stream:

```php
use ChessZebra\PortableGameNotation\TokenIterator;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Writer\Stream;
use ChessZebra\StandardAlgebraicNotation\Notation;

$tokenIterator = new TokenIterator([
    new MoveNumber(1),
    new StandardAlgebraicNotation(new Notation('e4')),
]);

$writer = new Stream(fopen('game.pgn', 'w'));
$writer->write($tokenIterator);
```

### Tokenizing games

#### From a string

```php
use ChessZebra\PortableGameNotation\Lexer\StringLexer;

$lexer = new StringLexer('1. e4');

$token = $lexer->getNextToken();
```

#### From a resource

```php
use ChessZebra\PortableGameNotation\Lexer\StreamLexer;

$lexer = new StreamLexer(fopen('my-games.pgn', 'r'));

$token = $lexer->getNextToken();
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please report them via [HackerOne][link-hackerone].

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/chesszebra/portable-game-notation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/chesszebra/portable-game-notation/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/chesszebra/portable-game-notation.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/chesszebra/portable-game-notation.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/chesszebra/portable-game-notation.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/chesszebra/portable-game-notation
[link-travis]: https://travis-ci.org/chesszebra/portable-game-notation
[link-scrutinizer]: https://scrutinizer-ci.com/g/chesszebra/portable-game-notation/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/chesszebra/portable-game-notation
[link-downloads]: https://packagist.org/packages/chesszebra/portable-game-notation
[link-contributors]: ../../contributors
[link-hackerone]: https://hackerone.com/chesszebra
