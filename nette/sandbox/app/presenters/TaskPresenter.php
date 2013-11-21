<?php

use Nette\Application\UI\Form;



/**
 * Presenter, ktorý vypisuje zoznam objednávok
 *
 * @property callable $taskFormSubmitted
 */
class TaskPresenter extends BasePresenter
{

        /** @var Todo\TaskRepository */
        private $objednavkaRepository;

        /** @var Todo\UserRepository */
        private $userRepository;

        /** @var Nette\Database\Table\ActiveRow */
        private $list;



        public function inject(Todo\ObjednavkaRepository $objednavkaRepository, Todo\PacientRepository $pacientRepository)
        {
                $this->objednavkaRepository = $objednavkaRepository;
                $this->pacientRepository = $pacientRepository;
        }



        public function actionDefault($id)
        {
                $this->list = $this->pacientRepository->findBy(array('id_objednavky' => $id))->fetch();
                if ($this->list === FALSE) {
                        $this->setView('notFound');
                }
        }



        public function renderDefault()
        {
                $this->template->list = $this->list;
                $this->template->tasks = $this->pacientRepository->tasksOf($this->list);
        }



        /**
         * @return Nette\Application\UI\Form
         */
        protected function createComponentTaskForm()
        {
                $userPairs = $this->userRepository->findAll()->fetchPairs('rodne_cislo', 'prijmeni');

                $form = new Form();
                $form->addText('text', 'Oddelenie:', 40, 100)
                        ->addRule(Form::FILLED, 'Je nutné zadať oddelenie.');
				$form->addText('state', 'Stav:')
					->addRule(Form::INTEGER, 'STAV JE ČÍSLO.');
                      
                $form->addSelect('userId', 'Pre pacienta:', $userPairs)
                        ->setPrompt('- Vyberte -')
                        ->addRule(Form::FILLED, 'Je nutné vybrat, komu je objednávka priradená.');

                $form->addSubmit('create', 'Vytvoriť');
                $form->onSuccess[] = $this->taskFormSubmitted;

                return $form;
        }



        /**
         * @param  Nette\Application\UI\Form $form
         */
        public function taskFormSubmitted(Form $form)
        {
                $this->objednavkaRepository->createTask($this->list->id, $form->values->text, $form->values->userId);
                $this->flashMessage('Objednkávka pridaná.', 'success');
                $this->redirect('this');
        }

}