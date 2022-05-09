<?php
namespace BlogFram;

use \BlogFram\UserEntity;

class userManagerPDO extends userManager
{

  protected function add(UserEntity $user)
  {
    $requete = $this->dao->prepare('INSERT INTO users SET username = :username, email = :email, adminBool = :adminBool, password = :password, value = :value');
 
    $requete->bindValue(':username', $user->username());
    $requete->bindValue(':email', $user->email());
    $requete->bindValue(':adminBool', $user->adminBool());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':value', 0);

    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
  }
 
  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, username, email, adminBool, password, value FROM users ORDER BY id DESC';

    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\UserEntity');

    $listeuserEntity = $requete->fetchAll();

    $requete->closeCursor();

    return $listeuserEntity;
  }

  public function getUnique($username)
  {
    $requete = $this->dao->prepare('SELECT id, username, email, adminBool, password, value FROM users WHERE username = :username');
    $requete->bindValue(':username', $username);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\BlogFram\UserEntity');

    if ($user = $requete->fetch())
    {
      return $user;
    }
 
    return null;
  }
  
  public function getUsernameById($id)
  {
    $requete = $this->dao->prepare('SELECT username FROM users WHERE id = :id');
    $requete->bindValue(':id', $id);
    $requete->execute();
    
    if ($username = $requete->fetch())
    {
      return $username;
    }
    
    return null;
  }
 
  protected function modify(UserEntity $user)
  {
    $requete = $this->dao->prepare('UPDATE users SET username = :username, email = :email, adminBool = :adminBool, password = :password, value = :value WHERE id = :id');

    $requete->bindValue(':username', $user->username());
    $requete->bindValue(':email', $user->email());
    $requete->bindValue(':adminBool', $user->adminBool());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':value', $user->value());
    $requete->bindValue(':id', $user->id());
    
    $requete->execute();
  }
}
