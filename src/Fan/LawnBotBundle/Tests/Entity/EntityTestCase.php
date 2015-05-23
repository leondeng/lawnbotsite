<?php

namespace Fan\LawnBotBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class EntityTestCase extends KernelTestCase
{
  /**
   *
   * @var \Doctrine\ORM\EntityManager
   */
  protected $em;

  /**
   * {@inheritDoc}
   */
  public function setUp() {
    self::bootKernel();
    $this->em = static::$kernel->getContainer()
      ->get('doctrine')
      ->getManager();
    
    $this->em->beginTransaction();
  }

  /**
   * {@inheritDoc}
   */
  protected function tearDown() {
    $this->em->rollback();
    
    parent::tearDown();
    $this->em->close();
  }
}