<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

      protected function startup()
	{
    	parent::startup();
		if (!$this->getUser()->isLoggedIn()) {
        $this->redirect('Sign:in');
    }
	if ($this->getUser()->isInRole('admin'))
	{
	$this->redirect('Administrator:');	
	}
	if ($this->getUser()->isInRole('sestra') )
		{
		 $this->redirect('Sestra:');
		}
		if ($this->getUser()->isInRole('kucharka') )
		{
		 $this->redirect('Kucharka:');
		}
       



	}

}