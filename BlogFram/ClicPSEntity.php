<?php
namespace BlogFram;

use \BlogFram\Entity;

class ClicPSEntity extends Entity
{
  protected $name,
            $instanceName,
            $price,
            $clicPS,
            $defaultClicPS,
            $numberOfUpgrade,
            $multiplicateur,
            $playerID,
  			$possessed;
 
  public function __Construct($jsonString='')
  {
    $arrayClicPS = json_decode($jsonString, true);

    if (!empty($arrayClicPS))
    {
      $this->hydrate($arrayClicPS);
    }
  }

  public function setName($name)
  {
    $this->name = $name;
  }
 
  public function setInstanceName($instanceName)
  {
    $this->instanceName = $instanceName;
  }
 
  public function setPrice($price)
  {
    $this->price = $price;
  }

  public function setClicPS($clicPS)
  {
    $this->clicPS = $clicPS;
  }

  public function setDefaultClicPS($defaultClicPS)
  {
    $this->defaultClicPS = $defaultClicPS;
  }

  public function setNumberOfUpgrade($numberOfUpgrade){
    $this->numberOfUpgrade = $numberOfUpgrade;
  }

  public function setMultiplicateur($multiplicateur)
  {
    $this->multiplicateur = $multiplicateur;
  }

  public function setPlayerID($playerID)
  {
    $this->playerID = $playerID;
  }
  
  public function setPossessed($possessed)
  {
    $this->possessed = $possessed;
  }

  public function name()
  {
    return $this->name;
  }

  public function instanceName()
  {
    return $this->instanceName;
  }

  public function price()
  {
    return $this->price;
  }

  public function clicPS()
  {
    return $this->clicPS;
  }

  public function defaultClicPS()
  {
    return $this->defaultClicPS;
  }

  public function numberOfUpgrade()
  {
    return $this->numberOfUpgrade;
  }  

  public function multiplicateur()
  {
    return $this->multiplicateur;
  }

  public function playerID()
  {
    return $this->playerID;
  }
  
  public function possessed()
  {
    return $this->possessed;
  }

  public function jsonString()
  {
    return json_encode(get_object_vars($this));
  }
}
