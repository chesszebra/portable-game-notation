<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Reader;

use ChessZebra\PortableGameNotation\Lexer\StreamLexer;
use InvalidArgumentException;

final class Stream extends AbstractReader
{
    /**
     * Initializes a new instance of this class.
     *
     * @param resource $stream The stream to read from.
     * @throws InvalidArgumentException Thrown when the stream is not valid.
     */
    public function __construct($stream)
    {
        parent::__construct(new StreamLexer($stream));
    }
}
