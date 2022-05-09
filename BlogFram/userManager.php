<?php
namespace BlogFram;
 
use \BlogFram\Manager;
use \BlogFram\UserEntity;
 
abstract class userManager extends Manager
{
  /**
   * Méthode permettant d'ajouter une entitée à ajouter.
   * @param $user userEntity L'entitée à ajouter
   * @return void
   */
  abstract protected function add(UserEntity $user);
 
  /**
   * Méthode permettant d'enregistrer une entitée de clic.
   * @param $user userEntity l'entitée à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(UserEntity $user)
  {
    if ($user->isValid())
    {
      $user->isNew() ? $this->add($user) : $this->modify($user);
    }
    else
    {
      throw new \RuntimeException('L\'entitée doit être validée pour être enregistrée');
    }
  }
 
  /**
   * Méthode renvoyant le nombre d'entitées total.
   * @return int
   */
  abstract public function count();
 
  /**
   * Méthode permettant de supprimer une entitée.
   * @param $id int L'identifiant de l'entitée à supprimer
   * @return void
   */
  abstract public function delete($id);
 
  /**
   * Méthode retournant une liste d'entitées demandée.
   * @param $debut int La première entitée à sélectionner
   * @param $limite int Le nombre d'entitées à sélectionner
   * @return array La liste des entitées. Chaque entrée est une instance de user.
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode retournant une entitée précise.
   * @param $username string L'username de l'utilisateur à récupérer
   * @return user L'entitée demandée
   */
  abstract public function getUnique($username);
  
  /**
   * Méthode retournant un username précis.
   * @param $id int L'identifiant de l'utilisateur à récupérer
   * @return username Le username demandé
   */
  abstract public function getUsernameById($id);
  
  /**
   * Méthode permettant de modifier une entitée.
   * @param $user userEntity l'entitée à modifier
   * @return void
   */
  abstract protected function modify(UserEntity $user);
}
