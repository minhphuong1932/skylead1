<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 11:04:17
         compiled from "./templates/admin/manageadseditcategory.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1990532703618f394165b088-22415675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffe0e1ea86d73a9cb3a344c9a085aa4a1230b635' => 
    array (
      0 => './templates/admin/manageadseditcategory.tpl.html',
      1 => 1635911777,
    ),
  ),
  'nocache_hash' => '1990532703618f394165b088-22415675',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<?php if ($_smarty_tpl->getVariable('error')->value['invalid']||$_smarty_tpl->getVariable('error')->value['message']){?>
<?php $_smarty_tpl->assign('input',$_smarty_tpl->getVariable('error')->value['INPUT'],null,null);?>
<div class="errorBox">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('error_notes');?>
:</h2>
<ul class="listStyle">
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('input')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['error']){?><li><?php echo $_smarty_tpl->tpl_vars['field']->value['message'];?>
</li><?php }?>
<?php }} ?>
<li><?php echo $_smarty_tpl->getVariable('error')->value['message'];?>
</li>
</ul>
</div>
<?php }?>
<?php }?>
<div class="formContent">
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit_product_category');?>
</h1>
<?php if ($_smarty_tpl->getVariable('validItem')->value){?>
<?php if ($_smarty_tpl->getVariable('item')->value){?>
<!-- Load store info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_ads_group');?>
: </label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" name="name" id="name" /></p>


<p><label for="status">Thuộc dự án:</label>
<select name="pid" id="pid">
	<option value="0">Gốc</option>
	
<?php if ($_smarty_tpl->getVariable('listArticlePro')->value){?>
<?php  $_smarty_tpl->tpl_vars['artiproitem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listArticlePro')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['artiproitem']->key => $_smarty_tpl->tpl_vars['artiproitem']->value){
?>
<option value="<?php echo $_smarty_tpl->getVariable('artiproitem')->value->getId();?>
"<?php if ($_smarty_tpl->getVariable('item')->value->getPId()==$_smarty_tpl->getVariable('artiproitem')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('artiproitem')->value->getTitle();?>
</option>
<?php }} ?>
<?php }?>
</select></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status">
<option value="1"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p class="boxTyle">
<label for="bannersub">Mặt bằng:</label>
<input type="file"  name="bannersub[]" multiple="multiple" style="width: 300px;" />
</p>
<?php $_smarty_tpl->assign('photos',$_smarty_tpl->getVariable('item')->value->getProperty('photos'),null,null);?>
<?php if ($_smarty_tpl->getVariable('photos')->value){?>
<div style="margin:10px 0 15px 210px">
<?php  $_smarty_tpl->tpl_vars['photo'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['photo']->key => $_smarty_tpl->tpl_vars['photo']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['photo']->value){?>
<a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/l_<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/a_<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" width="50" alt="Logo"/></a>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=editcategory&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delFilesub&photo=<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a>
<?php }?>
<?php }} ?>
</div>
<?php }?>
<!-- <p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['error']){?> class="errormsg"<?php }?>><label for="ipp">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('num_baner_display');?>
:</label>
<?php $_smarty_tpl->assign('catInfo',$_smarty_tpl->getVariable('estore')->value->getAdsCategoryInfo($_smarty_tpl->getVariable('id')->value),null,null);?>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('catInfo')->value['rows'];?>
" name="ipp" id="ipp" /></p> -->
<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="editcategory"/>
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit" />
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
<input type="button" onclick="javascript:formSubmit('formEdit','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }else{ ?>
<!-- Load submitted info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_ads_group');?>
: </label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('catInfo')->value->getName();?>
" name="name" id="name" /></p>

<p><label for="status">Thuộc dự án:</label>
<select name="pid" id="pid">
	<option value="0">Gốc</option>
<?php if ($_smarty_tpl->getVariable('listArticlePro')->value){?>
<?php  $_smarty_tpl->tpl_vars['artiproitem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listArticlePro')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['artiproitem']->key => $_smarty_tpl->tpl_vars['artiproitem']->value){
?>
<option value="<?php echo $_smarty_tpl->getVariable('artiproitem')->value->getId();?>
"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['pid']['value']==$_smarty_tpl->getVariable('artiproitem')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('artiproitem')->value->getTitle();?>
</option>
<?php }} ?>
<?php }?>
</select></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p class="boxTyle">
<label for="bannersub">Mặt bằng con:</label>
<input type="file" name="bannersub[]" multiple="multiple">
</p>
<!-- <p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['error']){?> class="errormsg"<?php }?>><label for="ipp">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('num_baner_display');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['value'];?>
<?php }?>" name="ipp" id="ipp" /></p> -->

<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="editcategory" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />

<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit" />
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
<input type="button" onclick="javascript:formSubmit('formClean','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('locale')->value->msg('code_invalid');?>
...<?php }?>
</div>
</div>