<?php

use Nette\Application\UI\Form;
/**
 * Base presenter for all application presenters.
 *
 * @property callable $newListFormSubmitted
 */
class SestraPresenter extends BasePresenter
{

 	//private $list;
	protected $pacientRepository;
	protected $objednavkaRepository;
	protected $jidlaRepository;
	
	
	
	protected function startup()
	{
    	parent::startup();
		if (!$this->getUser()->isLoggedIn()) {
        $this->redirect('Sign:in');
    }
    	$this->objednavkaRepository = $this->context->objednavkaRepository;
		$this->pacientRepository = $this->context->pacientRepository;
		$this->jidlaRepository = $this->context->jidlaRepository;
		
	}
	
	

	public function renderDefault()
	{
    	$this->template->objednavkys = $this->objednavkaRepository->findAll();
		

	}
	
	public function renderDeleteEditDefault()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
	}
	
	
	
	public function renderAddDefault()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
	}
	
	
	public function renderPacient()
	{
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	//zobrazenie pre prijaté objednávky
	public function renderAccepted()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAccepted();
	}
	
	
	//zobrazenie pre potvrdené objednávky
	public function renderConfirmed()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findConfirmed();
	}
	
	//zobrazenie pre zmenené objednávky
	public function renderChanged()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findChanged();
	}
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm()
	{
	//vyber pacienta od ktoreho bola vybrata objednavka	
    $userPairs = $this->pacientRepository->findAll()->fetchPairs('rodne_cislo', 'prijmeni');
	
	//vyber preferovaneho jedla
	$userPairs2 = $this->jidlaRepository->findAll()->fetchPairs('id_jidla', 'nazev_jidla');
	
    $form = new Form();
    $form->addText('text', 'Oddelenie:', 20, 50)
        ->addRule(Form::FILLED, 'Je treba zadať názov oddelenia');
    $form->addSelect('rodne_cislo', 'prijmeni:', $userPairs)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať komu je objednávka priradená.');
	 $form->addSelect('id_jidla', 'nazev_jidla:', $userPairs2)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať preferované jedlo.');
    $form->addSubmit('create', 'Vytvoriť');
	
	$form->onSuccess[] = $this->taskFormSubmitted;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted(Form $form)
	{
		//echo $form->values->rodne_cislo;
   $this->objednavkaRepository->createTask($form->values->text, $form->values->rodne_cislo,$form->values->id_jidla);
  $this->flashMessage('<h2>Úkol přidaný.</h2>', 'success');
    $this->redirect('this');
	}
	
	
	
	
	
	
	
	

	
	

}