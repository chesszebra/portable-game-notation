# portable-game-notation

[![Build Status](https://travis-ci.org/chesszebra/portable-game-notation.svg?branch=master)](https://travis-ci.org/chesszebra/portable-game-notation)

A PHP library to parse and write chess games in the portable game notation (PGN) format.

## Installation

Via composer

```
composer require chesszebra/portable-game-notation
```

## Usage

### Reading

Reading a single PGN game from a string:

```php
use ChessZebra\PortableGameNotation\Parser\Parser;
use ChessZebra\PortableGameNotation\Lexer\StreamLexer;

$parser = new Parser(new StreamLexer(fopen('games.pgn', 'r')));

$tokenIterator = $parser->parse();
```

### Writing

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

