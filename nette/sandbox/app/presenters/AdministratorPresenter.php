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
	protected $authenticator;
	protected $aktivitaRepository;
	
	
	protected function startup()
	{
    	parent::startup();
			if (!$this->getUser()->isLoggedIn()) {
        $this->redirect('Sign:in');
    }
    	$this->objednavkaRepository = $this->context->objednavkaRepository;
		$this->pacientRepository = $this->context->pacientRepository;
		$this->jidlaRepository = $this->context->jidlaRepository;
		$this->userRepository = $this->context->userRepository;
		$this->surovinyRepository = $this->context->surovinyRepository;
		$this->rolesRepository = $this->context->rolesRepository;
		$this->authenticator = $this->context->authenticator;
		$this->aktivitaRepository = $this->context->aktivitaRepository;
		
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
	
		public function renderConfirmchange()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAccepted();
		$this->template->surovinys = $this->surovinyRepository->findAll();
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
	
	//zobrazenie pre zmenené objednávky
	public function renderChange()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAccepted();
		$this->template->surovinys = $this->surovinyRepository->findAll();
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
            ->addRule(Form::MIN_LENGTH, 'Nové heslo musí mať aspoň %d znaků.', 5);
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
		
   	$this->userRepository->createUser($form->values->user, $form->values->username,$this->authenticator->calculateHash($form->values->newPassword),$form->values->id_role);
   
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
	$userPairs3 = $this->aktivitaRepository->findAll()->fetchPairs('id_aktivita', 'nazov');
	
    $form = new Form();
	 
    $form->addSelect('id', 'username:', $userPairs)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné vybrať užívateľa na editovanie.');
	
	 $form->addSelect('id_role', 'nazov:', $userPairs2)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať rolu pre užívateľa.');
	$form->addSelect('id_aktivita', 'nazov:', $userPairs3)
         ->setPrompt('- Vyberte -')
         ->addRule(Form::FILLED, 'Je nutné zadať aktivitu užívateľa.');
	$form->addText('meno', 'Skutočné meno:', 20, 50)
           ->addRule(Form::FILLED, 'Je treba zadať názov skutočný názov pre užívateľa');
	
	 $form->addPassword('newPassword', 'Nové heslo:', 30)
            ->addRule(Form::MIN_LENGTH, 'Nové heslo musí mať aspoň %d znaků.', 5);
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
		
		
   	$this->userRepository->editUser($form->values->id,$form->values->id_role,$form->values->meno,Authenticator::calculateHash($form->values->newPassword),$form->values->id_aktivita);
   
    $this->redirect('this');
	}
	
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm123()
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
	
	$form->onSuccess[] = $this->taskFormSubmitted123;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted123(Form $form)
	{
		//echo $form->values->rodne_cislo;
   $this->objednavkaRepository->createTask($form->values->text, $form->values->rodne_cislo,$form->values->id_jidla);
  
    $this->redirect('this');
	}
	
	
	//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm44()
	{
	
	$userPairs2 = $this->stavRepository->findAll()->fetchPairs('id_stav', 'nazov');
	$userPairs = $this->objednavkaRepository->findAccepted()->fetchPairs('id_objednavky', 'id_objednavky');
	$userPairs3 = $this->surovinyRepository->findAll()->fetchPairs('id_suroviny', 'nazev_suroviny');
	
    $form = new Form();
     $form->addSelect('id_objednavky', 'id_objednavky:', $userPairs)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať objednávku.');
   
	 $form->addSelect('stav', 'stav:', $userPairs2)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať stav pre objednávku.');
	
    $form->addSubmit('create', 'Zmenit');
	
	$form->onSuccess[] = $this->taskFormSubmitted44;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted44(Form $form)
	{
	if ($form->values->stav-1 == 1)
	{
	 
	 //test ci nie je uz nahodou potvrdena
	 $stavObjednavky = $this->objednavkaRepository->findBy(array('id_objednavky' => $form->values->id_objednavky))->fetch();
	 
	 if ( $stavObjednavky->stav == 1 or $stavObjednavky->stav == 2)
	 {
	   $this->flashMessage('<h1>Nastala chyba. Snaha o potvrdenie uz zmenenej alebo potvrdenej objednavky</h1>');
	   $this->redirect('this');
	 }
	 	
	$nazovJedlaZObjednavky = $this->objednavkaRepository->findBy(array('id_objednavky' => $form->values->id_objednavky))->fetch();
	
	$nazovJedla = $this->jidlaRepository->findBy(array('id_jidla' => $nazovJedlaZObjednavky->preferovane_jidlo))->fetch();
	
	
  
  	$mnozstvoVSklade = $this->surovinyRepository->findBy(array('nazev_suroviny' => $nazovJedla->nazev_jidla))->fetch();
	if ($mnozstvoVSklade->mnozstvi_surovin == 0 )
	{
	  	 $this->flashMessage('Nastala chyba. Nemozme potvrdit objednavku na dane jedlo,pretoze ho nie je dostatok v sklade. Doporucujeme zmenit typ jedla pre zakaznika.');
	   $this->redirect('this');
		
	}
	$mnozstvoVSklade->mnozstvi_surovin -= 1;

    $mnozstvoVSklade->mnozstvi_objednane_suroviny += 1;
	
 
   

	$this->objednavkaRepository->updateObjednavka($form->values->id_objednavky, $form->values->stav-1);
    $this->surovinyRepository->updateSkladByObjednavka( $mnozstvoVSklade->id_suroviny,$mnozstvoVSklade->mnozstvi_surovin, $mnozstvoVSklade->mnozstvi_objednane_suroviny);
    $this->redirect('this');
	}
	else if ($form->values->stav-1 == 0)
	{
	 $this->redirect('this');
	}
	else
	{
		 $this->redirect('Administrator:change');
		 
		 
	}
	}
	
	
		//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm10()
	{
		$userPairs = $this->jidlaRepository->findAll()->fetchPairs('id_jidla', 'nazev_jidla');
		$userPairs2 = $this->objednavkaRepository->findAccepted()->fetchPairs('id_objednavky', 'id_objednavky');
	
    $form = new Form();
	 
   	     $form->addSelect('id_objednavky', 'id_objednavky:', $userPairs2)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať objednávku.');
	$form->addSelect('id_jidla', 'nazev_jidla:', $userPairs)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať ID objednávky.');
    $form->addSubmit('create', 'Zmeniť');
	
	$form->onSuccess[] = $this->taskFormSubmitted10;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted10(Form $form)
	{	
	
	//test ci nie je uz nahodou potvrdena
	 $stavObjednavky = $this->objednavkaRepository->findBy(array('id_objednavky' => $form->values->id_objednavky))->fetch();
	 
	 if ( $stavObjednavky->stav == 1 or $stavObjednavky->stav == 2)
	 {
	    $this->flashMessage('Nastala chyba. Objednavka uz bola zmenena alebo potvrdena');
	   $this->redirect('this');
	 }
	
	 $nazovJedlaZObjednavky = $this->objednavkaRepository->findBy(array('id_objednavky' => $form->values->id_objednavky))->fetch();
	 
	$nazovJedla = $this->jidlaRepository->findBy(array('id_jidla' => $nazovJedlaZObjednavky->preferovane_jidlo))->fetch();
	$porovnanieJedla = $this->jidlaRepository->findBy(array('id_jidla' => $form->values->id_jidla))->fetch();
	if ($nazovJedla->nazev_jidla == $porovnanieJedla->nazev_jidla)
	{
	  	 $this->flashMessage('Nastala chyba. Nemozme zmenit jedlo na to iste.');
	   $this->redirect('this');
		
	}
	 $jedlo = $this->jidlaRepository->findBy(array('id_jidla' => $form->values->id_jidla))->fetch();
  
  	$mnozstvoVSklade = $this->surovinyRepository->findBy(array('nazev_suroviny' => $jedlo->nazev_jidla))->fetch();
	
	
	
	
	if ($mnozstvoVSklade->mnozstvi_surovin == 0 )
	{
	  	 $this->flashMessage('Nastala chyba. Nemozme zmenit objednavku na dane jedlo,pretoze ho nie je dostatok v sklade.');
	   $this->redirect('this');
		
	}
	
	$this->objednavkaRepository->updateJedlo($form->values->id_objednavky,$form->values->id_jidla);
	
	
	$mnozstvoVSklade->mnozstvi_surovin -= 1;

    $mnozstvoVSklade->mnozstvi_objednane_suroviny += 1;
	
    
   

	
    $this->surovinyRepository->updateSkladByJedlo($jedlo->nazev_jidla,$mnozstvoVSklade->mnozstvi_surovin, $mnozstvoVSklade->mnozstvi_objednane_suroviny);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
		$this->objednavkaRepository->updateObjednavka($form->values->id_objednavky, 2);
		
   
        $this->redirect('Administrator:confirmchange');
	}
	
	
	
	
	
	
	
	
	
	
	

	
	

}