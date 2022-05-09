<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 11:31:03
         compiled from "./templates/admin/systemfieldadd.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1490385245618f3f874aa831-47065043%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf9fdb5b64cf76b12505028feacef49def890900' => 
    array (
      0 => './templates/admin/systemfieldadd.tpl.html',
      1 => 1635911802,
    ),
  ),
  'nocache_hash' => '1490385245618f3f874aa831-47065043',
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_custom_field');?>
</h1>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formAdd" id="formAdd" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status" class="small">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['module']['error']){?> class="errormsg"<?php }?>><label for="module">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('object');?>
: </label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['module']['value'];?>
<?php }?>" name="module" id="module" />(product, article, static, customer, order)</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
: </label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['name']['value'];?>
<?php }?>" name="name" id="name" />(Color, size, weight,...)</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['title']['error']){?> class="errormsg"<?php }?>><label for="title">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('title');?>
: </label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['title']['value'];?>
<?php }?>" name="title" id="title" /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('color_size');?>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['class']['error']){?> class="errormsg"<?php }?>><label for="class"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('css_class');?>
: </label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['class']['value'];?>
<?php }?>" name="class" id="class" />(small, medium, long, left, right, center,...)</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['type']['error']){?> class="errormsg"<?php }?>><label for="type">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('custom_field_type');?>
:</label>
<select name="type" id="type" class="small" onChange="javascript:showFieldValueControl(this,'value_p');">
<?php echo $_smarty_tpl->getVariable('typeCombo')->value;?>

</select>
</p>
<p id="value_p" <?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['value']['error']){?> class="errormsg"<?php }elseif($_smarty_tpl->getVariable('error')->value['INPUT']['type']['value']<=3){?> class="hidden"<?php }?>><label for="value">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('custom_field_value');?>
:<br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('format_item');?>
: KEY:VALUE<br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('arow_antem');?>
</label>
<textarea rows="10" cols="20" name="value" id="value"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['value']['value'];?>
<?php }?></textarea></p>
<p class="btn">
<input type="hidden" name="op" value="system" />
<input type="hidden" name="act" value="field" />
<input type="hidden" name="mod" value="add" />
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
<input type="button" onClick="javascript:formSubmit('formAdd','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>
</div>