<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:21:32
         compiled from "/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/404.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1477219240618f2f3c73d675-15963354%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de1970404366e5374ff451ad089dcae04d3b7250' => 
    array (
      0 => '/home/skylead/domains/skylead.vn/public_html/templates/hangkhong/404.tpl.html',
      1 => 1636167610,
    ),
  ),
  'nocache_hash' => '1477219240618f2f3c73d675-15963354',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html lang="vi" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>404</title>
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/style.css">
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/libs/plugins/bootstrap.min.css">
        <style>
          .container{
            background: url(/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/404.png) center center no-repeat;
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            padding: 20px 0px 0px 20px;
            position: relative;
          }
        </style>
  </head>
  <body>
<div class="container">
  <div class="row">
    <div class="span12">
      <div class="hero-unit center">
          <?php if ($_smarty_tpl->getVariable('lang')->value=="vn"){?>
          <h1>Không tìm thấy trang bạn yêu cầu <small><font face="Tahoma" color="red">Lỗi 404</font></small></h1>
          <br/>
          <p>Trang bạn yêu cầu đã không còn tồn tại, vui lòng liên hệ với quản trị viên hoặc<b>
          
          <a href="/" class="btn btn-large btn-info" style="color:red"><i class="icon-home icon-white"></i> Trở về Trang chủ</a>
          <?php }else{ ?>
          <h1>The requested page could not be found <small><font face="Tahoma" color="red">404 error</font></small></h1>
          <br/>
          <p>The page you requested no longer exists, please contact the administrator or<b>
        
          <a href="/" class="btn btn-large btn-info" style="color:red"><i class="icon-home icon-white"></i> Back to Home</a >
          <?php }?>

        </div>
        <br/>
    </div>
  </div>
</div>
</body>
</html>