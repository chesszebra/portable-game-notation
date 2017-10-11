<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer;

use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\Lexer\Exception\InvalidTokenException;
use InvalidArgumentException;

/**
 * Reads PGN games from a stream.
 */
final class StreamLexer extends AbstractLexer
{
    /**
     * @var resource
     */
    private $stream;

    /**
     * Initializes a new instance of this class.
     *
     * @param resource $stream The stream to read from.
     * @throws InvalidArgumentException Thrown when the stream is invalid.
     */
    public function __construct($stream)
    {
        parent::__construct();

        if (!is_resource($stream)) {
            throw new InvalidArgumentException('Invalid stream provided.');
        }

        $this->stream = $stream;
    }

    public function getOffset()
    {
        $position = ftell($this->stream);

        if ($this->buffer) {
            $position -= strlen($this->buffer);
        }

        return $position;
    }

    /**
     * Gets the next token from the lexer.
     *
     * @return TokenInterface|null
     * @throws InvalidTokenException
     */
    public function getNextToken(): ?TokenInterface
    {
        if (feof($this->stream)) {
            return null;
        }

        // Make sure the buffer is always filled.
        if (!$this->buffer || strlen($this->buffer) < 4096) {
            $this->buffer .= fread($this->stream, 4096);
        }

        return parent::getNextToken();
    }

    /**
     * Peeks in the stream what the next token will be.
     *
     * @return TokenInterface|null
     * @throws InvalidTokenException
     */
    public function peekNextToken(): ?TokenInterface
    {
        $offset = ftell($this->stream);
        $buffer = $this->buffer;

        $token = $this->getNextToken();

        fseek($this->stream, $offset);
        $this->buffer = $buffer;

        return $token;
    }
}
