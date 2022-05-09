<?php /* Smarty version Smarty-3.0-RC2, created on 2022-03-15 11:20:51
         compiled from "./templates/admin/managearticleadd.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:5555054623014230a2945-81338427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f35c296bd6b10ea6d004df09a44bbaba0782096' => 
    array (
      0 => './templates/admin/managearticleadd.tpl.html',
      1 => 1647318049,
    ),
  ),
  'nocache_hash' => '5555054623014230a2945-81338427',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.escape.php';
?><?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new_article');?>
</h1>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="cat_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_category');?>
:</label>
<select name="cat_id" id="cat_id">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" class="small" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['title']['error']){?> class="errormsg"<?php }?>><label for="title">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('title');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['title']['value'];?>
<?php }?>" name="title" id="title" /></p>
<!-- 
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['Cssimg']['error']){?> class="errormsg"<?php }?>><label for="Cssimg">CSS img(1->4)</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['Cssimg']['value'];?>
<?php }?>" name="Cssimg" id="Cssimg" /></p> -->

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['error']){?> class="errormsg"<?php }?>><label for="keyword">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('keyword');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['value'];?>
<?php }?>" name="keyword" id="keyword" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sapo']['error']){?> class="errormsg"<?php }?>><label for="description"> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('sapo');?>
:</label>
<textarea rows="10" cols="20" name="sapo" id="sapo"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['sapo']['value'];?>
<?php }?></textarea></p>
<!-- <p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['viewed']['error']){?> class="errormsg"<?php }?>><label for="viewed">Số lượt xem </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['viewed']['value'];?>
<?php }?>" name="viewed" id="viewed" /></p> -->
<!-- <p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['price1']['error']){?> class="errormsg"<?php }?>><label for="price1">Giá 1 năm:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['price1']['value'];?>
<?php }?>" name="price1" id="price1" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['priceh1']['error']){?> class="errormsg"<?php }?>><label for="priceh1">Giá Hãng 1 năm:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['priceh1']['value'];?>
<?php }?>" name="priceh1" id="priceh1" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['price2']['error']){?> class="errormsg"<?php }?>><label for="price2">Giá 2 năm:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['price2']['value'];?>
<?php }?>" name="price2" id="price2" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['priceh2']['error']){?> class="errormsg"<?php }?>><label for="priceh2">Giá Hãng 2 năm:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['priceh2']['value'];?>
<?php }?>" name="priceh2" id="priceh2" /></p> -->
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['detail']['error']){?> class="errormsg"<?php }?>><label for="detail">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('detail');?>
:</label></p>
<textarea rows="10" cols="20" name="detail" id="detail" class="detailtext" contenteditable="true"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('error')->value['INPUT']['detail']['value']);?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('detail');</script> 
<br>
<p><label for="description_en">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('detail_en');?>
:</label></p>
<textarea rows="10" cols="20" name="en_detail" id="en_detail"></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('en_detail');</script>
<br />
<p><label for="avatar"> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('avatar');?>
: </label><input type="file"  name="avatar" id="avatar" /></p>
<!-- <p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dateshow']['error']){?> class="errormsg"<?php }?>><label for="dateshow">Ngày hiển thị:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['dateshow']['value'];?>
<?php }?>" name="dateshow" id="fdate" /></p>

<div class="boxTyle">
<label for="articleimg">Ảnh bài viết:</label>
<input class="selectPhoto" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['articleimg']['value'];?>
<?php }?>" name="articleimg" id="articleimg" />
</div>
-->
<p hidden><label for="files">Hình ảnh slide:</label><input type="file" name="files[]" id="files[]" multiple /><br clear="all" /></p>
<!-- <p><label for="avatar">Hình ảnh slide: </label><input type="file"  name="slide" id="slide" /></p> -->
<!--<p><strong>Dành cho bài viết về nhân viên</strong></p>
<p><label for="chucvu">Chức vụ</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['chucvu']['value'];?>
<?php }?>" name="chucvu" id="chucvu" /></p>
<p><label for="phong">Phòng</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['phong']['value'];?>
<?php }?>" name="phong" id="phong" /></p>
<p><label for="title">Ngày sinh:</label>
<input placeholder="chọn ngày" style="width: 85px; text-align: center;" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['date']['value'];?>
<?php }?>" type="text" name="date" id="date" class="date" autocomplete="off" /></p>
<p><label for="emailsnv">Email</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['emailsnv']['value'];?>
<?php }?>" name="emailsnv" id="emailsnv" /></p>
<p><label for="hocvan">Học vấn</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['hocvan']['value'];?>
<?php }?>" name="hocvan" id="hocvan" /></p>
<p><label for="timeofstudy">Thời gian đi học</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['timeofstudy']['value'];?>
<?php }?>" name="timeofstudy" id="timeofstudy" /></p>
 <p><label for="qtlamviec">Quá trình công tác:</label></p>
<textarea rows="10" cols="20" name="qtlamviec" id="qtlamviec" class="detailtext" contenteditable="true"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('error')->value['INPUT']['qtlamviec']['value']);?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('qtlamviec');</script> 
<br />-->
<!-- <p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['detail']['error']){?> class="errormsg"<?php }?>><label for="detail">* Nội dung Tiếng anh:</label></p>
<textarea rows="10" cols="20" name="detail_en" id="detail_en" class="detailtext" contenteditable="true"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('error')->value['INPUT']['detail_en']['value']);?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('detail_en');</script> -->
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

<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML('');?>

<?php }?>
<?php }} ?>
<?php }?>
<br />
<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="article" />
<input type="hidden" name="mod" value="add" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit"/>
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
<input type="button" onClick="javascript:formSubmit('formAdd','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>