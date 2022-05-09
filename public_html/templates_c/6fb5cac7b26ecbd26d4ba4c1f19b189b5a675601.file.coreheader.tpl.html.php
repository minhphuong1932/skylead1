<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:01:52
         compiled from "./templates/admin/coreheader.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1662074452618f2aa02601c8-20193077%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fb5cac7b26ecbd26d4ba4c1f19b189b5a675601' => 
    array (
      0 => './templates/admin/coreheader.tpl.html',
      1 => 1635911811,
    ),
  ),
  'nocache_hash' => '1662074452618f2aa02601c8-20193077',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<html xmlns="http://www.w3.org/1999/xhtml" class="color_primary">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="DeraCMS, e-commerce solution, administration page" />
<meta name="description" content="DeraCMS for E-store" />
<title><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_website');?>
</title>
<link rel="stylesheet" type="text/css" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/screen.css" media="all" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/libs/plugins/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto|Roboto+Condensed|Noto+Sans" rel="stylesheet">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/libs/plugins/slick.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/libs/plugins/slick-theme.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/libs/plugins/jquery-ui.min.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/style.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/bootstrap-combined.min.css">

<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/bootstrap-select.min.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/jquery.timepicker.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/color.css">
<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/datetimepick.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script>
    !window.jQuery && document.write('<script src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/jquery-1.4.3.min.js"><\/script>');
  </script>
  <script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
  ( function( $ ) {
  $(document).ready(function() {

    $("a[rel=example_group]").fancybox({
        width  : 800,
        height : 600,
        type   :'iframe'
      });
    $("a[rel=example_img]").fancybox({
        'transitionIn'    : 'none',
        'transitionOut'   : 'none',
        'titlePosition'   : 'over',
        'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
          return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
      });
    $("a[rel=example_group_invoice]").fancybox({
        width  : 800,
        height : 600,
        type   :'iframe'
      });
    $("a[rel=example_invoice]").fancybox({
        'transitionIn'    : 'none',
        'transitionOut'   : 'none',
        'titlePosition'   : 'over',
        'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
          return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
      });
  });
})( jQuery );
</script>

<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/mootools.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/js/swfobject.js"></script>
<?php if ($_smarty_tpl->getVariable('selectPhoto')->value){?>
<script type="text/javascript">
function init(){
	var els=document.getElementsByTagName('*');
	var reg=/(^| )selectPhoto($| )/;
	for(i in els){
		var el=els[i];
		if(reg.test(el.className))el.onclick=function(){
			window.SetUrl=(function(id){
				return function(value){
					value=value.replace(/[a-z]*:\/\/[^\/]*/,'');
					document.getElementById(id).value=value;
				}
			})(this.id);
			var photo_url='/plugins/filemanager/browse.php?type=files';
			window.open(photo_url,'selectPhoto','modal,width=800,height=600');
		}
	}
}
</script>
<?php }?>


<script type="text/javascript">
   function confirmAction() {
        return confirm("Do you want intall this addon?");
      }
   function confirmUninstall() {
        return confirm("Do you want unintall this addon?");
      }
</script>



<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
  });
