<?php /* Smarty version Smarty-3.0-RC2, created on 2022-02-07 20:27:14
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/totalnews.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:181452297962011e32538b71-76010735%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fd3d6f0208dfe5a4ff4e7afff85338fc9e89c01' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/totalnews.tpl.html',
      1 => 1644240432,
    ),
  ),
  'nocache_hash' => '181452297962011e32538b71-76010735',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.date_format.php';
?>
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
      <main class="main news">
        <div class="lazy">
          <?php if ($_smarty_tpl->getVariable('imageNewsHeader')->value){?>
          <img src="/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('imageNewsHeader')->value->getProperty('logo');?>
" alt="news cover" class="news__cover" />
          <?php }?>
        </div>
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
        
          <div class="news__list total-news lazy">
            <div data-effect="slide-right">
              <div class="news__heading news__heading--no"><?php echo $_smarty_tpl->getVariable('pageTitle')->value;?>
</div>
            </div>
            <div class="row">
              <?php if ($_smarty_tpl->getVariable('arrayFinalHome')->value){?>
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('arrayFinalHome')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?> 
              <div class="col l-4 m-12 c-12">
                <div class="news__item">
                  <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['slug'];?>
" class="news__item__image">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['img'];?>
" alt="image">
                  </a>
                  <div class="news__item__body">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['slug'];?>
" class="news__item__title"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a>
                    <div class="news__item__date"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['date_created'],"d-m-Y");?>
</div>
                    <div class="news__item__content">
                      <?php echo $_smarty_tpl->tpl_vars['item']->value['sapo'];?>

                    </div>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['slug'];?>
" class="news__item__link"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a>
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
        </div>
      </main>
    <?php $_template = new Smarty_Internal_Template('footer-info.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footerinfo'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
  </div>
  <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>