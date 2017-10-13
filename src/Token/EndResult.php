<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

final class EndResult implements TokenInterface
{
    /**
     * @var string
     */
    private $result;

    /**
     * Initializes a new instance of this class.
     *
     * @param string $result
     */
    public function __construct(string $result)
    {
        $this->result = $result;
    }

    /**
     * Gets the end result that is represented.
     *
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * Gets the type of this token.
     *
     * @return int
     */
    public function getType(): int
    {
        return TokenInterface::END_RESULT;
    }
}
