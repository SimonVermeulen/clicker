<?php
namespace BlogFram;

use \BlogFram\ClicPCEntity;

class ClicPCManagerPDO extends ClicPCManager
{

  public function add(ClicPCEntity $clicPC)
  {
    $requete = $this->dao->prepare('INSERT INTO clicPC SET name = :name, nameUpgrade = :nameUpgrade, instanceName = :instanceName, price = :price, clicPC = :clicPC, defaultClicPC = :defaultClicPC, numberOfUpgrade = :numberOfUpgrade, multiplicateur = :multiplicateur, playerID = :playerID');
 
    $requete->bindValue(':name', $clicPC->name());
    $requete->bindValue(':nameUpgrade', $clicPC->nameUpgrade());
    $requete->bindValue(':instanceName', $clicPC->instanceName());
    $requete->bindValue(':price', $clicPC->price());
    $requete->bindValue(':clicPC', $clicPC->clicPC());
    $requete->bindValue(':defaultClicPC', $clicPC->defaultClicPC());
    $requete->bindValue(':numberOfUpgrade', $clicPC->numberOfUpgrade());
    $requete->bindValue(':multiplicateur', $clicPC->multiplicateur());
    $requete->bindValue(':playerID', $clicPC->playerID());
    
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM clicPC')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM clicPC WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, name, instanceName, nameUpgrade, price, clicPC, defaultClicPC, numberOfUpgrade, multiplicateur, playerID FROM clicPC ORDER BY id DESC';

    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\ClicPCEntity');

    $listeClicPCEntity = $requete->fetchAll();

    $requete->closeCursor();

    return $listeClicPCEntity;
  }
 
  public function getListOf($playerID)
  {
    $requete = $this->dao->prepare('SELECT id, name, instanceName, nameUpgrade, price, clicPC, defaultClicPC, numberOfUpgrade, multiplicateur, playerID FROM clicPC WHERE playerID = :playerID');
    $requete->bindValue(':playerID', (int) $playerID, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\ClicPCEntity');

    $listeClicPCEntityOfPlayer = $requete->fetchAll();

    $requete->closeCursor();

    return $listeClicPCEntityOfPlayer;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, name, nameUpgrade, instanceName, price, clicPC, defaultClicPC, numberOfUpgrade, multiplicateur, playerID FROM clicPC WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();

    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\ClicPCEntity');

    if ($clicPC = $requete->fetch())
    {
      return $clicPC;
    }
 
    return null;
  }
 
  protected function modify(ClicPCEntity $clicPC)
  {
    $requete = $this->dao->prepare('UPDATE clicPC SET name = :name, nameUpgrade = :nameUpgrade, price = :price, clicPC = :clicPC, defaultClicPC = :defaultClicPC, numberOfUpgrade = :numberOfUpgrade, multiplicateur = :multiplicateur, playerID = :playerID WHERE id = :id');
 
    $requete->bindValue(':name', $clicPC->name());
    $requete->bindValue(':nameUpgrade', $clicPC->nameUpgrade());
    $requete->bindValue(':price', $clicPC->price());
    $requete->bindValue(':clicPC', $clicPC->clicPC());
    $requete->bindvalue(':defaultClicPC', $clicPC->defaultClicPC());
    $requete->bindvalue(':numberOfUpgrade', $clicPC->numberOfUpgrade());
    $requete->bindvalue(':multiplicateur', $clicPC->multiplicateur());
    $requete->bindValue(':playerID', $clicPC->playerID());
    $requete->bindValue(':id', $clicPC->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }

  public function addPublic(ClicPCEntity $clicPC)
  {
    $this->add($clicPC);
  }
}
