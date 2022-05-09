<?php /* Smarty version Smarty-3.0-RC2, created on 2022-05-06 19:03:12
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/index.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:164624651862750e80a020e2-11531102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af37e9ef637b0392b6bce275c314135ecabed73a' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/index.tpl.html',
      1 => 1651838582,
    ),
  ),
  'nocache_hash' => '164624651862750e80a020e2-11531102',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('head.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-head'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<body>
    <!-- <div class="loading">
    <img src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo');?>
" alt="logo" />
  </div> -->
    <div class="modal__shadow"></div>
    <div class="noti-stack"></div>
    <!--  <?php if ($_smarty_tpl->getVariable('checkShow')->value==0){?>
  <div class="popup__language">
    <div class="popup__language__block">
      <div class="popup__language__heading">Please choose your language!</div>
      <div class="popup__language__heading">Xin hãy lựa chọn ngôn ngữ!</div>
      <div class="header__language header__language__popup">
        <a
          href="/en/<?php if ($_smarty_tpl->getVariable('slug')->value){?><?php if ($_smarty_tpl->getVariable('id')->value){?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
<?php }?><?php }else{ ?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
.html<?php }?><?php }?><?php }else{ ?>index.html<?php }?>"
          class="<?php if ($_smarty_tpl->getVariable('lang')->value=='en'){?>active<?php }?>"
        >
          <img
            src="https://cdn.pixabay.com/photo/2012/04/18/19/53/flag-37712_960_720.png"
            alt="usa"
          />
        </a>
        <a
          href="/vn/<?php if ($_smarty_tpl->getVariable('slug')->value){?><?php if ($_smarty_tpl->getVariable('id')->value){?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
-<?php echo $_smarty_tpl->getVariable('id')->value;?>
<?php }?><?php }else{ ?><?php if ($_smarty_tpl->getVariable('page')->value){?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('slug')->value;?>
.html<?php }?><?php }?><?php }else{ ?>index.html<?php }?>"
          class="<?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>active<?php }?>"
        >
          <img
            src="https://cdn.pixabay.com/photo/2012/04/10/23/04/vietnam-26834_640.png"
            alt="vn"
          />
        </a>
      </div>
    </div>
  </div>
  <?php }?> -->
  <?php if ($_smarty_tpl->getVariable('checkout')->value==0){?>
    <div class="plane__loading">
        <div class="plane__loading__block">
            <div class="plane__loading__effect">
                <div class="plane__loading__khach">
                </div>
                <img src="/templates/hangkhong/img/airplane1.png" alt="may bay" class="plane__loading__plane">
            </div>
            <div class="plane__loading__progress">
                <div class="plane__loading__progress__percent"></div>
            </div>
            <div class="plane__loading__boarding">
                boarding
            </div>
            <div class="plane__loading__fly">Cất cánh</div>
        </div>
    </div>
    <?php }?>
    <!-- <div class="popup__continue__block">
    <div class="popup__continue">
      <p>Enable audio?</p>
      <div>
        <button class="btn__yes">YES</button>
        <button class="btn__no">NO</button>
      </div>
    </div>
  </div> -->

    <div class="wrapper">
        <header class="header">
            <?php $_template = new Smarty_Internal_Template('menu-top.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-menu-top'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
            <div class="header__bar">
                <?php $_template = new Smarty_Internal_Template('menu-right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-menu-right'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
            </div>
        </header>

        <div class="all-sound">
            <?php if ($_smarty_tpl->getVariable('mp3Planesss')->value){?> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mp3Planesss')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
            <audio controls <?php if ($_smarty_tpl->getVariable('item')->value->getPosition()==2){?>loop<?php }?> class="sound<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
">
        <source
          src="/upload/1/resources/<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('logo');?>
"
          type="audio/ogg"
        />
        <source
          src="/upload/1/resources/<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('logo');?>
"
          type="audio/mpeg"
        />
      </audio> <?php }} ?> <?php }?>
            <!-- <audio  muted class="sound1">
          <source
          src="/templates/hangkhong/img/Flyingeffect.wav"
          type="audio/mpeg"
        />
      </audio>
      <audio  muted loop class="sound2">
          <source
          src="/templates/hangkhong/img/sound1.mp3"
          type="audio/mpeg"
        />
      </audio> -->

        </div>
        <!--     <?php if ($_smarty_tpl->getVariable('checkShow')->value==0||$_smarty_tpl->getVariable('checkShow')->value==1){?>
    <div class="plane__start">
      <video class="set-video" playsinline muted>
        <?php if ($_smarty_tpl->getVariable('videoFlyPlane')->value){?>
        <source
          src="/upload/1/resources/<?php echo $_smarty_tpl->getVariable('videoFlyPlane')->value->getProperty('logo');?>
"
          type="video/mp4"
        />
        <?php }?>
      </video>
      <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
      <img
        class="plane__start__gif"
        src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/Untitled-1.gif"
        alt="gif scroll"
      />
      <?php }else{ ?>
      <img
        class="plane__start__gif"
        src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/scroll-to-fly.gif"
        alt="gif scroll"
      />
      <?php }?>
    </div>
    <?php }?> -->

        <main class="main plane">
            <!-- slide 1 -->
            <div data-slide="1" class="plane-slide plane__fly">
                <div class="plane__fly__volume">
                    <i class="fas fa-volume-up volume--on active"></i>
                    <i class="fas fa-volume-mute volume--mute"></i>
                </div>
                <div class="plane__fly__theme">
                    <?php if ($_smarty_tpl->getVariable('videoPlanesss')->value){?> <?php  $_smarty_tpl->tpl_vars['imagePlane'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('videoPlanesss')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['imagePlane']->key => $_smarty_tpl->tpl_vars['imagePlane']->value){
 $_smarty_tpl->tpl_vars['val']->value = $_smarty_tpl->tpl_vars['imagePlane']->key;
?>
                    <div class="plane__fly__block <?php if ($_smarty_tpl->tpl_vars['val']->value==0){?>active<?php }?>">
                        <video class="plane__fly__video set-video" playsinline muted loop="loop">
              <source
                src="/upload/1/resources/<?php echo $_smarty_tpl->getVariable('imagePlane')->value->getProperty('logo');?>
"
                type="video/mp4"
              />
            </video>
                        <img src="/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('imagePlane')->value->getProperty('the_plane');?>
" alt="1FN.png" class="plane__fly__image" />
                    </div>
                    <?php }} ?> <?php }?>
                </div>
                <div class="plane__fly__scroll" id="plane__fly__scroll">
                    <ul class="plane__fly__ul">
                        <?php if ($_smarty_tpl->getVariable('videoPlanesss')->value){?> <?php  $_smarty_tpl->tpl_vars['itemVideo'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('videoPlanesss')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemVideo']->key => $_smarty_tpl->tpl_vars['itemVideo']->value){
 $_smarty_tpl->tpl_vars['val']->value = $_smarty_tpl->tpl_vars['itemVideo']->key;
?>
                        <!-- text loại hình -->
                        <?php if ($_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_option_text_plane')&&$_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_option_text_plane')==2){?> <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                        <li>
                            <span class="plane__fly__item">
                <img src="<?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_img_plane_text');?>
" data-mobile="<?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_custom_img_plane_text_mb_vn');?>
" alt="png">
              </span>
                        </li>
                        <?php }else{ ?>
                        <li>
                            <span class="plane__fly__item">
                <img src="<?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_custom_img_plane_text_en');?>
" data-mobile="<?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_custom_img_plane_text_mb_en');?>
" alt="png">
               </span>
                        </li>
                        <?php }?>
                        <!-- mobie -->
                        <!-- <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
            	<img src="<?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_custom_img_plane_text_mb_vn');?>
" data-mobile="link ảnh mobile" alt="">
	        
           	<?php }else{ ?>
            	<img src="<?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_custom_img_plane_text_mb_en');?>
" data-mobile="link ảnh mobile" alt="">
           	<?php }?> -->
                        <!-- text loại chữ -->
                        <?php }else{ ?> <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                        <li>
                            <span class="plane__fly__item"><?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_content_ads');?>

              </span>
                        </li>
                        <?php }else{ ?>
                        <li>
                            <span class="plane__fly__item"><?php echo $_smarty_tpl->getVariable('itemVideo')->value->getProperty('custom_en_sapo');?>

              </span>
                        </li>
                        <?php }?> <?php }?> <?php }} ?> <?php }?>
                    </ul>
                </div>
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <img class="plane__fly__gif" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/scrollgif.gif" alt="gif scroll" data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/viet.gif" /> <?php }else{ ?>
                <img class="plane__fly__gif" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/fly.gif" alt="gif scroll" data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/english.gif" /> <?php }?>
            </div>
            <!-- slide 2 -->
            <?php if ($_smarty_tpl->getVariable('becomeAPilot')->value){?>
            <div data-slide="2" class="plane-slide plane__video scroll-1 image__zoom__block">
                <div class="plane__video__bg image__zoom" style="
            background-image: url(/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('becomeAPilot')->value->getProperty('the_plane');?>
);
          "></div>
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <div class="plane__video__heading"><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_change_text_home2');?>
</div>
                <?php }else{ ?>
                <div class="plane__video__heading"><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_change_text_home2_en');?>
</div>
                <?php }?>
                <div class="plane__video__popup">
                    <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/Vector1.png" alt="image" class="plane__video__play" data-link="<?php echo $_smarty_tpl->getVariable('becomeAPilot')->value->getProperty('custom_link_video');?>
" />
                    <div id="plane__video__popup-player1">
                    </div>
                    <i class="fas fa-times plane__video__popup__icon"></i>
                </div>
                <a class="plane__video__link" href="<?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/conduongtrothanhphicong.html<?php }else{ ?>/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/how.html<?php }?>"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a
        >
        <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
        <img
          class="plane__fly__gif"
          src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/z2901156658748_6b72a85dabf4cc8d4070d48d294fd850.gif"
          alt="gif scroll"
          data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/viet.gif"
        />
        <?php }else{ ?>
        <img
          class="plane__fly__gif"
          src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/scroll-down.gif"
          alt="gif scroll"
          data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/english.gif"
        />
        <?php }?>
      </div>
      <?php }?> <?php if ($_smarty_tpl->getVariable('about')->value){?>
      <!-- slide 3 -->
      <div
        data-slide="3"
        class="plane-slide plane__video scroll-2 image__zoom__block"
      >
        <div
          class="plane__video__bg image__zoom"
          style="
            background-image: url(/upload/1/resources/l_<?php echo $_smarty_tpl->getVariable('about')->value->getProperty('the_plane');?>
);
          "
        ></div>
        <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
        <div class="plane__video__heading"><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_change_text_home');?>
</div>
        <?php }else{ ?>
        <div class="plane__video__heading"><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_change_text_home_en');?>
</div>
        <?php }?>
      
        <div class="plane__video__popup">
          <img
            src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/Vector1.png"
            alt="image"
            class="plane__video__play"
            data-link="<?php echo $_smarty_tpl->getVariable('about')->value->getProperty('custom_link_video');?>
"
          />
          <div id="plane__video__popup-player2">
          </div>
          <i class="fas fa-times plane__video__popup__icon"></i>
        </div>
        <a
          class="plane__video__link"
          href="<?php if ($_smarty_tpl->getVariable('lang')->value=='vn'){?>/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/vechungtoi.html<?php }else{ ?>/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/about.html<?php }?>"
          ><?php echo $_smarty_tpl->getVariable('locale')->value->msg('see_more');?>
</a
        >

        <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
        <img
          class="plane__fly__gif"
          src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/z2901156658748_6b72a85dabf4cc8d4070d48d294fd850.gif"
          alt="gif scroll"
          data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/viet.gif"
        />
        <?php }else{ ?>
        <img
          class="plane__fly__gif"
          src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/scroll-down.gif"
          alt="gif scroll"
          data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/english.gif"
        />
        <?php }?>
      </div>
      <?php }?>
      <!-- slide 4 -->
      <div data-slide="4" class="plane-slide plane__bottom">
        <div class="plane__bottom__slider">
          <?php if ($_smarty_tpl->getVariable('slidesss')->value){?> <?php  $_smarty_tpl->tpl_vars['itemSlide'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slidesss')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemSlide']->key => $_smarty_tpl->tpl_vars['itemSlide']->value){
?>
          <div class="plane__bottom__slide image__zoom__block">
            <div
              class="image__zoom"
              style="
                background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemSlide')->value->getProperty('avatar');?>
);
              "
            ></div>
            <img
              src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/Subtract.png"
              alt="image"
              class="plane__bottom__slide__subtract"
            />
            <div class="wrapper--1">
              <div class="plane__bottom__slide__block">
                <a
                  href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlide')->value->getSlug($_tmp1);?>
-<?php echo $_smarty_tpl->getVariable('itemSlide')->value->getId();?>
"
                  class="plane__bottom__slide__title"
                  ><?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlide')->value->getTitle($_tmp2);?>
</a
                >
                <div class="plane__bottom__slide__text">
                  <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlide')->value->getSapo($_tmp3);?>

                </div>
              </div>
            </div>
          </div>
          <?php }} ?> <?php }?>
        </div>
        <div class="wrapper--2">
          <div class="plane__bottom__nav">
            <?php if ($_smarty_tpl->getVariable('slidesss')->value){?> <?php  $_smarty_tpl->tpl_vars['itemSlide'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('slidesss')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemSlide']->key => $_smarty_tpl->tpl_vars['itemSlide']->value){
?>
            <div class="plane__bottom__item__slide">
              <div class="plane__bottom__item__border"></div>
              <div class="plane__bottom__item">
                <div
                  class="plane__bottom__item__image"
                  style="
                    background-image: url(/upload/1/articles/l_<?php echo $_smarty_tpl->getVariable('itemSlide')->value->getProperty('avatar');?>
);
                  "
                ></div>
                <div class="plane__bottom__item__block">
                  <a href="/<?php echo $_smarty_tpl->getVariable('lang')->value;?>
/<?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlide')->value->getSlug($_tmp4);?>
-<?php echo $_smarty_tpl->getVariable('itemSlide')->value->getId();?>
" class="plane__bottom__item__title">
                    <?php ob_start();?><?php echo $_smarty_tpl->getVariable('lang')->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('itemSlide')->value->getTitle($_tmp5);?>

                  </a>
                <button class="plane__bottom__item__icon">
                    <i class="fas fa-arrow-circle-right"></i>
                  </button>
            </div>
    </div>
    </div>
    <?php }} ?> <?php }?>
    </div>
    </div>
    <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
    <img class="plane__fly__gif plane__fly__gif--2" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/z2901156658748_6b72a85dabf4cc8d4070d48d294fd850.gif" alt="gif scroll" data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/viet.gif" /> <?php }else{ ?>
    <img class="plane__fly__gif plane__fly__gif--2" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/scroll-down.gif" alt="gif scroll" data-gifmobile="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/english.gif" /> <?php }?>
    </div>
    <!-- slide 5 -->
    <div data-slide="5" class="plane-slide plane-form__container">
        <div class="wrapper--3">
            <form id="plane-form" class="plane-form">
                <?php $_template = new Smarty_Internal_Template('form.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-form'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
            </form>
        </div>
    </div>
    </main>
    </div>
    <input hidden id="showVideo" value="<?php echo $_smarty_tpl->getVariable('showVideo')->value;?>
" /> <?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</body>