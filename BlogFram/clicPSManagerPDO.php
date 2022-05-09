<?php
namespace BlogFram;

use \BlogFram\ClicPSEntity;

class ClicPSManagerPDO extends ClicPSManager
{

  protected function add(ClicPSEntity $clicPS)
  {
    $requete = $this->dao->prepare('INSERT INTO clicPS SET name = :name, instanceName = :instanceName, price = :price, clicPS = :clicPS, defaultClicPS = :defaultClicPS, numberOfUpgrade = :numberOfUpgrade, multiplicateur = :multiplicateur, playerID = :playerID, possessed = :possessed');
 
    $requete->bindValue(':name', $clicPS->name());
    $requete->bindValue(':instanceName', $clicPS->instanceName());
    $requete->bindValue(':price', $clicPS->price());
    $requete->bindValue(':clicPS', $clicPS->clicPS());
    $requete->bindValue(':defaultClicPS', $clicPS->defaultClicPS());
    $requete->bindValue(':numberOfUpgrade', $clicPS->numberOfUpgrade());
    $requete->bindValue(':multiplicateur', $clicPS->multiplicateur());
    $requete->bindValue(':playerID', $clicPS->playerID());
    $requete->bindValue(':possessed', $clicPS->possessed());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM clicPS')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM clicPS WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, name, instanceName, price, clicPS, defaultClicPS, numberOfUpgrade, multiplicateur, playerID, possessed FROM clicPS ORDER BY id ASC';

    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\ClicPSEntity');

    $listeClicPSEntity = $requete->fetchAll();

    $requete->closeCursor();

    return $listeClicPSEntity;
  }
 
  public function getListOf($playerID)
  {
    $requete = $this->dao->prepare('SELECT id, name, instanceName, price, clicPS, defaultClicPS, numberOfUpgrade, multiplicateur, playerID, possessed FROM clicPS WHERE playerID = :playerID');
    $requete->bindValue(':playerID', (int) $playerID, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\ClicPSEntity');

    $listeClicPSEntityOfPlayer = $requete->fetchAll();

    $requete->closeCursor();

    return $listeClicPSEntityOfPlayer;
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, name, instanceName, price, clicPS, defaultClicPS, numberOfUpgrade, multiplicateur, playerID, possessed FROM clicPS WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\ClicPSEntity');

    if ($clicPS = $requete->fetch())
    {
      return $clicPS;
    }
 
    return null;
  }
 
  protected function modify(ClicPSEntity $clicPS)
  {
    $requete = $this->dao->prepare('UPDATE clicPS SET name = :name, instanceName = :instanceName, price = :price, clicPS = :clicPS, defaultClicPS = :defaultClicPS, numberOfUpgrade = :numberOfUpgrade, multiplicateur = :multiplicateur, playerID = :playerID, possessed = :possessed WHERE id = :id');
 
    $requete->bindValue(':name', $clicPS->name());
    $requete->bindValue(':instanceName', $clicPS->instanceName());
    $requete->bindValue(':price', $clicPS->price());
    $requete->bindValue(':clicPS', $clicPS->clicPS());
    $requete->bindvalue(':defaultClicPS', $clicPS->defaultClicPS());
    $requete->bindvalue(':numberOfUpgrade', $clicPS->numberOfUpgrade());
    $requete->bindvalue(':multiplicateur', $clicPS->multiplicateur());
    $requete->bindValue(':playerID', $clicPS->playerID());
    $requete->bindValue(':possessed', $clicPS->possessed());
    $requete->bindValue(':id', $clicPS->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }
}
