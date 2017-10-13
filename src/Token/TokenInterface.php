<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

interface TokenInterface
{
    const COMMENT = 1;
    const END_RESULT = 2;
    const MOVE_NUMBER = 3;
    const NULL_MOVE = 4;
    const NUMERIC_ANNOTATION_GLYPH = 5;
    const RECURSIVE_ANNOTATION_VARIATION = 6;
    const STANDARD_ALGEBRAIC_NOTATION = 7;
    const TAG_PAIR = 8;

    /**
     * Gets the type of this token.
     *
     * @return int
     */
    public function getType(): int;
}
