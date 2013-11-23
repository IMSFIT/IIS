<?php //netteCache[01]000451a:2:{s:4:"time";s:21:"0.12847400 1385218664";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:128:"C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Kucharka\default.latte";i:2;i:1385218605;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Kucharka\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ty3tdyyu06')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb8d26c83dfd_content')) { function _lb8d26c83dfd_content($_l, $_args) { extract($_args)
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
<h1>Rozhranie pre kucharky</h1>
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