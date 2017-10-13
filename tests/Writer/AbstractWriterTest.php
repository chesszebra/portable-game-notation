<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

use ChessZebra\PortableGameNotation\Token\Comment;
use ChessZebra\PortableGameNotation\Token\EndResult;
use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\NullMove;
use ChessZebra\PortableGameNotation\Token\NumericAnnotationGlyph;
use ChessZebra\PortableGameNotation\Token\RecursiveAnnotationVariation;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\Token\TokenIterator;
use ChessZebra\StandardAlgebraicNotation\Notation;
use PHPUnit\Framework\TestCase;

final class DummyToken implements TokenInterface
{
    /**
     * Gets the type of this token.
     *
     * @return int
     */
    public function getType(): int
    {
        return 1337;
    }
}

final class AbstractWriterTest extends TestCase
{
    public function testComment()
    {
        // Arrange
        $tokens = [
            new Comment('hello world'),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("{hello world}\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testEndResult()
    {
        // Arrange
        $tokens = [
            new EndResult('1-0'),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("1-0\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testMoveNumber()
    {
        // Arrange
        $tokens = [
            new MoveNumber(1),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("1.\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testMoveNumberOnce()
    {
        // Arrange
        $tokens = [
            new MoveNumber(1),
            new StandardAlgebraicNotation(new Notation('e4')),
            new MoveNumber(1),
            new StandardAlgebraicNotation(new Notation('e5')),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("1. e4 e5\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testMoveNumberTwice()
    {
        // Arrange
        $tokens = [
            new MoveNumber(1),
            new StandardAlgebraicNotation(new Notation('e4')),
            new MoveNumber(1),
            new StandardAlgebraicNotation(new Notation('e5')),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->setConstructorArgs([
            true
        ])->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("1. e4 1... e5\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testNullMove()
    {
        // Arrange
        $tokens = [
            new NullMove(),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("--\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testNumericAnnotationGlyph()
    {
        // Arrange
        $tokens = [
            new NumericAnnotationGlyph(1337),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("$1337\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testRecursiveAnnotationVariationOpening()
    {
        // Arrange
        $tokens = [
            new RecursiveAnnotationVariation(true),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("(\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testRecursiveAnnotationVariationClosing()
    {
        // Arrange
        $tokens = [
            new RecursiveAnnotationVariation(false),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo(")\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    public function testTagPair()
    {
        // Arrange
        $tokens = [
            new TagPair('name', 'value'),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("[name \"value\"]\n\n\n"));

        // Act
        $writer->write($tokenIterator);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidToken()
    {
        // Arrange
        $tokens = [
            new DummyToken(),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Act
        $writer->write($tokenIterator);

        // Assert
        // ...
    }

    public function testPadding()
    {
        // Arrange
        $tokens = [];

        for ($i = 1; $i <= 50; ++$i) {
            $tokens[] = new MoveNumber($i);
        }

        $tokenIterator = new TokenIterator($tokens);

        $writer = $this->getMockBuilder(AbstractWriter::class)->getMockForAbstractClass();

        // Assert
        $writer->expects($this->once())->method('writeGame')->with($this->equalTo("1. 2. 3. 4. 5. 6. 7. 8. 9. 10. 11. 12. 13. 14. 15. 16. 17. 18. 19. 20. 21. 22.\n" .
            "23. 24. 25. 26. 27. 28. 29. 30. 31. 32. 33. 34. 35. 36. 37. 38. 39. 40. 41. 42.\n" .
            "43. 44. 45. 46. 47. 48. 49. 50.\n\n"));

        // Act
        $writer->write($tokenIterator);
    }
}
