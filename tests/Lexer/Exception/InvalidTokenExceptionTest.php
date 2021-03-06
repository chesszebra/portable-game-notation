<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer\Exception;

use PHPUnit\Framework\TestCase;

final class InvalidTokenExceptionTest extends TestCase
{
    public function testCreateForBuffer()
    {
        // Arrange
        $buffer = 'buffer';

        // Act
        $result = InvalidTokenException::createForBuffer($buffer);

        // Assert
        static::assertInstanceOf(InvalidTokenException::class, $result);
    }
}
