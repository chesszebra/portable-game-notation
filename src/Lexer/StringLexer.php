<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

/**
 * Reads PGN games from a string.
 */
final class StringLexer extends AbstractLexer
{
    /**
     * Initializes a new instance of this class.
     *
     * @param string $buffer
     */
    public function __construct(string $buffer)
    {
        parent::__construct();

        $this->buffer = $buffer;
    }
}
