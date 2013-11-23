<?php

use Nette\Application\UI;
use Nette\Application\UI\Form;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{


        /**
         * Sign-in form factory.
         * @return Nette\Application\UI\Form
         */
        protected function createComponentSignInForm()
        {
                $form = new UI\Form;
                $form->addText('username', 'Login:', 30, 20);
    $form->addPassword('password', 'Heslo:', 30);
   
    $form->addSubmit('login', 'Prihlásiť sa');
    $form->onSuccess[] = $this->signInFormSucceeded;
    return $form;
        }



        public function signInFormSucceeded($form)
        {
                try {
        	$user = $this->getUser();
       	 $values = $form->getValues();
       	 
         $user->setExpiration('+30 seconds', FALSE);
       		 
        $user->login($values->username, $values->password);
        
		echo $user->role->nazov;
        //$this->redirect('Administrator:');
   		 } 
		 catch (NS\AuthenticationException $e) 
		 {
        $form->addError('Neplatné uívateľské meno alebo heslo.');
    		}
        }



        public function actionOut()
        {
                $this->getUser()->logout();
                $this->flashMessage('You have been signed out.');
                $this->redirect('in');
        }

}