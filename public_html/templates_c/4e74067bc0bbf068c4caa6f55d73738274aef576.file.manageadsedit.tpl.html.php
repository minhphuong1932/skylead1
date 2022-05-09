<?php /* Smarty version Smarty-3.0-RC2, created on 2021-12-21 12:15:06
         compiled from "./templates/admin/manageadsedit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:162823909461c162da590729-55550484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e74067bc0bbf068c4caa6f55d73738274aef576' => 
    array (
      0 => './templates/admin/manageadsedit.tpl.html',
      1 => 1640061288,
    ),
  ),
  'nocache_hash' => '162823909461c162da590729-55550484',
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('update_banner');?>
</h1>
<?php if ($_smarty_tpl->getVariable('validItem')->value){?>
<?php if ($_smarty_tpl->getVariable('item')->value){?>
<!-- Load product info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>

<!-- <p><label for="expert_id_list" style="color: red">Cùng thuộc chuyên gia: <br> Lưu ý: chỉ chọn cho đối tác chuyên gia<br>(Nhấn và giữ phím Ctr để chọn nhiều chuyên gia)</label>
	<select name="expert_id_list[]" id="expert_id_list" multiple="multiple" style="height: 100px;">
        <option value="0">Chọn</option>
        <?php if ($_smarty_tpl->getVariable('listExpert')->value){?>
		<?php  $_smarty_tpl->tpl_vars['catesub'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listExpert')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['catesub']->key => $_smarty_tpl->tpl_vars['catesub']->value){
?>
		
		<option value="<?php echo $_smarty_tpl->getVariable('catesub')->value->getId();?>
" <?php if (in_array($_smarty_tpl->getVariable('catesub')->value->getId(),$_smarty_tpl->getVariable('arraylistExpert')->value)){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('catesub')->value->getTitle();?>
</option>
        
        <?php }} ?>
		<?php }?>
    </select>
</p> -->

<p><label for="cat_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_group');?>
:</label>
<select name="gId" id="gId">
<?php if ($_smarty_tpl->getVariable('listAdsCate')->value){?>
<?php  $_smarty_tpl->tpl_vars['adscateiem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAdsCate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['adscateiem']->key => $_smarty_tpl->tpl_vars['adscateiem']->value){
?>
<option value="<?php echo $_smarty_tpl->getVariable('adscateiem')->value->getId();?>
"<?php if ($_smarty_tpl->getVariable('item')->value->getGId()==$_smarty_tpl->getVariable('adscateiem')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('adscateiem')->value->getName();?>
<?php if ($_smarty_tpl->getVariable('adscateiem')->value->getPId()>0){?> (Thuộc dự án <?php echo $_smarty_tpl->getVariable('articles')->value->getNameFromId($_smarty_tpl->getVariable('adscateiem')->value->getPId());?>
)<?php }?></option>
<?php }} ?>
<?php }?>
</select></p>
<!-- <p><label for="status">Thuộc dự án:</label>
<select name="tid" id="tid">
<?php if ($_smarty_tpl->getVariable('listArticlePro')->value){?>
<?php  $_smarty_tpl->tpl_vars['artiproitem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listArticlePro')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['artiproitem']->key => $_smarty_tpl->tpl_vars['artiproitem']->value){
?>
<option value="<?php echo $_smarty_tpl->getVariable('artiproitem')->value->getId();?>
"<?php if ($_smarty_tpl->getVariable('item')->value->getTId()==$_smarty_tpl->getVariable('artiproitem')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('artiproitem')->value->getTitle();?>
</option>
<?php }} ?>
<?php }?>
</select></p> -->

<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status">
<option value="1"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()=="1"){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()=="0"){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
" name="position" id="position" /></p>
<?php $_smarty_tpl->assign('logo',$_smarty_tpl->getVariable('item')->value->getProperty('logo'),null,null);?>
<?php $_smarty_tpl->assign('logo_type',$_smarty_tpl->getVariable('item')->value->getProperty('logo_type'),null,null);?>
<?php $_smarty_tpl->assign('url_logo',$_smarty_tpl->getVariable('item')->value->getProperty('url_logo'),null,null);?>
<?php $_smarty_tpl->assign('url_logo_type',$_smarty_tpl->getVariable('item')->value->getProperty('url_logo_type'),null,null);?>
<?php $_smarty_tpl->assign('width',$_smarty_tpl->getVariable('item')->value->getProperty('width'),null,null);?>
<?php $_smarty_tpl->assign('height',$_smarty_tpl->getVariable('item')->value->getProperty('height'),null,null);?>
<?php $_smarty_tpl->assign('url',$_smarty_tpl->getVariable('item')->value->getProperty('url'),null,null);?>
<?php $_smarty_tpl->assign('plane_one',$_smarty_tpl->getVariable('item')->value->getProperty('plane_one'),null,null);?>
<?php $_smarty_tpl->assign('plane_two',$_smarty_tpl->getVariable('item')->value->getProperty('plane_two'),null,null);?>
<?php $_smarty_tpl->assign('plane_three',$_smarty_tpl->getVariable('item')->value->getProperty('plane_three'),null,null);?>

<!-- <div class="boxTyle">
<label for="with"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_banner');?>
:</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
" name="urllogo" id="urllogo" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_banner');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_urllogo');?>
</p>
</div>
</div>
</div> -->
<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('banner_type_from_url');?>
:</label>
<select name="typeurl">
<option value="img" <?php if ($_smarty_tpl->getVariable('url_logo_type')->value=='img'){?> selected="selected"<?php }?> >Image</option>
<!-- <option value="swf" <?php if ($_smarty_tpl->getVariable('url_logo_type')->value=='swf'){?> selected="selected"<?php }?>>Flash</option>
<option value="video" <?php if ($_smarty_tpl->getVariable('url_logo_type')->value=='video'){?> selected="selected"<?php }?>>Video</option> -->
</select></p>
<?php if ($_smarty_tpl->getVariable('url_logo')->value){?>
<div style="margin:10px 0 15px 210px">
<?php if ($_smarty_tpl->getVariable('url_logo_type')->value=='img'){?>
<img src="<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
" <?php if ($_smarty_tpl->getVariable('width')->value){?>width="<?php echo $_smarty_tpl->getVariable('width')->value;?>
"<?php }?> <?php if ($_smarty_tpl->getVariable('height')->value){?>height="<?php echo $_smarty_tpl->getVariable('height')->value;?>
"<?php }?> alt="Logo" />
<?php }elseif($_smarty_tpl->getVariable('url_logo_type')->value=='swf'){?>
<div id="url_logo">
<?php echo $_smarty_tpl->getVariable('item')->value->getContent();?>

</div>
<script type='text/javascript'> 
var s1 = new SWFObject('<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
','url_logo','<?php echo $_smarty_tpl->getVariable('width')->value;?>
','<?php echo $_smarty_tpl->getVariable('height')->value;?>
','9');
s1.addParam('allowfullscreen','true');
s1.addParam('allowscriptaccess','always');
s1.addParam("wmode", "transparent");
s1.addParam('flashvars','autostart=1');
s1.write('url_logo');
</script>
<?php }elseif($_smarty_tpl->getVariable('url_logo_type')->value=='video'){?>
<a target="_blank" href="<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/video.png" width="100" height="100" /></a>
<?php }?>
</div>
<?php }?>
<!-- <div class="boxTyle">
<label for="articleimg">Ảnh từ thư viện:</label>
<input class="selectPhoto" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('articleimg');?>
" name="articleimg" id="articleimg" />
</div> -->
<div class="boxTyle">
<label for="photos"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_image_or_video');?>
:</label><input type="file" name="logo" id="logo" /></label>
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_image_or_video');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_logo');?>
</p>
</div>
</div>
</div>



<?php if ($_smarty_tpl->getVariable('logo_type')->value){?>
<div style="margin:10px 0 15px 210px">
<?php if (in_array($_smarty_tpl->getVariable('logo_type')->value,array("jpg","gif","png"))){?>
<?php if ($_smarty_tpl->getVariable('logo')->value){?>
<a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/l_<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/a_<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" <?php if ($_smarty_tpl->getVariable('width')->value){?>width="<?php echo $_smarty_tpl->getVariable('width')->value;?>
"<?php }?> <?php if ($_smarty_tpl->getVariable('height')->value){?>height="<?php echo $_smarty_tpl->getVariable('height')->value;?>
"<?php }?> alt="Logo"/></a>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delFile&file=<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a>
<?php }?>
<?php }elseif(in_array($_smarty_tpl->getVariable('logo_type')->value,array("mp3","wav","mp4","wmv","flv","f4v"))){?>
<?php if ($_smarty_tpl->getVariable('logo')->value){?>
 <embed width="<?php if ($_smarty_tpl->getVariable('width')->value){?><?php echo $_smarty_tpl->getVariable('width')->value;?>
<?php }else{ ?> 355<?php }?>" height="<?php if ($_smarty_tpl->getVariable('height')->value){?><?php echo $_smarty_tpl->getVariable('height')->value;?>
<?php }else{ ?>210<?php }?>" src="mediaplayer.swf" flashvars="file=/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/<?php echo $_smarty_tpl->getVariable('logo')->value;?>
&amp;image=/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/video.png">
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delFile&file=<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a><?php }?>
<?php }elseif($_smarty_tpl->getVariable('logo_type')->value=="swf"){?>
<div id="upload_banner">
<?php echo $_smarty_tpl->getVariable('item')->value->getContent();?>

</div>
<?php if ($_smarty_tpl->getVariable('logo')->value){?>
<script type='text/javascript'> 
var s1 = new SWFObject('/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/<?php echo $_smarty_tpl->getVariable('logo')->value;?>
','upload_banner','<?php echo $_smarty_tpl->getVariable('width')->value;?>
','<?php echo $_smarty_tpl->getVariable('height')->value;?>
','9');
s1.addParam('allowfullscreen','true');
s1.addParam('allowscriptaccess','always');
s1.addParam("wmode", "transparent");
s1.addParam('flashvars','autostart=1');
s1.write('upload_banner');
</script><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delFile&file=<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a>
<?php }?>
<?php }?>
</div>
<?php }?>
<div class="boxTyle">
<label for="photos">Hình ảnh : </label><input type="file" name="the_plane" id="the_plane" /></label>
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4>Cập nhật hình ảnh</h4>
<p>Chỉ update hình ảnh ( background ) ở trang chủ .</p>

</div>
</div>
</div>
<p>
<?php $_smarty_tpl->assign('the_plane',$_smarty_tpl->getVariable('item')->value->getProperty('the_plane'),null,null);?>
<?php if ($_smarty_tpl->getVariable('the_plane')->value){?>
<div class="listPhoto">
<ul>
<li>
<a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/l_<?php echo $_smarty_tpl->getVariable('the_plane')->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/a_<?php echo $_smarty_tpl->getVariable('the_plane')->value;?>
" width="100" /></a><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delPlane&plane=<?php echo $_smarty_tpl->getVariable('the_plane')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" style="margin-left: 10px;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a></li>
</ul>
</div>
<?php }?>
</p>
<br>


<br>
<p>
    <p><label for="detail"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('detail');?>
:</label></p>
    <textarea rows="10" cols="20" name="detail" id="detail" class="detailtext" contenteditable="true"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('detail');?>
</textarea>
    <script type="text/javascript">var editor = CKEDITOR.replace('detail');</script> 
</p>

<p>
    <p><label for="detail_en"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('detail_en');?>
:</label></p>
    <textarea rows="10" cols="20" name="detail_en" id="detail_en" class="detailtext" contenteditable="true"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('detail_en');?>
</textarea>
    <script type="text/javascript">var editor = CKEDITOR.replace('detail_en');</script> 
</p>

<!-- <div class="boxTyle">
<label for="with"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('width');?>
 (pixel):</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('width')->value;?>
" name="width" id="width" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('width');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_width_logo');?>
</p>
</div>
</div>
</div> -->
<!-- <div class="boxTyle">
<label for="height"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('height');?>
 (pixel):</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('height')->value;?>
" name="height" id="height" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('height');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_heigt_logo');?>
</p>
</div>
</div>
</div> -->
<!-- <div class="boxTyle">
<label for="url"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_banner');?>
:</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('url')->value;?>
" name="url" id="url" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_banner');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_url_logo');?>
</p>
</div>
</div>
</div> -->

<!-- <p class="boxTyle">
<label for="bannersub">Banner con:</label>
<input type="file"  name="bannersub[]" multiple="multiple" style="width: 300px;" />
</p> -->
<?php $_smarty_tpl->assign('photos',$_smarty_tpl->getVariable('item')->value->getProperty('photos'),null,null);?>
<?php if ($_smarty_tpl->getVariable('photos')->value){?>
<div style="margin:10px 0 15px 210px">
<?php  $_smarty_tpl->tpl_vars['photo'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['photo']->key => $_smarty_tpl->tpl_vars['photo']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['photo']->value){?>
<a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/l_<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/a_<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" width="50" alt="Logo"/></a>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delFilesub&photo=<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a>
<?php }?>
<?php }} ?>
</div>
<?php }?>
<!-- <p class="boxTyle">
<label for="caption">Ghi chú hình ảnh:</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('caption');?>
" name="caption" id="caption" style="width: 300px;" />
</p>
<p class="boxTyle">
<label for="caption_en">Ghi chú hình ảnh(Tiếng anh):</label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('caption_en');?>
" name="caption_en" id="caption_en" style="width: 300px;" />
</p> -->
<p>
<!-- <label for="url">Nội dung bổ sung:</label></p>
<textarea rows="10" cols="20" name="altcontent" id="altcontent"><?php echo $_smarty_tpl->getVariable('item')->value->getContent();?>
</textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('altcontent');</script>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['detail']['error']){?> class="errormsg"<?php }?>><label for="detail">* Nội dung Tiếng anh:</label></p>
<textarea rows="10" cols="20" name="detail_en" id="detail_en" class="detailtext" contenteditable="true"><?php echo $_smarty_tpl->getVariable('item')->value->getProperty('detail_en');?>
</textarea>
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
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML($_smarty_tpl->getVariable('item')->value->getProperty($_smarty_tpl->getVariable('field')->value->getName()));?>

<?php }} ?>
<?php }?>
</div>
</div>

<p>&nbsp;</p>

<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="edit" />
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
<input type="button" onClick="javascript:formSubmit('formEdit','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }else{ ?>
<!-- Load submitted info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="cat_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_group');?>
:</label>
<select name="gId" id="gId">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>
<!-- <p><label for="status">Thuộc dự án:</label>
<select name="tid" id="tid">
<?php if ($_smarty_tpl->getVariable('listArticlePro')->value){?>
<?php  $_smarty_tpl->tpl_vars['artiproitem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listArticlePro')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['artiproitem']->key => $_smarty_tpl->tpl_vars['artiproitem']->value){
?>
<option value="<?php echo $_smarty_tpl->getVariable('artiproitem')->value->getId();?>
"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tid']['value']==$_smarty_tpl->getVariable('artiproitem')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('artiproitem')->value->getTitle();?>
</option>
<?php }} ?>
<?php }?>
</select></p> -->
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<?php $_smarty_tpl->assign('logo',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('logo'),null,null);?>
<?php $_smarty_tpl->assign('logo_type',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('logo_type'),null,null);?>
<?php $_smarty_tpl->assign('width',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('width'),null,null);?>
<?php $_smarty_tpl->assign('height',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('height'),null,null);?>
<?php $_smarty_tpl->assign('url_logo',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('url_logo'),null,null);?>
<?php $_smarty_tpl->assign('url_logo_type',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('url_logo_type'),null,null);?>
<?php $_smarty_tpl->assign('url',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('url'),null,null);?>
<div class="boxTyle">
<!-- <label for="with"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_logo');?>
</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['urllogo']['value'];?>
 <?php }else{ ?><?php echo $_smarty_tpl->getVariable('urllogo')->value;?>
<?php }?>" name="urllogo" id="urllogo" /> -->
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_logo');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_urllogo');?>
</p>
</div>
</div>
</div>
<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_url_logo');?>
:</label>
<select name="typeurl">
<option value="img" <?php if ($_smarty_tpl->getVariable('typeurl')->value=='img'){?> selected="selected"<?php }?> >Image</option>
<option value="swf" <?php if ($_smarty_tpl->getVariable('typeurl')->value=='swf'){?> selected="selected"<?php }?>>Flash</option>
<option value="video" <?php if ($_smarty_tpl->getVariable('typeurl')->value=='video'){?> selected="selected"<?php }?>>Video</option>
</select></p>
<?php if ($_smarty_tpl->getVariable('url_logo')->value){?>
<div style="margin:10px 0 15px 210px">
<?php if ($_smarty_tpl->getVariable('url_logo_type')->value=='img'){?>
<img src="<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
" <?php if ($_smarty_tpl->getVariable('width')->value){?>width="<?php echo $_smarty_tpl->getVariable('width')->value;?>
"<?php }?> <?php if ($_smarty_tpl->getVariable('height')->value){?>height="<?php echo $_smarty_tpl->getVariable('height')->value;?>
"<?php }?> alt="Logo" />
<?php }elseif($_smarty_tpl->getVariable('url_logo_type')->value=='swf'){?>
<div id="url_logo">
<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getContent();?>

</div>
<script type='text/javascript'> 
var s1 = new SWFObject('<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
','url_logo','<?php echo $_smarty_tpl->getVariable('width')->value;?>
','<?php echo $_smarty_tpl->getVariable('height')->value;?>
','9');
s1.addParam('allowfullscreen','true');
s1.addParam('allowscriptaccess','always');
s1.addParam("wmode", "transparent");
s1.addParam('flashvars','autostart=1');
s1.write('url_logo');
</script>
<?php }elseif($_smarty_tpl->getVariable('url_logo_type')->value=='video'){?>
<a target="_blank" href="<?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/video.png" width="100" height="100" /></a>
<?php }?>
</div>
<?php }?>
<!-- <div class="boxTyle">
<label for="articleimg">Ảnh từ thư viện:</label>
<input class="selectPhoto" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['articleimg']['value'];?>
<?php }?>" name="articleimg" id="articleimg" />
</div> -->

<div class="boxTyle">
<label for="photos"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('upload_banner');?>
:</label><input type="file" name="logo" id="logo" /></label>
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('upload_banner');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_logo');?>
</p>
</div>
</div>
</div>
<?php if ($_smarty_tpl->getVariable('logo_type')->value){?>
<div style="margin:10px 0 15px 210px">
<?php if (in_array($_smarty_tpl->getVariable('logo_type')->value,array("jpg","gif","png"))){?>
<img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" <?php if ($_smarty_tpl->getVariable('width')->value){?>width="<?php echo $_smarty_tpl->getVariable('width')->value;?>
"<?php }?> <?php if ($_smarty_tpl->getVariable('height')->value){?>height="<?php echo $_smarty_tpl->getVariable('height')->value;?>
"<?php }?> alt="Logo"/>
<?php }elseif(in_array($_smarty_tpl->getVariable('logo_type')->value,array("mp4","wmv","flv","f4v"))){?>
<?php if ($_smarty_tpl->getVariable('logo')->value){?>
 <embed width="<?php if ($_smarty_tpl->getVariable('width')->value){?><?php echo $_smarty_tpl->getVariable('width')->value;?>
<?php }else{ ?> 355<?php }?>" height="<?php if ($_smarty_tpl->getVariable('height')->value){?><?php echo $_smarty_tpl->getVariable('height')->value;?>
<?php }else{ ?>210<?php }?>" src="mediaplayer.swf" flashvars="file=/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/<?php echo $_smarty_tpl->getVariable('logo')->value;?>
&amp;image=/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/video.png">
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delFile&file=<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a><?php }?>
<?php }elseif($_smarty_tpl->getVariable('logo_type')->value=="swf"){?>
<div id="upload_banner">
<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getContent();?>

</div>
<script type='text/javascript'> 
var s1 = new SWFObject('/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/<?php echo $_smarty_tpl->getVariable('logo')->value;?>
','upload_banner','<?php echo $_smarty_tpl->getVariable('width')->value;?>
','<?php echo $_smarty_tpl->getVariable('height')->value;?>
','9');
s1.addParam('allowfullscreen','true');
s1.addParam('allowscriptaccess','always');
s1.addParam("wmode", "transparent");
s1.addParam('flashvars','autostart=1');
s1.write('upload_banner');
</script>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=edit&id=<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getId();?>
&doo=delFile&file=<?php echo $_smarty_tpl->getVariable('logo')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a>
<?php }?>
</div>
<?php }?>
<div class="boxTyle">
<label for="with"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('width');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['width']['value'];?>
 <?php }else{ ?><?php echo $_smarty_tpl->getVariable('width')->value;?>
<?php }?>" name="width" id="width" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('width');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_width_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="height"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('height');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['height']['value'];?>
 <?php }else{ ?><?php echo $_smarty_tpl->getVariable('height')->value;?>
<?php }?>" name="height" id="height" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('height');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_heigt_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="url">URL:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['url']['value'];?>
 <?php }else{ ?><?php echo $_smarty_tpl->getVariable('url')->value;?>
<?php }?>" name="url" id="url" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4>URL</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_url_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="url"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_change');?>
:</label>
<textarea rows="10" cols="20" name="altcontent" id="altcontent"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['altcontent']['value'];?>
<?php }?></textarea>
<div class="helpIcon"><a href="#" class="btnHelp">&nbsp;<img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_change');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_altcontent');?>
</p>
</div>
</div>
</div>
<p class="boxTyle">
<label for="caption">Ghi chú hình ảnh:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['caption']['value'];?>
<?php }?>" name="caption" id="caption" style="width: 300px;" />
</p>
<p class="boxTyle">
<label for="caption_en">Ghi chú hình ảnh(Tiếng anh):</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['caption_en']['value'];?>
<?php }?>" name="caption_en" id="caption_en" style="width: 300px;" />
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['detail']['error']){?> class="errormsg"<?php }?>><label for="detail">* Nội dung Tiếng anh:</label></p>
<textarea rows="10" cols="20" name="detail_en" id="detail_en" class="detailtext" contenteditable="true"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('error')->value['INPUT']['detail_en']['value']);?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('detail_en');</script>
<p>&nbsp;</p>
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
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="edit" />
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
<input type="button" onClick="javascript:formSubmit('formEdit','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
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