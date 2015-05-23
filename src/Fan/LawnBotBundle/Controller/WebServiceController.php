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
        throw new \Exception('Invalid lawn id!', self::ERROR_CODE_BASE + 2);
      }

      $em = $this->getDoctrine()->getManager();
      if ($lawn = $em->getRepository('Fan\LawnBotBundle\Entity\Lawn')->find($id)) {
        return new JsonResponse($lawn->__toArray());
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
    try {
      $id = $request->get('id');

      if (! is_numeric($id)) {
        throw new \Exception('Invalid lawn id!', self::ERROR_CODE_BASE + 2);
      }

      $em = $this->getDoctrine()->getManager();
      if ($lawn = $em->getRepository('Fan\LawnBotBundle\Entity\Lawn')->find($id)) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($lawn);
        $em->flush();

        return new JsonResponse(array('status' => 'ok'));
      } else {
        $data = array(
          'message' => 'Lawn not found!'
        );
        return new JsonResponse($data, 404);
      }
    } catch ( \Exception $e ) {
      $data = array (
        'error_code' => $e->getCode(),
        'message' => $e->getMessage()
      );
      return new JsonResponse($data, 500);
    }
  }

  public function createBotAction($id) {

  }

  public function getBotAction($id, $mid) {

  }

  public function updateBotAction($id, $mid) {

  }

  public function deleteBotAction($id, $mid) {

  }

  public function mowLawnAction($id) {

  }
}
