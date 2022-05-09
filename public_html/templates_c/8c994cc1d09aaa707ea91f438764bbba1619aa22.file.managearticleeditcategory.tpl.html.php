<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 11:03:31
         compiled from "./templates/admin/managearticleeditcategory.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:539126889618f3913cf3152-61559567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c994cc1d09aaa707ea91f438764bbba1619aa22' => 
    array (
      0 => './templates/admin/managearticleeditcategory.tpl.html',
      1 => 1635911797,
    ),
  ),
  'nocache_hash' => '539126889618f3913cf3152-61559567',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<?php if ($_smarty_tpl->getVariable('error')->value['invalid']||$_smarty_tpl->getVariable('error')->value['message']){?>
<?php $_smarty_tpl->assign('input',$_smarty_tpl->getVariable('error')->value['INPUT'],null,null);?>
<div class="errorBox">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('error_notes');?>
:</h2>
<ul class="listStyle">
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('input')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['error']){?><li><?php echo $_smarty_tpl->tpl_vars['field']->value['message'];?>
</li><?php }?>
<?php }} ?>
<li><?php echo $_smarty_tpl->getVariable('error')->value['message'];?>
</li>
</ul>
</div>
<?php }?>
<?php }?>
<div class="formContent">
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit_product_category');?>
</h1>
<?php if ($_smarty_tpl->getVariable('validItem')->value){?>
<?php if ($_smarty_tpl->getVariable('item')->value){?>
	<!-- Load user info -->
	<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data">
	<fieldset>
	<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
	<p><label for="parent_id">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_category');?>
:</label>
	<select name="parent_id" id="parent_id">
	<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

	</select></p>
	<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
	<select class="small" name="status" id="status">
	<option value="1"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
	<option value="0"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
	</select></p>
	<p><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
	<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
" name="position" id="position" /></p>
	<p><label for="slug">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('slug');?>
: </label>
	<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getSlug();?>
" name="slug" id="slug" /></p>

	<p><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_category');?>
: </label>
	<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" name="name" id="name" /></p>
	<p><label for="keyword">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('keyword');?>
: </label>
	<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getKeyword();?>
" name="keyword" id="keyword" /></p>
	<p><label for="description">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('sapo');?>
:</label>
	<textarea rows="10" cols="20" name="sapo" id="sapo"><?php echo $_smarty_tpl->getVariable('item')->value->getSapo();?>
</textarea></p>
	<p><label for="avatar"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('avatar');?>
: </label>
	<input type="file"  name="avatar" id="avatar" /></p>
	<p>
	<?php $_smarty_tpl->assign('avatar',$_smarty_tpl->getVariable('item')->value->getProperty('avatar'),null,null);?>
	<?php if ($_smarty_tpl->getVariable('avatar')->value){?>
	<div class="listPhoto">
	<ul>
	<li>
	<a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/l_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/a_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" width="100" /></a><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=editcategory&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delAvatar&avatar=<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a></li>
	</ul>
	</div>
	<?php }?>
	</p>
<!-- 
	<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_sort_result');?>
:</label>
	<input type="radio" name="sort_type" id="radio3" class="box" value="position"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_type')=="position"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('parameter_position');?>
</label>
	<input type="radio" name="sort_type" id="radio2" class="box" value="date_created"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_type')=="date_created"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('time_created');?>
</label>

	<input type="radio" name="sort_type" id="radio2" class="box" value="dateshow"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_type')=="dateshow"){?> checked<?php }?> />
	<label for="radio2" class="lbl">Ngày hiển thị</label>


	<input type="radio" name="sort_type" id="radio2" class="box" value="date_update"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_type')=="date_updated"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('time_update');?>
</label>
	<input type="radio" name="sort_type" id="radio3" class="box" value="slug"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_type')=="slug"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_title');?>
</label>
	<input type="radio" name="sort_type" id="radio3" class="box" value="viewed"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_type')=="viewed"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('num_of_accsess');?>
</label>
	</p>
	<p>
	<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_result');?>
:</label>
	<input type="radio" name="sort_dir" id="radio1" class="box" value="ASC"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_dir')=="ASC"){?> checked<?php }?> />
	<label for="radio1" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('asc');?>
</label>
	<input type="radio" name="sort_dir" id="radio2" class="box" value="DESC"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('sort_dir')=="DESC"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('desc');?>
</label>
	</p>
	<p>
	<label>Chọn hiển thị:</label>
	<input type="radio" name="template" id="radio2" class="box" value="news1"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('template')=="news1"){?> checked<?php }?> />
	<label for="radio2" class="lbl">New basic</label>
	<input type="radio" name="template" id="radio1" class="box" value="news2"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('template')=="news2"){?> checked<?php }?> />
	<label for="radio1" class="lbl">New Explore</label>
	<input type="radio" name="template" id="radio2" class="box" value="news3"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('template')=="news3"){?> checked<?php }?> />
	<label for="radio1" class="lbl">Company structure</label>
	</p>
	<p>
	<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_display_result');?>
