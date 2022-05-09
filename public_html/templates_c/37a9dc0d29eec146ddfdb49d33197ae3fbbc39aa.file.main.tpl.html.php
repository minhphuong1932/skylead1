<?php /* Smarty version Smarty-3.0-RC2, created on 2022-05-06 19:03:04
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/main.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:66408092662750e78015914-57557611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37a9dc0d29eec146ddfdb49d33197ae3fbbc39aa' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/main.tpl.html',
      1 => 1651838497,
    ),
  ),
  'nocache_hash' => '66408092662750e78015914-57557611',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('head.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-head'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<body>
  <div class="main-page">
		<div class="main-page__content">
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
        <!-- <?php if ($_smarty_tpl->getVariable('usingIE')->value==1){?>
        <img style="max-width: 100%; display: block;margin: auto;" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/img/error.jpg" alt="image">
        <?php }else{ ?>
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
        <div class="line-leftoright">
          <div class="progresssenc"></div>    
        </div>
		</div>
	</div>

  <script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery-3.6.0.js"></script>
  <script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
  <script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/main.js"></script>
  </body>
  </html>
  <!-- <script type="text/javascript">
    var c = '100%';
    $(".progresssenc").animate({
    width: c
    },5000).promise().done(function () {
      window.location="/";
    });
  </script> -->


