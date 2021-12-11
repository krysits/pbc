<?php

namespace Krysits\PBC;

require_once("./Block.php");

/**
 *  Da Chain
 */
class BlockChain
{
    /**
     * @var int
     */
    protected int $difficulty;

    /**
     * @var Block[]
     */
    public array $chain;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chain = [$this->createGenesisBlock()];
        $this->difficulty = 4;
    }

    /**
     * @return Block
     */
    private function createGenesisBlock(): Block
    {
        return new Block(0, strtotime("2022-01-01"), "Genesis Block");
    }

    /**
     * Gets the last block of the chain.
     */
    public function getLastBlock(): Block
    {
        return $this->chain[count($this->chain)-1];
    }

    /**
     * @param $block
     * @return void
     */
    public function push($block): void
    {
        $block->previousHash = $this->getLastBlock()->hash;
        $this->mine($block);
        $this->chain[] = $block;
    }

    /**
     * @param $block
     * @return void
     */
    public function mine($block): void
    {
        while (strpos($block->hash, str_repeat("0", $this->difficulty)) !== 0) {
            $block->nonce++;
            $block->hash = $block->calculateHash();
        }

        echo "Block mined: ".$block->hash.PHP_EOL;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        for ($i = 1, $iMax = count($this->chain); $i < $iMax; $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i-1];

            if ($currentBlock->hash !== $currentBlock->calculateHash()) {
                return false;
            }

            if ($currentBlock->previousHash !== $previousBlock->hash) {
                return false;
            }
        }

        return true;
    }
}
