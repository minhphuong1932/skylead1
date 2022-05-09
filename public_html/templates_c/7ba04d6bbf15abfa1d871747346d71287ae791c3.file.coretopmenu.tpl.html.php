<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:01:52
         compiled from "./templates/admin/coretopmenu.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1811505101618f2aa02ef811-26911143%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ba04d6bbf15abfa1d871747346d71287ae791c3' => 
    array (
      0 => './templates/admin/coretopmenu.tpl.html',
      1 => 1635911811,
    ),
  ),
  'nocache_hash' => '1811505101618f2aa02ef811-26911143',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('authUser')->value){?>
<script>
	speed=1000;
	len=40;
	tid = 0;
	num=0;
	clockA = new Array();
	timeA = new Array();
	formatA = new Array();
	dd = new Date();
	var d,x;

	function doDate()
	{
		id = "#studingtimenoti";
		for (i=0;i<num;i++) {
			dt = new Date();

			if (timeA[i] != 0) {
				v1 = Math.round(( dt - timeA[i] )/1000) ;
				if (formatA[i] == 1)
		        //clockA[i].date.value = v1;
		    $(id) = v1;
		    else if (formatA[i] ==2) {
		    	sec = v1%60;
		    	v1 = Math.floor( v1/60);
		    	min = v1 %60 ;
		    	hour = Math.floor(v1 / 60);
		    	if (sec < 10 ) sec = "0"+sec;
		    	if (min < 10 ) min = "0"+min;
		    	$(id).val(hour+":"+min+":"+sec) ;
		    }
		    else if (formatA[i] ==3) {
		    	sec = v1%60;
		    	v1 = Math.floor( v1/60);
		    	min = v1 %60 ;
		    	v1 = Math.floor(v1 / 60);
		    	hour = v1 %24 ;
		    	day = Math.floor(v1 / 24);
		    	if (sec < 10 ) sec = "0"+sec;
		    	if (min < 10 ) min = "0"+min;
		    	if (hour < 10 ) hour = "0"+hour;
		    	$(id).val(hour+":"+min+":"+sec);
		    }
		    else if (formatA[i] ==4 ) {
		    	sec = v1%60;
		    	v1 = Math.floor( v1/60);
		    	min = v1 %60 ;
		    	v1 = Math.floor(v1 / 60);
		    	hour = v1 %24 ;
		    	day = Math.floor(v1 / 24);
		    	$(id).val(hour+(hour==1?"hour ":"hours ")+min+(min==1?"min ":"mins ")+sec+(sec==1?"sec ":"secs "));      
		    }
		    else
		    	clockA[i].date.value = "Invalid Format spec";
		}
		else
			clockA[i].date.value = "Countup from when?";

	}

	tid=window.setTimeout('doDate()',speed);
}
function start(d,format) {
	if (d == "now")
		timeA[num] = new Date();
	else
		timeA[num] = new Date(d);
	formatA[num] = format;
	if (num == 0)  
		tid=window.setTimeout('doDate()',speed);
	num++;
}
start('now',2);
</script>

<div id="nav" class="nav-noti">

	<input type="hidden" name="idCurUs" id="idCurUs" value="<?php echo $_smarty_tpl->getVariable('authUser')->value->getId();?>
">
<?php if ($_smarty_tpl->getVariable('authUser')->value){?><p class="datetime">
	<input type="hidden" id="studingtimenoti" name="studingtimenoti" value="" />
<a class="notifi">
<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()==4&&$_smarty_tpl->getVariable('notibacluong')->value==2){?>
<i aria-hidden="true" class="fa fa-comment comment3" onclick="ShowNotificationBL(this);"></i>
<i aria-hidden="true" class="fa fa-comment comment4 hiddendiv" onclick="HidenNotificationBL(this);"></i>
<span class="badgebl bg-yellow">1</span>
<?php }?>
<i aria-hidden="true" class="fa fa-bell bell1" onclick="ShowNotification(this);"></i>
<i aria-hidden="true" class="fa fa-bell bell2 hiddendiv" onclick="HidenNotification(this);"></i>

<span class="badge bg-green hiddendiv"></span>

</a>
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('hello');?>
 <a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=profile&act=information" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_profile');?>
"><strong><?php echo $_smarty_tpl->getVariable('authUser')->value->getFullname();?>
</strong></a> (<?php echo $_smarty_tpl->getVariable('authUser')->value->getUsername();?>
) [<?php echo $_smarty_tpl->getVariable('authUser')->value->getType();?>
]. [<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=logout" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('log_out');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('log_out');?>
</a>]</p>
	<?php if ($_smarty_tpl->getVariable('listNotification')->value){?>
	<div class="notifi-div hiddendiv">
	<ul class="listNotiul">
		<?php  $_smarty_tpl->tpl_vars['itemn'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['non'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotification')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemn']->key => $_smarty_tpl->tpl_vars['itemn']->value){
 $_smarty_tpl->tpl_vars['non']->value = $_smarty_tpl->tpl_vars['itemn']->key;
?>
	<li class="li-item">
	  <a onclick="ReadNotification(this);">
	      <?php echo $_smarty_tpl->getVariable('itemn')->value->getDetails();?>

	  </a>
	  <input type="hidden" class="linktomove" value="<?php echo $_smarty_tpl->getVariable('itemn')->value->getLink();?>
">
	  <input type="hidden" class="idtomove" value="<?php echo $_smarty_tpl->getVariable('itemn')->value->getId();?>
">
	</li>
	<?php }} ?>

	<li class="marsk-noti">
	    <a class="a-marsk-noti" href="/admin.php?op=manage&act=article&mod=clearnoti">
	      Xóa tất cả
	      <i class="fa fa-angle-right"></i>
	    </a>
	</li>
	</ul> 
	</div>
	<?php }?>
