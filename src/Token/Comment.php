<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

final class Comment extends AbstractToken
{
    /**
     * @var string
     */
    private $comment;

    /**
     * Initializes a new instance of this class.
     *
     * @param string $comment
     */
    public function __construct(string $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Gets the value of field "comment".
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Gets the type of this token.
     *
     * @return int
     */
    public function getType(): int
    {
        return TokenInterface::COMMENT;
    }
}
