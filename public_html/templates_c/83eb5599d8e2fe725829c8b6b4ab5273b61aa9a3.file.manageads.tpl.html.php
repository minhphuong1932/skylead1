<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:29:06
         compiled from "./templates/admin/manageads.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1857874958618f3102d84c81-56567519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83eb5599d8e2fe725829c8b6b4ab5273b61aa9a3' => 
    array (
      0 => './templates/admin/manageads.tpl.html',
      1 => 1635911777,
    ),
  ),
  'nocache_hash' => '1857874958618f3102d84c81-56567519',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coreheader.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="main" class="left-content">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coreleft.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'top'-'menu'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="content">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corenavigation.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','navigation'-'bar'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="innerContent">
<div id="tabContent" class="tabContent">
<?php if ($_smarty_tpl->getVariable('mod')->value=="list"){?>
<div class="search">
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formSearch">
<fieldset>
<?php if ($_smarty_tpl->getVariable('listArticlePro')->value){?>
<select name="tid">
<option value="">----- Dự án -----</option>
<?php  $_smarty_tpl->tpl_vars['artiproitem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listArticlePro')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['artiproitem']->key => $_smarty_tpl->tpl_vars['artiproitem']->value){
?>
<option value="<?php echo $_smarty_tpl->getVariable('artiproitem')->value->getId();?>
" <?php if ($_smarty_tpl->getVariable('tid')->value==$_smarty_tpl->getVariable('artiproitem')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('artiproitem')->value->getTitle();?>
</option>
<?php }} ?>
</select>
<?php }?>
<select name="gId">
<option value="">----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('filter_group');?>
 -----</option>
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select>
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('search');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('search');?>
" name="btnSearch" class="btnSearch" />
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="search" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="hidden" name="ipp" value="<?php echo $_smarty_tpl->getVariable('ipp')->value;?>
" />
<input type="hidden" name="sk" value="<?php echo $_smarty_tpl->getVariable('sk')->value;?>
" />
<input type="hidden" name="sd" value="<?php echo $_smarty_tpl->getVariable('sd')->value;?>
" />
<input type="hidden" name="pg" value="<?php echo $_smarty_tpl->getVariable('pg')->value;?>
" />
</fieldset>
</form>
</div>
<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coretabs.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','show'-'tabs'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="tableContent">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/".($_smarty_tpl->getVariable('op')->value).($_smarty_tpl->getVariable('act')->value).($_smarty_tpl->getVariable('mod')->value).".tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','show'-'tabs'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corefooter.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>