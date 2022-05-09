<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-19 16:42:48
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/landingpage.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:896816361625e841848ec37-12545858%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9df6c6108d0957adfc09253687c71adc0c2c0238' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/landingpage.tpl.html',
      1 => 1650361304,
    ),
  ),
  'nocache_hash' => '896816361625e841848ec37-12545858',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_strip_tags')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.strip_tags.php';
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <title><?php if ($_smarty_tpl->getVariable('pageTitle')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageTitle')->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_seo_en');?>
<?php }?><?php }?></title>
    <link rel="shortcut icon" type=image/x-icon href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo');?>
">
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/all.css" />
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/lity.min.css" />
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/landingpage.css<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
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

  <body>
    <div class="loading">
        <img src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo');?>
" alt="logo" />
    </div>
  
    <div class="wrapper">
      <div class="ldp__skylead">
        <div class="ldp__skylead__sticky">
        <form class="ldp__skylead__form <?php if ($_smarty_tpl->getVariable('popup')->value==1){?>ldp__skylead__form__submit<?php }?>" method="POST" id="plane-forms">
          <div class="ldp__skylead__form__show1">
            <h2 class="ldp__skylead__form__heading"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('register_consultant');?>
</h2>
            <div class="ldp__skylead__form__sub"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('register_consultant_sub');?>
</div>
            <div class="ldp__skylead__group">
              <input placeholder="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('fullname');?>
"  value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planename']['value'];?>
<?php }?>"  type="text" name="planename" id="planename" />
              <div class="ldp__skylead__error"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['planename']['error']){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planename']['message'];?>
<?php }?></div>
            </div>
            <div class="ldp__skylead__group">
              <input placeholder="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('tels');?>
" type="tel"  value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planephone']['value'];?>
<?php }?>"  name="planephone" id="plane-phone" />
              <div class="ldp__skylead__error"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['planephone']['error']){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planephone']['message'];?>
<?php }?></div>
            </div>
            <div class="ldp__skylead__group">
              <input placeholder="Email" type="email" name="planeemail"  value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planeemail']['value'];?>
<?php }?>"  id="planeemail" />
              <div class="ldp__skylead__error"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['planeemail']['error']){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planeemail']['message'];?>
<?php }?></div>
            </div>
            <div class="ldp__skylead__group">
              <input placeholder="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('provinces');?>
" type="text"  value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planeprovinces']['value'];?>
<?php }?>"  name="planeprovinces" id="planeprovinces" />
              <div class="ldp__skylead__error"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['planeprovinces']['error']){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['planeprovinces']['message'];?>
<?php }?></div>
            </div>
            <input type="hidden" name="doo" value="submit"/>
            <input type="hidden" name="op" value="estore"/>
            <input type="hidden" name="act" value="landingpage"/>
            <?php if ($_smarty_tpl->getVariable('errMsg')->value){?>
            <div class="form-message-success"  style="color:red;font-size:18px"><i class='far fa-check-circle'></i> <?php echo $_smarty_tpl->getVariable('errMsg')->value;?>
</div>
            <?php }?>
            <input class="ldp__form__submit"  type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('send');?>
">
          </div>
        <div class="ldp__skylead__form__show2">
          <h2>Thank you</h2>
          <p>Skylead đã nhận được thông tin của bạn. Chuyên viên tư vấn của chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
        </div>
      </form>
        </div>
        
       
        <div class="ldp__skylead__open-form"> <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('consultant');?>
</span><i class="fas fa-edit"></i></div>
        <input class="lang" hidden value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" id="lang">
        
        <?php if ($_smarty_tpl->getVariable('objArticle')->value){?>
            <?php echo $_smarty_tpl->getVariable('objArticle')->value->getDetails($_smarty_tpl->getVariable('lang')->value);?>

        <?php }?>
      </div>
    </div>
    <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
  <script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/landingpage.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script>

  </body>
</html>
