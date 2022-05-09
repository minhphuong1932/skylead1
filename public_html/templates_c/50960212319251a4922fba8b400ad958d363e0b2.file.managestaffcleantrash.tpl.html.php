<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-18 15:48:48
         compiled from "./templates/admin/managestaffcleantrash.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:302791177625d25f02a9902-38047098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50960212319251a4922fba8b400ad958d363e0b2' => 
    array (
      0 => './templates/admin/managestaffcleantrash.tpl.html',
      1 => 1635911807,
    ),
  ),
  'nocache_hash' => '302791177625d25f02a9902-38047098',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="contType">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes');?>
:</h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes_clean_trash');?>
</div>
<form name="formClean" id="formClean" action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post">
<fieldset>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="cleantrash" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<p class="btn"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" name="btnSubmit2" />
<input type="button" onclick="javascript:formSubmit('formClean','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>