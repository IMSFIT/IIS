<?php

use Nette\Application\UI\Form;



/**
 * Base presenter for all application presenters.
 *
 * @property callable $newListFormSubmitted
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

        /** @var Todo\ListRepository */
        protected $objednavkaRepository;
		protected $pacientRepository;
		protected $jidlaRepository;
		protected $surovinyRepository;
		protected $userRepository;
		protected $rolesRepository;
		

 public function injectBase(Todo\Objednavka_Na_KuchynRepository $objednavkaRepository,Todo\PacientRepository $pacientRepository,Todo\JidloRepository $jidlaRepository,Todo\SurovinyRepository $surovinyRepository,Todo\UserRepository $userRepository,Todo\RolesRepository $rolesRepository)
        {
                $this->objednavkaRepository = $objednavkaRepository;
				$this->pacientRepository = $pacientRepository;
				$this->jidlaRepository = $jidlaRepository;
				$this->surovinyRepository = $surovinyRepository;
				$this->userRepository = $userRepository;
				$this->rolesRepository = $rolesRepository;
        }



        public function beforeRender()
        {
                $this->template->lists = $this->objednavkaRepository->findConfirmed()->order('title ASC');
        }



        /**s
         * @return Nette\Application\UI\Form
         */
        protected function createComponentNewListForm()
        {
                if (!$this->getUser()->isLoggedIn()) {
                        $this->redirect('Sign:in');
                }

                $form = new Form();
                $form->addText('title', 'Název:', 15, 50)
                        ->addRule(Form::FILLED, 'Musíte zadat název seznamu úkolů.');

                $form->addSubmit('create', 'Vytvořit');
                $form->onSuccess[] = $this->newListFormSubmitted;

                return $form;
        }



        public function newListFormSubmitted(Form $form)
        {
                $list = $this->listRepository->createList($form->values->title);
                $this->flashMessage('Seznam úkolů založen.', 'success');
                $this->redirect('Task:default', $list->id);
        }

}