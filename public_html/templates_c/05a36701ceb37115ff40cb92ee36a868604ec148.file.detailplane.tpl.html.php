<?php /* Smarty version Smarty-3.0-RC2, created on 2022-03-19 08:47:52
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/detailplane.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:5709635462353648363586-90750835%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05a36701ceb37115ff40cb92ee36a868604ec148' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/detailplane.tpl.html',
      1 => 1647654470,
    ),
  ),
  'nocache_hash' => '5709635462353648363586-90750835',
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
    <?php if ($_smarty_tpl->getVariable('itemArticle')->value){?>
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
          <!-- <div class="news__list-page" data-effect="slide-right">
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
            <div class="detail-new__body lazy">
                <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemArticle')->value->getDetails($_tmp2);?>

            </div>
          </div>
          
          <div class="row lazy">
            <div class="col l-6 m-6 c-6">
              <div class="detail-plane">
              <?php if ($_smarty_tpl->getVariable('listNewsBack')->value){?>
              <?php  $_smarty_tpl->tpl_vars['itemBack'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNewsBack')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemBack']->key => $_smarty_tpl->tpl_vars['itemBack']->value){
?>
              <?php if ($_smarty_tpl->getVariable('idNext')->value!=$_smarty_tpl->getVariable('idBackSmaller')->value){?>
               <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemBack')->value->getSlug($_tmp3);?>
-<?php echo $_smarty_tpl->getVariable('itemBack')->value->getId();?>
" class="detail-plane__block">
                        <div class="detail-plane__image" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemBack')->value->getProperty('avatar');?>
)"></div>
                        <div class="detail-plane__nav"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('back');?>
</div>
                        <div class="detail-plane__body">
                        <div class="detail-plane__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemBack')->value->getTitle($_tmp4);?>
</div>
                        <div class="detail-plane__content">
                            <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemBack')->value->getSapo($_tmp5);?>

                        </div>
                        </div>
                    </a>
                    <?php }else{ ?>
                    <div></div>
                 <?php }?>
                <?php }} ?>
                <?php }?>
              </div>
            </div>
            <div class="col l-6 m-6 c-6">
              <div class="detail-plane">
                    <?php if ($_smarty_tpl->getVariable('listNewsNext')->value){?>
                    <?php  $_smarty_tpl->tpl_vars['itemNext'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNewsNext')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemNext']->key => $_smarty_tpl->tpl_vars['itemNext']->value){
?>
                    <?php if ($_smarty_tpl->getVariable('idNextGreater')->value!=$_smarty_tpl->getVariable('idBack')->value){?>
                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNext')->value->getSlug($_tmp6);?>
-<?php echo $_smarty_tpl->getVariable('itemNext')->value->getId();?>
" class="detail-plane__block">
                      <div class="detail-plane__image" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemNext')->value->getProperty('avatar');?>
)"></div>
                      <div class="detail-plane__nav detail-plane__nav--2"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('next');?>
</div>
                      <div class="detail-plane__body">
                      <div class="detail-plane__title"><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNext')->value->getTitle($_tmp7);?>
</div>
                      <div class="detail-plane__content">
                                <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp8=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemNext')->value->getSapo($_tmp8);?>

                      </div>
                      </div>
                    </a>
                    <?php }?>
                    <?php }} ?>
                    <?php }?>
               
              </div>
            </div>
            <div class="col l-6 m-12 c-12">
              <a style="--link-color: #00A6DF"  href="<?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>/vn/conduongtrothanhphicong.html#scroll<?php echo $_smarty_tpl->getVariable('idCat')->value;?>
<?php }else{ ?>/en/how.html#scroll<?php echo $_smarty_tpl->getVariable('idCat')->value;?>
<?php }?>" class="detail-plane__link">
                    <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/iconplaneleft.png" alt="plane icon" />
                    <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('become_a_pilot');?>
</span>
                </a>
            </div>
            <div class="col l-6 m-12 c-12">
               <a style="--link-color: #273C8B"  href="#" class="detail-plane__link about__slider__link about__slider__link--no detail-plane__link--2">
                    <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
//img/planeicon.png" alt="plane icon" />
                    <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('start_journeys');?>
</span>
                  </a>
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
    <?php }?>
    <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
