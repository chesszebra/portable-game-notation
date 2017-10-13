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

final class CommentTest extends TestCase
{
    public function testGetType()
    {
        // Arrange
        $token = new Comment('');

        // Act
        $result = $token->getType();

        // Assert
        static::assertEquals(TokenInterface::COMMENT, $result);
    }

    public function testGetComment()
    {
        // Arrange
        $token = new Comment('comment');

        // Act
        $result = $token->getComment();

        // Assert
        static::assertEquals('comment', $result);
    }
}
