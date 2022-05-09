<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-12 13:59:56
         compiled from "./templates/admin/coreleft.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:9653659406255236c4576e4-09087392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67d3e938c2fc6522e3751dc713c3c03ffe5bec5c' => 
    array (
      0 => './templates/admin/coreleft.tpl.html',
      1 => 1649745969,
    ),
  ),
  'nocache_hash' => '9653659406255236c4576e4-09087392',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('authUser')->value){?>
<div id="lev">
	<span class="button_setting"><i class="fa fa-bars" aria-hidden="true"></i></span>
<div class="levInner">
<ul>
<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()!=0){?>
<li<?php if ($_smarty_tpl->getVariable('op')->value=='dashboard'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=dashboard" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
</a>
<?php }?>	

<li<?php if ($_smarty_tpl->getVariable('act')->value=='article'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_article');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_article');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='article'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='addcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=addcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_article_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_article_category');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_article_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_article_category');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='banner'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_banner');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_banner');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='ads'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_banner_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_banner_category');?>
</a></li>
</ul>
<?php }?>
</li>
<!-- 
<li<?php if ($_smarty_tpl->getVariable('act')->value=='static'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_static');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_static');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='static'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li> -->
<li<?php if ($_smarty_tpl->getVariable('act')->value=='menu'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_menu');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_menu');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='menu'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_menu_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_menu_category');?>
</a></li>
</ul>
<?php }?>
</li>

<!-- Comment -->
<!-- <li<?php if ($_smarty_tpl->getVariable('act')->value=='comment'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=comment" title="Bình Luận">Bình Luận</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='comment'){?>
<ul>

<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=comment&mod=list" title="Danh Sách Bình Luận">Danh Sách Bình Luận</a></li>

</ul>
<?php }?>
</li> -->

<!-- information -->
<li<?php if ($_smarty_tpl->getVariable('act')->value=='information'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=information" title="Thông tin khách hàng">Thông tin khách hàng</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='information'){?>
<ul>

<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=information&mod=list" title="Danh sách thông tin khách hàng">Danh sách thông tin khách hàng</a></li>

</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='consultant'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=consultant" title="Thông tin đăng kí tư vấn">Danh sách khách hàng đăng kí tư vấn</a>
</li>

<!-- <li<?php if ($_smarty_tpl->getVariable('act')->value=='product'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_product');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_product');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='product'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='addcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=addcategory<?php if ($_smarty_tpl->getVariable('pId')->value){?>&pId=<?php echo $_smarty_tpl->getVariable('pId')->value;?>
<?php }?>" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_product_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_product_category');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_product_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_category');?>
</a></li>

</ul>
<?php }?>
</li> -->
<!-- <li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=gallery" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_gallery');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_gallery');?>
</a></li> -->
<!-- <li<?php if ($_smarty_tpl->getVariable('act')->value=='support'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_support');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_support');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='support'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_support');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_support');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li> -->

<!-- Quản lý nhân viên-->
<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()==3||$_smarty_tpl->getVariable('authUser')->value->getType()==4||$_smarty_tpl->getVariable('authUser')->value->getType()==2||$_smarty_tpl->getVariable('authUser')->value->getType()==7){?>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='add'||$_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='list'||$_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='dependentall'||$_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='awardall'||$_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='excel'||$_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='listTracking'){?> class="current"<?php }?>> <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_staff');?>
</span>
<ul>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=list" title="Danh sách nhân viên">Danh sách nhân viên</a></li>
<!-- <li<?php if ($_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='excel'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=excel" title="Import nhân viên">Import nhân viên</a></li> -->
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><li<?php if ($_smarty_tpl->getVariable('act')->value=='staff'&&$_smarty_tpl->getVariable('mod')->value=='listTracking'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=staff&mod=listTracking" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('tracking_title');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('tracking_title');?>
</a></li><?php }?> 

</ul>
<?php }?>


<!-- Hệ thống -->
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteAdmin()||$_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?>
<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()!=2){?> 
<li<?php if ($_smarty_tpl->getVariable('op')->value=='system'){?> class="current"}<?php }?>> <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
</span>

<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='general'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=general" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('general_config');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('general_config');?>
</a>
</li>

<li<?php if ($_smarty_tpl->getVariable('act')->value=='field'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=field" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_custom_field');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_custom_field');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='field'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=field&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=field&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>


<!-- <?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteAdmin()||$_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?>

<li<?php if ($_smarty_tpl->getVariable('act')->value=='email'){?> class="current"<?php }?>> <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_email_template');?>

</span>
<ul>
<li<?php if ($_smarty_tpl->getVariable('op')->value=='system'&&$_smarty_tpl->getVariable('act')->value=='email'&&$_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=email&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('op')->value=='system'&&$_smarty_tpl->getVariable('act')->value=='email'&&$_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=email&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>

</li>

<?php }?> -->
</ul>

</li>
<?php }?>
<?php }?>

<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()!=0){?>
	<li<?php if ($_smarty_tpl->getVariable('op')->value=='profile'){?> class="current"}<?php }?>> <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('profile');?>
</span>
		
			<ul>
			<li<?php if ($_smarty_tpl->getVariable('act')->value=='information'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=profile&act=information" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_profile');?>
 "><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_profile');?>
</a></li>
			<li<?php if ($_smarty_tpl->getVariable('act')->value=='password'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=profile&act=password" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('change_password');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('change_password');?>
</a></li>
			</ul>		
	</li>
	<?php }?>
</ul>
</div>
</div>
<?php }?>
