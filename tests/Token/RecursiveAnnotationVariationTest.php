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

final class RecursiveAnnotationVariationTest extends TestCase
{
    public function testGetType()
    {
        // Arrange
        $token = new RecursiveAnnotationVariation(false);

        // Act
        $result = $token->getType();

        // Assert
        static::assertEquals(TokenInterface::RECURSIVE_ANNOTATION_VARIATION, $result);
    }

    public function testWithOpening()
    {
        // Arrange
        $token = new RecursiveAnnotationVariation(true);

        // Act
        $result = $token->isOpening();

        // Assert
        static::assertTrue($result);
    }

    public function testWithoutOpening()
    {
        // Arrange
        $token = new RecursiveAnnotationVariation(false);

        // Act
        $result = $token->isOpening();

        // Assert
        static::assertFalse($result);
    }
}
