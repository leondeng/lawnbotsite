<?php

namespace Fan\LawnBotBundle\Tests\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Fan\LawnBotBundle\Entity\Lawn;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LawnFixture extends AbstractFixture implements DependentFixtureInterface
{
  public function load(ObjectManager $manager) {
    $lawn = Lawn::create('5 5');
    $botA = $this->getReference('botA');
    $lawn->addBot($botA);
    $botB = $this->getReference('botB');
    $lawn->addBot($botB);

    $manager->persist($lawn);
    $this->addReference('lawn', $lawn);
    $manager->flush();
  }

  public function getDependencies() {
    return array(
      'Fan\LawnBotBundle\Tests\Fixtures\BotFixture',
     );
  }
}
