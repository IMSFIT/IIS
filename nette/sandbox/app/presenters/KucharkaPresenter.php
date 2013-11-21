<?php

use Nette\Application\UI\Form;
/**
 * Base presenter for all application presenters.
 *
 * @property callable $newListFormSubmitted
 */
class KucharkaPresenter extends BasePresenter
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
		if (!$this->getUser()->isLoggedIn()) {
        $this->redirect('Sign:in');
    }
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
	public function renderConfirmchange()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
		$this->template->surovinys = $this->surovinyRepository->findAll();
	}
	
	//zobrazenie pre zmenené objednávky
	public function renderChange()
	{
		$this->template->objednavkys = $this->objednavkaRepository->findAll();
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
	
	
		//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm4()
	{
	
	$userPairs2 = $this->stavRepository->findAll()->fetchPairs('id_stav', 'nazov');
	$userPairs = $this->objednavkaRepository->findAll()->fetchPairs('id_objednavky', 'id_objednavky');
	$userPairs3 = $this->surovinyRepository->findAll()->fetchPairs('id_suroviny', 'nazev_suroviny');
	
    $form = new Form();
     $form->addSelect('id_objednavky', 'id_objednavky:', $userPairs)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať objednávku.');
   
	 $form->addSelect('stav', 'stav:', $userPairs2)
        ->setPrompt('- Vyberte -')
        ->addRule(Form::FILLED, 'Je nutné zadať stav pre objednávku.');
	
    $form->addSubmit('create', 'Zmenit');
	
	$form->onSuccess[] = $this->taskFormSubmitted4;
    return $form;
	}
	
	//overenie formularu
	public function taskFormSubmitted4(Form $form)
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
		 $this->redirect('Kucharka:change');
		 
		 
	}
	}
	
	
		//vytvorenie formularu na pridanie novych objednavok
	protected function createComponentTaskForm10()
	{
		$userPairs = $this->jidlaRepository->findAll()->fetchPairs('id_jidla', 'nazev_jidla');
		$userPairs2 = $this->objednavkaRepository->findAll()->fetchPairs('id_objednavky', 'id_objednavky');
	
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
		
   
        $this->redirect('Kucharka:confirmchange');
	}

	
	
	
	
	
	

	
	

}