<?php
$lang = $request->element('lang'); 
if(!$lang){
    $lang = "vn";
}
$template->assign('lang',$lang);
$templateFile = '404.tpl.html';
?>