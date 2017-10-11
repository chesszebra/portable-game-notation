<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Parser;

use ChessZebra\PortableGameNotation\Lexer\Exception\InvalidTokenException;
use ChessZebra\PortableGameNotation\Lexer\LexerInterface;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\TokenIterator;

final class Parser
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
     * Parses a new game based on the lexer.
     *
     * @return TokenIterator|null
     * @throws InvalidTokenException
     */
    public function parse(): ?TokenIterator
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
