<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:01:52
         compiled from "./templates/admin/coretabs.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:102874396618f2aa04126e5-05006179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48980f50e11adb51dfa3e6d0db9ffca37fdfd521' => 
    array (
      0 => './templates/admin/coretabs.tpl.html',
      1 => 1635911811,
    ),
  ),
  'nocache_hash' => '102874396618f2aa04126e5-05006179',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('listTabs')->value){?>
<ul class="tabs">
<?php  $_smarty_tpl->tpl_vars['url'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTabs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tab']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['url']->key => $_smarty_tpl->tpl_vars['url']->value){
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['url']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['tab']['iteration']++;
?>
<li<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tab']['iteration']==$_smarty_tpl->getVariable('currentTab')->value){?> class="current"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a></li>
<?php }} ?>
</ul>
<?php }?>