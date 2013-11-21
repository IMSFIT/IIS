<?php
namespace Todo;
use Nette;

/**
 * Tabulka pacient
 */
class PacientRepository extends Repository
{
	public function tasksOf(Nette\Database\Table\ActiveRow $list)
	{
    return $list->related('rodne_cislo')->order('created');
	}
}

