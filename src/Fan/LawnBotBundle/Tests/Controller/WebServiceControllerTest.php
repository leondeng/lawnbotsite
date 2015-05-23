<?php

namespace Fan\LawnBotBundle\Tests\Controller;

class WebServiceControllerTest extends ControllerTestCase
{

  public function webserviceAutomatedProvider() {
    return $this->controllerAutomatedProvider(static::getConfigPrefix());
  }

  /**
   * @param array $url [$path, $route, $params, $ajax] url info
   * @param unknown $auth_type
   * @param unknown $data
   * @param unknown $files
   * @param unknown $checks
   * @param unknown $test_id
   * @dataProvider webserviceAutomatedProvider
   */
  public function testWebServices($method, $uri, $parameters, $files, $server, $content, $checks, $test_id) {
    return $this->controllerAutomatedTest($method, $uri, $parameters, $files, $server, $content, $checks, $test_id);
  }

  /* public function testCreatelawn() {
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
  } */

  protected static function getConfigPaths() {
    return array(__DIR__.'/specs/');
  }

  protected static function getConfigPrefix() {
    return 'controller_actions';
  }
}
