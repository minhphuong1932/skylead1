<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 09:59:32
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/menu-right.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:200551092618f2a14e39c21-55142855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1659a6ef14184d028e968a259f7f08dc40140aa' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/menu-right.tpl.html',
      1 => 1636621113,
    ),
  ),
  'nocache_hash' => '200551092618f2a14e39c21-55142855',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/bar.png" alt="bar icon">
<div class="header__menu" style="background-image: url(<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('background_menuright');?>
);">
    <i class="fas fa-times"></i>
    <ul>
        <?php if ($_smarty_tpl->getVariable('menuRight')->value){?>
        <?php  $_smarty_tpl->tpl_vars['itemMenuRight'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuRight')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemMenuRight']->key => $_smarty_tpl->tpl_vars['itemMenuRight']->value){
?>
            <li>
            <a class="<?php echo $_smarty_tpl->getVariable('itemMenuRight')->value->getProperty('custom_css');?>
" href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemMenuRight')->value->getUrl($_tmp1);?>
">
                <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemMenuRight')->value->getName($_tmp2);?>

            </a>
            </li>
        <?php }} ?>
        <?php }?>
            
    </ul>

    <div class="header__language">
        <a href="/en/<?php if ($_smarty_tpl->getVariable('slug')->value){?><?php if ($_smarty_tpl->getVariable('id')->value){?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
<?php }?><?php }else{ ?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
.html<?php }?><?php }?><?php }else{ ?>index.html<?php }?>" class="<?php if ($_smarty_tpl->getVariable('lang')->value=='en'){?>active<?php }?>">
            <img src="https://cdn.pixabay.com/photo/2012/04/18/19/53/flag-37712_960_720.png" alt="usa">
        </a>
        <a href="/vn/<?php if ($_smarty_tpl->getVariable('slug')->value){?><?php if ($_smarty_tpl->getVariable('id')->value){?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
<?php }?><?php }else{ ?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
.html<?php }?><?php }?><?php }else{ ?>index.html<?php }?>"  class="<?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>active<?php }?>">
            <img src="https://cdn.pixabay.com/photo/2012/04/10/23/04/vietnam-26834_640.png" alt="vn">
        </a>
    </div>
</div>