<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

use ChessZebra\PortableGameNotation\TokenIterator;

/**
 * An interface that should be implemented by all PGN writers.
 */
interface WriterInterface
{
    /**
     * Writes the token iterator.
     *
     * @param TokenIterator $tokenIterator The token iterator to write.
     * @return void
     */
    public function write(TokenIterator $tokenIterator): void;
}
