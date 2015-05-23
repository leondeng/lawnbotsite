<?php

namespace Fan\LawnBotBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WebServiceControllerTest extends WebTestCase
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

  public function testCreatelawn() {
    $client = static::createClient();
    
    $crawler = $client->request('POST', '/lawn', array (), array (), array (
      'CONTENT_TYPE' => 'application/json' 
    ), '{"width":"5", "height":"5"}');
    
    $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));
    $this->assertEquals('{"id":10,"width":"5","height":"5"}', $client->getResponse()
      ->getContent());
    
    $crawler = $client->request('POST', '/lawn', array (), array (), array (
      'CONTENT_TYPE' => 'application/json' 
    ), '{"width":"invalid", "height":"invalid"}');
    
    $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));
    $this->assertEquals('{"width":"5", "height":"5"}', $client->getResponse()
      ->getContent());
  }

  public function testGetlawn() {
    $client = static::createClient();
    
    $crawler = $client->request('GET', '/lawn');
  }

  public function testDeletelawn() {
    $client = static::createClient();
    
    $crawler = $client->request('DELETE', '/lawn');
  }

  public function testCreatebot() {
    $client = static::createClient();
    
    $crawler = $client->request('POST', '/lawn/{id}/mower');
  }

  public function testGetbot() {
    $client = static::createClient();
    
    $crawler = $client->request('GET', '/lawn/{id}/mower/{mid}');
  }

  public function testUpdatebot() {
    $client = static::createClient();
    
    $crawler = $client->request('PUT', '/lawn/{id}/mower/{mid}');
  }

  public function testDeletebot() {
    $client = static::createClient();
    
    $crawler = $client->request('DELETE', '/lawn/{id}/mower/{mid}');
  }

  public function testMowlawn() {
    $client = static::createClient();
    
    $crawler = $client->request('POST', '/lawn/{id}/execute');
  }
}
