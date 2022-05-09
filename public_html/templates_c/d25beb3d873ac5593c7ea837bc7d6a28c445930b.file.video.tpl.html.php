<?php /* Smarty version Smarty-3.0-RC2, created on 2022-01-14 16:40:44
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/video.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:39841368561e1451cf05f14-34263366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd25beb3d873ac5593c7ea837bc7d6a28c445930b' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/video.tpl.html',
      1 => 1642153243,
    ),
  ),
  'nocache_hash' => '39841368561e1451cf05f14-34263366',
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
          <div class="news__list total-news video--main lazy">
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
            <div class="row">
              <?php if ($_smarty_tpl->getVariable('arrayFinalHome')->value){?>
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('arrayFinalHome')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?> 
              <!-- id="<?php echo $_smarty_tpl->tpl_vars['item']->value['idVideo'];?>
" -->
              <div class="col l-4 m-6 c-6">
                <div class="video__item" >
                  <div class="video__item__link" data-link="<?php echo $_smarty_tpl->tpl_vars['item']->value['video'];?>
">
                    <img src="#" alt="image">
                  </div>
                  <div class="video__item__body">
                    <div class="video__item__title"><?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['title_en'];?>
<?php }?></div>
                    <div class="video__item__content">
                      <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?><?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['content_en'];?>
<?php }?>
                    </div>
                  </div>
                </div>
              </div>
              <?php }} ?>
              <?php }?>
            </div>
            <div>
              <ul class="total-news__nav">
                <?php if (isset($_smarty_tpl->getVariable('rowsPages')->value['pages'])&&$_smarty_tpl->getVariable('rowsPages')->value['pages']>1){?>   
                <?php  $_smarty_tpl->tpl_vars['pageItem1'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['p2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pager')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pageItem1']->key => $_smarty_tpl->tpl_vars['pageItem1']->value){
 $_smarty_tpl->tpl_vars['p2']->value = $_smarty_tpl->tpl_vars['pageItem1']->key;
?>
                    <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['pageItem1']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['pageItem1']->value['name'];?>
</a>
                    </li>
                <?php }} ?>
                <li>
                  <i class="fas fa-circle"></i>
                  <i class="fas fa-circle"></i>
                  <i class="fas fa-circle"></i>
                </li>
                <?php }?>
              </ul>
            </div>
          </div>
          <div class="detail-video video--extra">
            <div class="news__list-page">
              <ul class="list-page2">
                <li>
                  <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/video.html">Video</a>
                </li>
                <li>
                  <a class="detail-video__current__title"></a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col l-7 m-12 c-12">
                <div class="detail-video__current">
                  <div class="detail-video__player-block">
                    <div id="detail-video__player"></div>
                  </div>
                  <div class="detail-video__current__block">
                    <div class="detail-video__current__title">
                    </div>
                    <div class="detail-video__current__content">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col l-5 m-12 c-12">
                <div class="news__heading news__heading--no" ><?php echo $_smarty_tpl->getVariable('locale')->value->msg('videos_topic');?>
</div>
                <div class="detail-video__list">
                  <?php if ($_smarty_tpl->getVariable('listVideos')->value){?>
                  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listVideos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?> 
                  <div class="detail-video__item" id="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
">
                    <div class="detail-video__image" data-link="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('custom_link_video');?>
">
                      <img src="#" alt="image">
                    </div>
                    <div class="detail-video__body">
                      <div class="detail-video__title"><?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('custom_title_ads');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('custom_en_title');?>
<?php }?></div>
                      <div class="detail-video__content">
                        <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('custom_content_ads');?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('custom_en_sapo');?>
<?php }?>
                      </div>
                    </div>
                  </div>
                  <?php }} ?>
                  <?php }?>
                </div>
              </div>
              <div class="col l-12 m-12 c-12">
                <div class="detail-video__link__block">
                  <a class="about__slider__link about__slider__link--no detail-video__link" href="#">
                    <span><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_input');?>
</span>
                    <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/planeicon.png" alt="image">
                  </a>
                </div>
              </div>
            </div>
            <div class="news__list">
              <div class="news__heading news__heading--no"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('news');?>
</div>
              <div class="row">
                <?php if ($_smarty_tpl->getVariable('listNews')->value){?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNews')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                <div class="col l-4 m-12 c-12">
                  <div class="news__item">
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('item')->value->getSlug($_tmp1);?>
-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="news__item__image" >
                      <img src="/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('avatar');?>
" alt="image">
                    </a>
                    <div class="news__item__body">
                      <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('item')->value->getSlug($_tmp2);?>
-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="news__item__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('item')->value->getTitle($_tmp3);?>
</a>
                      <div class="news__item__date"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"d-m-Y");?>
</div>
                      <div class="news__item__content">
                        <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('item')->value->getSapo($_tmp4);?>

                      </div>
                      <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('item')->value->getSlug($_tmp5);?>
-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="news__item__link"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
                    </div>
                  </div>
                </div>
                <?php }} ?>
                <?php }?>
              </div>
            </div>
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