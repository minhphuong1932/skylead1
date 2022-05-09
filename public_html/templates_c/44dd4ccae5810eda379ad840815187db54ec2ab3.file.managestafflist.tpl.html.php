<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 13:54:41
         compiled from "./templates/admin/managestafflist.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:714235698618f61311166e6-85003385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44dd4ccae5810eda379ad840815187db54ec2ab3' => 
    array (
      0 => './templates/admin/managestafflist.tpl.html',
      1 => 1635911807,
    ),
  ),
  'nocache_hash' => '714235698618f61311166e6-85003385',
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th>

	<input type="checkbox" name="all" id="all" value="1" class="box3" onclick="toggleAllChecks('formType');" />
</th>
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
','fullname','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_name');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('fullname');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="fullname"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>

<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','type','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_position');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="type"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','last_login','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_last_login');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('last_login');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="last_login"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','status','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_status');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="status"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('actions');?>
</th>
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
<td>
	<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()!=$_smarty_tpl->getVariable('item')->value->getType()){?>
	<input type="checkbox" name="ids[]" id="ids[]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="box3" />
 <?php }?>
</td>
<td><?php echo $_smarty_tpl->getVariable('startNum')->value+$_smarty_tpl->tpl_vars['no']->value;?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getUsername();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getFullName();?>
</td>

<td><?php echo $_smarty_tpl->getVariable('item')->value->getTypeTextBackend();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getLastLogin();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getStatusTextBackend();?>
</td>
<td>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&lang=<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_edit.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit');?>
" width="16" height="16" /></a>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=permission&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&lang=<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('permission');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_permission.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('permission');?>
" width="16" height="16" /></a><?php }?>
<a href="javascript:formSubmit('formType','list','enable',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_enable.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
" width="16" height="16" /></a>
<a href="javascript:formSubmit('formType','list','disable',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_disable.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
" width="16" height="16" /></a>
<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()!=$_smarty_tpl->getVariable('item')->value->getType()){?>
<a href="javascript:formSubmit('formType','list','delete',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_delete.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
" width="16" height="16" /></a>
<?php }?>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><a href="javascript:formSubmit('formType','listTracking','','<?php echo $_smarty_tpl->getVariable('item')->value->getUsername();?>
');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('tracking_title');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_log.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('tracking_title');?>
" width="16" height="16" /></a><?php }?>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
<div class="paging">
<p class="listBtn">
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','enable','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','disable','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','delete','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
</a>
<!-- <a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=export" title="Export nhân viên">Export nhân viên</a> -->

</p>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corepager.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','pager'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<div class="infoType2">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corecomboipp.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','ipp'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="listCategory">
<select name="type">
<option value="0" selected="selected">----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_group');?>
 -----</option>
<option value="1"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('employment');?>
</option>
<option value="2"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('managerment');?>
</option>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteSuperAdmin()){?><option value="7"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('superadmin');?>
</option><?php }?>
<option value="5"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('member');?>
</option>
<option value="6"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('khach');?>
</option>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><option value="3"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('founder');?>
</option><?php }?>
</select>
<input type="button" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_move');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_move');?>
" class="btnSubmit2" name="btnSubmit2" onclick="javascript:formSubmit('formType','list','changegroup','0');" />
</div>
</div>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="uid" value="<?php echo $_smarty_tpl->getVariable('uid')->value;?>
" />
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
<input type="hidden" name="id" value="" />
</form>
<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('no_record');?>

<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="" />
</form>
<?php }?>
</div>