:</label>
	<input type="radio" name="display" id="radio2" class="box" value="1"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('display')=="1"){?> checked<?php }?> />
	<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('acolum_rows');?>
</label>
	<input type="radio" name="display" id="radio1" class="box" value="0"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('display')=="0"){?> checked<?php }?> />
	<label for="radio1" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('colums_rows');?>
</label>
	</p>-->

<!-- 	<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['error']){?> class="errormsg"<?php }?>><label for="ipp">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('items_per_page');?>
:</label>
	<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('ipp');?>
" name="ipp" id="ipp" /></p> -->
	
	<!--<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('page_landing');?>
:</label>
	<input type="checkbox" name="landing" value="1" id="landing" class="box"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('landing')=="1"){?> checked<?php }?>/>
	<label for="landing_page" class="lbl"></label></p> -->


	<div style="display: none;">
	<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['landing_page']['error']){?> class="errormsg"<?php }?>><label for="comment"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_landing');?>
:</label></p>
	<textarea rows="5" cols="10" name="landing_page" id="landing_page"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('landing_page');?>
</textarea>
	<script type="text/javascript">var editor = CKEDITOR.replace('landing_page');</script>
		<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['landing_pageen']['error']){?> class="errormsg"<?php }?>><label for="comment"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_landing');?>
 (EN):</label></p>
	<textarea rows="5" cols="10" name="landing_pageen" id="landing_pageen"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('landing_pageen');?>
</textarea>
	<script type="text/javascript">var editor = CKEDITOR.replace('landing_pageen');</script>

	<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['moreinfo']['error']){?> class="errormsg"<?php }?>><label for="comment">Thông tin thêm:</label></p>
	<textarea rows="5" cols="10" name="moreinfo" id="moreinfo"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('moreinfo');?>
</textarea>
	<script type="text/javascript">var editor = CKEDITOR.replace('moreinfo');</script>
		<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['moreinfoen']['error']){?> class="errormsg"<?php }?>><label for="comment">Thông tin thêm (EN):</label></p>
	<textarea rows="5" cols="10" name="moreinfoen" id="moreinfoen"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('moreinfoen');?>
</textarea>
	<script type="text/javascript">var editor = CKEDITOR.replace('moreinfoen');</script>
</div>
	<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
	<br /><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_custom_field');?>
</h2>
	<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fieldList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
	<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML($_smarty_tpl->getVariable('item')->value->getProperty($_smarty_tpl->getVariable('field')->value->getName()));?>

	<?php }} ?>
	<?php }?>
	<p class="btn">
	<input type="hidden" name="op" value="manage" />
	<input type="hidden" name="act" value="article" />
	<input type="hidden" name="mod" value="editcategory" />
	<input type="hidden" name="doo" value="submit" />
	<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" />
	<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
	<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit" />
	<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
	<input type="button" onClick="javascript:formSubmit('formEdit','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
	</p>
	</fieldset>
	</form>
