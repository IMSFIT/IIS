<?php //netteCache[01]000442a:2:{s:4:"time";s:21:"0.34917000 1385225512";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:119:"C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Sign\in.latte";i:2;i:1385225511;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"80a7e46 released on 2013-08-08";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\projects\IIS2\nette\sandbox\app\templates\Sign\in.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'pneqeonggi')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb86fe7b824e_content')) { function _lb86fe7b824e_content($_l, $_args) { extract($_args)
;call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("signInForm") ? "signInForm" : $_control["signInForm"]), array()) ?>
<div class="sign-in-form">
<?php if (is_object($form)) $_ctrl = $form; else $_ctrl = $_control->getComponent($form); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render('errors') ?>

    <div class="pair">
<?php $_input = is_object("username") ? "username" : $_form["username"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php $_input = (is_object("username") ? "username" : $_form["username"]); echo $_input->getControl()->addAttributes(array()) ?></div>
    </div>
    <div class="pair">
<?php $_input = is_object("password") ? "password" : $_form["password"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?>
        <div class="input"><?php $_input = (is_object("password") ? "password" : $_form["password"]); echo $_input->getControl()->addAttributes(array()) ?></div>
    </div>
    

    <div class="pair">
        <div class="input"><?php $_input = (is_object("login") ? "login" : $_form["login"]); echo $_input->getControl()->addAttributes(array()) ?></div>
    </div>
</div>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ;
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb7854e434eb_title')) { function _lb7854e434eb_title($_l, $_args) { extract($_args)
?><h1>Prihlásenie do systému</h1>
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