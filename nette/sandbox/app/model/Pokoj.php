<?php
namespace Todo;
use Nette;

/**
 * Tabulka Pokoj
 */
class Pokoj extends Repository
{
	public function findIncomplete()
{
    return $this->findBy(array('done' => false))->order('created ASC');
}
}

