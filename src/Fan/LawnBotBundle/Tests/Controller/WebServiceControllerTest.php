<?php

namespace Fan\LawnBotBundle\Tests\Controller;

use LeonDeng\TesTube\Symfony\ControllerTestCase;

class WebServiceControllerTest extends ControllerTestCase
{

  public function webserviceAutomatedProvider() {
    return $this->controllerAutomatedProvider(static::getConfigPrefix());
  }

  /**
   * @param string $method HTTP method
   * @param string $uri URI
   * @param array $parameters request parameters
   * @param array $files files posted
   * @param array $server server parameters
   * @param string $content data posted
   * @param unknown $checks
   * @param unknown $test_id
   * @dataProvider webserviceAutomatedProvider
   */
  public function testWebServices($method, $uri, $parameters, $files, $server, $content, $checks, $test_id) {
    return $this->controllerAutomatedTest($method, $uri, $parameters, $files, $server, $content, $checks, $test_id);
  }

  protected static function getConfigPaths() {
    return array(__DIR__.'/specs/');
  }

  protected static function getConfigPrefix() {
    return 'controller_actions';
  }
}
