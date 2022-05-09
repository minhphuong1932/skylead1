<?php /* Smarty version Smarty-3.0-RC2, created on 2022-03-14 12:29:26
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/detailnews.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:583006836622ed2b6ccd2b6-91774358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c980b2333214f52dc1c1f68e62b13e1bbe438b1c' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/detailnews.tpl.html',
      1 => 1647235763,
    ),
  ),
  'nocache_hash' => '583006836622ed2b6ccd2b6-91774358',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('head.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-head'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

  <body>
    <div class="loading">
      <img src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo');?>
" alt="logo">
  </div>
    <div class="modal__shadow"></div>
    <div class="noti-stack"></div>
    <div class="wrapper">
      <header class="header">
        <div class="header__bar header__bar--color header__bar--2">
          <?php $_template = new Smarty_Internal_Template('menu-right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-menu-right'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
      </header>
      <main class="main news">
        <?php if ($_smarty_tpl->getVariable('imageNewsHeader')->value){?>
        <div class="image__zoom__block">
          <img src="/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('imageNewsHeader')->value->getProperty('logo');?>
" alt="news cover" class="news__cover image__zoom--toggle" />
        </div>
        <?php }?>
        <div class="grid wide">
          <!-- <div class="lazy">
            <div class="news__list-page" data-effect="slide-right">
              <ul class="list-page">
                <?php if ($_smarty_tpl->getVariable('topNav')->value){?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('topNav')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
                </li>
                <?php }} ?>
                <?php }?>
              </ul>
            </div>
          </div> -->
          <div class="detail-new">
            <div class="lazy">
              <div data-effect="slide-right">
                <h1 class="detail-new__heading"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemArticle')->value->getTitle($_tmp1);?>
</h1>
                <div class="detail-new__date"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('itemArticle')->value->getDateCreated(),"d-m-Y");?>
</div>
              </div>
            </div>
            <div class="detail-new__body lazy" id="alt_img">
              <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemArticle')->value->getDetails($_tmp2);?>

            </div>
            <div class="detail-new__block">
              <a class="about__slider__link about__slider__link--no detail-new__link no-popup-form lazy">
                <div data-effect="slide-left">
                	<?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                  		<span><?php echo $_smarty_tpl->getVariable('itemArticle')->value->getProperty('custom_text_input_vn');?>
</span>
                	<?php }else{ ?>
                  		<span><?php echo $_smarty_tpl->getVariable('itemArticle')->value->getProperty('custom_text_input_en');?>
</span>
                	<?php }?>
                </div>
                <div style="display: inherit;" data-effect="slide-right">
                  <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/planeicon.png" alt="image">
                </div>
              </a>
            </div>
          </div>
          <div class="news__list detail-new__list lazy">
            <div data-effect="slide-right">
              <div class="news__heading news__heading--no"><?php if ($_smarty_tpl->getVariable('titleCateArticle')->value){?><?php echo $_smarty_tpl->getVariable('titleCateArticle')->value;?>
<?php }?></div>
            </div>
            <div class="row" data-effect="slide-left">
              <?php if ($_smarty_tpl->getVariable('listNews')->value){?>
              <?php  $_smarty_tpl->tpl_vars['itemNewsRandom'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNews')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemNewsRandom']->key => $_smarty_tpl->tpl_vars['itemNewsRandom']->value){
?>
              <div class="col l-4 m-12 c-12">
                <div class="news__item">
                  <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getSlug($_tmp3);?>
-<?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getId();?>
" class="news__item__image" >
                    <img src="/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getProperty('avatar');?>
" alt="image">
                  </a>
                  <div class="news__item__body">
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getSlug($_tmp4);?>
-<?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getId();?>
" class="news__item__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getTitle($_tmp5);?>
</a>
                    <div class="news__item__date"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('itemNewsRandom')->value->getDateCreated(),"d-m-Y");?>
</div>
                    <div class="news__item__content">
                      <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getSapo($_tmp6);?>

                    </div>
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getSlug($_tmp7);?>
-<?php echo $_smarty_tpl->getVariable('itemNewsRandom')->value->getId();?>
" class="news__item__link"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
                  </div>
                </div>
              </div>
              <?php }} ?>
              <?php }?>
            </div>
            <a href="<?php if ($_smarty_tpl->getVariable('slugCateArticle')->value){?><?php echo $_smarty_tpl->getVariable('slugCateArticle')->value;?>
<?php }?>" class="news__more"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
          </div>
        </div>
        <div class="about__slider__popup plane-form__container">
          <i class="fas fa-times"></i>
          <form id="plane-form" class="plane-form">
            <?php $_template = new Smarty_Internal_Template('form.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-form'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
          </form>
        </div>
      </main>
     
      <?php $_template = new Smarty_Internal_Template('footer-info.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footerinfo'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    </div>
    <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
