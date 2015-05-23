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
  const ERROR_CODE_BASE = 900;

  public function needsRollback() {
    return 'test' == $this->container->get( 'kernel' )->getEnvironment();
  }

  private function saveEntity($object) {
    $this->getDoctrine()->getManager()->persist($object);
    $this->getDoctrine()->getManager()->flush();
  }

  public function createLawnAction(Request $request) {
    try {
      $size = json_decode($request->getContent(), true);
      if (count($size) != 2 || !isset($size['width']) || !isset($size['height'])) {
        throw new \Exception('Invalid create lawn request!', self::ERROR_CODE_BASE + 1);
      }

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
    try {
      $id = $request->get('id');

      if (!is_numeric($id)) {
        throw new \Exception('Invalid get lawn request!', self::ERROR_CODE_BASE + 2);
      }

     if ($lawn = $this->getDoctrine()->getManager()->getRepository('Fan\LawnBotBundle\Entity\Lawn')->find($id)) {
        $data = $lawn->__toArray();
        return new JsonResponse($data);
      } else {
        $data = array(
          'message' => 'Lawn not found!'
        );
        return new JsonResponse($data, 404);
      }
    } catch (\Exception $e) {
      $data = array (
        'error_code' => $e->getCode(),
        'message' => $e->getMessage()
      );
      return new JsonResponse($data, 500);
    }
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
