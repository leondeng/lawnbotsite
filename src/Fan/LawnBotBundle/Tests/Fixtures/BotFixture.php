<?php

namespace Fan\LawnBotBundle\Tests\Fixtures;

use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Fan\LawnBotBundle\Entity\Bot;
use Doctrine\Common\Persistence\ObjectManager;

class BotFixture implements SharedFixtureInterface
{
private $referenceRepository;

  public function setReferenceRepository(ReferenceRepository $referenceRepository) {
    $this->referenceRepository = $referenceRepository;
  }

  public function load(ObjectManager $manager) {
    $botA = $this->getBotA();
    $botB = $this->getBotB();

    $manager->persist($botA);
    $this->referenceRepository->addReference('botA', $botA);
    $manager->persist($botB);
    $this->referenceRepository->addReference('botB', $botB);
    $manager->flush();
  }

  public function getBotA() {
    $bot = Bot::create(array(1, 2, 'N'));
    $bot->setCommand('LMLMLMLMM');
    return $bot;
  }

  public function getBotB() {
    $bot = Bot::create(array(3, 3, 'E'));
    $bot->setCommand('MMRMMRMRRM');
    return $bot;
  }
}
