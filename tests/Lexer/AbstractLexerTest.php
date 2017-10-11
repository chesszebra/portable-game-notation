<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

use ChessZebra\PortableGameNotation\Token\Comment;
use ChessZebra\PortableGameNotation\Token\EndResult;
use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\NullMove;
use ChessZebra\PortableGameNotation\Token\NumericAnnotationGlyph;
use ChessZebra\PortableGameNotation\Token\RecursiveAnnotationVariation;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Token\TagPair;
use PHPUnit\Framework\TestCase;

final class AbstractLexerTest extends TestCase
{
    public function testEmptyBuffer()
    {
        // Arrange
        $buffer = '';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertNull($result);
    }

    /**
     * @expectedException \ChessZebra\PortableGameNotation\Lexer\Exception\InvalidTokenException
     */
    public function testInvalidToken()
    {
        // Arrange
        $buffer = 'x';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertNull($result);
    }

    public function testMatchComment()
    {
        // Arrange
        $buffer = '{hello world}';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(Comment::class, $result);
    }

    public function testMatchEndResultBlackWins()
    {
        // Arrange
        $buffer = '0-1';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(EndResult::class, $result);
        static::assertEquals('0-1', $result->getResult());
    }

    public function testMatchEndResultDraw()
    {
        // Arrange
        $buffer = '1/2-1/2';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(EndResult::class, $result);
        static::assertEquals('1/2-1/2', $result->getResult());
    }

    public function testMatchEndResultOngoing()
    {
        // Arrange
        $buffer = '*';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(EndResult::class, $result);
        static::assertEquals('*', $result->getResult());
    }

    public function testMatchEndResultWhiteWins()
    {
        // Arrange
        $buffer = '1-0';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(EndResult::class, $result);
        static::assertEquals('1-0', $result->getResult());
    }

    public function testMatchNullMove()
    {
        // Arrange
        $buffer = '--';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(NullMove::class, $result);
    }

    public function testMoveNumberWhite()
    {
        // Arrange
        $buffer = '1.';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(MoveNumber::class, $result);
    }

    public function testMoveNumberBlack()
    {
        // Arrange
        $buffer = '1...';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(MoveNumber::class, $result);
    }

    public function testMatchRecursiveAnnotationVariationOpening()
    {
        // Arrange
        $buffer = '(';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(RecursiveAnnotationVariation::class, $result);
        static::assertTrue($result->isOpening());
    }

    public function testMatchRecursiveAnnotationVariationClosing()
    {
        // Arrange
        $buffer = ')';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(RecursiveAnnotationVariation::class, $result);
        static::assertFalse($result->isOpening());
    }

    public function testMatchNumericAnnotationGlyph()
    {
        // Arrange
        $buffer = '$123';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(NumericAnnotationGlyph::class, $result);
        static::assertEquals(123, $result->getValue());
    }

    public function testMatchSANCastling()
    {
        // Arrange
        $buffer = 'O-O';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(StandardAlgebraicNotation::class, $result);
    }

    public function testMatchSAN()
    {
        // Arrange
        $buffer = 'e4';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(StandardAlgebraicNotation::class, $result);
    }

    public function testMatchTagPair()
    {
        // Arrange
        $buffer = '[name "value"]';

        $lexer = new StringLexer($buffer);

        // Act
        $result = $lexer->getNextToken();

        // Assert
        static::assertInstanceOf(TagPair::class, $result);
    }
}
