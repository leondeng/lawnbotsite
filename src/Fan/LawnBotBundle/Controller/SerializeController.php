<?php

namespace Fan\LawnBotBundle\Controller;

use Fan\LawnBotBundle\EventListener\SerializeListener;

interface SerializeController
{

  public function setSal(SerializeListener $sal);
}