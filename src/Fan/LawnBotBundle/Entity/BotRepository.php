<?php

namespace Fan\LawnBotBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * BotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BotRepository extends EntityRepository
{
  public function findBotOnLawn($lawn_id, $bot_id, $hydrationMode = Query::HYDRATE_OBJECT) {
    $qb = $this->_em->createQueryBuilder();
    $expr = $qb->expr();

    $qb->select('b')
      ->from('Fan\LawnBotBundle\Entity\Bot', 'b')
      ->join('Fan\LawnBotBundle\Entity\Lawn', 'l')
      ->where($expr->andX($expr->eq('b.id', ':bot_id'), $expr->eq('l.id', ':lawn_id')))
      ->setParameters(array('lawn_id' => $lawn_id, 'bot_id' => $bot_id))
    ;

    $bots = $qb->getQuery()->getResult($hydrationMode);
    if (count($bots)) {
      return $bots[0];
    } else {
      return false;
    }
  }
}
