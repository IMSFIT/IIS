<?php //netteCache[01]000457a:2:{s:4:"time";s:21:"0.98657900 1385900260";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:134:"C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Kucharka\confirmchange.latte";i:2;i:1385900151;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Kucharka\confirmchange.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '4mm6njwzv5')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb467caac227_content')) { function _lb467caac227_content($_l, $_args) { extract($_args)
?><div class="menu">
<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Kucharka:objednavka")) ?>
">Zobrazenie všetkých objednávok</a></li>
<div class="menu2">
<ul>

<li><a href="<?php echo htmlSpecialChars($_control->link("Kucharka:confirmchange")) ?>
">Potvrdenie/zmena objednávok</a></li>

</ul>
</div>
<li><a href="<?php echo htmlSpecialChars($_control->link("Kucharka:suroviny")) ?>
">Zobrazenie surovín</a></li>
<div class="menu2">

<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Kucharka:surovinyadd")) ?>
">Doplnenenie surovín do skladu</a></li>


</ul>

</div>








</ul>
</div>
<div class="center3">
<h1>Zobrazenie objednávok a ich potvrdenie alebo zmena</h1>
<fieldset>
    <legend>Potvrdenie alebo zmena objednávky</legend>

<?php $_ctrl = $_control->getComponent("taskForm4"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</fieldset>






<table>
    <thead>
    <tr>
	<th>ID objednávky</th>
        <th>Oddelenie</th>
        <th>Preferované jedlo</th>
        <th>Stav objednávky</th>
		<th>RC pacienta</th>
        <th>Priezvisko pacienta</th>    
    </tr>
    </thead>
    <tbody>
<?php $iterations = 0; foreach ($objednavkys as $objednavky): ?>
                <tr>
						 <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->id_objednavky, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->oddeleni, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->jidlo->nazev_jidla, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->stav, ENT_NOQUOTES) ?></td>
						 <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->rc_pacienta, ENT_NOQUOTES) ?></td>
						
						
				</tr>
<?php $iterations++; endforeach ?>
   
    </tbody>
</table>



<table>
    <thead>
    <tr>
	<th>Názov suroviny</th>
        <th>Množstvo suroviny</th>
        <th>Dátum objednania</th>
        <th>Množstvo objednané suroviny</th>
 
    </tr>
    </thead>
    <tbody>
<?php $iterations = 0; foreach ($surovinys as $suroviny): ?>
                <tr>
						 <td><?php echo Nette\Templating\Helpers::escapeHtml($suroviny->nazev_suroviny, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($suroviny->mnozstvi_surovin, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($suroviny->datum_objednavky, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($suroviny->mnozstvi_objednane_suroviny, ENT_NOQUOTES) ?></td>

						
						
				</tr>
<?php $iterations++; endforeach ?>
   
    </tbody>
</table>
<br />
<br />

<table>
    <thead>
    <tr>
        <th>rodné číslo</th>
        <th>Jméno</th>
        <th>Priezvisko</th>
		<th>Meno ošetrujúceho lekára</th>
		<th>Dátum prijatia</th>
		
		<th>Názov diety</th>
		<th>Zmena diety</th>
		<th>Číslo izby</th>
	
    </tr>
    </thead>
    <tbody>
<?php $iterations = 0; foreach ($pacients as $pacient): ?>
                <tr>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->rodne_cislo, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->jmeno, ENT_NOQUOTES) ?></td>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->prijmeni, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->jmeno_osetrujiciho_lekare, ENT_NOQUOTES) ?></td>
                	    <td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->datum_prijeti, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->diety->nazev_diety, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->zmena_diety, ENT_NOQUOTES) ?></td>
						<td><?php echo Nette\Templating\Helpers::escapeHtml($pacient->cislo_pokoje, ENT_NOQUOTES) ?></td>
						
						
				</tr>
<?php $iterations++; endforeach ?>
   
    </tbody>
</table>


</div>






<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 