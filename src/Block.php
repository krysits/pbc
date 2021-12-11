<?php

namespace Krysits\PBC;

class Block
{
    /**
     * @var int
     */
    public int $nonce;

    /**
     * @param $index
     * @param $timestamp
     * @param $data
     * @param $previousHash
     */
    public function __construct($index, $timestamp, $data, $previousHash = null)
    {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
        $this->nonce = 0;
    }

    /**
     * @return false|string
     */
    public function calculateHash()
    {
        return hash("sha256",
                    $this->index
                    .$this->previousHash
                    .$this->timestamp
                    .((string)$this->data)
                    .$this->nonce
        );
    }
}
