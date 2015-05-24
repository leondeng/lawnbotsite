<?php

namespace Fan\LawnBotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Bot
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fan\LawnBotBundle\Entity\BotRepository")
 *
 * @ExclusionPolicy("all")
 */
class Bot
{
  use \Fan\LawnBotBundle\Traits\Accessor;

  const ERROR_CODE_BASE = 200;

  const HEADINGS = [
    'W' => 'N',
    'N' => 'E',
    'E' => 'S',
    'S' => 'W'
  ];

  private $headings;
  private $sequence = null;

  /**
   *
   * @var integer @ORM\Column(name="id", type="integer")
   *      @ORM\Id
   *      @ORM\GeneratedValue(strategy="AUTO")
   *
   *      @Expose
   */
  private $id;

  /**
   *
   * @var integer @ORM\Column(name="x", type="integer", length=10)
   *
   * @Expose
   */
  private $x;

  /**
   *
   * @var integer @ORM\Column(name="y", type="integer", length=10)
   *
   * @Expose
   */
  private $y;

  /**
   *
   * @var char @ORM\Column(name="heading", type="string", length=1)
   *
   * @Expose
   */
  private $heading;

  /**
   *
   * @var string @ORM\Column(name="command", type="string", length=100)
   *
   * @Expose
   */
  private $command;

  /**
   *
   * @var Lawn @ORM\ManyToOne(targetEntity="Lawn", inversedBy="bots")
   *      @ORM\JoinColumn(name="lawn_id", referencedColumnName="id", onDelete="CASCADE")
   */
  private $lawn;

  public static function create($position, $command) {
    $bot = new Bot($position);
    $bot->setCommand($command);

    return $bot;
  }

  public function __construct($position) {
    $params = explode(' ', $position);
    if (count($params) !== 3) {
      throw new \InvalidArgumentException('Invalid position string!', self::ERROR_CODE_BASE + 1);
    }

    $this->initialize($params);
  }

  private function initialize(array $params) {
    $this->setX($params[0]);
    $this->setY($params[1]);
    $this->setHeading($params[2]);
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set x
   *
   * @param integer $x
   * @return Bot
   */
  public function setX($x) {
    if (! is_numeric($x)) {
      throw new \InvalidArgumentException('Invalid x position!', self::ERROR_CODE_BASE + 2);
    }

    $this->x = $x;

    return $this;
  }

  /**
   * Get x
   *
   * @return integer
   */
  public function getX() {
    return $this->x;
  }

  /**
   * Set y
   *
   * @param integer $y
   * @return Bot
   */
  public function setY($y) {
    if (! is_numeric($y)) {
      throw new \InvalidArgumentException('Invalid y position!', self::ERROR_CODE_BASE + 3);
    }

    $this->y = $y;

    return $this;
  }

  /**
   * Get y
   *
   * @return integer
   */
  public function getY() {
    return $this->y;
  }

  /**
   * Set heading
   *
   * @param string $heading
   * @return Bot
   */
  public function setHeading($heading) {
    if (! in_array($heading, self::HEADINGS)) {
      throw new \InvalidArgumentException('Invalid heading!', self::ERROR_CODE_BASE + 4);
    }

    $this->heading = $heading;

    return $this;
  }

  /**
   * Get heading
   *
   * @return string
   */
  public function getHeading() {
    return $this->heading;
  }

  /**
   * Set command
   *
   * @param string $command
   * @return Bot
   */
  public function setCommand($command) {
    if (! preg_match('/^[LRM]+$/', $command)) {
      throw new \InvalidArgumentException('Invalid command string!', self::ERROR_CODE_BASE + 5);
    }

    $this->command = $command;

    return $this;
  }

  /**
   * Get command
   *
   * @return string
   */
  public function getCommand() {
    return $this->command;
  }

  /**
   * Set lawn
   *
   * @param Lawn $lawn
   *
   * @return Comment
   */
  public function setLawn(Lawn $lawn) {
    $this->lawn = $lawn;

    return $this;
  }

  /**
   * Get lawn
   *
   * @return Lawn
   */
  public function getLawn() {
    return $this->lawn;
  }

  public function getSequence() {
    if ($this->sequence) return $this->sequence;

    $sequence = array ();
    $sequence[] = array (
      'x' => $this->x,
      'y' => $this->y,
      'heading' => $this->heading
    );

    foreach ( str_split($this->command) as $action ) {
      $sequence[] = $this->getNextPosition(end($sequence), $action);
    }

    return $this->sequence = $sequence;
  }

  private function getNextPosition($position, $action) {
    if ($action === 'M') {
      $position = $this->getNextCoordinates($position);
    } else {
      $position = $this->getNextHeading($position, $action);
    }

    return $position;
  }

  private function getNextHeading($position, $direction) {
    if ($direction === 'R') {
      $headings = self::HEADINGS;
      $position['heading'] = $headings[$position['heading']];
    } else {
      $flip_headings = array_flip(self::HEADINGS);
      $position['heading'] = $flip_headings[$position['heading']];
    }

    return $position;
  }

  private function getNextCoordinates($position) {
    switch ($position['heading']) {
      case 'N' :
        $position['y'] ++;
        break;
      case 'E' :
        $position['x'] ++;
        break;
      case 'S' :
        $position['y'] --;
        break;
      case 'W' :
        $position['x'] --;
        break;
    }

    return $position;
  }

  public function getFinalPosition() {
    $seq = $this->getSequence();

    $position = end($seq);

    return sprintf('%d %d %s', $position['x'], $position['y'], $position['heading']);
  }

  public function getCurrentPosition() {
    return array(
      'x' => $this->x,
      'y' => $this->y,
      'heading' => $this->heading
    );
  }

  public function update(array $data) {
    $this->setX($data['x']);
    $this->setY($data['y']);
    $this->setHeading($data['heading']);
    $this->setCommand($data['command']);
  }

  public function reset() {
    $this->x = null;
    $this->y = null;
    $this->heading = null;
    $this->command = null;
    $this->sequence = null;
    // $this->lawn = null;
  }

  public function __toString() {
    return sprintf('%d %d %s', $this->x, $this->y, $this->heading);
  }
}
