<?php
namespace Todo;
use Nette;

/**
 * Tabulka user
 */
class Suroviny extends Repository
{
	public function findIncomplete()
{
    return $this->findBy(array('done' => false))->order('created ASC');
}
}

