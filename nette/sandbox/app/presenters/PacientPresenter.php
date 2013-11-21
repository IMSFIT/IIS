<?php



/**
 * Presenter, ktory vypisuje zoznam pacientov
 */
class PacienterPresenter extends BasePresenter
{

        /** @var \Nette\Database\Table\ActiveRow */
        private $list;



        public function actionDefault($id)
        {
                $this->list = $this->pacientRepository->findBy(array('id' => $id))->fetch();
                if ($this->list === FALSE) {
                        $this->setView('notFound');
                }
        }



        public function renderDefault()
        {
                $this->template->list = $this->list;
                $this->template->tasks = $this->pacientRepository->tasksOf($this->list);
        }

}