<?php

use Nette\Application\UI;
use Nette\Forms\Form;

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
              	 $form = new Form();
   				 $form->addText('username', 'Užívateľské meno:', 30, 20);
   				 $form->addPassword('password', 'Heslo:', 30);
    			 $form->addCheckbox('persistent', 'Trvalé prihlásenie');
    			 $form->addSubmit('login', 'Prihlásiť sa');
    			 
				 $form->onSuccess[] = $this->signInFormSucceeded;
				 
    			 return $form;
        }



        public function signInFormSucceeded($form)
        {
                 
				
				
				try {
        		$user = $this->getUser();
       			 $values = $form->getValues();
       			 if ($values->persistent) {
           			 $user->setExpiration('+30 days', FALSE);
       			 }
       			 $user->login($values->username, $values->password);
       			 $this->flashMessage('Přihlášení bylo úspěšné.', 'success');
       			 $this->redirect('Homepage:');
   				 }
				 
				  catch (NS\AuthenticationException $e)
				  {
        			$form->addError('Neplatné uživatelské jméno nebo heslo.');
					$this->redirect('Sign:');
   				 }
        }



        public function actionOut()
        {
                $this->getUser()->logout();
                $this->flashMessage('You have been signed out.');
                $this->redirect('in');
        }

}