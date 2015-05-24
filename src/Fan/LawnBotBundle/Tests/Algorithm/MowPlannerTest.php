<?php

namespace Fan\LawnBotBundle\Tests\Algorithm;

use Fan\LawnBotBundle\Entity\Lawn;
use Fan\LawnBotBundle\Entity\Bot;
use Fan\LawnBotBundle\Algorithm\MowPlanner;

class MowPlannerTest extends \PHPUnit_Framework_TestCase
{

  public function testCreate() {
    $mp = $this->getMowPlanner();
    $this->assertInstanceOf('Fan\LawnBotBundle\Algorithm\MowPlanner', $mp);
  }

  public function testCreateInvalidInput() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid params!');
    $mp = MowPlanner::create(array('Invalid'));
  }

  public function testCreateInvalidLawn() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid width!');
    $mp = MowPlanner::create(array(
      's',
      's',
      6
    ));
  }

  public function testCreateInvalidBotsNumber() {
    $this->setExpectedException('InvalidArgumentException', 'Invalid bots number!');
    $mp = MowPlanner::create(array(
      4,
      4,
      'invalid'
    ));
  }

  public function testGenerateInstructions() {
    $mp = $this->getMowPlanner();
    $instructions = $mp->generateInstructions();
    $this->assertTrue(is_array($instructions));
  }

  public function testTooManyBots() {
    $this->setExpectedException('Exception', 'Invalid bots number, too many!');
    $mp = MowPlanner::create(array(
      4,
      4,
      26
    ));
  }

  public function getMowPlanner() {
    $mp = MowPlanner::create(array(
      5,
      5,
      3
    ));

    return $mp;
  }
}