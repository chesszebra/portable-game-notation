<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Reader;

use ChessZebra\PortableGameNotation\Lexer\StringLexer;

final class StringReader extends AbstractReader
{
    /**
     * Initializes a new instance of this class.
     *
     * @param string $data The data to read.
     */
    public function __construct(string $data)
    {
        parent::__construct(new StringLexer($data));
    }
}
