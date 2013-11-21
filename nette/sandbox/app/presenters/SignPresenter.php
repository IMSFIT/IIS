<?php

use Nette\Application\UI;
use Nette\Forms\Form;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{


     protected $userRepository;
	
	
	
	protected function startup()
	{
    	parent::startup();
    	$this->userRepository = $this->context->userRepository;
	
		
	}
		
		
		
		
protected function createComponentSignInForm()
{
    $form = new Form();
    $form->addText('username', 'Uživatelské jméno:', 30, 20);
    $form->addPassword('password', 'Heslo:', 30);
    $form->addCheckbox('persistent', 'Pamatovat si mě na tomto počítači');
    $form->addSubmit('login', 'Přihlásit se');
    $form->onSuccess[] = $this->signInFormSubmitted;
    return $form;
}

public function signInFormSubmitted(Form $form)
{
    try {
        $user = $this->getUser();
        $values = $form->getValues();
        if ($values->persistent) {
            $user->setExpiration('+30 days', FALSE);
        }
        $user->login($values->username, $values->password);
        $this->flashMessage('Přihlášení bylo úspěšné.', 'success');
        $this->redirect('Administrator:default');
    } catch (NS\AuthenticationException $e) {
        $form->addError('Neplatné uživatelské jméno nebo heslo.');
    }
}
}

