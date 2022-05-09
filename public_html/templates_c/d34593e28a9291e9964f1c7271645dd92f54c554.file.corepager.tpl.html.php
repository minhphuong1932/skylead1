<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:07:43
         compiled from "./templates/admin/corepager.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1057506763618f2bffd2d988-24159172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd34593e28a9291e9964f1c7271645dd92f54c554' => 
    array (
      0 => './templates/admin/corepager.tpl.html',
      1 => 1635911811,
    ),
  ),
  'nocache_hash' => '1057506763618f2bffd2d988-24159172',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lower')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.lower.php';
?><?php if ($_smarty_tpl->getVariable('rowsPages')->value['pages']>=1){?>
<ul>
<li class="first"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('page');?>
</li>
<?php if ($_smarty_tpl->getVariable('pager')->value){?>
<?php  $_smarty_tpl->tpl_vars['pageItem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pager')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pageItem']->key => $_smarty_tpl->tpl_vars['pageItem']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['pageItem']->value['current']==1){?>
<li class="current"><?php echo $_smarty_tpl->tpl_vars['pageItem']->value['name'];?>
</li>
<?php }else{ ?>
<li><a href="<?php echo $_smarty_tpl->tpl_vars['pageItem']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['pageItem']->value['name'];?>
</a></li>
<?php }?>
<?php }} ?>
<?php }?>
<?php if ($_smarty_tpl->getVariable('rowsPages')->value['rows']&&$_smarty_tpl->getVariable('rowsPages')->value['pages']){?>
<li class="first"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('total_of');?>
 <?php echo number_format($_smarty_tpl->getVariable('rowsPages')->value['rows']);?>
 <?php echo $_smarty_tpl->getVariable('locale')->value->msg('result_display');?>
   <?php echo number_format($_smarty_tpl->getVariable('rowsPages')->value['pages']);?>
 <?php echo smarty_modifier_lower($_smarty_tpl->getVariable('amessages')->value['page']);?>
.</li>
<?php }?>
</ul>
<?php }?>