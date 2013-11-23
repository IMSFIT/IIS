<?php
use Nette\Application\UI\Form;
use Nette\Security as NS;

/**
 */
class UserPresenter extends BasePresenter
{
    /** @var Todo\UserRepository */
    public $userRepository;

    /** @var Todo\Authenticator */
    protected $authenticator;

    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            $this->redirect('Sign:in');
        }
        $this->userRepository = $this->context->userRepository;
        $this->authenticator = $this->context->authenticator;
    }

    protected function createComponentPasswordForm()
    {
        $form = new Form();
        $form->addPassword('oldPassword', 'Staré heslo:', 30)
            ->addRule(Form::FILLED, 'Trebe zadať staré heslo.');
        $form->addPassword('newPassword', 'Nové heslo:', 30)
            ->addRule(Form::MIN_LENGTH, 'Nové heslo musí mať aspoň %d znakov.', 5);
        $form->addPassword('confirmPassword', 'Potvrdenie hesla:', 30)
            ->addRule(Form::FILLED, 'Nové heslo je treba zadat ešte raz pre potvrdenie.')
            ->addRule(Form::EQUAL, 'Zadané heslá se musia zhodovať.', $form['newPassword']);
        $form->addSubmit('set', 'Změnit heslo');
        $form->onSuccess[] = $this->passwordFormSubmitted;
        return $form;
    }


    public function passwordFormSubmitted(Form $form)
    {
        $values = $form->getValues();
        $user = $this->getUser();
        try {
            $this->authenticator->authenticate(array($user->getIdentity()->username, $values->oldPassword));
            $this->userRepository->setPassword($user->getId(), Authenticator::calculateHash($values->newPassword));
           
            $this->redirect('Homepage:');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Zadané heslo nie je správne.');
        }
    }
}