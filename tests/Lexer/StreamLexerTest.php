<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

use ChessZebra\PortableGameNotation\Token\MoveNumber;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class StreamLexerTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidResource()
    {
        // Arrange
        $stream = null;

        // Act
        new StreamLexer($stream);

        // Assert
        // ...
    }

    public function testStreamIsInitialized()
    {
        // Arrange
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, '1. e4');
        rewind($stream);

        $lexer = new StreamLexer($stream);

        // Act
        $result = $lexer->peekNextToken();

        // Assert
        static::assertInstanceOf(MoveNumber::class, $result);
    }

    public function testGetOffset()
    {
        // Arrange
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, '1. e4');
        rewind($stream);

        $lexer = new StreamLexer($stream);

        // Act
        $result = $lexer->getOffset();

        // Assert
        static::assertEquals(0, $result);
    }

    public function testGetOffsetWithBuffer()
    {
        // Arrange
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, '1. e4');
        rewind($stream);

        $lexer = new StreamLexer($stream);
        $lexer->getNextToken();

        // Act
        $result = $lexer->getOffset();

        // Assert
        static::assertEquals(3, $result);
    }

    public function testGetNextTokenWithEndOfStream()
    {
        // Arrange
        $stream = fopen('php://temp', 'r+');

        $lexer = new StreamLexer($stream);
        $lexer->getNextToken();

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertNull($result);
    }
}
