<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-12 11:54:18
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/head.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1049925527625505fa594640-07305062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f8ded3d205366c89966d56be9abb9de3f8aa2c7' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/head.tpl.html',
      1 => 1649739255,
    ),
  ),
  'nocache_hash' => '1049925527625505fa594640-07305062',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_strip_tags')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.strip_tags.php';
?><!DOCTYPE html>
<html lang="<?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>vi<?php }else{ ?>en<?php }?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <title><?php if ($_smarty_tpl->getVariable('pageTitle')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageTitle')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo_en');?>
<?php }?><?php }?></title>
    <link rel="shortcut icon" type=image/x-icon href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo');?>
">
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/slick.css" />
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/jquery.parallax.css" />
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/all.css" />
    <!-- <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/plyr.css<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
" /> -->
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/lity.min.css" />
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/main.css<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
" />

    <meta property="fb:app_id" content="636139804451313" />
    <meta name="description" content="<?php if ($_smarty_tpl->getVariable('pageDescription')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageDescription')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_desc_seo_en');?>
<?php }?><?php }?>" />
    <meta name="keywords" content="<?php if ($_smarty_tpl->getVariable('pageKeywords')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageKeywords')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?><?php echo $_smarty_tpl->getVariable('estore')->value->getKeywords();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_keyword_seo_en');?>
<?php }?><?php }?>">
    <meta property="og:locale" content="vi_VN" />
    <?php if ($_smarty_tpl->getVariable('currentUrlx1')->value){?>
    <link rel="canonical" href="<?php echo $_smarty_tpl->getVariable('currentUrlx1')->value;?>
" />
    <meta property="og:url" content="<?php echo $_smarty_tpl->getVariable('currentUrlx1')->value;?>
" />
    <?php }?>
    <meta property="og:type" content="<?php if ($_smarty_tpl->getVariable('typeweb')->value){?><?php echo $_smarty_tpl->getVariable('typeweb')->value;?>
<?php }else{ ?>website<?php }?>" />
    <meta property="og:title" content="<?php if ($_smarty_tpl->getVariable('pageTitle')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageTitle')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo_en');?>
<?php }?><?php }?>" />
    <meta property="og:description" content="<?php if ($_smarty_tpl->getVariable('pageDescription')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageDescription')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_desc_seo_en');?>
<?php }?><?php }?>" />
    <?php if ($_smarty_tpl->getVariable('logoimg1')->value){?>
    <meta property="og:image" content="<?php if ($_smarty_tpl->getVariable('logoimg1')->value){?><?php echo $_smarty_tpl->getVariable('logoimg1')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('logoimg1')->value;?>
<?php }?>" />
    <?php }else{ ?>
    <meta property="og:image" content="<?php echo $_smarty_tpl->getVariable('logoimg')->value;?>
" />
    <?php }?>
    <meta property="og:image:alt" content="image-item" />
    <meta property="og:image:width" content="384" />
    <meta property="og:image:height" content="384" />
    <meta property="og:site_name" content="<?php if ($_smarty_tpl->getVariable('pageTitle')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageTitle')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo_en');?>
<?php }?><?php }?>" />
    <meta name="google-site-verification" content="JNVQhK960NdPxkdpNNO1iZwZOVcmqORhL7Ido1J5kto" />

  <!-- Global site tag (gtag.js) - Google Analytics -->
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ED5X7GCTB8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-ED5X7GCTB8');
    </script>
    
    
  </head>

