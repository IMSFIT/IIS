<?php
use Nette\Application\UI\Form;
// class TaskPresenter

/** @var Todo\UserRepository */
private $userRepository;

protected function startup()
{
    parent::startup();
    $this->listRepository = $this->context->listRepository;
    $this->userRepository = $this->context->userRepository; // získáme model pro práci s uživateli
}

protected function createComponentTaskForm()
{
    $userPairs = $this->userRepository->findAll()->fetchPairs('id', 'name');

    $form = new Form();
    $form->addText('text', 'Úkol:', 40, 100)
        ->addRule(Form::FILLED, 'Je nutné zadat text úkolu.');
    $form->addSelect('userId', 'Pro:', $userPairs)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné vybrat, komu je úkol přiřazen.');
    $form->addSubmit('create', 'Vytvořit');
    return $form;
}