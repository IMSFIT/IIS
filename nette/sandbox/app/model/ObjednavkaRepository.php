<?php
namespace Todo;
use Nette;

/**
 * Tabulka objednavka pacienta
 */
class Objednavka_Na_KuchynRepository extends Repository
{
	public function findIncomplete()
{
    return $this->findBy(array('stav' => 0))->order('oddeleni ASC');
}
}

