<?php

namespace Fan\LawnBotBundle\Tests\Entity;

use Fan\LawnBotBundle\Entity\Lawn;
use Fan\LawnBotBundle\Entity\Bot;

class LawnTest extends \PHPUnit_Framework_TestCase
{

  public function testCreate() {
    $lawn = $this->getLawn();
    $this->assertInstanceOf('Fan\LawnBotBundle\Entity\Lawn', $lawn);
    $this->assertEquals(5, $lawn->getWidth());
    $this->assertEquals(5, $lawn->getHeight());
    $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $lawn->getBots());
  }

  public function testCreateInvalidSize() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid size string!');
    $lawn = Lawn::create('xxx');
  }

  public function testCreateInvalidWidth() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid width!');
    $lawn = $this->getLawn();
    $lawn->setWidth('width');
  }

  public function testCreateInvalidPostion() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid height!');
    $lawn = $this->getLawn();
    $lawn->setHeight('height');
  }

  public function testToString() {
    $lawn = $this->getLawn();
    $this->assertEquals('5 5', (string) $lawn);
    
    $lawn->setWidth(7);
    $lawn->setHeight(14);
    $this->assertEquals('7 14', (string) $lawn);
  }

  public function testAddBot() {
    $lawn = $this->getLawn();
    $lawn->addBot($this->getBotA());
    $lawn->addBot($this->getBotB());
    
    $this->assertEquals(2, count($lawn->getBots()));
  }

  public function testRemovebot() {
    $lawn = $this->getLawn();
    $botA = $this->getBotA();
    $lawn->addBot($botA);
    $botB = $this->getBotB();
    $lawn->addBot($botB);
    $lawn->removeBot($botA);
    
    $bots = $lawn->getBots();
    $this->assertEquals(1, count($bots));
    $botOnLawn = $bots->first();
    $this->assertInstanceOf('Fan\LawnBotBundle\Entity\Bot', $botOnLawn);
    $this->assertEquals(3, $botOnLawn->getX());
    $this->assertEquals(3, $botOnLawn->getY());
    $this->assertEquals('MMRMMRMRRM', $botOnLawn->getCommand());
  }

  public function testOutWidthBot() {
    $this->setExpectedException('Exception', 'Invalid x postion of bot, out of width of lawn!');
    $lawn = $this->getLawn();
    $bot = $this->getBotA();
    $bot->setX(6);
    $lawn->addBot($bot);
  }

  public function testOutHeightBot() {
    $this->setExpectedException('Exception', 'Invalid y postion of bot, out of height of lawn!');
    $lawn = $this->getLawn();
    $bot = $this->getBotA();
    $bot->setY(9);
    $lawn->addBot($bot);
  }

  public function testOverStepBot() {
    $this->setExpectedException('Exception', 'Bad command of bot, overstep of boundary detected!');
    $lawn = $this->getLawn();
    $bot = $this->getBotA();
    $bot->setCommand('LMMLMMLM'); // print_r($bot->getSequence()); die();
    $lawn->addBot($bot);
  }

  public function testCollisionBot() {
    $this->setExpectedException('Exception', 'Bad command of bot, bots collision detected!');
    $lawn = $this->getLawn();
    $botA = $this->getBotA();
    $lawn->addBot($botA);
    
    $botC = $this->getBotC();
    $lawn->addBot($botC);
  }

  public function getLawn() {
    return Lawn::create('5 5');
  }

  public function getBotA() {
    return Bot::create('1 2 N', 'LMLMLMLMM');
  }

  public function getBotB() {
    return Bot::create('3 3 E', 'MMRMMRMRRM');
  }

  public function getBotC() {
    return Bot::create('0 3 W', 'LMMMLMMLM');
  }
}