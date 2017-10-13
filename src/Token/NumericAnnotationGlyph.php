<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

final class NumericAnnotationGlyph implements TokenInterface
{
    /**
     * @var int
     */
    private $value;

    /**
     * Initializes a new instance of this class.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Gets the value of field "value".
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Gets the type of this token.
     *
     * @return int
     */
    public function getType(): int
    {
        return TokenInterface::NUMERIC_ANNOTATION_GLYPH;
    }
}
