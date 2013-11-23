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
                $form->addText('username', 'Username:')
                        ->setRequired('Please enter your username.');

                $form->addPassword('password', 'Password:')
                        ->setRequired('Please enter your password.');

                               $form->addSubmit('login', 'Sign in');

                // call method signInFormSucceeded() on success
                $form->onSuccess[] = $this->signInFormSucceeded;
                return $form;
        }



        public function signInFormSucceeded($form)
        {
                $values = $form->getValues();

                 ///$this->getUser()->setExpiration('+ 20 minutes', TRUE);

                try {	
						
                        $user = $this->getUser();
						$user->login($values->username, $values->password); 
						
						$this->redirect('Administrator:');
                } 
				catch (Nette\Security\AuthenticationException $e) {
                        $form->addError($e->getMessage());
                        return;
                }

                
        }
		
}