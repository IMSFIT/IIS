<?php
namespace Todo;
use Nette;

/**
 * Tabulka suroviny
 */
class RolesRepository extends Repository
{
	public function findIncomplete()
	{
    	return $this->findBy(array('done' => false))->order('created ASC');
	}
}

