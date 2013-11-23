<?php //netteCache[01]000457a:2:{s:4:"time";s:21:"0.75130400 1385220671";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:134:"C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Administrator\suroviny.latte";i:2;i:1385220579;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Administrator\suroviny.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'o9s3y00x70')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb67fbc87bbf_content')) { function _lb67fbc87bbf_content($_l, $_args) { extract($_args)
?><div class="menu">
<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:objednavka")) ?>
">Zobrazenie všetkých objednávok</a></li>
<div class="menu2">
<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:deleteeditdefault")) ?>
">Mazanie Objednávok</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:adddefault")) ?>
">Pridanie objednávok</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:editdefault")) ?>
">Editovanie objednávok</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:accepted")) ?>
">Zobrazenie prijatých objednávok</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:confirmed")) ?>
">Zobrazenie potvrdených objednávok</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:changed")) ?>
">Zobrazenie zmeneneých objednávok</a></li>

<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:confirmchange")) ?>
">Potvrdenie/zmena objednávok</a></li>
</ul>
</div>
<div class="menu2">
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:user")) ?>
">Zobrazenie uzivatelov</a></li>
<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:useradd")) ?>
">Pridávanie užívateľov</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:deleteedituser")) ?>
">Mazanie užívateľov</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:edituser")) ?>
">Editovanie užívateľov</a></li>
</ul>

</div>

<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:pacient")) ?>
">Zobrazenie pacientov</a></li>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:suroviny")) ?>
">Zobrazenie surovín</a></li>
<div class="menu2">

<ul>
<li><a href="<?php echo htmlSpecialChars($_control->link("Administrator:surovinyadd")) ?>
">Doplnenenie surovín do skladu</a></li>


</ul>

</div>








</ul>
</div>

<div class="center">

<h1>Zobrazenie surovín</h1>






<table>
    <thead>
    <tr>
        <th>Nazov suroviny</th>
        <th>Množstvo surovín</th>
        <th>Dátum objednávky</th>
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