<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

use PHPUnit\Framework\TestCase;

final class TagPairTest extends TestCase
{
    public function testGetType()
    {
        // Arrange
        $token = new TagPair('name', 'value');

        // Act
        $result = $token->getType();

        // Assert
        static::assertEquals(TokenInterface::TAG_PAIR, $result);
    }

    public function testGetName()
    {
        // Arrange
        $token = new TagPair('name', 'value');

        // Act
        $result = $token->getName();

        // Assert
        static::assertEquals('name', $result);
    }

    public function testGetValue()
    {
        // Arrange
        $token = new TagPair('name', 'value');

        // Act
        $result = $token->getValue();

        // Assert
        static::assertEquals('value', $result);
    }
}
