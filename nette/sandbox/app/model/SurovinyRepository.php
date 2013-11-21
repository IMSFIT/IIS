<?php
namespace Todo;
use Nette;

/**
 * Tabulka suroviny
 */
class SurovinyRepository extends Repository
{
	public function findIncomplete()
{
    return $this->findBy(array('done' => false))->order('created ASC');
}



 public function updateSklad()
      {
                return $this->getTable()->update(array(
                        
                        
                        
                        'mnozstvi_surovin' => 2000,
						'mnozstvi_objednane_suroviny' =>0,
                ));
        }

}

