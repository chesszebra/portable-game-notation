<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

final class RecursiveAnnotationVariation implements TokenInterface
{
    /**
     * @var bool
     */
    private $opening;

    /**
     * Initializes a new instance of this class.
     *
     * @param bool $opening
     */
    public function __construct(bool $opening)
    {
        $this->opening = $opening;
    }

    /**
     * Gets the value of field "opening".
     *
     * @return bool
     */
    public function isOpening(): bool
    {
        return $this->opening;
    }

    /**
     * Gets the type of this token.
     *
     * @return int
     */
    public function getType(): int
    {
        return TokenInterface::RECURSIVE_ANNOTATION_VARIATION;
    }
}
