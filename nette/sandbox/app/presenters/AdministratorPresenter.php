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
	
	//zobrazenie pre zmenené objednávky
	public function renderEdituser()
	{
		$this->template->users = $this->userRepository->findAll();
	}
	
	//zobrazenie pre zmenené objednávky
	public function renderEditdefault()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
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
    $form->addText('user', 'login:', 20, 50)
        ->addRule(Form::FILLED, 'Je treba zadať názov uzivatela');
	
	$form->addText('username', 'Nazov uzivatela, ktory sa bude zobrazovat:', 20, 50)
           ->addRule(Form::FILLED, 'Je treba zadať názov skutočný názov pre užívateľa');
	
	 $form->addPassword('newPassword', 'Nové heslo:', 30)
            ->addRule(Form::MIN_LENGTH, 'Nové heslo musí mať aspoň %d znaků.', 6);
      $form->addPassword('confirmPassword', 'Potvrdenie hesla:', 30)
            ->addRule(Form::FILLED, 'Nové heslo je treba zadať ešte raz pre potvrdenie.')
            ->addRule(Form::EQUAL, 'Zadané heslá sa musia zhodovať.', $form['newPassword']);
	$form->addSelect('id_role', 'nazov:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné rolu pre užívateľa.');
    $form->addSubmit('create', 'Vytvoriť');
	
	$form->onSuccess[] = $this->taskFormSubmitted3;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted3(Form $form)
	{
		
   	$this->userRepository->createUser($form->values->user, $form->values->username,$form->values->newPassword,$form->values->id_role);
   
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
	
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm4()
	{
	$userPairs = $this->userRepository->findAll()->fetchPairs('id', 'username');
	
    $form = new Form();
    $form->addSelect('id', 'username:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať užívateľa na zmazanie.');
    $form->addSubmit('create', 'Zmazať');
	
	$form->onSuccess[] = $this->taskFormSubmitted4;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted4(Form $form)
	{
		//echo $form->values->id;
   	$this->userRepository->deleteUser($form->values->id);
   
    $this->redirect('this');
	}
	
	
	//vytvorenie formularu na zmazanie objednavok
	protected function createComponentTaskForm5()
	{
	$userPairs = $this->objednavkaRepository->findAll()->fetchPairs('id_objednavky', 'id_objednavky');
	
    $form = new Form();
    $form->addSelect('id', 'id_objednavky:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať objednávku na zmazanie.');
    $form->addSubmit('create', 'Zmazať');
	
	$form->onSuccess[] = $this->taskFormSubmitted5;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted5(Form $form)
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
	
	
	//vytvorenie formularu na zmazanie objednavok
	protected function createComponentTaskForm7()
	{
	$userPairs = $this->userRepository->findAll()->fetchPairs('id', 'username');
	$userPairs2 = $this->rolesRepository->findAll()->fetchPairs('id_role', 'nazov');
	
	
    $form = new Form();
	 
    $form->addSelect('id', 'username:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné vybrať užívateľa na editovanie.');
	
	 $form->addSelect('id_role', 'nazov:', $userPairs2)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať rolu pre užívateľa.');
	$form->addText('meno', 'Skutočné meno:', 20, 50)
           ->addRule(Form::FILLED, 'Je treba zadať názov skutočný názov pre užívateľa');
	
	 $form->addPassword('newPassword', 'Nové heslo:', 30)
            ->addRule(Form::MIN_LENGTH, 'Nové heslo musí mať aspoň %d znaků.', 6);
      $form->addPassword('confirmPassword', 'Potvrdenie hesla:', 30)
            ->addRule(Form::FILLED, 'Nové heslo je treba zadať ešte raz pre potvrdenie.')
            ->addRule(Form::EQUAL, 'Zadané heslá sa musia zhodovať.', $form['newPassword']);
	

    $form->addSubmit('create', 'Editovať');
	
	$form->onSuccess[] = $this->taskFormSubmitted7;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted7(Form $form)
	{
		
		
   	$this->userRepository->editUser($form->values->id,$form->values->id_role,$form->values->meno,$form->values->newPassword);
   
    $this->redirect('this');
	}
	
	
	
	
	
	
	
	
	
	
	

	
	

}