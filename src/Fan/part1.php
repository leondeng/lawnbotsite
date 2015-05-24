<?php

use Fan\LawnBotBundle\Entity\Lawn;
use Fan\LawnBotBundle\Entity\Bot;

include_once __DIR__.'/../../vendor/autoload.php';

$data_file = __DIR__.'/data/part1/input.txt';
$lines = array();
if (($handle = fopen($data_file, 'r')) !== FALSE) {
  while (($row = fgets($handle)) !== FALSE) 	{
    $lines[] = trim($row);
  }
  fclose($handle);
}

//print_r($lines);

$size = array_shift($lines);
$lawn = Lawn::create($size);

$i = 0;
do {
  $bot = Bot::create($lines[$i], $lines[$i+1]);
  $lawn->addBot($bot);
  $i += 2;
} while ($i < count($lines));

foreach ($lawn->getBots() as $bot) {
  echo "\t".$bot->getFinalPosition().PHP_EOL;
}
