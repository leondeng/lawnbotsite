<?php

namespace Fan\LawnBotBundle\Tests\Entity;

use Fan\LawnBotBundle\Entity\Bot;
use Symfony\Component\Validator\Validation;

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
    $this->setExpectedException('InvalidArgumentException', 'Invalid position!');
    $bot = Bot::create(array('11N'));
  }

  public function testInvalidCommand() {
    $bot = Bot::create(array(2, 3, 'S'));
    $bot->setCommand('sjfewpnfe21');

    $validator = $this->getValidator();
    $errors = $validator->validate($bot);
    $this->assertTrue(count($errors) > 0);
    $this->assertEquals('Invalid command string!', $errors[0]->getMessage());
  }

  public function testEmptyCommand() {
    $bot = Bot::create(array(2, 3, 'S'));
    $bot->setCommand('');

    $validator = $this->getValidator();
    $errors = $validator->validate($bot);
    $this->assertTrue(count($errors) > 0);
    $this->assertEquals('This value should not be blank.', $errors[0]->getMessage());
  }

  public function testUnknowProperty() {
    $this->setExpectedException('Exception', 'Unknown property Fan\LawnBotBundle\Entity\Bot::$unknownProperty!');
    $bot = $this->getBot();
    $bot->setUnknownProperty('invalid');
  }

  public function testCreateInvalidXPostion() {
    $bot = $this->getBot();
    $bot->setX('x');

    $validator = $this->getValidator();
    $errors = $validator->validate($bot);
    $this->assertTrue(count($errors) > 0);
    $this->assertEquals('Invalid x position!', $errors[0]->getMessage());
  }

  public function testCreateInvalidYPostion() {
    $bot = $this->getBot();
    $bot->setY('y');

    $validator = $this->getValidator();
    $errors = $validator->validate($bot);
    $this->assertTrue(count($errors) > 0);
    $this->assertEquals('Invalid y position!', $errors[0]->getMessage());
  }

  public function testCreateInvalidHeading() {
    $bot = $this->getBot();
    $bot->setHeading('999');

    $validator = $this->getValidator();
    $errors = $validator->validate($bot);
    $this->assertTrue(count($errors) > 0);
    $this->assertEquals('Invalid heading!', $errors[0]->getMessage());
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
    $bot = Bot::create(array(1, 2, 'N'));
    $bot->setCommand('LMLMLMLMM');

    return $bot;
  }

  public function getValidator() {
    return Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
  }
}