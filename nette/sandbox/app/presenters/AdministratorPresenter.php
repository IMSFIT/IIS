<?php

use Nette\Application\UI\Form;
/**
 * Base presenter for all application presenters.
 *
 * @property callable $newListFormSubmitted
 */
class AdministratorPresenter extends BasePresenter
{

 	//private $list;
	protected $pacientRepository;
	protected $objednavkaRepository;
	protected $jidlaRepository;
	protected $surovinyRepository;
	protected $userRepository;
	protected $rolesRepository;
	
	
	protected function startup()
	{
    	parent::startup();
    	$this->objednavkaRepository = $this->context->objednavkaRepository;
		$this->pacientRepository = $this->context->pacientRepository;
		$this->jidlaRepository = $this->context->jidlaRepository;
		$this->userRepository = $this->context->userRepository;
		$this->surovinyRepository = $this->context->surovinyRepository;
		$this->rolesRepository = $this->context->rolesRepository;
		
	}
	
	

	public function renderDefault()
	{
    	
		

	}
	
	public function renderObjednavka()
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
	
	public function renderUser()
	{
		$this->template->users = $this->userRepository->findAll();
	}
	
	public function renderSurovinyadd()
	{
		$this->template->surovinys = $this->surovinyRepository->findAll();
	}
	
	public function renderSuroviny()
	{
		$this->template->surovinys = $this->surovinyRepository->findAll();
	}
	
	public function renderDeleteedituser()
	{
		$this->template->users = $this->userRepository->findAll();
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
	
	public function renderUseradd()
	{
		$this->template->users = $this->userRepository->findAll();
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
	
	
	
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm3()
	{
	$userPairs = $this->rolesRepository->findAll()->fetchPairs('id_role', 'nazov');
	
    $form = new Form();
    $form->addText('user', 'Nazov uzivatela:', 20, 50)
        ->addRule(Form::FILLED, 'Je treba zadať názov uzivatela');
	$form->addText('username', 'login:', 20, 50)
        ->addRule(Form::FILLED, 'Je treba zadať login');
	$form->addText('password', 'password:', 20, 50)
        ->addRule(Form::FILLED, 'Je treba zadať heslo');
   
	 $form->addSelect('id_role', 'id_role:', $userPairs)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať rolu pre užívateľa.');
    $form->addSubmit('create', 'Vytvoriť');
	
	$form->onSuccess[] = $this->taskFormSubmitted3;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted3(Form $form)
	{
		
   	$this->userRepository->createUser($form->values->user, $form->values->username,$form->values->password,$form->values->id_role);
    $this->flashMessage('<h2>Užívateľ přidaný.</h2>', 'success');
    $this->redirect('this');
	}
	
	
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm2()
	{
	
	
    $form = new Form();
   
    $form->addSubmit('create', 'Doplniť');
	
	$form->onSuccess[] = $this->taskFormSubmitted2;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted2(Form $form)
	{
		
   	$this->surovinyRepository->updateSklad();
        $this->redirect('this');
	}
	
	
	
	
	
	
	

	
	

}