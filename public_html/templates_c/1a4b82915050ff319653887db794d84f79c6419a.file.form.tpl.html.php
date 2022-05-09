<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-08 14:23:43
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/form.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1193032185624fe2ffbcedf2-09617471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a4b82915050ff319653887db794d84f79c6419a' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/form.tpl.html',
      1 => 1649402233,
    ),
  ),
  'nocache_hash' => '1193032185624fe2ffbcedf2-09617471',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
    <input hidden class="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
">
    <div class="plane-form__block">
      <?php echo $_smarty_tpl->getVariable('locale')->value->msg('text_form1');?>

      <span class="plane-form__group">
        <label for="plane-name"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
,</label>
        <span class="plane-form__popup">
          <input placeholder="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
" type="text" name="plane-name" id="plane-name">
          <i class="fas fa-chevron-right"></i>
          <span class="plane-form__message"></span>
        </span>
      </span> 
      <span class="plane-form__group">
        <label for="plane-phone"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('tel');?>
</label>
        <span class="plane-form__popup">
          <input placeholder="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('tel');?>
" type="number" name="plane-phone" id="plane-phone">
          <i class="fas fa-chevron-right"></i>
          <span class="plane-form__message"></span>
        </span>
      </span>      
      <?php echo $_smarty_tpl->getVariable('locale')->value->msg('text_form2');?>

      <span class="plane-form__group">
        <label for="plane-email">email.</label>
        <span class="plane-form__popup plane-form__popup--2">
          <input class="last-input" placeholder="email" type="email" name="plane-email" id="plane-email">
          <i class="fas fa-chevron-right"></i>
          <span class="plane-form__message"></span>
        </span>
      </span> <br>
      <?php echo $_smarty_tpl->getVariable('locale')->value->msg('text_form3');?>

    </div>
    <input class="plane-form__submit" onclick="saveInformation()" type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('send');?>
">

