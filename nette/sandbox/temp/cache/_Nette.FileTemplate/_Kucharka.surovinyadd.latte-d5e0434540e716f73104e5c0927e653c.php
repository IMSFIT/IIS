<?php //netteCache[01]000455a:2:{s:4:"time";s:21:"0.38992500 1385218794";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:132:"C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Kucharka\surovinyadd.latte";i:2;i:1385218793;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Kucharka\surovinyadd.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'y0fyysh3dl')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbf92a7bcb93_content')) { function _lbf92a7bcb93_content($_l, $_args) { extract($_args)
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









</ul>
</div>
<div class="center3">
<h1>Zobrazenie surovín a ich pridanie zásob do skladu</h1>


<fieldset>
    <legend>Doplniť sklad</legend>

<?php $_ctrl = $_control->getComponent("taskForm2"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
</fieldset>




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