<?php }else{ ?>
<!-- Load submitted info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="parent_id">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_category');?>
:</label>
<select name="parent_id" id="parent_id">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select class="small" name="status" id="status">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['slug']['error']){?> class="errormsg"<?php }?>><label for="slug">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('slug');?>
: </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['slug']['value'];?>
<?php }?>" name="slug" id="slug" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_category');?>
: </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['name']['value'];?>
<?php }?>" name="name" id="name" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['error']){?> class="errormsg"<?php }?>><label for="keyword">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('keyword');?>
: </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['value'];?>
<?php }?>" name="keyword" id="keyword" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sapo']['error']){?> class="errormsg"<?php }?>><label for="sapo">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('sapo');?>
:</label>
<textarea rows="10" cols="20" name="sapo" id="sapo"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['sapo']['value'];?>
<?php }?></textarea></p>
<p><label for="avatar"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('avatar');?>
: </label>
<input type="file"  name="avatar" id="avatar" /></p>
<p>
<?php $_smarty_tpl->assign('avatar',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('avatar'),null,null);?>
<?php if ($_smarty_tpl->getVariable('avatar')->value){?>
<div class="listPhoto">
<ul>
<li>
<a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/a_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/a_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" width="100" /></a><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=editcategory&id=<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getId();?>
&doo=delAvatar&avatar=<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a></li>
</ul>
</div>
<?php }?>
</p>
<p>
<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_display_result');?>
:</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="position"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="position"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('parameter_position');?>
</label>
<input type="radio" name="sort_type" id="radio2" class="box" value="date_created"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="created"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('time_created');?>
</label>
<input type="radio" name="sort_type" id="radio2" class="box" value="date_update"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="date_update"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('time_update');?>
</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="slug"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="slug"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_title');?>
</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="viewed"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="viewed"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('num_of_accsess');?>
</label>
</p>
<p>
<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_result');?>
:</label>
<input type="radio" name="sort_dir" id="radio1" class="box" value="ASC"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['sort_dir']['value']=="ASC"){?> checked<?php }?> />
<label for="radio1" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('asc');?>
</label>
<input type="radio" name="sort_dir" id="radio2" class="box" value="DESC"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_dir']['value']=="DESC"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('desc');?>
</label>
</p>
<p>
<label>Chọn hiển thị:</label>
<input type="radio" name="template" id="radio2" class="box" value="news1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['template']['value']=="news1"){?> checked<?php }?> />
<label for="radio2" class="lbl">New basic</label>
<input type="radio" name="template" id="radio1" class="box" value="news2"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['template']['value']=="news2"){?> checked<?php }?> />
<label for="radio1" class="lbl">New Explore</label>
<input type="radio" name="template" id="radio2" class="box" value="news3"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['template']['value']=="news3"){?> checked<?php }?> />
<label for="radio1" class="lbl">Company structure</label>
</p>
<p>
<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_display_result');?>
:</label>
<input type="radio" name="display" id="radio2" class="box" value="1"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['display']['value']=="1"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('acolum_rows');?>
</label>
<input type="radio" name="display" id="radio1" class="box" value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['display']['value']=="0"){?> checked<?php }?> />
<label for="radio1" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('colums_rows');?>
</label>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['error']){?> class="errormsg"<?php }?>><label for="ipp">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('items_per_page');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['value'];?>
<?php }?>" name="ipp" id="ipp" /></p>
<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('page_landing');?>
:</label>
<input type="checkbox" name="landing" value="1" id="landing" class="box" <?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['landing']['value']=="1"){?>checked<?php }?>/>
<label for="landing_page" class="lbl"></label></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['landing_page']['error']){?> class="errormsg"<?php }?>><label for="comment"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_landing');?>
:</label></p>
<textarea rows="5" cols="10" name="landing_page" id="landing_page"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['landing_page']['value'];?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('landing_page');</script>
<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
<br /><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_custom_field');?>
</h2>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fieldList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?>
<?php $_smarty_tpl->assign('field_name',$_smarty_tpl->getVariable('field')->value->getName(),null,null);?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML($_smarty_tpl->getVariable('error')->value['INPUT'][$_smarty_tpl->getVariable('field_name')->value]['value']);?>

<?php }?>
<?php }} ?>
<?php }?>

<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="article" />
<input type="hidden" name="mod" value="editcategory" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit" />
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
<input type="button" onClick="javascript:formSubmit('formEdit','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('locale')->value->msg('code_invalid');?>
...<?php }?>
</div>
</div>