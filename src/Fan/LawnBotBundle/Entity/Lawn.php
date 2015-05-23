<?php

namespace Fan\LawnBotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lawn
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fan\LawnBotBundle\Entity\LawnRepository")
 */
class Lawn
{
  use \Fan\LawnBotBundle\Traits\Accessor;
  
  /**
   *
   * @var integer @ORM\Column(name="id", type="integer")
   *      @ORM\Id
   *      @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  
  /**
   *
   * @var integer @ORM\Column(name="width", type="integer", length=10)
   */
  private $width;

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set width
   *
   * @param integer $width          
   * @return Lawn
   */
  public function setWidth($width) {
    $this->width = $width;
    
    return $this;
  }

  /**
   * Get width
   *
   * @return integer
   */
  public function getWidth() {
    return $this->width;
  }
}
