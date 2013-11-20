<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

        /** @var Todo\Objednabka */
        private $objednavka;



        public function inject(Todo\Objednavka_Na_KuchynRepository $objednavka)
        {
                $this->objednavka = $objednavka;
        }



        public function renderDefault()
        {
                $this->template->tasks = $this->objednavka->findIncomplete();
        }

}
