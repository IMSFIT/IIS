<?php
namespace Todo;
use Nette;

/**
 * Tabulka user
 */
class Objednavka extends Repository
{
	public function findIncomplete()
{
    return $this->findBy(array('stav' => 0))->order('created ASC');
}
}

