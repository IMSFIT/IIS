<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

        /** @var Todo\TaskRepository */
       protected $objednavkaRepository;



        public function inject(Todo\Objednavka_Na_KuchynRepository $objednavkaRepository)
        {
                $this->objednavkaRepository = $objednavkaRepository;
        }



        protected function startup()
        {
                parent::startup();

                if (!$this->getUser()->isLoggedIn()) {
                        $this->redirect('Sign:in');
                }
        }





}