<?php }?>
<?php if ($_smarty_tpl->getVariable('authUser')->value->getType()==4&&$_smarty_tpl->getVariable('notibacluong')->value==2){?>
<div class="notifi-divbl hiddendiv">
	<ul>
	<li class="li-item">
	  <a href="/admin.php?op=manage&act=article&mod=addlvlsalary">
	     Vui lòng tạo thang bảng lương cho năm hiện hành
	  </a>
	</li>
	</ul> 
</div>
<?php }?>
<ul id="listmenu">
	<?php if ($_smarty_tpl->getVariable('topNav')->value){?>
<ul class=" fix_breadcrumb" <?php if ($_smarty_tpl->getVariable('authUser')->value->getType()==1){?>style="position: absolute;"<?php }?>>
<?php  $_smarty_tpl->tpl_vars['url'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('topNav')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['url']->total=count($_from);
 $_smarty_tpl->tpl_vars['url']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nav']['total'] = $_smarty_tpl->tpl_vars['url']->total;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['url']->key => $_smarty_tpl->tpl_vars['url']->value){
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['url']->key;
 $_smarty_tpl->tpl_vars['url']->iteration++;
 $_smarty_tpl->tpl_vars['url']->last = $_smarty_tpl->tpl_vars['url']->iteration === $_smarty_tpl->tpl_vars['url']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nav']['last'] = $_smarty_tpl->tpl_vars['url']->last;
?>
<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['nav']['last']){?><li class="last"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</li>
<?php }else{ ?><li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a></li>
<?php }?>
<?php }} ?>
</ul>
<?php }?>
<!-- <li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=dashboard" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
</a></li> -->
<!-- <li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_website');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_original_data');?>
</a></li> -->
<!-- <?php if ($_smarty_tpl->getVariable('authUser')->value->getType()!=0){?>
<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
</a></li>
<?php }?> -->

</ul>
</div>
<?php }else{ ?>
<div id="nav">
<ul id="listmenu">
<li><a href="/" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('home_page');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('home_page');?>
</a></li>
</ul>
</div>
<?php }?>
<script type="text/javascript">
		var interval = setInterval(function () { LoadNotification(); }, 10000);
</script>
