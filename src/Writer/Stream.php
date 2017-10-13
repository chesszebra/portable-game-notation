<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

final class Stream extends AbstractWriter
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * Initializes a new instance of this class.
     *
     * @param resource $resource The resource to write to.
     * @param bool $showMoveNumberTwice Whether or not to repeat the move number.
     */
    public function __construct($resource, bool $showMoveNumberTwice = false)
    {
        $this->resource = $resource;

        parent::__construct($showMoveNumberTwice);
    }

    /**
     * Writes a single game.
     *
     * @param string $pgn The PGN data of a single game.
     * @return void
     */
    protected function writeGame(string $pgn): void
    {
        fwrite($this->resource, $pgn);
    }
}
