<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Token;

use ChessZebra\StandardAlgebraicNotation\Notation;

final class StandardAlgebraicNotation implements TokenInterface
{
    /**
     * @var Notation
     */
    private $standardAlgebraicNotation;

    /**
     * Initializes a new instance of this class.
     *
     * @param Notation $standardAlgebraicNotation
     */
    public function __construct(Notation $standardAlgebraicNotation)
    {
        $this->standardAlgebraicNotation = $standardAlgebraicNotation;
    }

    /**
     * Gets the value of field "standardAlgebraicNotation".
     *
     * @return Notation
     */
    public function getStandardAlgebraicNotation(): Notation
    {
        return $this->standardAlgebraicNotation;
    }

    public function getType(): int
    {
        return TokenInterface::STANDARD_ALGEBRAIC_NOTATION;
    }
}
