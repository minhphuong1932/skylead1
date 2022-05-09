<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:01:52
         compiled from "./templates/admin/corefooter.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:469053316618f2aa0490fc1-24013247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ece26f76d5691fb00eaa335b6af0b5074d93bb54' => 
    array (
      0 => './templates/admin/corefooter.tpl.html',
      1 => 1635911811,
    ),
  ),
  'nocache_hash' => '469053316618f2aa0490fc1-24013247',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div id="footer">
<p>DeraCMS v3.0</p>
</div>
<?php if ($_smarty_tpl->getVariable('urlPopup')->value){?>
<!--Get URL Popup-->  
<div class="popup2">
<p class="btnClose2"><a href="javascript:;" class="close" title="Close">X Close</a></p>
<div class="popupInner2">
<form action="" method="post" name="formContact">
<fieldset>
<ul>
<li>Get URL</li>
</ul>
<p>
<label for="name">Relative link</label>
<input type="text" value="" name="relative" id="valueRelative" /> 
</p>
<p>
<label for="name">Permanent link</label>
<input type="text" value="http://<?php echo $_smarty_tpl->getVariable('estore')->value->getDomain();?>
" name="relative" id="valuePermanent" />  
</p>
</fieldset>
</form>
</div>
</div>
<!--end Get URL Popup-->
<?php }?>
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/jquery-1.12.4.min.js"></script>

<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/common.js"></script>
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/forms.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/libs/bootstrap.min.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/libs/plugins/jquery.validate.min.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/libs/plugins/jquery-ui.min.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/libs/plugins/slick.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/script.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/jquery.timepicker.js"></script>
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/bootstrap-datetimepicker.min.js"></script>
<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/datetimepick.js"></script>

<!--Chọn mã màu-->
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/media/scripts/jquery.ps-color-picker.min.js"></script>  
<script type="text/javascript">

	$(".Checkcustom").hover(function(){
		$(this).find(".linkHover").show();
	}, function(){
		$(this).find(".linkHover").hide();
	})
</script>
</body>
</html>