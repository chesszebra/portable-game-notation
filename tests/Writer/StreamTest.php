<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Parser;

use ChessZebra\PortableGameNotation\Token\EndResult;
use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\TokenIterator;
use ChessZebra\PortableGameNotation\Writer\Stream;
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

final class StreamTest extends TestCase
{
    private $stream;

    protected function setUp()
    {
        $this->stream = fopen('php://temp', 'r+');
    }

    public function testMoveNumber()
    {
        // Arrange
        $tokens = [
            new MoveNumber(1),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = new Stream($this->stream);

        // Act
        $writer->write($tokenIterator);

        // Assert
        rewind($this->stream);
        $content = stream_get_contents($this->stream);

        static::assertEquals("1. \n\n", $content);
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

        $writer = new Stream($this->stream);

        // Act
        $writer->write($tokenIterator);

        // Assert
        rewind($this->stream);
        $content = stream_get_contents($this->stream);

        static::assertEquals("1. e4 e5 \n\n", $content);
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

        $writer = new Stream($this->stream, true);

        // Act
        $writer->write($tokenIterator);

        // Assert
        rewind($this->stream);
        $content = stream_get_contents($this->stream);

        static::assertEquals("1. e4 1... e5 \n\n", $content);
    }

    public function testEndResult()
    {
        // Arrange
        $tokens = [
            new EndResult('1-0'),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = new Stream($this->stream, true);

        // Act
        $writer->write($tokenIterator);

        // Assert
        rewind($this->stream);
        $content = stream_get_contents($this->stream);

        static::assertEquals("1-0\n\n", $content);
    }

    public function testTagPair()
    {
        // Arrange
        $tokens = [
            new TagPair('name', 'value'),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = new Stream($this->stream, true);

        // Act
        $writer->write($tokenIterator);

        // Assert
        rewind($this->stream);
        $content = stream_get_contents($this->stream);

        static::assertEquals("[name \"value\"]\n\n\n", $content);
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

        $writer = new Stream($this->stream, true);

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

        $writer = new Stream($this->stream, true);

        // Act
        $writer->write($tokenIterator);

        // Assert
        rewind($this->stream);
        $content = stream_get_contents($this->stream);

        static::assertEquals(
            "1. 2. 3. 4. 5. 6. 7. 8. 9. 10. 11. 12. 13. 14. 15. 16. 17. 18. 19. 20. 21. 22. \n" .
            "23. 24. 25. 26. 27. 28. 29. 30. 31. 32. 33. 34. 35. 36. 37. 38. 39. 40. 41. \n" .
            "42. 43. 44. 45. 46. 47. 48. 49. 50. \n\n",
            $content
        );
    }
}
