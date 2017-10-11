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

final class NumericAnnotationGlyphTest extends TestCase
{
    public function testGetType()
    {
        // Arrange
        $token = new NumericAnnotationGlyph(123);

        // Act
        $result = $token->getType();

        // Assert
        static::assertEquals(TokenInterface::NUMERIC_ANNOTATION_GLYPH, $result);
    }

    public function testGetValue()
    {
        // Arrange
        $token = new NumericAnnotationGlyph(123);

        // Act
        $result = $token->getValue();

        // Assert
        static::assertEquals(123, $result);
    }
}
