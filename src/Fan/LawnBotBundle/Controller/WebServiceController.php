<?php

namespace Fan\LawnBotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Symfony\Component\HttpFoundation;
use Fan\LawnBotBundle\Entity\Lawn;
use Fan\LawnBotBundle\Entity\Bot;

class WebServiceController extends Controller implements TransactionWrapController
{

  public function isTransactionWrapped() {
    return 'test' == $this->container->get( 'kernel' )->getEnvironment();
  }

  private function saveEntity($object) {
    $this->getDoctrine()->getManager()->persist($object);
    $this->getDoctrine()->getManager()->flush();
  }

  public function createLawnAction(Request $request) {
    try {
      $size = json_decode($request->getContent(), true);
      $size = sprintf('%s %s', $size['width'], $size['height']);

      $lawn = Lawn::create($size);
      $this->saveEntity($lawn);

      $data = $lawn->__toArrayExclude(array (
        'bots'
      ));

      return new JsonResponse($data);
    } catch ( \Exception $e ) {
      $data = array (
        'error_code' => $e->getCode(),
        'message' => $e->getMessage()
      );
      return new JsonResponse($data, 500);
    }
  }

  public function getLawnAction(Request $request) {
    $id = $request->get('id');
    $data = array (
      'id' => 1,
      'width' => 10
    );

    return new JsonResponse($data);
  }

  public function deleteLawnAction() {
    return $this->render('FanLawnBotBundle:WebService:deleteLawn.html.twig', array ());
    // ...
  }

  public function createBotAction($id) {
    return $this->render('FanLawnBotBundle:WebService:createBot.html.twig', array ());
    // ...
  }

  public function getBotAction($id, $mid) {
    return $this->render('FanLawnBotBundle:WebService:getBot.html.twig', array ());
    // ...
  }

  public function updateBotAction($id, $mid) {
    return $this->render('FanLawnBotBundle:WebService:updateBot.html.twig', array ());
    // ...
  }

  public function deleteBotAction($id, $mid) {
    return $this->render('FanLawnBotBundle:WebService:deleteBot.html.twig', array ());
    // ...
  }

  public function mowLawnAction($id) {
    return $this->render('FanLawnBotBundle:WebService:mowLawn.html.twig', array ());
    // ...
  }
}
