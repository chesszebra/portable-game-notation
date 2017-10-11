<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

use ChessZebra\StandardAlgebraicNotation\Notation;
use PHPUnit\Framework\TestCase;

final class StandardAlgebraicNotationTest extends TestCase
{
    public function testGetType()
    {
        // Arrange
        $token = new StandardAlgebraicNotation(new Notation('e4'));

        // Act
        $result = $token->getType();

        // Assert
        static::assertEquals(TokenInterface::STANDARD_ALGEBRAIC_NOTATION, $result);
    }

    public function testGetName()
    {
        // Arrange
        $token = new StandardAlgebraicNotation(new Notation('e4'));

        // Act
        $result = $token->getStandardAlgebraicNotation();

        // Assert
        static::assertInstanceOf(Notation::class, $result);
    }
}
