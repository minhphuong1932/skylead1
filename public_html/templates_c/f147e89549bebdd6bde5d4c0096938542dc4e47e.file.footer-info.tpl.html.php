<?php /* Smarty version Smarty-3.0-RC2, created on 2022-03-17 10:48:09
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/footer-info.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:9159377046232af791b9c15-92618548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f147e89549bebdd6bde5d4c0096938542dc4e47e' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/footer-info.tpl.html',
      1 => 1647488318,
    ),
  ),
  'nocache_hash' => '9159377046232af791b9c15-92618548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<footer class="footer">
    <div class="grid wide footer__row">
        <div class="footer__block">
        <ul class="footer__list">
            <li>
            <strong><?php echo $_smarty_tpl->getVariable('locale')->value->msg('hotline');?>
:</strong>
            <?php echo $_smarty_tpl->getVariable('estore')->value->getTel();?>

            </li>
            <li>
            <strong>Email:</strong>
            <?php echo $_smarty_tpl->getVariable('estore')->value->getEmail();?>

            </li>
        </ul>
        <ul class="footer__socials">
            <li>
            <a href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_linkfb');?>
">
                <i class="fab fa-facebook-square"></i>
            </a>
            </li>
            <li>
            <a href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_instagram');?>
">
                <i class="fab fa-instagram"></i>
            </a>
            </li>
            <li>
            <a href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_linkyoutube');?>
">
                <i class="fab fa-youtube-square"></i>
            </a>
            </li>
        </ul>
        </div>
        <a href="/" class="footer__block footer__block--2">
            <img class="footer__logo" src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('logo_footer');?>
" alt="logo footer" />
            <div class="footer__slogan">
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_slogan');?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_en_slogan');?>

                <?php }?>
            </div>
        </a>
        <div class="footer__block">
            <div class="footer__address">
                <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getAddress();?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('address_en');?>

                <?php }?>
            </div>
        </div>
    </div>
</footer>