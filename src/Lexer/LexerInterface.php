<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\Lexer\Exception\InvalidTokenException;

interface LexerInterface
{
    /**
     * Gets the next token from the lexer.
     *
     * @return TokenInterface|null
     * @throws InvalidTokenException
     */
    public function getNextToken(): ?TokenInterface;

    /**
     * Peeks in the stream what the next token will be.
     *
     * @return TokenInterface|null
     * @throws InvalidTokenException
     */
    public function peekNextToken(): ?TokenInterface;
}
