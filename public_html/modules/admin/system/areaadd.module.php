<?php
/*************************************************************************
Adding article category module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 07/05/2012
**************************************************************************/
$templateFile = 'managearticle.tpl.html';
include_once(ROOT_PATH.'classes/dao/areas.class.php');
include_once(ROOT_PATH.'classes/dao/shippingmethods.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$areas = new Areas($storeId);
$shippingMethods = new ShippingMethods($storeId);

$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['system'] => '/'.ADMIN_SCRIPT.'?op=system',
				$amessages['manage_area'] => '/'.ADMIN_SCRIPT.'?op=system&act=area',
				$amessages['add_area'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=system&act=area';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# Category combo box
$categoryCombo = $areas->generateCombo($request->element('pId'));
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

# Shipping combo box
$shippingCombo = $shippingMethods->generateCombo($request->element('ship_id'));
if($shippingCombo) $template->assign('shippingCombo',$shippingCombo);

# Allow some javascript
$template->assign('ckEditor',0);
	
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate category name
		if($areas->checkDuplicate($request->element('name'))) {
			$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
			$validate['INPUT']['name']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$data = array('store_id' => $storeId,
						  'ship_id' => Filter($request->element('ship_id')),
						  'aid' => Filter($request->element('parent_id')),
						  'name' => Filter($request->element('name')),
						  'time' => Filter($request->element('time')),
						  'price' => Filter($request->element('price')),
						  'position' => Filter($request->element('position')),
						  'status' => Filter($request->element('status')));
			$areas->addData($data);
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_area'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=system&act=area&mod=list&pId=".$request->element('parent_id')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['parent_id'] = $validate->pasteString($request->element('parent_id'));
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['ship_id'] = $validate->pasteString($request->element('ship_id'));
	$error['INPUT']['time'] = $validate->pasteString($request->element('time'));
	$error['INPUT']['price'] = $validate->pasteString($request->element('price'));
	$error['INPUT']['position'] = $validate->pasteString($request->element('position'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	if($error['INPUT']['name']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>