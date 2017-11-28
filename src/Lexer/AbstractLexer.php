<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

use ChessZebra\PortableGameNotation\Token\Comment;
use ChessZebra\PortableGameNotation\Token\EndResult;
use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\Token\NullMove;
use ChessZebra\PortableGameNotation\Token\NumericAnnotationGlyph;
use ChessZebra\PortableGameNotation\Token\RecursiveAnnotationVariation;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\Lexer\Exception\InvalidTokenException;
use ChessZebra\StandardAlgebraicNotation\Notation;

abstract class AbstractLexer implements LexerInterface
{
    /**
     * @var string
     */
    protected $buffer;

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        $this->buffer = '';
    }

    /**
     * Gets the next token from the lexer.
     *
     * @return TokenInterface|null
     * @throws InvalidTokenException
     */
    public function getNextToken(): ?TokenInterface
    {
        if (!$this->buffer) {
            return null;
        }

        // Match a tag pair:
        if (preg_match('/^\s*\[(.+?)(\s+"(.+?)")?\]/s', $this->buffer, $matches) !== 0) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new TagPair($matches[1], $matches[3]);
        }

        // Match an end result:
        if (preg_match('/^\s*(\*|1-0|0-1|1\/2-1\/2)\s*/', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new EndResult($matches[1]);
        }

        // Match a move number:
        if (preg_match('/^\s*([0-9]+)\.+\s*/', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new MoveNumber((int)$matches[1]);
        }

        // Match a SAN (castling):
        if (preg_match('/^\s*(O-O(?:-O)?[\+\-\!\#\=\?]*)\s*/s', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new StandardAlgebraicNotation(new Notation($matches[1]));
        }

        // Match a SAN:
        if (preg_match('/^\s*([a-zA-Z][a-zA-Z0-9\+\-\!\#\=\?]+)\s*/s', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new StandardAlgebraicNotation(new Notation($matches[1]));
        }

        // Match a comment:
        if (preg_match('/^\s*\{(.+?)\}\s*/s', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new Comment($matches[1]);
        }

        // Match a Recursive Annotation Variation:
        if (preg_match('/^\s*[\(|\)]/s', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new RecursiveAnnotationVariation(trim($matches[0]) === '(');
        }

        // Match a Numeric Annotation Glyph
        if (preg_match('/^\s*\$([0-9]+)\s*/', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new NumericAnnotationGlyph((int)trim($matches[1]));
        }

        // Match a null move
        if (preg_match('/^\s*--\s*/', $this->buffer, $matches)) {
            $this->buffer = substr($this->buffer, strlen($matches[0]));
            return new NullMove();
        }

        throw InvalidTokenException::createForBuffer($this->buffer);
    }

    /**
     * Peeks in the stream what the next token will be.
     *
     * @return TokenInterface|null
     * @throws InvalidTokenException
     */
    public function peekNextToken(): ?TokenInterface
    {
        $buffer = $this->buffer;

        $token = $this->getNextToken();

        $this->buffer = $buffer;

        return $token;
    }
}
