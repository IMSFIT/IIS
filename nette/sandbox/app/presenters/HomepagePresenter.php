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

       



	}

}