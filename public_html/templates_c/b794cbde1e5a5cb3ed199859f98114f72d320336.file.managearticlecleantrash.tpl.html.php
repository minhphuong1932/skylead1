<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-12 12:11:15
         compiled from "./templates/admin/managearticlecleantrash.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:872491688625509f3b252c0-43596335%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b794cbde1e5a5cb3ed199859f98114f72d320336' => 
    array (
      0 => './templates/admin/managearticlecleantrash.tpl.html',
      1 => 1635911797,
    ),
  ),
  'nocache_hash' => '872491688625509f3b252c0-43596335',
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
<p> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_cate_clean');?>
:</p>
<p><input type="checkbox" name="categories" checked="checked" value="1"/> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('warning_clean_cate');?>
</p>
<input type="checkbox" name="items" checked="checked" value="1" /> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('posts');?>
</fieldset>
</p>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="article" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="cleantrash" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<p class="btn"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" name="btnSubmit2" />
<input type="button" onClick="javascript:formSubmit('formClean','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>