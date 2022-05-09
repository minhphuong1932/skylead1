<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-20 09:43:12
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/news.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1847225045625f7340678409-97337456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bacb700933c55fae9cf3cba66098a6e88f78c4ec' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/news.tpl.html',
      1 => 1650422590,
    ),
  ),
  'nocache_hash' => '1847225045625f7340678409-97337456',
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
      <header class="header ">
        <div class="header__bar header__bar--color header__bar--2">
            <?php $_template = new Smarty_Internal_Template('menu-right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-menu-right'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
      </header>
      <main class="main news">
        <?php if ($_smarty_tpl->getVariable('imageNewsHeader')->value){?>
        <div class="lazy image__zoom__block">
          <img src="/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('imageNewsHeader')->value->getProperty('logo');?>
" alt="news cover" class="news__cover image__zoom--toggle" />
        </div>
       
        <?php }?>
        <div class="grid wide">
          <div class="lazy">
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
          </div>
        </div>
        <div class="news__container lazy">
          <div>
            <div class="news__slider1">
              <div class="news__slider1__for">
                <?php if ($_smarty_tpl->getVariable('slideNews')->value){?>
                <?php  $_smarty_tpl->tpl_vars['itemSlideNews'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideNews')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemSlideNews']->key => $_smarty_tpl->tpl_vars['itemSlideNews']->value){
?>
                    <div class="news__slider1__for__slide" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemSlideNews')->value->getProperty('avatar');?>
)"></div>
                <?php }} ?>
                <?php }?>
              </div>
              <div class="news__slider1__nav">
                <?php if ($_smarty_tpl->getVariable('slideNews')->value){?>
                <?php  $_smarty_tpl->tpl_vars['itemSlideNews'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideNews')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemSlideNews']->key => $_smarty_tpl->tpl_vars['itemSlideNews']->value){
?>
                <div class="news__slider1__nav__slide">
                <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlideNews')->value->getSlug($_tmp1);?>
-<?php echo $_smarty_tpl->getVariable('itemSlideNews')->value->getId();?>
" class="news__slider1__nav__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlideNews')->value->getTitle($_tmp2);?>
</a>
                <div class="news__slider1__nav__content">
                    <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlideNews')->value->getSapo($_tmp3);?>

                </div>
                </div>
                <?php }} ?>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
        <?php if ($_smarty_tpl->getVariable('finalData')->value){?>
        <?php  $_smarty_tpl->tpl_vars['itemCate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('finalData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCate']->key => $_smarty_tpl->tpl_vars['itemCate']->value){
?>
        <div class="grid wide">
          <div class="news__list lazy">
            <div data-effect="slide-right">
              <div class="news__heading news__heading--no"><?php echo $_smarty_tpl->tpl_vars['itemCate']->value['name'];?>
</div>
            </div>
            <div class="row" data-effect="slide-left">
              <?php  $_smarty_tpl->tpl_vars['itemArticle'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['itemCate']->value['listArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemArticle']->key => $_smarty_tpl->tpl_vars['itemArticle']->value){
?>
              <div class="col l-4 m-12 c-12">
                <div class="news__item">
                  <a href="/<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['slug'];?>
" class="news__item__image">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['avatar'];?>
" alt="image">
                  </a>
                  <div class="news__item__body">
                  <a href="/<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['slug'];?>
" class="news__item__title"><?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['name'];?>
</a>
                    <div class="news__item__date"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['itemArticle']->value['date_created'],"d-m-Y");?>
 </div>
                    <div class="news__item__content">
                      <?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['sapo'];?>
 
                  </div>
                    <a href="/<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['slug'];?>
" class="news__item__link"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
                  </div>
                </div>
              </div> 
            <?php }} ?>
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['url'];?>
" class="news__more"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
          </div>
        </div>
           <?php }} ?>
        <?php }?>

        <div class="news__container">
          <div class="news__slider2 lazy">
            <div data-effect="slide-right">
              <div class="news__heading"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('new_course');?>
</div>
            </div>
            <div data-effect="slide-left">
              <div class="news__slider2__block">
                <div class="news__slider2__for">
                  <?php if ($_smarty_tpl->getVariable('slideNewsCourse')->value){?>
                  <?php  $_smarty_tpl->tpl_vars['itemCourse'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideNewsCourse')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCourse']->key => $_smarty_tpl->tpl_vars['itemCourse']->value){
?>
                  <div class="news__slider2__for__slide" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemCourse')->value->getProperty('avatar');?>
)"></div>
                  <?php }} ?>
                  <?php }?>
                </div>
                <div class="news__slider2__nav">
                  <?php if ($_smarty_tpl->getVariable('slideNewsCourse')->value){?>
                  <?php  $_smarty_tpl->tpl_vars['itemCourse'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slideNewsCourse')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCourse']->key => $_smarty_tpl->tpl_vars['itemCourse']->value){
?>
                  <div class="news__slider2__nav__slide">
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemCourse')->value->getSlug($_tmp4);?>
-<?php echo $_smarty_tpl->getVariable('itemCourse')->value->getId();?>
" class="news__slider2__nav__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemCourse')->value->getTitle($_tmp5);?>
</a>
                    <div class="news__slider2__nav__content">
                      <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemCourse')->value->getSapo($_tmp6);?>

                    </div>
                  </div>
                  <?php }} ?>
                  <?php }?>
                </div>
              </div>
            </div>
          </div>
        </div>

            
        <div class="grid wide">
          <?php if ($_smarty_tpl->getVariable('titleCateNewsDay')->value){?>
          <?php  $_smarty_tpl->tpl_vars['itemCateNewsDay'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('titleCateNewsDay')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCateNewsDay']->key => $_smarty_tpl->tpl_vars['itemCateNewsDay']->value){
?>
          <div class="news__list lazy">
            <div data-effect="slide-right">
              <div class="news__heading news__heading--no"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemCateNewsDay')->value->getName($_tmp7);?>
</div>
            </div>
            <div class="row" data-effect="slide-left">
            <?php if ($_smarty_tpl->getVariable('newsDay')->value){?>
            <?php  $_smarty_tpl->tpl_vars['itemNewsDay'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('newsDay')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemNewsDay']->key => $_smarty_tpl->tpl_vars['itemNewsDay']->value){
?>
              <div class="col l-4 m-12 c-12">
                <div class="news__item">
                  <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp8=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getSlug($_tmp8);?>
-<?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getId();?>
" class="news__item__image">
                    <img src="/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getProperty('avatar');?>
" alt="image">
                  </a>
                  <div class="news__item__body">
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp9=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getSlug($_tmp9);?>
-<?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getId();?>
" class="news__item__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp10=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getTitle($_tmp10);?>
</a>
                    <div class="news__item__content">
                      <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp11=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getSapo($_tmp11);?>

                    </div>
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp12=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getSlug($_tmp12);?>
-<?php echo $_smarty_tpl->getVariable('itemNewsDay')->value->getId();?>
" class="news__item__link"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a></div>
                </div>
              </div>
            <?php }} ?>
            <?php }?>
          </div>

            <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp13=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemCateNewsDay')->value->getSlug($_tmp13);?>
-<?php echo $_smarty_tpl->getVariable('itemCateNewsDay')->value->getId();?>
" class="news__more"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
          </div>
          <?php }} ?>
          <?php }?>
        </div>

     
        
      </main>
      <?php $_template = new Smarty_Internal_Template('footer-info.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footerinfo'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    </div>
<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
 