<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\TokenIterator;
use PHPUnit\Framework\TestCase;

final class StreamTest extends TestCase
{
    private $stream;

    protected function setUp()
    {
        $this->stream = fopen('php://temp', 'r+');
    }

    public function testIfDataIsPopulated()
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

        static::assertEquals("1.\n\n", $content);
    }
}
