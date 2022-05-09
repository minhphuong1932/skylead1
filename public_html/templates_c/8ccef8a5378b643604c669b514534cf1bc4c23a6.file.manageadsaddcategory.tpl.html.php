<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 11:04:11
         compiled from "./templates/admin/manageadsaddcategory.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1724564729618f393b97e782-50497098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ccef8a5378b643604c669b514534cf1bc4c23a6' => 
    array (
      0 => './templates/admin/manageadsaddcategory.tpl.html',
      1 => 1635912315,
    ),
  ),
  'nocache_hash' => '1724564729618f393b97e782-50497098',
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
<ul class="tabs">
<li><a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formAdd','list','',0);"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li><a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formAdd','add','',0);"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li><a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_banner_category');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formAdd','listcategory','',0);"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_banner_category');?>
</a></li>
<li class="current"><a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_banner_category');?>
" href="javascript:;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_banner_category');?>
</a></li>
<li><a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('clean_trash');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formAdd','cleantrash','',0);"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('clean_trash');?>
</a></li>
</ul>
<div class="tableContent hidden"><center><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/loading.gif" width="36" height="36" alt="Loading" /></center></div>
<div class="tableContent hidden"><center><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/loading.gif" width="36" height="36" alt="Loading" /></center></div>
<div class="tableContent hidden"><center><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/loading.gif" width="36" height="36" alt="Loading" /></center></div>
<div class="tableContent">
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_product_category');?>
</h1>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<!--<p><label for="parent_id">Thuộc nhóm quảng cáo:</label>
<select name="parent_id" id="parent_id">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>-->
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_ads_group');?>
: </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['name']['value'];?>
<?php }?>" name="name" id="name" /></p>
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
<label for="bannersub">Banner con:</label>
<input type="file" name="bannersub[]" multiple="multiple">
</p>

<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="addcategory" />
<input type="hidden" name="doo" value="submit" />
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
<input type="button" onclick="javascript:formSubmit('formAdd','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>
</div>
<div class="tableContent hidden">
<div class="contType"><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes');?>
:</h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes_clean_trash');?>
</div>
<form name="formClean" id="formClean" action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post">
<fieldset>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="listcategory" />
<input type="hidden" name="doo" value="cleantrash" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<p class="btn"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" name="btnSubmit2" />
<input type="button" onclick="javascript:formSubmit('formClean','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corefooter.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>