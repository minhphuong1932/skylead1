<?php /* Smarty version Smarty-3.0-RC2, created on 2021-11-13 10:28:58
         compiled from "./templates/admin/managearticlelist.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:828141506618f30fa5faed2-19892481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cdf0eea6db53f838e9f429e23d9c345f3e5c507' => 
    array (
      0 => './templates/admin/managearticlelist.tpl.html',
      1 => 1636166271,
    ),
  ),
  'nocache_hash' => '828141506618f30fa5faed2-19892481',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/skylead/domains/skylead.vn/public_html/classes/template/plugins/modifier.date_format.php';
?><?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('pId')->value){?><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=list&pId=<?php echo $_smarty_tpl->getVariable('gfId')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back_group');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/icon_parent.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back_group');?>
" width="32" height="32" />...<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back');?>
</a></p><?php }?>
<?php if ($_smarty_tpl->getVariable('listItems')->value){?>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th><input type="checkbox" name="all" id="all" value="1" class="box3" onClick="toggleAllChecks('formType');" /></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('numbers');?>
</th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','id','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_code');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('code');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="id"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('images');?>
</th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','cat_id','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_cate');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('category');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="cat_id"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','title','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_title');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('title');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="name"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('link');?>
</th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('posts_user');?>
</th>
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','position','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_position');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="position"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<!-- <th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','viewed','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_view');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('view');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="viewed"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th> -->
<th><a href="javascript:void(0)" onClick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','status','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_status');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="status"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('actions');?>
</th>
</tr>
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
<?php $_smarty_tpl->assign('properties',$_smarty_tpl->getVariable('item')->value->getProperties(),null,null);?>
<tr<?php if ($_smarty_tpl->tpl_vars['no']->value%2==0){?> class="bgType"<?php }?>>
<td><input type="checkbox" name="ids[]" id="ids[]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="box3" /></td>
<td><?php echo $_smarty_tpl->getVariable('startNum')->value+$_smarty_tpl->tpl_vars['no']->value;?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
</td>
<td><?php if ($_smarty_tpl->getVariable('properties')->value['avatar']){?><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/l_<?php echo $_smarty_tpl->getVariable('properties')->value['avatar'];?>
" width="100" height="50px"/><?php }?>
</td>
<td><a class="underline" href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=list&pId=<?php echo $_smarty_tpl->getVariable('item')->value->getCatId();?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('view_list_product_of_group');?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</a></td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
 <?php if ($_smarty_tpl->getVariable('properties')->value['photos']){?><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_photo.png" alt="Photo available" width="16" height="16" /><?php }?><?php if ($_smarty_tpl->getVariable('properties')->value['videos']){?><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_video.png" alt="Video available" width="16" height="16" /><?php }?><?php if ($_smarty_tpl->getVariable('properties')->value['files']){?><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_attachment.png" alt="Attachment available" width="16" height="16" /><?php }?></td>
<td><a href="/vn/<?php echo $_smarty_tpl->getVariable('item')->value->getSlug();?>
-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" target="_blank" style="color:rgb(129, 129, 255)"><?php echo $_smarty_tpl->getVariable('item')->value->getSlug();?>
</a></td>
<td>
<?php $_smarty_tpl->assign('userUpload',$_smarty_tpl->getVariable('item')->value->getProperty('user_upload'),null,null);?>
<?php $_smarty_tpl->assign('userUpdate',$_smarty_tpl->getVariable('item')->value->getProperty('user_update'),null,null);?>
<?php if ($_smarty_tpl->getVariable('userUpload')->value){?><p>[P]<?php echo $_smarty_tpl->getVariable('userUpload')->value;?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"%Y-%m-%d");?>
</p><?php }?>
<?php if ($_smarty_tpl->getVariable('userUpdate')->value){?>[U]<?php echo $_smarty_tpl->getVariable('userUpdate')->value;?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"%Y-%m-%d");?>
<?php }?>
</td>
<td><input type="text" name="positions[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
" /></td>
<!-- <td><?php echo $_smarty_tpl->getVariable('item')->value->getViewed();?>
</td> -->
<td><?php echo $_smarty_tpl->getVariable('item')->value->getStatusTextBackend();?>
</td>
<td>
 <?php if ($_smarty_tpl->getVariable('item')->value->getStatusDuyet()==0){?>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&lang=<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_edit.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit');?>
" width="16" height="16" /></a>
<?php }?>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()||$_smarty_tpl->getVariable('authUser')->value->getType()==2||$_smarty_tpl->getVariable('authUser')->value->getType()==7){?>

<a href="javascript:formSubmit('formType','list','confirmrequest',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Duyệt" onclick="if(!confirm('Bạn có chắc muốn kích hoạt bài viết này không ?'))
		  return false;"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_enable.png" alt="Duyệt" width="16" height="16" /></a>

<?php }else{ ?>
<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()==4){?>
<a href="javascript:formSubmit('formType','list','sendrequest',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Yêu cầu duyệt" onclick="if(!confirm('Bạn có chắc muốn gửi yêu cầu duyệt bài viết cho cấp trên?'))
 return false;"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/tick.jpg" alt="Yêu cầu duyệt" width="16" height="16" /></a>
<?php }?>
<?php }?>
<a href="javascript:formSubmit('formType','list','disable',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_disable.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
" width="16" height="16" /></a>
<a href="javascript:formSubmit('formType','list','delete',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_delete.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
" width="16" height="16" /></a>
<?php if ($_smarty_tpl->getVariable('item')->value->getHome()){?>
<a href="javascript:formSubmit('formType','list','deletehome',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable_home');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/delete_home.gif" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable_home');?>
" width="16" height="16" /></a>
<?php }else{ ?>
<!-- <a href="javascript:formSubmit('formType','list','sethome',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable_home');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/home_ico.gif" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable_home');?>
" width="16" height="16" /></a> -->
<?php }?>
<!-- <?php if ($_smarty_tpl->getVariable('item')->value->getBanner()){?>
<a href="javascript:formSubmit('formType','list','deletebanner',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable_banner');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/delete_special.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable_banner');?>
" width="16" height="16" /></a>
<?php }else{ ?>
<a href="javascript:formSubmit('formType','list','setbanner',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable_banner');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/special.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable_banner');?>
" width="16" height="16" /></a>
<?php }?> -->
<a href="javascript:formSubmit('formType','list','duplicate',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Copy"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_copy.png" alt="Copy" width="16" height="16" /></a>
<!-- <a target="_blank" href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('first_view');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_preview.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('first_view');?>
" width="16" height="16" /></a> -->
<!-- <span class="check"><a rel="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" href="javascript:void(0);" title="Link"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_link.png" alt="Link" width="16" height="16" /></a><span> -->
</td>
</tr>
<?php }} ?>
</tbody>
</table>
<div class="paging">
<p class="listBtn">
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_update');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','changeposition','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_update');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','enable','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','disable','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
" href="javascript:void(0);" onClick="javascript:formSubmit('formType','list','delete','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
</a>
</p>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corepager.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','pager'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<div class="infoType2">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corecomboipp.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','ipp'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="listCategory">
<select name="parent_id">
<option value="0" selected="selected">----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_group');?>
 -----</option>
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select>
<input type="button" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_move');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_move');?>
" class="btnSubmit2" name="btnSubmit2" onClick="javascript:formSubmit('formType','list','changegroup','0');" />
</div>
</div>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="article" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="pId" value="<?php echo $_smarty_tpl->getVariable('pId')->value;?>
" />
<input type="hidden" name="doo" value="" />
<input type="hidden" name="kw" value="<?php echo $_smarty_tpl->getVariable('kw')->value;?>
" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="hidden" name="ipp" value="<?php echo $_smarty_tpl->getVariable('ipp')->value;?>
" />
<input type="hidden" name="sk" value="<?php echo $_smarty_tpl->getVariable('sk')->value;?>
" />
<input type="hidden" name="sd" value="<?php echo $_smarty_tpl->getVariable('sd')->value;?>
" />
<input type="hidden" name="pg" value="<?php echo $_smarty_tpl->getVariable('pg')->value;?>
" />
<input type="hidden" name="id" value="" />
</form>
<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('no_record');?>

<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="article" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="" />
</form>
<?php }?>
</div>