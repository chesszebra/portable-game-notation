<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

final class StringWriter extends AbstractWriter
{
    /**
     * @var string
     */
    private $pgn;

    /**
     * Initializes a new instance of this class.
     *
     * @param bool $showMoveNumberTwice Whether or not to repeat the move number.
     */
    public function __construct(bool $showMoveNumberTwice = false)
    {
        parent::__construct($showMoveNumberTwice);

        $this->pgn = '';
    }

    /**
     * Gets the PGN data that was written.
     *
     * @return string
     */
    public function getPgn(): string
    {
        return $this->pgn;
    }

    /**
     * Writes a single game.
     *
     * @param string $pgn The PGN data of a single game.
     * @return void
     */
    protected function writeGame(string $pgn): void
    {
        $this->pgn .= $pgn;
    }
}
