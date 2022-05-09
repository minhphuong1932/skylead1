<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 11:32:42
         compiled from "./templates/admin/systemfieldedit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:89039944618f3fead5a4a0-85734710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '148485f92408669444401270396abec8e7aae0f6' => 
    array (
      0 => './templates/admin/systemfieldedit.tpl.html',
      1 => 1635911802,
    ),
  ),
  'nocache_hash' => '89039944618f3fead5a4a0-85734710',
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit_field_method');?>
</h1>
<?php if ($_smarty_tpl->getVariable('validItem')->value){?>
<?php if ($_smarty_tpl->getVariable('item')->value){?>
<!-- Load user info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select class="small" name="status" id="status">
<option value="1"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
" name="position" id="position" /></p>
<p><label for="module">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('object');?>
: </label><?php echo $_smarty_tpl->getVariable('item')->value->getModule();?>
</p>
<p><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
: </label><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</p>
<p><label for="title">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('title');?>
:</label>
<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
" name="title" id="title" /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('color_size');?>
</p>
<p><label for="class"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('css_class');?>
: </label>
<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getClass();?>
" name="class" id="class" />(<?php echo $_smarty_tpl->getVariable('locale')->value->msg('css_class_note');?>
</p>
<p><label for="type">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('custom_field_type');?>
:</label>
<select name="type" id="type" class="small" onChange="javascript:showFieldValueControl(this,'value_p');">
<?php echo $_smarty_tpl->getVariable('typeCombo')->value;?>

</select>
</p>
<p id="value_p" <?php if ($_smarty_tpl->getVariable('item')->value->getType()<=3||$_smarty_tpl->getVariable('item')->value->getType()==8){?>class="hidden"<?php }?>><label for="value">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('custom_field_value');?>
:<br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('format_item');?>
: KEY:VALUE<br />
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arow_antem');?>
</label>

<p class="btn">
<input type="hidden" name="op" value="system" />
<input type="hidden" name="act" value="field" />
<input type="hidden" name="mod" value="edit" />
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
<input type="button" onClick="javascript:formSubmit('formEdit','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }else{ ?>
<!-- Load submitted info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select class="small" name="status" id="status">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<p><label for="module">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('object');?>
: </label><?php echo $_smarty_tpl->getVariable('itemInfo')->value->getModule();?>
</p>
<p><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
: </label><?php echo $_smarty_tpl->getVariable('itemInfo')->value->getName();?>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['title']['error']){?> class="errormsg"<?php }?>><label for="title">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('title');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['title']['value'];?>
<?php }?>" name="title" id="title" /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('color_size');?>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['class']['error']){?> class="errormsg"<?php }?>><label for="class"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('css_class');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['class']['value'];?>
<?php }?>" name="class" id="class" />(<?php echo $_smarty_tpl->getVariable('locale')->value->msg('css_class_note');?>
</p>
<p><label for="type">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('custom_field_type');?>
:</label>
<select name="type" id="type" class="small" onChange="javascript:showFieldValueControl(this,'value_p');">
<?php echo $_smarty_tpl->getVariable('typeCombo')->value;?>

</select>
</p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['value']['error']){?> class="errormsg"<?php }else{ ?> class="hidden"<?php }?>><label for="value">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('custom_field_value');?>
:<br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('format_item');?>
: KEY:VALUE<br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('arow_antem');?>
</label>
<textarea rows="10" cols="20" name="value" id="value"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['value']['value'];?>
<?php }?></textarea></p>
<p class="btn">
<input type="hidden" name="op" value="system" />
<input type="hidden" name="act" value="field" />
<input type="hidden" name="mod" value="edit" />
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
<input type="button" onClick="javascript:formSubmit('formEdit','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
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