<?php //netteCache[01]000450a:2:{s:4:"time";s:21:"0.23449200 1384969196";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:127:"C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Sestra\accepted.latte";i:2;i:1384969173;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Sestra\accepted.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '0weqad47zq')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb7ea3dc14ae_content')) { function _lb7ea3dc14ae_content($_l, $_args) { extract($_args)
?><h1>Zobrazenie prijatých objednávok</h1>

<table>
    <thead>
    <tr>
        <th>Oddelenie</th>
      
        <th>Stav objednávky</th>
		<th>Nazov jidla</th>
        <th>Rodné číslo</th>    
    </tr>
    </thead>
    <tbody>
<?php $iterations = 0; foreach ($objednavkys as $objednavky): ?>
                <tr>
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->oddeleni, ENT_NOQUOTES) ?></td>
                     
                        <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->stav, ENT_NOQUOTES) ?></td>
                         <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->jidlo->nazev_jidla, ENT_NOQUOTES) ?></td>
                         <td><?php echo Nette\Templating\Helpers::escapeHtml($objednavky->rc_pacienta, ENT_NOQUOTES) ?></td>
                       
						

						
				</tr>
<?php $iterations++; endforeach ?>
   
    </tbody>
</table>

<a href="<?php echo htmlSpecialChars($_control->link("Sestra:pacient")) ?>">Zobrazenie pacientov</a>
<a href="<?php echo htmlSpecialChars($_control->link("Sestra:deleteeditdefault")) ?>
">Mazanie a Editovanie Objednávok</a>
<a href="<?php echo htmlSpecialChars($_control->link("Sestra:pacient")) ?>">Pridanie objednávok</a>
<a href="<?php echo htmlSpecialChars($_control->link("Sestra:accepted")) ?>">Zobrazenie prijatých objednávok</a>
<a href="<?php echo htmlSpecialChars($_control->link("Sestra:confirmed")) ?>">Zobrazenie potvredných objednávok</a>
<a href="<?php echo htmlSpecialChars($_control->link("Sestra:changed")) ?>">Zobrazenie zmenených objednávok</a>



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