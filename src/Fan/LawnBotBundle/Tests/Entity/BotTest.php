<?php

namespace Fan\LawnBotBundle\Tests\Entity;

use Fan\LawnBotBundle\Entity\Bot;

class BotTest extends EntityTestCase
{

  public function testCreate() {
    $bot = $this->getBot();
    $this->assertInstanceOf('Fan\LawnBotBundle\Entity\Bot', $bot);
    $this->em->persist($bot);
    $this->em->flush();

    $botFromDb = $this->em->getRepository('Fan\LawnBotBundle\Entity\Bot')
      ->findOneBy(array (
      'command' => 'LMLMLMLMM'
    ));

    $this->assertInstanceOf('Fan\LawnBotBundle\Entity\Bot', $botFromDb);
    $this->assertEquals(1, $botFromDb->getX());
    $this->assertEquals(2, $botFromDb->getY());
    $this->assertEquals('LMLMLMLMM', $botFromDb->getCommand());
  }

  public function testCreateInvalidPosition() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid position string!');
    $bot = Bot::create('11N', 'S62d8');
  }

  public function testCreateInvalidCommand() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid command string!');
    $bot = Bot::create('2 3 S', 'sjfewpnfe21');
  }

  public function testCreateEmptyCommand() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid command string!');
    $bot = Bot::create('2 3 S', '');
  }

  public function testUnknowProperty() {
    $this->setExpectedException('Exception', 'Unknown property Fan\LawnBotBundle\Entity\Bot::$unknownProperty!');
    $bot = $this->getBot();
    $bot->setUnknownProperty('invalid');
  }

  public function testCreateInvalidXPostion() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid x position!');
    $bot = $this->getBot();
    $bot->setX('x');
  }

  public function testCreateInvalidPostion() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid y position!');
    $bot = $this->getBot();
    $bot->setY('y');
  }

  public function testCreateInvalidHeading() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid heading!');
    $bot = $this->getBot();
    $bot->setHeading('999');
  }

  public function testToString() {
    $bot = $this->getBot();
    $this->assertEquals('1 2 N', (string) $bot);

    $bot->setX(3);
    $bot->setY(5);
    $bot->setHeading('W');
    $this->assertEquals('3 5 W', (string) $bot);
  }

  public function testFinalPosition() {
    $bot = $this->getBot();
    $this->assertEquals('1 3 N', $bot->getFinalPosition());

    $bot->reset();
    $bot->setX(3);
    $bot->setY(3);
    $bot->setHeading('E');
    $bot->setCommand('MMRMMRMRRM');
    $this->assertEquals('5 1 E', $bot->getFinalPosition());
  }

  public function getBot() {
    $bot = Bot::create('1 2 N', 'LMLMLMLMM');

    return $bot;
  }
}