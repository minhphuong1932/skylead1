<?php
/*************************************************************************
Adding product weight module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 10/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
$userInfo->checkPermission('pro_cat','add');
$templateFile = 'manageproduct.tpl.html';
include_once(ROOT_PATH.'classes/dao/productweights.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$productWeights = new ProductWeights($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=manage&act=product',
				$amessages['add_product_weight'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=product';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['list_category'] => $tabLink.'&mod=listcategory',
				$amessages['add_product_category'] => $tabLink.'&mod=addcategory',
				$amessages['list_weight'] => $tabLink.'&mod=listweight',
				$amessages['add_product_weight'] => $tabLink.'&mod=addweight',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',5);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate category name
		if($productWeights->checkDuplicate($request->element('name'))) {
			$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
			$validate['INPUT']['name']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			$data = array('store_id' => $storeId,
						  'name' => Filter($request->element('name')),
						  'position' => $request->element('position'),
						  'status' => $request->element('status'),
						  'properties' => serialize($properties));
			$productWeights->addData($data);
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_product_weight'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=product&mod=listweight&pId=".$request->element('parent_id')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
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