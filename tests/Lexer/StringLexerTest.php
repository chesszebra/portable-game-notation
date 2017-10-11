<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

use ChessZebra\PortableGameNotation\Token\MoveNumber;
use PHPUnit\Framework\TestCase;

final class StringLexerTest extends TestCase
{
    public function testConstructor()
    {
        // Arrange
        $buffer = '1. e4';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->peekNextToken();

        // Assert
        static::assertInstanceOf(MoveNumber::class, $result);
    }
}
