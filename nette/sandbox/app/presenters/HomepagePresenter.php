<?php

/**
 * Homepage presenter.
 */
 
/** @var Todo\Objednavka */




 
class HomepagePresenter extends BasePresenter
{	private $objednavka;

	public function renderDefault()
	{
		$this->template->tasks = $this->objednavka->findIncomplete();;
	}
	
	protected function startup()
{
    parent::startup();
    $this->objednavka = $this->context->objednavka;
}

}


