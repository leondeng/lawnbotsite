<?php

namespace Fan\LawnBotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Symfony\Component\HttpFoundation;

class WebServiceController extends Controller
{

  public function createLawnAction() {
    return $this->render('FanLawnBotBundle:WebService:createLawn.html.twig', array ());
    // ...
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
