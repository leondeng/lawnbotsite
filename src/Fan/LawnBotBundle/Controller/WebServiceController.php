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
        throw new \Exception('Invalid lawn data!', self::ERROR_CODE_BASE + 1);
      }

      $size = sprintf('%s %s', $size['width'], $size['height']);

      $lawn = Lawn::create($size);
      $this->saveEntity($lawn);

      $data = $lawn->__toArrayExclude(array('bots'));

      return new JsonResponse($data);
    } catch ( \Exception $e ) {
      return $this->err500($e);
    }
  }

  public function getLawnAction($id) {
    try {
      //$id = $request->get('id');

      if (!is_numeric($id)) {
        throw new \Exception('Invalid lawn id!', self::ERROR_CODE_BASE + 2);
      }

      $em = $this->getDoctrine()->getManager();
      if ($lawn = $em->getRepository('Fan\LawnBotBundle\Entity\Lawn')->find($id)) {
        return new JsonResponse($lawn->__toArray());
      } else {
        return $this->err404('Lawn not found!');
     }
    } catch (\Exception $e) {
      return $this->err500($e);
    }
  }

  public function deleteLawnAction($id) {
    try {
      //$id = $request->get('id');

      if (!is_numeric($id)) {
        throw new \Exception('Invalid lawn id!', self::ERROR_CODE_BASE + 2);
      }

      $em = $this->getDoctrine()->getManager();
      if ($lawn = $em->getRepository('Fan\LawnBotBundle\Entity\Lawn')->find($id)) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($lawn);
        $em->flush();

        return new JsonResponse(array('status' => 'ok'));
      } else {
        return $this->err404('Lawn not found!');
      }
    } catch ( \Exception $e ) {
      return $this->err500($e);
    }
  }

  public function createBotAction(Request $request) {
    try {
      $id = $request->get('id');

      if (!is_numeric($id)) {
        throw new \Exception('Invalid lawn id!', self::ERROR_CODE_BASE + 2);
      }

      $em = $this->getDoctrine()->getManager();
      if ($lawn = $em->getRepository('Fan\LawnBotBundle\Entity\Lawn')->find($id)) {
        $data = json_decode($request->getContent(), true);
        if (count($size) != 4 || !isset($data['x']) || !isset($data['y']) || !isset($data['heading']) || !isset($data['command'])) {
          throw new \Exception('Invalid bot data!', self::ERROR_CODE_BASE + 11);
        }
        $position = sprintf('%s %s %s', $data['x'], $data['y'], $data['heading']);
        $command = $data['command'];
        $bot = Bot::create($postion, $command);

        $lawn->addBot($bot);
        $this->saveEntity($lawn);

        return new JsonResponse($bot->__toArray());
      } else {
        return $this->err404('Lawn not found!');
      }
    } catch ( \Exception $e ) {
      return $this->err500($e);
    }

  }

  public function getBotAction($id, $mid) {
    return $this->err404('Not implemented!');
  }

  public function updateBotAction($id, $mid, Request $request) {
    return $this->err404('Not implemented!');
  }

  public function deleteBotAction($id, $mid) {
    return $this->err404('Not implemented!');
  }

  public function mowLawnAction($id) {
    return $this->err404('Not implemented!');
  }

  private function err400($msg) {
    return new JsonResponse(array('message' => $msg), 400);
  }

  private function err401($msg) {
    return new JsonResponse(array('message' => $msg), 401);
  }

  private function err404($msg) {
    return new JsonResponse(array('message' => $msg), 404);
  }

  private function err500(\Exception $e) {
    $data = array (
      'error_code' => $e->getCode(),
      'message' => $e->getMessage()
    );

    return new JsonResponse($data, 500);
  }
}
