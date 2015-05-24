<?php

use Fan\LawnBotBundle\Entity\Lawn;
use Fan\LawnBotBundle\Entity\Bot;
use Fan\LawnBotBundle\Algorithm\MowPlanner;

include_once __DIR__.'/../../vendor/autoload.php';

$data_file = __DIR__.'/data/part2/input.txt';
$lines = array();
if (($handle = fopen($data_file, 'r')) !== FALSE) {
  while (($row = fgets($handle)) !== FALSE) 	{
    $lines[] = trim($row);
  }
  fclose($handle);
}

$params = explode(' ', $lines[0]);

$mp = MowPlanner::create($params);

print_r($mp->generateInstructions());

