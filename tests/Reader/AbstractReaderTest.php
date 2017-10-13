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

final class AbstractReaderTest extends TestCase
{
    /**
     * @var string
     */
    private $pgn;

    protected function setUp()
    {
        $this->pgn = '[White "player-white"]
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
{[%clk 0:08:27]} 15. Rb1 {[%clk 0:05:34]} 15... Qa2 {[%clk 0:08:09]} 0-1

[White "player-white"]
[Black "player-black"]

1. e4 {[%clk 0:09:58]} 1... e5 {[%clk 0:09:57]} 2. Nf3 {[%clk 0:09:57]} 2... Nc6
{[%clk 0:09:55]} 3. Bc4 {[%clk 0:09:52]} 3... Bc5 {[%clk 0:09:54]} 4. d3 {[%clk
0:09:50]} 4... h6 {[%clk 0:09:52]} 5. Be3 {[%clk 0:09:41]} 5... Bxe3 {[%clk
0:09:49]} 6. fxe3 {[%clk 0:09:40]} 6... Nf6 {[%clk 0:09:48]} 7. Nc3 {[%clk
0:09:39]} 7... O-O {[%clk 0:09:47]} 8. Nd5 {[%clk 0:09:37]} 8... d6 {[%clk
0:09:43]} 9. Nxf6+ {[%clk 0:09:28]} 9... Qxf6 {[%clk 0:09:41]} 10. O-O {[%clk
0:09:27]} 10... Be6 {[%clk 0:09:31]} 11. Bxe6 {[%clk 0:09:24]} 11... Qxe6 {[%clk
0:09:28]} 12. d4 {[%clk 0:09:21]} 12... exd4 {[%clk 0:09:23]} 13. Nxd4 {[%clk
0:09:05]} 13... Nxd4 {[%clk 0:09:05]} 14. Qxd4 {[%clk 0:09:03]} 14... c5 {[%clk
0:09:00]} 15. Qc4 {[%clk 0:08:59]} 15... Qxc4 {[%clk 0:08:56]} 0-1';
    }

    public function testReadGame()
    {
        // Arrange
        $reader = new StringReader($this->pgn);

        // Act
        $tokenIterator = $reader->read();

        // Assert
        static::assertInstanceOf(TokenIterator::class, $tokenIterator);
    }

    public function testReadSecondGame()
    {
        // Arrange
        $reader = new StringReader($this->pgn);
        $reader->read();

        // Act
        $tokenIterator = $reader->read();

        // Assert
        static::assertInstanceOf(TokenIterator::class, $tokenIterator);
    }

    public function testEndReturnsNull()
    {
        // Arrange
        $reader = new StringReader($this->pgn);
        $reader->read();
        $reader->read();

        // Act
        $tokenIterator = $reader->read();

        // Assert
        static::assertNull($tokenIterator);
    }
}
