<?php /* Smarty version Smarty-3.0-RC2, created on 2022-01-14 18:46:52
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/about.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:207336341861e162aceed2a4-09233543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e183b145a9cc5e1cf360ec438215283b417a4da8' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/about.tpl.html',
      1 => 1642160249,
    ),
  ),
  'nocache_hash' => '207336341861e162aceed2a4-09233543',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('head.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
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
      <main class="main about">
        <?php if ($_smarty_tpl->getVariable('imageHeader')->value){?>
        <div class="about__top image__zoom__block">
          <div class="image__zoom image__zoom--toggle" style="background-image: url(/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('imageHeader')->value->getProperty('logo');?>
);"></div>
          <div class="about__top__modal"></div>
          <div class="about__top__block load-effect">
              <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
              <?php echo $_smarty_tpl->getVariable('imageHeader')->value->getProperty('detail');?>

              <?php }else{ ?>
              <?php echo $_smarty_tpl->getVariable('imageHeader')->value->getProperty('detail_en');?>

              <?php }?>
          </div>
        </div>
        <?php }?>
        <div class="lazy">
          <div class="about__slider__container">
            <div class="about__slider">
                <?php if ($_smarty_tpl->getVariable('slideInspiration')->value){?>
                <?php  $_smarty_tpl->tpl_vars['itemInspiration'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideInspiration')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemInspiration']->key => $_smarty_tpl->tpl_vars['itemInspiration']->value){
?>
                    <div class="about__slide">
                    <div class="about__slide__content">
                        <div class="about__slide__title">
                        <?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>
                          <?php echo $_smarty_tpl->getVariable('itemInspiration')->value->getProperty('custom_title_ads');?>

                        <?php }else{ ?>
                          <?php echo $_smarty_tpl->getVariable('itemInspiration')->value->getProperty('custom_en_title');?>

                        <?php }?>
                        </div>
                        <div class="about__slide__text ">
                        <?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>
                          <?php echo $_smarty_tpl->getVariable('itemInspiration')->value->getProperty('custom_content_ads');?>

                        <?php }else{ ?>
                          <?php echo $_smarty_tpl->getVariable('itemInspiration')->value->getProperty('custom_en_sapo');?>

                        <?php }?>
                        </div>
                    </div>
                    <div class="about__slide__image" style="background-image: url(/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('itemInspiration')->value->getProperty('logo');?>
)"></div>
                    </div>
                <?php }} ?>
                <?php }?>
            </div>
          </div>
        </div>
        <div class="about__maxim ">
          <div class="about__maxim__block lazy">
            <div data-effect="slide-right">
              <div class="about__maxim__content" >
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_johnon');?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_johnon_en');?>

                <?php }?>
              </div>
            </div>
            <div data-effect="slide-left">
              <div class="about__maxim__author" data-effect="slide-left">
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_update_name_johnnie');?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_update_name_johnnie_en');?>

                <?php }?>
            </div>
            </div>
          </div>
        </div>
        <div class="lazy">
          <div class="about__slider__container about__slider__container--2">
            <div class="about__slider">
            <?php if ($_smarty_tpl->getVariable('slideCompanion')->value){?>
            <?php  $_smarty_tpl->tpl_vars['itemCompanion'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideCompanion')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCompanion']->key => $_smarty_tpl->tpl_vars['itemCompanion']->value){
?>
                <div class="about__slide about__slide--2">
                <div class="about__slide__content about__slide__content--2">
                    <div class="about__slide__title">
                    <?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>
                      <?php echo $_smarty_tpl->getVariable('itemCompanion')->value->getProperty('custom_title_ads');?>

                    <?php }else{ ?>
                      <?php echo $_smarty_tpl->getVariable('itemCompanion')->value->getProperty('custom_en_title');?>

                    <?php }?>
                    </div>
                    <div class="about__slide__text about__slide__text--2">
                    <?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>
                      <?php echo $_smarty_tpl->getVariable('itemCompanion')->value->getProperty('custom_content_ads');?>

                    <?php }else{ ?>
                      <?php echo $_smarty_tpl->getVariable('itemCompanion')->value->getProperty('custom_en_sapo');?>

                    <?php }?>
                    </div>
                </div>
                <div class="about__slide__image" style="background-image: url(/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('itemCompanion')->value->getProperty('logo');?>
)"></div>
                </div>
            <?php }} ?>
            <?php }?>
            </div>
            <a class="about__slider__link lazy">
              <div data-effect="slide-left">
              	<?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <span><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_input');?>
</span>
                <?php }else{ ?>
                <span><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_title_input_en');?>
</span>
                <?php }?>
              </div>
              <div style="display: inherit;" data-effect="slide-right">
                <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/planeicon.png" alt="image" />
              </div>
            </a>
          </div>
        </div>
        <div class="about__bot">
          <?php if ($_smarty_tpl->getVariable('imageFooter')->value){?>
          <?php  $_smarty_tpl->tpl_vars['itemImg'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('imageFooter')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemImg']->key => $_smarty_tpl->tpl_vars['itemImg']->value){
?>
          <div class="about__bot__image">
            <img src="/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('itemImg')->value->getProperty('logo');?>
" alt="image">
            <div class="about__bot__image__modal"></div>
            <div class="about__bot__image__body">
              <div class="about__bot__image__block">
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <?php echo $_smarty_tpl->getVariable('itemImg')->value->getProperty('detail');?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('itemImg')->value->getProperty('detail_en');?>

                <?php }?>
              </div>
              <div class="about__bot__image__content">
                <span>
                  <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                  <?php echo $_smarty_tpl->getVariable('itemImg')->value->getProperty('custom_content_ads');?>

                  <?php }else{ ?>
                  <?php echo $_smarty_tpl->getVariable('itemImg')->value->getProperty('custom_en_sapo');?>

                  <?php }?>
                </span>
              </div>
            </div>
          </div>
          <?php }} ?>
          <?php }?>
         
        </div>
        <div class="about__slider__popup plane-form__container">
          <i class="fas fa-times"></i>
          <form id="plane-form" class="plane-form">
            <?php $_template = new Smarty_Internal_Template('form.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-form'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
          </form>
        </div>
      </main>
    </div>
    <br><br><br>
    <br><br><br>
    <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

