<?php

namespace Krysits\PBC\tests;

use Krysits\PBC\Block;
use Krysits\PBC\BlockChain;

require_once(__DIR__ . '/../src/BlockChain.php');

/*
Hack the chain, changing values in the first block.
*/

$testCoin = new BlockChain;

echo "mining block 1...\n";
$testCoin->push(new Block(1, time(), "amount: 4"));

echo "mining block 2...\n";
$testCoin->push(new Block(2, time(), "amount: 10"));

echo "Chain valid: ".($testCoin->isValid() ? "true" : "false")."\n";

echo "Changing second block...\n";
$testCoin->chain[1]->data = "amount: 1000";
$testCoin->chain[1]->hash = $testCoin->chain[1]->calculateHash();

echo "Chain valid: ".($testCoin->isValid() ? "true" : "false")."\n";
