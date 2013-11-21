<?php
namespace Todo;
use Nette;

/**
 * Tabulka objednavka jedla pre pacienta
 */
class Objednavka_Na_KuchynRepository extends Repository
{	


	

	
	
	
	
	//metoda najde prijate objednavky
	public function findAccepted()
	{
    	return $this->findBy(array('stav' => 0))->order('oddeleni ASC');
	}
	
	//metoda najde potvrdene objednavky
	public function findConfirmed()
	{
    	return $this->findBy(array('stav' => 1))->order('oddeleni ASC');
	}
	
	//metoda najde zmenene objednavky
	public function findChanged()
	{
    	return $this->findBy(array('stav' => 2))->order('oddeleni ASC');
	}
	
	/**
         * @param int $listId
         * @param string $task
         * @param int $assignedUser
         * @return Nette\Database\Table\ActiveRow
         */
    public function createTask($oddelenie, $rodne_cislo, $jidlo)
      {
                return $this->getTable()->insert(array(
                        'oddeleni' => $oddelenie,
                        //'rc_pacienta' => $rodne_cislo,
                        'rc_pacienta' => 9410185784,
						'stav' => 0,
                        'preferovane_jidlo' => $jidlo,
                ));
        }
	
	
	
}

