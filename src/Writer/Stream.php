<?php declare(strict_types=1);
/**
 * portable-game-notation (https://github.com/chesszebra/portable-game-notation)
 *
 * @link https://github.com/chesszebra/portable-game-notation for the canonical source repository
 * @copyright Copyright (c) 2017 Chess Zebra (https://chesszebra.com)
 * @license https://github.com/chesszebra/portable-game-notation/blob/master/LICENSE MIT
 */

namespace ChessZebra\PortableGameNotation\Writer;

use ChessZebra\PortableGameNotation\Token\EndResult;
use ChessZebra\PortableGameNotation\Token\MoveNumber;
use ChessZebra\PortableGameNotation\Token\StandardAlgebraicNotation;
use ChessZebra\PortableGameNotation\Token\TagPair;
use ChessZebra\PortableGameNotation\Token\TokenInterface;
use ChessZebra\PortableGameNotation\TokenIterator;
use InvalidArgumentException;

final class Stream implements WriterInterface
{
    /**
     * @var resource
     */
    private $resource;

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
     * @param resource $resource The resource to write to.
     * @param bool $showMoveNumberTwice Whether or not to repeat the move number.
     */
    public function __construct($resource, bool $showMoveNumberTwice = false)
    {
        $this->resource = $resource;
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
        $result = '';
        $line = '';

        /** @var TokenInterface $token */
        foreach ($tokenIterator as $token) {
            $value = $this->writeToken($token);

            if ($value && $value[strlen($value) - 1] === "\n") {
                $result .= $value;
                $line = '';
                continue;
            }

            if (strlen($line) + strlen($value) > 79) {
                $result .= $line . "\n";
                $line = '';
            }

            $line .= $value;
        }

        $result .= $line . "\n\n";

        fwrite($this->resource, $result);
    }

    private function writeToken(TokenInterface $token)
    {
        switch (true) {
            case $token instanceof EndResult:
                return $this->writeEndResult($token);

            case $token instanceof TagPair:
                return $this->writeTagPair($token);

            case $token instanceof MoveNumber:
                return $this->writeMoveNumber($token);

            case $token instanceof StandardAlgebraicNotation:
                return $this->writeStandardAlgebraicNotation($token);

            default:
                break;
        }

        throw new InvalidArgumentException('Invalid node type: ' . get_class($token));
    }

    private function writeTagPair(TagPair $node)
    {
        return sprintf('[%s "%s"]' . "\n", $node->getName(), $node->getValue());
    }

    private function writeMoveNumber(MoveNumber $node)
    {
        if ($node->getNumber() === $this->lastMoveNumber) {
            return $this->showMoveNumberTwice ? $node->getNumber() . '... ' : '';
        }

        $this->lastMoveNumber = $node->getNumber();

        return $node->getNumber() . '. ';
    }

    private function writeStandardAlgebraicNotation(StandardAlgebraicNotation $node)
    {
        return $node->getStandardAlgebraicNotation()->getValue() . ' ';
    }

    private function writeEndResult(EndResult $node)
    {
        return $node->getResult();
    }
}
