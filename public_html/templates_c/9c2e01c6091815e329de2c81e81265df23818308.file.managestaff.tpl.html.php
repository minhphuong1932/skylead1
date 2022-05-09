<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 13:54:41
         compiled from "./templates/admin/managestaff.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1371895626618f61310c44c7-66439684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c2e01c6091815e329de2c81e81265df23818308' => 
    array (
      0 => './templates/admin/managestaff.tpl.html',
      1 => 1635911807,
    ),
  ),
  'nocache_hash' => '1371895626618f61310c44c7-66439684',
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
<select name="gid">
<option value="all"<?php if ($_smarty_tpl->getVariable('gid')->value=='all'){?>selected="selected"<?php }?>>----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('filter_group');?>
 -----</option>
<option value="1"<?php if ($_smarty_tpl->getVariable('gid')->value==1){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('employment');?>
</option>
<option value="2"<?php if ($_smarty_tpl->getVariable('gid')->value==2){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('managerment');?>
</option>
<option value="7"<?php if ($_smarty_tpl->getVariable('gid')->value==7){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('superadmin');?>
</option>
<option value="5"<?php if ($_smarty_tpl->getVariable('gid')->value==5){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('member');?>
</option>
<option value="6"<?php if ($_smarty_tpl->getVariable('gid')->value==6){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('khach');?>
</option>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><option value="3"<?php if ($_smarty_tpl->getVariable('gid')->value==3){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('founder');?>
</option><?php }?>
</select>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('kw')->value;?>
" name="kw" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('search');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('search');?>
" name="btnSearch" class="btnSearch" />
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
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
<?php }elseif($_smarty_tpl->getVariable('mod')->value=='listTracking'){?>
<div class="search">
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formSearch">
<fieldset>
<select name="filter_date">
<option value="0" selected="selected">----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_display');?>
 -----</option>
<option value="today"<?php if ($_smarty_tpl->getVariable('filter_date')->value=='today'){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('in_today');?>
</option>
<option value="1"<?php if ($_smarty_tpl->getVariable('filter_date')->value=='1'){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('from_yesterday');?>
</option>
<option value="7"<?php if ($_smarty_tpl->getVariable('filter_date')->value=='7'){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('in_weekend');?>
</option>
<option value="30"<?php if ($_smarty_tpl->getVariable('filter_date')->value=='30'){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('in_month');?>
</option>
<option value="365"<?php if ($_smarty_tpl->getVariable('filter_date')->value=='365'){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('in_year');?>
</option>
<option value="all"<?php if ($_smarty_tpl->getVariable('filter_date')->value=='all'){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('all');?>
</option>
</select>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('kw')->value;?>
" name="kw" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('search');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('search');?>
" name="btnSearch" class="btnSearch" />
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
<input type="hidden" name="mod" value="listTracking" />
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
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('username')->value;?>
" />
</fieldset>
</form>
</div>
<?php }?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coretabs.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','show'-'tabs'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="tableContent">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/".($_smarty_tpl->getVariable('op')->value).($_smarty_tpl->getVariable('act')->value).((strtolower($_smarty_tpl->getVariable('mod')->value))).".tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','show'-'tabs'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corefooter.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>