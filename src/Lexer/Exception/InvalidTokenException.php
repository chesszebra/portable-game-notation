<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Lexer\Exception;

use RuntimeException;

/**
 * An exception that is thrown when a token was found that could not be matched.
 */
final class InvalidTokenException extends RuntimeException
{
    /**
     * Creates a new exception for the given buffer.
     *
     * @param string $buffer The buffer to create the exception for.
     * @return InvalidTokenException
     */
    public static function createForBuffer(string $buffer): InvalidTokenException
    {
        $msg = sprintf('An invalid token was given. Buffer: "%s"', $buffer);

        return new self($msg);
    }
}
