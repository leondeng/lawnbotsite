<?php

namespace Fan\LawnBotBundle\EventListener;

use Fan\LawnBotBundle\Controller\SerializeController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/*
 * @TODO: better to use @ParameterConvert for this?
 */

class SerializeListener
{
  private $encoders;
  private $normalizers;
  private $serializer;
  private $requestContent;

  public function __construct() {
    $this->encoders = array (
      new XmlEncoder(),
      new JsonEncoder()
    );
    $this->normalizers = array (
      new GetSetMethodNormalizer()
    );

    $this->serializer = new Serializer($this->normalizers, $this->encoders);
  }

  public function onKernelController(FilterControllerEvent $event) {
    $controller = $event->getController();

    /*
     * $controller passed can be either a class or a Closure.
     * This is not usual in Symfony but it may happen.
     * If it is a class, it comes in array format
     */
    if (! is_array($controller)) {
      return;
    }

    if ($controller[0] instanceof SerializeController) {
      $controller[0]->setSal($this);

      if ($content = $event->getRequest()
        ->getContent()) {
        $this->requestContent = $this->serializer->decode($content, 'json');
      }
    }
  }

  public function getRequestContent() {
    return $this->requestContent;
  }

  public function serialize($data, $format, array $context = array()) {
    return $this->serializer->serialize($data, $format, $context);
  }

  public function normalize($data, $format, array $context = array()) {
    return $this->serializer->normalize($data, $format, $context);
  }
}