<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

use PHPUnit\Framework\TestCase;

final class TokenIteratorTest extends TestCase
{
    public function testCurrent()
    {
        // Arrange
        $iterator = new TokenIterator(['a', 'b', 'c']);

        // Act
        $result = $iterator->current();

        // Assert
        static::assertEquals('a', $result);
    }

    public function testNext()
    {
        // Arrange
        $iterator = new TokenIterator(['a', 'b', 'c']);

        // Act
        $iterator->next();

        // Assert
        static::assertEquals(1, $iterator->key());
    }

    public function testKey()
    {
        // Arrange
        $iterator = new TokenIterator(['a', 'b', 'c']);

        // Act
        $result = $iterator->key();

        // Assert
        static::assertEquals(0, $result);
    }

    public function testValid()
    {
        // Arrange
        $iterator = new TokenIterator(['a', 'b', 'c']);

        // Act
        $result = $iterator->valid();

        // Assert
        static::assertTrue($result);
    }

    public function testValidEmpty()
    {
        // Arrange
        $iterator = new TokenIterator([]);

        // Act
        $result = $iterator->valid();

        // Assert
        static::assertFalse($result);
    }

    public function testRewind()
    {
        // Arrange
        $iterator = new TokenIterator(['a', 'b', 'c']);
        $iterator->next();

        // Act
        $iterator->rewind();

        // Assert
        static::assertEquals(0, $iterator->key());
    }
}
