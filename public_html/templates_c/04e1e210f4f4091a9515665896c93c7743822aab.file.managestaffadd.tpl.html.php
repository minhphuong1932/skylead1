<?php /* Smarty version Smarty-3.0-RC2, created on 2022-04-18 15:48:46
         compiled from "./templates/admin/managestaffadd.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2136455810625d25eebd41e9-60759928%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04e1e210f4f4091a9515665896c93c7743822aab' => 
    array (
      0 => './templates/admin/managestaffadd.tpl.html',
      1 => 1635911807,
    ),
  ),
  'nocache_hash' => '2136455810625d25eebd41e9-60759928',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<div class="contType"><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes');?>
:</h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes_user');?>
</div>
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new_user');?>
</h1>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['username']['error']){?> class="errormsg"<?php }?>><label for="username">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('username');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['username']['value'];?>
<?php }?>" name="username" id="username" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['password']['error']){?> class="errormsg"<?php }?>><label for="password">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('password');?>
:</label>
<input class="small" type="password" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['password']['value'];?>
<?php }?>" name="password" id="password" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['confirm_password']['error']){?> class="errormsg"<?php }?>><label for="confirm_password">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('confirm_password');?>
:</label>
<input class="small" type="password" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['confirm_password']['value'];?>
<?php }?>" name="confirm_password" id="confirm_password" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['idNV']['error']){?> class="errormsg"<?php }?>><label for="idNV">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('idNV');?>
:</label>
<input class="medium" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['idNV']['value'];?>
<?php }?>" name="idNV" id="idNV" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['fullname']['error']){?> class="errormsg"<?php }?>><label for="fullname">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('fullname');?>
:</label>
<input class="medium" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['fullname']['value'];?>
<?php }?>" name="fullname" id="fullname" /></p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['date']['error']){?> class="errormsg"<?php }?>><label for="title"> Ng??y sinh : </label>
<input placeholder="ch???n ng??y" style="width: 85px; text-align: center;" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['date']['value'];?>
<?php }?>" type="text" name="date" id="date" class="date"/></p>

<p><label for="gioitinh">Gi???i t??nh:</label>
<select class="gioitinh"  name="user_gioitinh" id="user_gioitinh">
<option value="0">Ch???n gi???i t??nh</option>
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_gioitinh']['value']==1){?>selected="selected"<?php }?>>Nam</option>
<option value="2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_gioitinh']['value']==2){?>selected="selected"<?php }?>>N???</option>
</select></p>

<!-- <p><label for="dantoc">D??n t???c:</label>
<select class="dantoc" name="dantoc" id="dantoc">
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==0){?>selected="selected"<?php }?>>Ch???n D??n t???c</option>
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==1){?>selected="selected"<?php }?>>Kinh</option>
<option value="2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==2){?>selected="selected"<?php }?>>Hoa</option>
<option value="3"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==3){?>selected="selected"<?php }?>>Khmer</option>
<option value="4"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==4){?>selected="selected"<?php }?>>Ch??m</option>
<option value="5"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==5){?>selected="selected"<?php }?>>T??y</option>
<option value="6"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==6){?>selected="selected"<?php }?>>N??ng</option>
<option value="7"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==7){?>selected="selected"<?php }?>>Th??i</option>
<option value="8"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dantoc']['value']==8){?>selected="selected"<?php }?>>Kh??c</option>
</select></p>
<p><label for="tongiao">T??n gi??o:</label>
<select class="tongiao" name="tongiao" id="tongiao">
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tongiao']['value']==0){?>selected="selected"<?php }?>>Ch???n T??n gi??o</option>
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tongiao']['value']==1){?>selected="selected"<?php }?>>Ph???t</option>
<option value="2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tongiao']['value']==2){?>selected="selected"<?php }?>>Thi??n Ch??a</option>
<option value="3"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tongiao']['value']==3){?>selected="selected"<?php }?>>Tin L??nh</option>
<option value="4"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tongiao']['value']==4){?>selected="selected"<?php }?>>Kh??c</option>
<option value="5"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tongiao']['value']==5){?>selected="selected"<?php }?>>Kh??ng</option>
</select></p>

<p><label for="weight">C??n n???ng:</label>
<input class="medium" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['weight']['value'];?>
<?php }?>" name="weight" id="weight" /></p>

<p><label for="height">Chi???u cao:</label>
<input class="medium" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['height']['value'];?>
<?php }?>" name="height" id="height" /></p>

<p><label for="avatar"> H??nh ???nh: </label><input type="file"  name="avatar" id="avatar" /></p>

<p><label for="telephone"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('telephone');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['telephone']['value'];?>
<?php }?>" name="telephone" id="telephone" /></p> -->

<!-- <p><label for="email"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('email');?>
:</label>
<input class="medium" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['email']['value'];?>
<?php }?>" name="email" id="email" /></p> -->

<!-- <p><label for="cmnd">CMND:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['CMND']['value'];?>
<?php }?>" name="CMND" id="CMND" /></p>

<p><label for="nguyenquan">Ng??y c???p:</label>
<input placeholder="ch???n ng??y" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['datecap']['value'];?>
<?php }?>" style="width: 85px; text-align: center;" type="text" name="datecap" id="datecap" class="datecap"/></p>

<p><label for="noicap">N??i c???p:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['noicap']['value'];?>
<?php }?>" name="noicap" id="noicap" /></p>

<p><label for="addresstt"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('address');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['addresstt']['value'];?>
<?php }?>" name="addresstt" id="addresstt" /></p>
<p>
<label for="txtProvine">T???nh/Th??nh:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['province']['value'];?>
<?php }?>" name="province" id="province"/> -->
<!--
<select id="province" name="province" onchange="ajaxprovince('#province','#national')">
<option value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['province']['value'];?>
<?php }?>" selected>Ch???n T???nh/Th??nh </option>
<?php echo $_smarty_tpl->getVariable('combotinh1')->value;?>

</select>
-->
<!-- </p>
<p><label for="national" >Qu???n/Huy???n:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['national']['value'];?>
<?php }?>" name="national" id="national"/> -->
<!--
<select  name="national">
<option value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['national']['value'];?>
<?php }?>" selected>Ch???n qu???n huy???n </option>
 </select>                   
-->
</p>

<!-- <p style="display: flex;"><label for="nguyenquan">?????a ch??? li??n h???:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['addresslh']['value'];?>
<?php }?>" name="addresslh" id="addresslh"/>
 <span class="same"><label><input id="samett" type="checkbox">Gi???ng ?????a ch??? th?????ng tr??</label></span>
 </p>
<p>
<label for="txtProvine1">T???nh/Th??nh:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['province1']['value'];?>
<?php }?>" name="province1" id="province1"/> -->
<!--
<select id="province1" name="province1" onchange="ajaxprovince('#province1','#national1')">
<option value="" selected>Ch???n T???nh/Th??nh </option>
<?php echo $_smarty_tpl->getVariable('combotinh1')->value;?>

</select>
-->
<!-- </p>
<p><label for="national1">Qu???n/Huy???n:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['national1']['value'];?>
<?php }?>" name="national1" id="national1"/> -->
<!--
<select id="national1" name="national1">
<option value="" selected>Ch???n qu???n huy???n </option>
<?php echo $_smarty_tpl->getVariable('comboquan1')->value;?>

 </select>                   
-->
<!-- </p>

<p class="tag"><label for="doanvien">??o??n vi??n:</label>
<label class="co"><input type="radio" name="doanvien" value="1">C??</label>
<label class="co"><input type="radio" name="doanvien" value="2" checked="checked">Kh??ng</label>

<p class="tag"><label for="dangvien">?????ng vi??n:</label>
<label class="co"><input type="radio" name="dangvien" value="1">C??</label>
<label class="co"><input type="radio" name="dangvien" value="2" checked="checked">Kh??ng</label> -->

<!--
<p><label for="listbrother">Danh s??ch anh ch??? em:</label>
<textarea rows="10" cols="20" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['listbrother']['value'];?>
<?php }?>" name="listbrother" id="listbrother"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['listbrother']['value'];?>
<?php }?></textarea></p>
-->

<!-- <p><label for="contact_person">Ng?????i li??n h??? khi c???n:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['contact_person']['value'];?>
<?php }?>" name="contact_person" id="contact_person" /></p>

<p><label for="contact_relationship">Quan h???:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['contact_relationship']['value'];?>
<?php }?>" name="contact_relationship" id="contact_relationship" /></p>

<p><label for="contact_phone">S??? ??i???n tho???i:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['contact_phone']['value'];?>
<?php }?>" name="contact_phone" id="contact_phone" /></p>

<p><label for="honnhan">T??nh tr???ng h??n nh??n:</label>
<select class="honnhan"  name="honnhan" id="honnhan">
<option value="0">Ch???n T??nh tr???ng h??n nh??n</option>
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['honnhan']['value']==1){?>selected="selected"<?php }?>>Ch??a k???t h??n</option>
<option value="2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['honnhan']['value']==2){?>selected="selected"<?php }?>>???? k???t h??n</option>
<option value="3"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['honnhan']['value']==3){?>selected="selected"<?php }?>>???? ly h??n</option>
<option value="4"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['honnhan']['value']==4){?>selected="selected"<?php }?>>Ly th??n</option>
</select></p>

<p class="tag_vochong"><label for="vochong">H??? t??n v???/ch???ng:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['vochong']['value'];?>
<?php }?>" name="vochong" id="vochong"/></p>

<p><label for="vanhoa">Tr??nh ????? v??n h??a:</label>
<select class="vanhoa"  name="vanhoa" id="vanhoa">
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==0){?>selected="selected"<?php }?>>Ch???n Tr??nh ????? v??n h??a</option>
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==1){?>selected="selected"<?php }?>>9/12</option>
<option value="2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==2){?>selected="selected"<?php }?>>12/12</option>
<option value="3"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==3){?>selected="selected"<?php }?>>Trung c???p</option>
<option value="4"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==4){?>selected="selected"<?php }?>>Cao ?????ng</option>
<option value="5"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==5){?>selected="selected"<?php }?>>?????i h???c</option>
<option value="6"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==6){?>selected="selected"<?php }?>>Sau ?????i h???c</option>
<option value="7"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['vanhoa']['value']==7){?>selected="selected"<?php }?>>Kh??c</option>
</select></p>

<p class="tag_tdvh tag d-none"><label for="tdkhac">Tr??nh ????? kh??c:</label>
	<label class="co tag"><input type="radio" name="tdkhac" value="1">1/12</label> 
	<label class="co tag"><input type="radio" name="tdkhac" value="2">2/12</label>
	<label class="co tag"><input type="radio" name="tdkhac" value="3">3/12</label> 
	<label class="co tag"><input type="radio" name="tdkhac" value="4">4/12</label>
	<label class="co tag"><input type="radio" name="tdkhac" value="5">5/12</label> 
	<label class="co tag"><input type="radio" name="tdkhac" value="6">6/12</label>
	<label class="co tag"><input type="radio" name="tdkhac" value="7">7/12</label> 
	<label class="co tag"><input type="radio" name="tdkhac" value="8">8/12</label>
	<label class="co tag"><input type="radio" name="tdkhac" value="10">10/12</label>
	<label class="co tag"><input type="radio" name="tdkhac" value="11">11/12</label>
</p>

<p class="tag"><label for="bangcap">B???ng c???p:</label>
<label class="co"><input type="checkbox" name="cap1" value="C???p 1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['cap1']['value']=="C???p 1"){?>checked="checked"<?php }?>>C???p 1</label>
<label class="co"><input type="checkbox" name="cap2" value="C???p 2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['cap2']['value']=="C???p 2"){?>checked="checked"<?php }?>>C???p 2</label>
<label class="co"><input type="checkbox" name="cap3" value="C???p 3"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['cap3']['value']=="C???p 3"){?>checked="checked"<?php }?>>C???p 3</label>
<label class="co"><input type="checkbox" name="trungcap" value="Trung c???p"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['trungcap']['value']=="Trung c???p"){?>checked="checked"<?php }?>>Trung c???p</label>
<label class="co"><input type="checkbox" name="caodang" value="Cao ?????ng"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['caodang']['value']=="Cao ?????ng"){?>checked="checked"<?php }?>>Cao ?????ng</label>
<label class="co"><input type="checkbox" name="daihoc" value="?????i h???c"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['daihoc']['value']=="?????i h???c"){?>checked="checked"<?php }?>>?????i h???c</label>
<label class="co"><input type="checkbox" name="saudaihoc" value="Sau ?????i h???c"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['saudaihoc']['value']=="Sau ?????i h???c"){?>checked="checked"<?php }?>>Sau ?????i h???c</label>
<label class="co"><input type="checkbox" name="bckhac" value="B???ng c???p kh??c"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['bckhac']['value']=="B???ng c???p kh??c"){?>checked="checked"<?php }?>>B???ng c???p kh??c</label>
</p>

<p class="tag"><label for="chungchi">Ch???ng ch???:</label>
<label class="co"><input type="checkbox" name="CCNV" value="CCNV"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['CCNV']['value']=="CCNV"){?>checked="checked"<?php }?>>CCNV</label>
<label class="co"><input type="checkbox" name="PCCC" value="PCCC"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['PCCC']['value']=="PCCC"){?>checked="checked"<?php }?>>PCCC</label>
</p>

<p class="tag"><label for="ngoaingu">Ngo???i ng???:</label>
<label class="co"><input type="checkbox" name="anh" value="Anh"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['anh']['value']=="Anh"){?>checked="checked"<?php }?>>Anh</label>
<label class="co"><input type="checkbox" name="phap" value="Ph??p"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['phap']['value']=="Ph??p"){?>checked="checked"<?php }?>>Ph??p</label>
<label class="co"><input type="checkbox" name="duc" value="?????c"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['duc']['value']=="?????c"){?>checked="checked"<?php }?>>?????c</label>
<label class="co"><input type="checkbox" name="hoa" value="Hoa"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['hoa']['value']=="Hoa"){?>checked="checked"<?php }?>>Hoa</label>
<label class="co"><input type="checkbox" name="nhat" value="Nh???t"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['nhat']['value']=="Nh???t"){?>checked="checked"<?php }?>>Nh???t</label>
<label class="co"><input type="checkbox" name="han" value="H??n"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['han']['value']=="H??n"){?>checked="checked"<?php }?>>H??n</label>
<label class="co"><input type="checkbox" name="nga" value="Nga"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['nga']['value']=="Nga"){?>checked="checked"<?php }?>>Nga</label>
</p>

<p><label for="title">Ng??y v??o l??m: </label>
<input placeholder="ch???n ng??y" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['date_join']['value'];?>
<?php }?>" style="width: 85px; text-align: center;" type="text" name="date_join" id="date_join" class="date"/></p>

<p><label for="title">Ng??y ngh??? vi???c: </label>
<input placeholder="ch???n ng??y" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['date_leave']['value'];?>
<?php }?>" style="width: 85px; text-align: center;" type="text" name="date_leave" id="date_leave" class="date"/></p> -->

<p><label for="user_group"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('user_group');?>
:</label>
<select class="small"  name="user_group" id="user_group">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_group']['value']==1){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('employment');?>
</option>
<option value="2"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_group']['value']==2){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('managerment');?>
</option>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()||$_smarty_tpl->getVariable('authUser')->value->getType()==7){?><option value="7"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_group']['value']==7){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('superadmin');?>
</option><?php }?>
<option value="5"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_group']['value']==5){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('member');?>
</option>
<option value="6"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_group']['value']==6){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('khach');?>
</option>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><option value="3"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['user_group']['value']==3){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('founder');?>
</option><?php }?>
</select></p>
<!-- <p><label for="muctieu">M???c ti??u:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['muctieu']['value'];?>
<?php }?>" name="muctieu" id="muctieu" class="medium" autocomplete="false" /><i>*Search ??t nh???t 3 k?? t???</i></p>
<input type="hidden" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['id_target']['value'];?>
<?php }?>" name="id_target" id="id_target" class="medium"/>
<div id="result-mt"></div>

<p><label for="kinhnghiem">Kinh nghi???m:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['kinhnghiem']['value'];?>
<?php }?>" name="kinhnghiem" id="kinhnghiem" /></p>

<p><label for="gioithieu">Ng?????i gi???i thi???u:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['gioithieu']['value'];?>
<?php }?>" name="gioithieu" id="gioithieu" class="medium" autocomplete="false" /><i>*Search ??t nh???t 3 k?? t???</i></p>
<input type="hidden" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['id_angt']['value'];?>
<?php }?>" name="id_angt" id="id_angt" class="medium"/>
<div id="result-box"></div>

<p><label for="STK">S??? t??i kho???n:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['STK']['value'];?>
<?php }?>" name="STK" id="STK" /></p> -->

<!--
<p><label for="chutk">Ch??? t??i kho???n:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['chutk']['value'];?>
<?php }?>" name="chutk" id="chutk" /></p>
-->

<!-- <p><label for="name_nh">T??n ng??n h??ng:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['name_nh']['value'];?>
<?php }?>" name="name_nh" id="name_nh" /></p> -->

<!--
<p><label for="chinhanh">T??n chi nh??nh:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['chinhanh']['value'];?>
<?php }?>" name="chinhanh" id="chinhanh" /></p>
-->

<!-- <p class="tag"><label for="hoso">Th??ng tin h??? s??:</label>
<label class="co"><input type="checkbox" name="syll" value="S?? y???u l?? l???ch"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['syll']['value']=="S?? y???u l?? l???ch"){?>checked="checked"<?php }?>>S?? y???u l?? l???ch</label>
<label class="co"><input type="checkbox" name="gksk" value="Gi???y kh??m s???c kh???e"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['gksk']['value']=="Gi???y kh??m s???c kh???e"){?>checked="checked"<?php }?>>Gi???y kh??m s???c kh???e</label>
<label class="co"><input type="checkbox" name="dxv" value="????n xin vi???c"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['dxv']['value']=="????n xin vi???c"){?>checked="checked"<?php }?>>????n xin vi???c</label>
<label class="co"><input type="checkbox" name="hk" value="H??? kh???u"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['hk']['value']=="H??? kh???u"){?>checked="checked"<?php }?>>H??? kh???u</label>
<label class="co"><input type="checkbox" name="bc" value="B???ng c???p"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['bc']['value']=="B???ng c???p"){?>checked="checked"<?php }?>>B???ng c???p</label>
<label class="co"><input type="checkbox" name="xnhk" value="X??c nh???n h???nh ki???m"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['xnhk']['value']=="X??c nh???n h???nh ki???m"){?>checked="checked"<?php }?>>X??c nh???n h???nh ki???m</label>
<label class="co"><input type="checkbox" name="chungminh" value="CMND"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['chungminh']['value']=="CMND"){?>checked="checked"<?php }?>>CMND</label>
<label class="co"><input type="checkbox" name="knbv" value="Kinh nghi???m b???o v???"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['knbv']['value']=="Kinh nghi???m b???o v???"){?>checked="checked"<?php }?>>Kinh nghi???m b???o v???</label>
</p>

<p class="tag"><label for="quannhan">C???u qu??n nh??n:</label>
<label class="co"><input type="radio" name="quannhan" value="1">C??</label>
<label class="co"><input type="radio" name="quannhan" value="2" checked="checked">Kh??ng</label>

<p class="tag"><label for="baohiem">B???o hi???m:</label>
<label class="co"><input type="radio" name="baohiem" value="1">C??</label>
<label class="co"><input type="radio" name="baohiem" value="2" checked="checked">Kh??ng</label>
<div class="tag_BH">
	<p>
	<label for="BHYT">M???c chi tr??? BHYT (%):</label>
	<input value="<?php echo $_smarty_tpl->getVariable('BHYT')->value;?>
" type="text" name="BHYT" id="BHYT" />
  </p>
  <p>	
	<label for="BHXH">M???c chi tr??? BHXH (%):</label>
	<input value="<?php echo $_smarty_tpl->getVariable('BHXH')->value;?>
" type="text" name="BHXH" id="BHXH" />
  </p>
  <p>
	<label for="BHTN">M???c chi tr??? BHTN (%):</label>
	<input value="<?php echo $_smarty_tpl->getVariable('BHTN')->value;?>
" type="text" name="BHTN" id="BHTN" />
  </p>
</div>

<p class="tag"><label for="baohiem">L????ng t??nh b???o hi???m:</label>
<label class="co cc_ltt"><input type="radio" name="luong_baohiem" value="1" checked="checked">L????ng th???c t???</label>
<label class="co cc_lcd"><input type="radio" name="luong_baohiem" value="2">L????ng c??? ?????nh</label>
<div class="tag_LCD">
	<p class="lcd">
	<label for="lcd">L????ng c??? ?????nh:</label>
	<input type="text"  value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['luongcd']['value'];?>
<?php }?>" name="luongcd" id="luongcd"/>
	<p>
</div>

<p class="tag"><label for="TNCN">Thu??? thu nh???p c?? nh??n:</label>
<label class="co"><input type="radio" name="TNCN" value="1">C??</label>
<label class="co"><input type="radio" name="TNCN" value="2" checked="checked">Kh??ng</label>

<p class="tag"><label for="thueTNCN">L????ng t??nh thu??? thu nh???p c?? nh??n:</label>
<label class="co cc_thuett"><input type="radio" name="thueTNCN" value="1" checked="checked">L????ng th???c t???</label>
<label class="co cc_thuecd"><input type="radio" name="thueTNCN" value="2">L????ng c??? ?????nh</label>
<div class="tag_TLCD">
	<p class="lcd">
	<label for="lcd">L????ng c??? ?????nh:</label>
	<input value="<?php echo @S_SALARY;?>
" type="text" name="luongthuecd" id="luongthuecd" />
	<p>
	<p class="tag"><label for="thueTNCN">Ng?????i ????ng thu???:</label>
	<label class="co tag"><input type="radio" name="nguoidongthue" value="1">Doanh nghi???p</label>
	<label class="co tag"><input type="radio" name="nguoidongthue" value="2" checked="checked">Ng?????i lao ?????ng</label>
  </p>
</div>

<p><label for="tomtat">T??m t???t b???n th??n:</label>
<textarea rows="50" cols="50" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['tomtat']['value'];?>
<?php }?>" name="tomtat" id="tomtat"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['tomtat']['value'];?>
<?php }?></textarea></p>

<p><label for="thigiac">Th??? gi??c:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['thigiac']['value'];?>
<?php }?>" name="thigiac" id="thigiac" /></p>

<p><label for="lamviec">L???ch s??? l??m vi???c:</label>
<textarea rows="10" cols="20" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['lamviec']['value'];?>
<?php }?>" name="lamviec" id="lamviec"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['lamviec']['value'];?>
<?php }?></textarea></p>

<p><label for="tiensu">Ti???n s??? b???nh t???t:</label>
<textarea rows="10" cols="20" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['tiensu']['value'];?>
<?php }?>" name="tiensu" id="tiensu"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['tiensu']['value'];?>
<?php }?></textarea></p>

<p><label for="files">H??nh ???nh ????nh k??m:</label><input type="file" multiple name="files[]" id="files[]" /></p> -->
<!-- Button -->

<p class="btn">
<input type="hidden" name="order[view]" value="1" id="order[view]" />
<input type="hidden" name="order[add]" value="1" id="order[add]" />
<input type="hidden" name="order[edit]" value="1" id="order[edit]" />
<input type="hidden" name="order[delete]" value="1" id="order[delete]" />
<input type="hidden" name="order[clean]" value="1" id="order[clean]" />

<input type="hidden" name="customer[view]" value="1" id="customer[view]" />
<input type="hidden" name="customer[add]" value="1" id="customer[add]" />
<input type="hidden" name="customer[edit]" value="1" id="customer[edit]" />
<input type="hidden" name="customer[delete]" value="1" id="customer[delete]" />
<input type="hidden" name="customer[clean]" value="1" id="customer[clean]" />

<input type="hidden" name="groups[view]" value="1" id="groups[view]" />
<input type="hidden" name="groups[add]" value="1" id="groups[add]" />
<input type="hidden" name="groups[edit]" value="1" id="groups[edit]" />
<input type="hidden" name="groups[delete]" value="1" id="groups[delete]" />
<input type="hidden" name="groups[clean]" value="1" id="groups[clean]" />

<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="staff" />
<input type="hidden" name="mod" value="add" />
<input type="hidden" name="doo" value="submit" />
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
<input type="button" onclick="javascript:formSubmit('formAdd','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>
</div>