</script>
  <script>
  $( function() {
    $( "#date" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true, yearRange: '1900:+1'});
  } );
  $( function() {
    $("#date_endholiday").datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true, yearRange: '1900:+1'});
  } );
  $( function() {
    $( "#create_date" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true, yearRange: '1900:+1'});
  } );
  $( function() {
    $( "#end_date" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true, yearRange: '1900:+1'});
  } );
  $( function() {
    $( "#date_dependent" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true, yearRange: '1900:'+ new Date().getFullYear()});
  } );
  $( function() {
    $( "#date_join" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true});
  } );
   $( function() {
    $( "#date_leave" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true});
  } );
  $( function() {
    $( "#datecap" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true, yearRange: '-50:+50'});
  } );
  $( function() {
    $( "#date_start" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true});
  } );
  $( function() {
    $( "#date_finish" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,
      changeYear: true});
  } );
  $( function() {
    $( "#date_hoadon" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
      changeYear: true});
  } );
  $( function() {
    $( "#date_checkin" ).datepicker({dateFormat: 'yy-mm-dd HH:MM:ss', changeMonth: true,
      changeYear: true});
  } );
  $( function() {
    $( "#start_hopdong" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
      changeYear: true, yearRange: '-3:+50'});
  } );
  $( function() {
    $( "#finish_hopdong" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
      changeYear: true, yearRange: '-3:+50'});
  } );
  $( function() {
    $( "#ngay_ki" ).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
      changeYear: true, yearRange: '-3:+50'});
  } );
  $(function() {
        $('#timestart').timepicker({ 'timeFormat': 'H:i:s' });
  });
  $(function() {
        $('#timefinish').timepicker({ 'timeFormat': 'H:i:s' });
  });
   $(function() {
    $("#from").datepicker({
        dateFormat: "yy-mm-dd",changeMonth: true,
      changeYear: true
    });
    $("#to").datepicker({
        dateFormat: "yy-mm-dd",changeMonth: true,
      changeYear: true
    });
});
  $( function() {
    $( "#date_processed" ).datepicker({
    		dateFormat: 'yy-mm-dd',
    onSelect: function(dateText, inst) {
      $("input[name='date_processed']").val(dateText);
    }
});
  });
   $( function() {
    $( "#date_approved" ).datepicker({
    	dateFormat: 'yy-mm-dd',
    onSelect: function(dateText, inst) {
      $("input[name='date_approved']").val(dateText);
    }
});
  });
     $( function() {
      $( "#month_processed" ).datepicker({
        dateFormat: 'mm/yy',
      onSelect: function(dateText, inst) {
        $("input[name='month_processed']").val(dateText);
      }
    });
  });
    
    $(function() {
	    $("#ngaytao").datepicker({
	        dateFormat: "dd-mm-yy",
	        onSelect: function(dateText, instance) {
	            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
	             date.setDate(date.getDate() + 30);
	            $("#ngayhethan").datepicker("setDate", date );
	        }
	    });
	    $("#ngayhethan").datepicker({
	        dateFormat: "dd-mm-yy"
	    });
	});


  </script>
  
  <?php if ($_smarty_tpl->getVariable('estore')->value){?>
		<?php $_smarty_tpl->assign('primaryColor',$_smarty_tpl->getVariable('estore')->value->getProperty('rgb'),null,null);?>
		<?php $_smarty_tpl->assign('primaryColorOpa',$_smarty_tpl->getVariable('estore')->value->getProperty('rgba'),null,null);?>
		<?php $_smarty_tpl->assign('css_1',$_smarty_tpl->getVariable('estore')->value->getProperty('css_1'),null,null);?>
		<?php $_smarty_tpl->assign('css_2',$_smarty_tpl->getVariable('estore')->value->getProperty('css_2'),null,null);?>
		<?php $_smarty_tpl->assign('css_3',$_smarty_tpl->getVariable('estore')->value->getProperty('css_3'),null,null);?>
		
		<!--Change color-->
		<?php echo $_smarty_tpl->getVariable('css_1')->value;?>
<?php echo $_smarty_tpl->getVariable('primaryColor')->value;?>
<?php echo $_smarty_tpl->getVariable('css_2')->value;?>
<?php echo $_smarty_tpl->getVariable('primaryColorOpa')->value;?>
<?php echo $_smarty_tpl->getVariable('css_3')->value;?>

	<?php }?>
</head>
<body<?php if ($_smarty_tpl->getVariable('selectPhoto')->value){?> onload="init()"<?php }?> class="home-page">
<div id="wrapper">
<div id="header">
<!-- <?php if (isset($_smarty_tpl->getVariable('estore')->value)&&$_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo')){?> -->
<h1><a href="/" title="Home page" target="_blank"><img src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('admin_logo');?>
" width="50px" alt="Logo" /></a></h1>
<!-- <?php }else{ ?>
<h1><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=general"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('update_admin_logo');?>
</a></h1>
<?php }?> -->
</div>    
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coretopmenu.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'top'-'menu'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>