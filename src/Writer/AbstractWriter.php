<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE.md MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

use ChessZebra\PortableGameNotation\Token\Comment;
use ChessZebra\PortableGameNotation\Token\EndResult;
use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\NullMove;
use ChessZebra\PortableGameNotation\Token\NumericAnnotationGlyph;
use ChessZebra\PortableGameNotation\Token\RecursiveAnnotationVariation;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\Token\TokenIterator;
use InvalidArgumentException;

abstract class AbstractWriter implements WriterInterface
{
    /**
     * @var int
     */
    private $lastMoveNumber;

    /**
     * @var bool
     */
    private $showMoveNumberTwice;

    /**
     * Initializes a new instance of this class.
     *
     * @param bool $showMoveNumberTwice Whether or not to repeat the move number.
     */
    public function __construct(bool $showMoveNumberTwice = false)
    {
        $this->showMoveNumberTwice = $showMoveNumberTwice;
    }

    /**
     * Writes the token iterator.
     *
     * @param TokenIterator $tokenIterator The token iterator to write.
     * @return void
     */
    public function write(TokenIterator $tokenIterator): void
    {
        $tokens = [];

        /** @var TokenInterface $token */
        foreach ($tokenIterator as $token) {
            $value = $this->writeToken($token);

            if ($value) {
                $tokens[] = $value;
            }
        }

        $result = '';
        $line = '';

        /** @var string $token */
        foreach ($tokens as $token) {
            if ($token && $token[strlen($token) - 1] === "\n") {
                $result .= $token;
                $line = '';
                continue;
            }

            if (strlen($line) + strlen($token) > 79) {
                $result .= trim($line) . "\n";
                $line = '';
            }

            $line .= $token . ' ';
        }

        $result .= $line;

        $this->writeGame(trim($result, ' ') . "\n\n");
    }

    /**
     * Writes a single game.
     *
     * @param string $pgn The PGN data of a single game.
     * @return void
     */
    abstract protected function writeGame(string $pgn): void;

    private function writeToken(TokenInterface $token)
    {
        switch (true) {
            case $token instanceof Comment:
                return $this->writeComment($token);

            case $token instanceof EndResult:
                return $this->writeEndResult($token);

            case $token instanceof MoveNumber:
                return $this->writeMoveNumber($token);

            case $token instanceof NullMove:
                return $this->writeNullMove($token);

            case $token instanceof NumericAnnotationGlyph:
                return $this->writeNumericAnnotationGlyph($token);

            case $token instanceof RecursiveAnnotationVariation:
                return $this->writeRecursiveAnnotationVariation($token);

            case $token instanceof StandardAlgebraicNotation:
                return $this->writeStandardAlgebraicNotation($token);

            case $token instanceof TagPair:
                return $this->writeTagPair($token);

            default:
                break;
        }

        throw new InvalidArgumentException('Invalid node type: ' . get_class($token));
    }

    private function writeComment(Comment $node)
    {
        return '{' . $node->getComment() . '}';
    }

    private function writeEndResult(EndResult $node)
    {
        return $node->getResult();
    }

    private function writeMoveNumber(MoveNumber $node)
    {
        if ($node->getNumber() === $this->lastMoveNumber) {
            return $this->showMoveNumberTwice ? $node->getNumber() . '...' : '';
        }

        $this->lastMoveNumber = $node->getNumber();

        return $node->getNumber() . '.';
    }

    private function writeNullMove(/** @scrutinizer ignore-unused */ NullMove $node)
    {
        return '--';
    }

    private function writeNumericAnnotationGlyph(NumericAnnotationGlyph $node)
    {
        return '$' . $node->getValue();
    }

    private function writeRecursiveAnnotationVariation(RecursiveAnnotationVariation $node)
    {
        if ($node->isOpening()) {
            return '(';
        }

        return ')';
    }

    private function writeStandardAlgebraicNotation(StandardAlgebraicNotation $node)
    {
        return $node->getStandardAlgebraicNotation()->getValue();
    }

    private function writeTagPair(TagPair $node)
    {
        return sprintf('[%s "%s"]' . "\n", $node->getName(), $node->getValue());
    }
}
