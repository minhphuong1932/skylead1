<?php /* Smarty version Smarty-3.0-RC2, created on 2022-01-21 16:31:12
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/menu-top.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:101508826561ea7d60e7fcc1-57100970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94c1c1673d2796c6708e03be5554bcc3819d4f7d' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/menu-top.tpl.html',
      1 => 1642754808,
    ),
  ),
  'nocache_hash' => '101508826561ea7d60e7fcc1-57100970',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<ul class="header__list">
    <?php if ($_smarty_tpl->getVariable('menuTopLeft')->value){?>
    <?php  $_smarty_tpl->tpl_vars['itemMenuTopLeft'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuTopLeft')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemMenuTopLeft']->key => $_smarty_tpl->tpl_vars['itemMenuTopLeft']->value){
?>
    <li>
        <a class="item-<?php echo $_smarty_tpl->getVariable('itemMenuTopLeft')->value->getProperty('custom_css');?>
" data-target="<?php echo $_smarty_tpl->getVariable('itemMenuTopLeft')->value->getPosition();?>
">
            <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemMenuTopLeft')->value->getName($_tmp1);?>

        </a>
    </li>
    <?php }} ?>
    <?php }?>
    </ul>
    <a class="header__logo hide-on-mobile-tablet" href="/">
    <img  src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('store_logo');?>
" alt="logo">
    </a>
    <input type="hidden" id="new-logo" name="logo" value="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_logo_two');?>
">
    <ul class="header__list ">
    <?php if ($_smarty_tpl->getVariable('menuTopRight')->value){?>
    <?php  $_smarty_tpl->tpl_vars['itemMenuTopRight'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuTopRight')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemMenuTopRight']->key => $_smarty_tpl->tpl_vars['itemMenuTopRight']->value){
?>
    <li>
        <a class="item-<?php echo $_smarty_tpl->getVariable('itemMenuTopRight')->value->getProperty('custom_css');?>
" data-target="<?php echo $_smarty_tpl->getVariable('itemMenuTopRight')->value->getPosition();?>
">
            <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemMenuTopRight')->value->getName($_tmp2);?>

        </a>
    </li>
    <?php }} ?>
    <?php }?>
</ul>