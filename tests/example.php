<?php

namespace Krysits\PBC\tests;

use Krysits\PBC\Block;
use Krysits\PBC\BlockChain;

require_once(__DIR__ . '/../src/BlockChain.php');

$testCoin = new BlockChain;

echo "mining block 1...\n";
$testCoin->push(new Block(1, time(), "amount: 4"));

echo "mining block 2...\n";
$testCoin->push(new Block(2, time(), "amount: 10"));

echo json_encode($testCoin, JSON_PRETTY_PRINT);
