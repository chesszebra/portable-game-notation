<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Reader;

use ChessZebra\PortableGameNotation\Token\TokenIterator;
use PHPUnit\Framework\TestCase;

final class StreamTest extends TestCase
{
    public function testWithGame()
    {
        // Arrange
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, '[White "player-white"]
[Black "player-black"]

1. d3 {[%clk 0:09:56]} 1... e5 {[%clk 0:09:56]} 2. e4 {[%clk 0:09:52]} 2... d6
{[%clk 0:09:55]} 3. f3 {[%clk 0:09:50]} 3... Be6 {[%clk 0:09:53]} 4. Ne2 {[%clk
0:09:44]} 4... Be7 {[%clk 0:09:52]} 5. g4 {[%clk 0:09:22]} 5... Nf6 {[%clk
0:09:42]} 6. Be3 {[%clk 0:09:17]} 6... Nc6 {[%clk 0:09:28]} 7. h3 {[%clk
0:08:58]} 7... d5 {[%clk 0:09:27]} 8. Bg2 {[%clk 0:08:36]} 8... dxe4 {[%clk
0:09:24]} 9. fxe4 {[%clk 0:08:29]} 9... Qd6 {[%clk 0:09:17]} 10. Nbc3 {[%clk
0:08:00]} 10... O-O-O {[%clk 0:09:03]} 11. Nb5 {[%clk 0:07:17]} 11... Qb4+
{[%clk 0:08:57]} 12. c3 {[%clk 0:06:07]} 12... Qxb5 {[%clk 0:08:51]} 13. a4
{[%clk 0:05:52]} 13... Qxb2 {[%clk 0:08:45]} 14. Bd2 {[%clk 0:05:42]} 14... Rxd3
{[%clk 0:08:27]} 15. Rb1 {[%clk 0:05:34]} 15... Qa2 {[%clk 0:08:09]} 0-1');
        rewind($stream);

        $reader = new Stream($stream);

        // Act
        $tokenIterator = $reader->read();

        // Assert
        static::assertInstanceOf(TokenIterator::class, $tokenIterator);
    }

    public function testWithNoGames()
    {
        // Arrange
        $stream = fopen('php://temp', 'r+');

        $reader = new Stream($stream);

        // Act
        $tokenIterator = $reader->read();

        // Assert
        static::assertNull($tokenIterator);
    }
}
