<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:15:05
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/how.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:547128989618f2db9209f33-85927878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b280f06ff69eb5932069b9e4d778a053774727b' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/how.tpl.html',
      1 => 1636078308,
    ),
  ),
  'nocache_hash' => '547128989618f2db9209f33-85927878',
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
        <div class="header__bar header__bar--2">
          <?php $_template = new Smarty_Internal_Template('menu-right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-menu-right'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
      </header>
      <main class="main how">
      <div class="how__slider">
        <?php if ($_smarty_tpl->getVariable('newsPilot')->value){?>
        <?php  $_smarty_tpl->tpl_vars['itemPilot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('newsPilot')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemPilot']->key => $_smarty_tpl->tpl_vars['itemPilot']->value){
?>
        <div class="how__top shadow-plane-0 image__zoom__block" >
          <div class="image__zoom image__zoom--toggle" style="background-image: url(/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('itemPilot')->value->getProperty('logo');?>
)"></div>
          <div class="how__top__block">
            <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
            <?php echo $_smarty_tpl->getVariable('itemPilot')->value->getProperty('detail');?>

            <?php }else{ ?>
            <?php echo $_smarty_tpl->getVariable('itemPilot')->value->getProperty('detail_en');?>

            <?php }?>
          </div>
        </div>
        <?php }} ?>
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('finalData')->value){?>
            <?php  $_smarty_tpl->tpl_vars['itemCate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('finalData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCate']->key => $_smarty_tpl->tpl_vars['itemCate']->value){
?>
                    <?php if ($_smarty_tpl->tpl_vars['itemCate']->value['css']==1){?>
                    <div class="how__slide shadow-plane-1">
                        <div class="how__slide__block">
                            <div class="how__slide__left">
                            <div class="how__slide__image" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['avatar'];?>
)"></div>
                            </div>
                            <div class="how__slide__right">
                            <div class="how__slide__right__title how__title"><?php echo $_smarty_tpl->tpl_vars['itemCate']->value['name'];?>
 </div>
                            <input hidden class="idCategory" value="<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['id'];?>
">
                            <ul>
                                <?php  $_smarty_tpl->tpl_vars['itemArticle'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['itemCate']->value['listArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemArticle']->key => $_smarty_tpl->tpl_vars['itemArticle']->value){
?>
                                <li>
                                <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['slug'];?>
-<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['id'];?>
">
                                    <i class="fas fa-check-circle"></i>
                                    <span><?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['name'];?>
</span>
                                </a>
                                </li>
                                <?php }} ?>

                            </ul>
                            </div>
                        </div>
                    </div>
                    <?php }elseif($_smarty_tpl->tpl_vars['itemCate']->value['css']==2){?>
                    <div class="how__slide shadow-plane-2">
                        <div class="how__slide__block how__slide__block--2">
                          <div class="how__slide__left how__slide__left--2">
                            <div class="how__slide__image" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['avatar'];?>
)"></div>
                          </div>
                          <div class="how__slide__right how__slide__right--2">
                            <div class="how__slide__right__title how__title"><?php echo $_smarty_tpl->tpl_vars['itemCate']->value['name'];?>
</div>
                            <input hidden class="idCategory" value="<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['id'];?>
">
                            <ul>
                                <?php  $_smarty_tpl->tpl_vars['itemArticle'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['itemCate']->value['listArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemArticle']->key => $_smarty_tpl->tpl_vars['itemArticle']->value){
?>
                                <li>
                                    <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['slug'];?>
-<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['id'];?>
">
                                    <i class="fas fa-check-circle"></i>
                                    <span><?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['name'];?>
</span>
                                    </a>
                                </li>
                                <?php }} ?>
                        
                            </ul>
                          </div>
                        </div>
                    </div>
                    <?php }elseif($_smarty_tpl->tpl_vars['itemCate']->value['css']==4){?>
                    <div class="how__contact shadow-plane-4 image__zoom__block">
                     <div class="image__zoom" style="background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['avatar'];?>
)"></div>
                        <div class="how__contact__block">
                          <div class="how__contact__title how__title"><?php echo $_smarty_tpl->tpl_vars['itemCate']->value['name'];?>
