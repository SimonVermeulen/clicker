<?php
namespace BlogFram;
 
use \BlogFram\Manager;
use \BlogFram\ClicPSEntity;
 
abstract class ClicPSManager extends Manager
{
  /**
   * Méthode permettant d'ajouter une entitée à ajouter.
   * @param $clicPS ClicPSEntity L'entitée à ajouter
   * @return void
   */
  abstract protected function add(ClicPSEntity $clicPS);
 
  /**
   * Méthode permettant d'enregistrer une entitée de clic.
   * @param $clicPS ClicPSEntity l'entitée à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(ClicPSEntity $clicPS)
  {

      $clicPS->isNew() ? $this->add($clicPS) : $this->modify($clicPS);

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
   * @return array La liste des entitées. Chaque entrée est une instance de clicPS.
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**  
   * Méthode retournant la liste des entitées du joueur voulu.
   * @param $playerID L'identitfiant du joueur dont on veux sélectionner les entitées
   * @return array La liste d'entitées. Chaque entrée est une instance de clicPS 
  */
  abstract public function getListOf($playerID);

  /**
   * Méthode retournant une entitée précise.
   * @param $id int L'identifiant de la entitée à récupérer
   * @return ClicPS L'entitée demandée
   */
  abstract public function getUnique($id);
 
  /**
   * Méthode permettant de modifier une entitée.
   * @param $clicPS ClicPSEntity l'entitée à modifier
   * @return void
   */
  abstract protected function modify(ClicPSEntity $clicPS);
}
