<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\TokenIterator;
use PHPUnit\Framework\TestCase;

final class StringTest extends TestCase
{
    public function testIfDataIsPopulated()
    {
        // Arrange
        $tokens = [
            new MoveNumber(1),
        ];

        $tokenIterator = new TokenIterator($tokens);

        $writer = new StringWriter();

        // Act
        $writer->write($tokenIterator);

        // Assert
        static::assertEquals("1.\n\n", $writer->getPgn());
    }
}