</div>
                          <input hidden class="idCategory" value="<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['id'];?>
">
                          <ul>
                            <?php  $_smarty_tpl->tpl_vars['itemArticle'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['itemCate']->value['listArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemArticle']->key => $_smarty_tpl->tpl_vars['itemArticle']->value){
?>
                            <li>
                                <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['slug'];?>
-<?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['id'];?>
">
                                <span><?php echo $_smarty_tpl->tpl_vars['itemArticle']->value['name'];?>
</span>
                                <i class="fas fa-check-circle"></i>
                                </a>
                            </li>
                            <?php }} ?>
                          </ul>
                        </div>
                      </div>
                    <?php }?>
            <?php }} ?>
        <?php }?>
        <div class="how__bot shadow-plane-5">
          <div class="how__title" style="position: absolute; opacity: 0;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('discover');?>
</div>
          <div class="how__bot__item">
            <a class="how__bot__item__icon">
              <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('start_journeys');?>
</span>
            </a>
            <div class="how__bot__item__hover">
              <a class="how__bot__item__icon--back">
                <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('back');?>
</span>
              </a>
              <form id="plane-form" class="plane-form how__bot__form">
                  <?php $_template = new Smarty_Internal_Template('form.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-form'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
              </form>
            </div>
          </div>
          <div class="how__bot__item" style="--item-color: #5ebcde">
            <a class="how__bot__item__icon"> <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('research');?>
</span> </a>
            <div class="how__bot__item__hover how__bot__item__hover--3">
              <a class="how__bot__item__icon--back">
                <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('back');?>
</span>
              </a>
              <div class="how__bot__item__question">
                <div class="how__bot__item__question__title"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('question');?>
</div>
                <ul>
                    <?php if ($_smarty_tpl->getVariable('newsquestion')->value){?>
                    <?php  $_smarty_tpl->tpl_vars['itemQuestions'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('newsquestion')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemQuestions']->key => $_smarty_tpl->tpl_vars['itemQuestions']->value){
?>
                        <li>
                        <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php echo $_smarty_tpl->getVariable('itemQuestions')->value->getSlug();?>
-<?php echo $_smarty_tpl->getVariable('itemQuestions')->value->getId();?>
">
                            <i class="fas fa-question-circle"></i>
                            <span><?php echo $_smarty_tpl->getVariable('itemQuestions')->value->getTitle($_smarty_tpl->getVariable('lang')->value);?>
</span>
                        </a>
                        </li>
                    <?php }} ?>
                    <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="how__duongbang">
          <img class="how__duongbang__duong" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/duongbay.png" alt="duong bay" />
          <div class="how__duongbang__plane">
            <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/maby.png" alt="may bay" />
            <span><?php echo $_smarty_tpl->getVariable('locale')->value->msg('start');?>
</span>
          </div>
          <div class="how__duongbang__all">
            <a data-scroll="shadow-plane-0"  title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('start');?>
" class="how__duongbang__shadow-plane">
              <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/plane2.png" alt="shawdow plane">
            </a>
            <?php if ($_smarty_tpl->getVariable('finalData')->value){?>
            <?php  $_smarty_tpl->tpl_vars['itemCate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('finalData')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemCate']->key => $_smarty_tpl->tpl_vars['itemCate']->value){
?>
            <a data-scroll="shadow-plane-<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['postion'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['itemCate']->value['name'];?>
" class="how__duongbang__shadow-plane">
              <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/plane2.png" alt="shawdow plane">
            </a>
            <?php }} ?>
            <?php }?>
            <a data-scroll="shadow-plane-5" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('discover');?>
" class="how__duongbang__shadow-plane">
              <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/plane2.png" alt="shawdow plane">
            </a>
          </div>
        </div>
      </main>

      <input type="hidden" name="over-plane" id="over-plane" value="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/maby.png">
      <input type="hidden" name="out-plane" id="out-plane" value="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/plane2.png">
    </div>
    <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
