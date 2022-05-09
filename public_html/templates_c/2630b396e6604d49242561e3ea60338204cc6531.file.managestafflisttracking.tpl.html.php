<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-18 15:48:49
         compiled from "./templates/admin/managestafflisttracking.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2018960798625d25f14197a8-62848648%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2630b396e6604d49242561e3ea60338204cc6531' => 
    array (
      0 => './templates/admin/managestafflisttracking.tpl.html',
      1 => 1635911807,
    ),
  ),
  'nocache_hash' => '2018960798625d25f14197a8-62848648',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('listItems')->value){?>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_action_log_user');?>
 <?php echo $_smarty_tpl->getVariable('username')->value;?>
</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('numbers');?>
</th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','id','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_code');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('code');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="id"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','username','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_username');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('username');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="username"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','action','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_action');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('action');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="action"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','date_created','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_date');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('date_created');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="date_created"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','ip','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_ip');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('ip');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="ip"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
</tr>
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
<tr<?php if ($_smarty_tpl->tpl_vars['no']->value%2==0){?> class="bgType"<?php }?>>
<td><?php echo $_smarty_tpl->getVariable('startNum')->value+$_smarty_tpl->tpl_vars['no']->value;?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getUsername();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getAction();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getDateCreated();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getIp();?>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
<div class="paging">
<div class="listCategory">
<select name="from_date">
<option value="0" selected="selected">----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_time');?>
 -----</option>
<option value="365"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('from_year_ago');?>
</option>
<option value="180"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('from_six_month');?>
</option>
<option value="30"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('from_month_ago');?>
</option>
<option value="7"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('from_week_ago');?>
</option>
<option value="all"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('all');?>
</option>
</select>
<input type="button" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_log');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_log');?>
" class="btnSubmit2" name="btnSubmit2" onclick="javascript:formSubmit('formType','listTracking','clear','<?php echo $_smarty_tpl->getVariable('username')->value;?>
');" />
</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corepager.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','pager'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<div class="infoType2">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corecomboipp.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','ipp'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
<input type="hidden" name="mod" value="listTracking" />
<input type="hidden" name="doo" value="" />
<input type="hidden" name="kw" value="<?php echo $_smarty_tpl->getVariable('kw')->value;?>
" />
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
</form>
<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('no_record');?>

<?php }?>
</div>