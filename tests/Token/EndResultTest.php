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

final class EndResultTest extends TestCase
{
    public function testGetType()
    {
        // Arrange
        $token = new EndResult('');

        // Act
        $result = $token->getType();

        // Assert
        static::assertEquals(TokenInterface::END_RESULT, $result);
    }

    public function testGetResult()
    {
        // Arrange
        $token = new EndResult('result');

        // Act
        $result = $token->getResult();

        // Assert
        static::assertEquals('result', $result);
    }
}
