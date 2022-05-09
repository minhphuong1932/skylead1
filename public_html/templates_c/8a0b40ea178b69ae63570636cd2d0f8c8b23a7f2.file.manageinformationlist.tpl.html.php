<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 11:08:58
         compiled from "./templates/admin/manageinformationlist.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:945726528618f3a5ac9aef0-11378473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a0b40ea178b69ae63570636cd2d0f8c8b23a7f2' => 
    array (
      0 => './templates/admin/manageinformationlist.tpl.html',
      1 => 1635911785,
    ),
  ),
  'nocache_hash' => '945726528618f3a5ac9aef0-11378473',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('pId')->value){?><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=information&mod=list&pId=<?php echo $_smarty_tpl->getVariable('gfId')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back_group');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/icon_parent.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back_group');?>
" width="32" height="32" />...<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back');?>
</a></p><?php }?>
<?php if ($_smarty_tpl->getVariable('listItems')->value){?>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th><input type="checkbox" name="all" id="all" value="1" class="box3" onClick="toggleAllChecks('formType');" /></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('numbers');?>
</th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','id','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('id');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('id');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="id"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','name','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_name');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="name"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','email','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('email');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('email');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="email"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','phone','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('telephone');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('telephone');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="phone"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','created','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('date_created');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('date_created');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="created"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
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
<td><input type="checkbox" name="ids[]" id="ids[]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="box3" /></td>
<td><?php echo $_smarty_tpl->getVariable('startNum')->value+$_smarty_tpl->tpl_vars['no']->value;?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 </td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
 </td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
 </td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getDateCreated();?>
 </td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getStatusTextBackend();?>
</td>
<td>
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
<a href="javascript:formSubmit('formType','list','delete',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_delete.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
" width="16" height="16" /></a>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
<div class="paging">
<p class="listBtn">
<!-- <a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_update');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','changeposition','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_update');?>
</a> -->
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','enable','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
</a>
<!-- <a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','disable','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
</a> -->
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','delete','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
</a>
</p>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corepager.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','pager'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<div class="infoType2">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corecomboipp.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','ipp'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="information" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="pId" value="<?php echo $_smarty_tpl->getVariable('pId')->value;?>
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

<?php }?>
</div>