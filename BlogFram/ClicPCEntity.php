<?php
namespace BlogFram;

use \BlogFram\Entity;

class ClicPCEntity extends Entity
{
  protected $name,
            $nameUpgrade,
            $instanceName,
            $price,
            $clicPC,
            $defaultClicPC,
            $numberOfUpgrade,
            $multiplicateur,
            $playerID;
 
  public function __construct($jsonString='')
  {
    $arrayClicPC = json_decode($jsonString, true);

    if (!empty($arrayClicPC))
    {
      $this->hydrate($arrayClicPC);
    }
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setNameUpgrade($nameUpgrade)
  {
    $this->nameUpgrade = $nameUpgrade;
  }
 
  public function setInstanceName($instanceName)
  {
    $this->instanceName = $instanceName;
  }
 
  public function setPrice($price)
  {
    $this->price = $price;
  }

  public function setClicPC($clicPC)
  {
    $this->clicPC = $clicPC;
  }

  public function setDefaultClicPC($defaultClicPC)
  {
    $this->defaultClicPC = $defaultClicPC;
  }

  public function setNumberOfUpgrade($numberOfUpgrade)
  {
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

  public function name()
  {
    return $this->name;
  }

  public function nameUpgrade()
  {
    return $this->nameUpgrade;
  }

  public function instanceName()
  {
    return $this->instanceName;
  }

  public function price()
  {
    return $this->price;
  }

  public function clicPC()
  {
    return $this->clicPC;
  }

  public function defaultClicPC()
  {
    return $this->defaultClicPC;
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

  public function jsonString()
  {
    return json_encode(get_object_vars($this));
  }
}
