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
    return Bot::create('1 2 N', 'LMLMLMLMM');
  }

  public function getBotB() {
    return Bot::create('3 3 E', 'MMRMMRMRRM');
  }
}
