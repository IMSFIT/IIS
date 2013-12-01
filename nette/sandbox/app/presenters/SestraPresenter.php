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
		if ($this->getUser()->isInrole('admin'))
		{
		$this->redirect('Administrator:');	
		}
		if ($this->getUser()->isInrole('kucharka'))
		{
		$this->redirect('Kucharka:');	
		}
	
	
    	$this->objednavkaRepository = $this->context->objednavkaRepository;
		$this->pacientRepository = $this->context->pacientRepository;
		$this->jidlaRepository = $this->context->jidlaRepository;
		
	}
	
	

	public function renderDefault()
	{
    	$this->template->objednavkys = $this->objednavkaRepository->findAll();
		$this->template->pacients = $this->pacientRepository->findAll();
		

	}
	
	public function renderDeleteEditDefault()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	
	
	public function renderAddDefault()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	
	public function renderPacient()
	{
		$this->template->pacients = $this->pacientRepository->findAll();
		
	}
	
	
	public function renderEditdefault()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	//zobrazenie pre prijaté objednávky
	public function renderAccepted()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAccepted();
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	
	//zobrazenie pre potvrdené objednávky
	public function renderConfirmed()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findConfirmed();
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	//zobrazenie pre zmenené objednávky
	public function renderChanged()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findChanged();
		$this->template->pacients = $this->pacientRepository->findAll();
	}
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm()
	{
	//vyber pacienta od ktoreho bola vybrata objednavka	
    $userPairs = $this->pacientRepository->findAll()->fetchPairs('rodne_cislo', 'rodne_cislo');
	
	//vyber preferovaneho jedla
	$userPairs2 = $this->jidlaRepository->findAll()->fetchPairs('id_jidla', 'nazev_jidla');
	
    $form = new Form();
    $form->addText('text', 'Oddelenie:', 20, 50)
        ->addRule(Form::FILLED, 'Je treba zadať názov oddelenia');
    $form->addSelect('rodne_cislo', 'Rodné číslo:', $userPairs)
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
  
    $this->redirect('this');
	}
	
	//vytvorenie formularu na zmazanie objednavok
	protected function createComponentTaskForm111()
	{
	$userPairs = $this->objednavkaRepository->findAll()->fetchPairs('id_objednavky', 'id_objednavky');
	
    $form = new Form();
    $form->addSelect('id', 'id_objednavky:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať objednávku na zmazanie.');
    $form->addSubmit('create', 'Zmazať');
	
	$form->onSuccess[] = $this->taskFormSubmitted111;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted111(Form $form)
	{
		//echo $form->values->id;
   	$this->objednavkaRepository->deleteObjednavka($form->values->id);
   
    $this->redirect('this');
	}
	
	//vytvorenie formularu na zmazanie objednavok
	protected function createComponentTaskForm6()
	{
	$userPairs = $this->objednavkaRepository->findAll()->fetchPairs('id_objednavky', 'id_objednavky');
	$userPairs2 = $this->jidlaRepository->findAll()->fetchPairs('id_jidla', 'nazev_jidla');
	$userPairs3 = $this->stavRepository->findAll()->fetchPairs('id_stav', 'nazov');
	
    $form = new Form();
	 
    $form->addSelect('id_objednavky', 'id_objednavky:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať objednávku na editovanie.');
	$form->addText('oddelenie', 'Nazov oddelenia:', 20, 50)
           ->addRule(Form::FILLED, 'Je treba zadať názov oddelenia');
	 $form->addSelect('id_stav', 'nazov:', $userPairs3)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať stav.');
	$form->addSelect('id_jidla', 'nazev_jidla:', $userPairs2)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať nazov jedla.');

    $form->addSubmit('create', 'Editovať');
	
	$form->onSuccess[] = $this->taskFormSubmitted6;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted6(Form $form)
	{
		
		
   	$this->objednavkaRepository->update2Objednavka($form->values->id_objednavky,$form->values->oddelenie,$form->values->id_stav-1,$form->values->id_jidla);
   
    $this->redirect('this');
	}
	
	
	
	
	

	
	

}