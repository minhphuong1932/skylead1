<?php /* Smarty version Smarty-3.0-RC2, created on 2022-05-03 10:08:29
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/footer.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:169226192762709cadc50036-12139910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1c142e4444dbc4795d4b052e3a38159b9f89b4d' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/footer.tpl.html',
      1 => 1651547306,
    ),
  ),
  'nocache_hash' => '169226192762709cadc50036-12139910',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/validate.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script>
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/form.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script>
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery-3.6.0.js"></script>
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/slick.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script>
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/lity.min.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script>
<!-- <script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/plyr.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script> -->
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery.parallax.js"></script>
<script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
<script src="https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js"></script>
<script  src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/main.js<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('custom_version_css_js');?>
"></script>
<script>
//Lưu thông tin khách 
function saveInformation() {
  var name = $('#plane-name').val();
  var phone = $('#plane-phone').val();
  var email = $('#plane-email').val();
  var op = "save_infomation";
  $.ajax({
    type: 'POST',
    url: '/ajax.php',
    dataType: "json",
    data: { op, name,phone,email},
    success: function (data) {
      // console.log(data)
      if(data['success']==1){
        document.getElementById("plane-form").reset();
        // notiStack('success','Đã gửi thông tin thành công');
      }
    }
  });
}
</script>
</body>
</html>

