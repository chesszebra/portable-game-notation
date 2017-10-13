<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Reader;

use ChessZebra\PortableGameNotation\Lexer\Exception\InvalidTokenException;
use ChessZebra\PortableGameNotation\Lexer\LexerInterface;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\Token\TokenIterator;

abstract class AbstractReader implements ReaderInterface
{
    /**
     * @var LexerInterface
     */
    private $lexer;

    /**
     * Initializes a new instance of this class.
     *
     * @param LexerInterface $lexer
     */
    public function __construct(LexerInterface $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * Reads a collection of tokens that form a game.
     *
     * @return TokenIterator|null Returns null when no tokens are left; an TokenIterator otherwise.
     * @throws InvalidTokenException Thrown when an invalid token was found during reading.
     */
    public function read(): ?TokenIterator
    {
        $token = $this->lexer->peekNextToken();

        if ($token === null) {
            return null;
        }

        $tokens = [];

        while ($token instanceof TagPair) {
            $tokens[] = $token;

            $token = $this->lexer->getNextToken();
        }

        while ($token && !$token instanceof TagPair) {
            $tokens[] = $token;

            $token = $this->lexer->getNextToken();
        }

        return new TokenIterator($tokens);
    }
}
