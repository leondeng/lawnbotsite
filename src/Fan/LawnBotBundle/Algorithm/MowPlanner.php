<?php

namespace  Fan\LawnBotBundle\Algorithm;

use Fan\LawnBotBundle\Entity\Lawn;
use Fan\LawnBotBundle\Entity\Bot;

class MowPlanner
{
  const PLAN_OPT_NUM = 3;

  private $plans = array();

  private static $headings = array('N', 'E', 'S', 'W');

  /*
   * @var lawn width
   */
  private $width;

  /*
   * @var Lawn height
   */
  private $height;

  /*
   * @var integer
   */
  private $botsNum;

  private $bots = array();

  private $mowed = array();

  public static function create(array $params) {
    return  new MowPlanner($params);
  }

  public function __construct(array $params) {
    if (count($params) !== 3) {
     throw new \InvalidArgumentException('Invalid params!');
    }

    $this->initialize($params);
  }

  private function initialize(array $params) {
    list($this->width, $this->height) = array_slice($params, 0, 2);
    if (!is_numeric($this->width)) {
      throw new \InvalidArgumentException('Invalid width!');
    }
    if (!is_numeric($this->height)) {
      throw new \InvalidArgumentException('Invalid height!');
    }

    $num = end($params);
    if (!is_numeric($num)) {
      throw new \InvalidArgumentException('Invalid bots number!');
    }

    $this->area = ($this->width + 1) * ($this->height + 1);
    if ($num > $this->area) {
      throw new \InvalidArgumentException('Invalid bots number, too many!');
    }
    $this->botsNum = $num;
  }

  /*
   * Landing {$num} bots on random locations with random headings
   */
  private function LandingBots() {

    $positions = $this->getRandomPositions();

    // TODO:if positions already in plans, get again

    foreach ($positions as $coord => $heading) {
      $this->bots[] = Bot::create(sprintf('%s %s', $coord, $heading), 'M');
    }

    return $this;
  }

  /*
   * {$num} random different positions
   */
  private function getRandomPositions() {
    $positions = array();
    do {
      $x = mt_rand(0, $this->width);
      $y = mt_rand(0, $this->height);
      $heading = self::$headings[mt_rand(0, 3)];

      $pos_str = sprintf('%d %d', $x, $y);
      if (!isset($positions[$pos_str])) {
        $positions[$pos_str] = $heading;
      }
    } while (count($positions) < $this->botsNum);

    return $positions;
  }

  public function generateInstructions() {
    $this->findPlans();
    $plans = $this->topPlans();

    return $plans;
  }

  private function topPlans() {
    usort($this->plans, function($a, $b){
      if ($a['cost'] == $b['cost']) {
        if ($a['time'] == $b['time']) return 0;
        return ($a['time'] < $b['time']) ? -1 : 1;
      }
      return ($a['cost'] < $b['cost']) ? -1 : 1;
    });

    return $this->plans;
  }

  private function findPlans() {
    do {
      $this->LandingBots();
      if ($plan = $this->findOnePlan()) {
        $this->plans[] = $plan;
      }

      $this->reset();
    } while (count($this->plans) < self::PLAN_OPT_NUM);
  }

  private function reset() {
    $this->bots = array();
    $this->mowed = array();
  }

  private function findOnePlan() {
    $plan = array();
    foreach ($this->bots as $bots) {
      $plan['bots'][] = (string) $bots;
    }

    $unmowed = $this->area;
    $time = 0;
    do { // drive bots till all cell mowed
      $mowed = $this->driveBots();
      $unmowed -= $mowed;
      $time++;
    } while ($unmowed > 0 && $time < 50);  // FIXME: needs a better solution to break dead loop

    if ($unmowed > 0) return false; // bad plan with unmowed cell

    $plan['time'] = $time;
    $plan['cost'] = array_sum($this->mowed);

    foreach ($this->bots as $i => $bot) {
      $plan['bots'][$i] .= ' '.$bot->getCommand();
    }

    return $plan;
  }

  private function driveBots() {
    $mowed = 0;
    $occupied = array();
    foreach ($this->bots as $bot) {
      // mow current cell if not mowed
      $cur_coord = sprintf('%d,%d', $bot->getX(), $bot->getY());

      if (!isset($this->mowed[$cur_coord])) {
        $this->mowed[$cur_coord] = 1;
        $mowed++;
      } else {
        $this->mowed[$cur_coord]++;
      }

      // detect next step
      $coord = $bot->nextCoord();
      $next_coord = sprintf('%d,%d', $coord['x'], $coord['y']);

      if (
         // overstep
         $coord['x'] < 0 ||
         $coord['y'] < 0 ||
         $coord['x'] > $this->width ||
         $coord['y'] > $this->height ||
         // mowed cell
         isset($this->mowed[$next_coord]) ||
         // collision
         in_array($next_coord, $occupied))
      {
        $bot->turn($this->width, $this->height); //smart turn: if heading overstep, turn opposite, update command
        $next_coord = $cur_coord;
      } else {
        $bot->move(); // move ahead, update command as well
      }

      $occupied[] = $next_coord;
    }

    return $mowed;
  }


}