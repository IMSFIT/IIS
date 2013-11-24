<?php
namespace Todo;
use Nette;

/**
 * Tabulka suroviny
 */
class StavRepository extends Repository
{
	public function findIncomplete()
	{
    	return $this->findBy(array('id_stav' => 2 ));
	}
}

