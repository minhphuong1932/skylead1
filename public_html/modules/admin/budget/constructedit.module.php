<?php
/*************************************************************************
Editing construct module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 09/05/2012
**************************************************************************/
checkPermission();
$templateFile = 'managematerialconstruct.tpl.html';
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/constructs.class.php');
$constructs = new Constructs($storeId);
$fields = new Fields($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=managematerial&act=construct',
				$amessages['constructs'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial&act=construct';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['edit_constructs'] => '#',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$productInfo = $constructs->getObject($id);
if(!$productInfo) {
	$template->assign('validItem',0);
} else {
	$template->assign('validItem',1);
	# Allow some javascript
	$template->assign('ckEditor',0);

	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$productInfo = $constructs->getObject($id);
			$template->assign('itemInfo',$productInfo);
		} else { # Valid data input
			# check duplicate category name
			//if($estore->getProperty('check_duplicate_product_name')) {
				if($constructs->checkDuplicate($request->element('name'),'name',"`id` <> '$id'")) {
					$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
					$validate['INPUT']['name']['error'] = 1;
					$validate['invalid'] = 1;
					$template->assign('error',$validate);
				}
			//}
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$productInfo = $constructs->getObject($id);
				if($productInfo) {			
					$data = array('store_id' => $storeId,
								  'user_id' => $userInfo->getId(),
						  		  'slug' => $slug,
								  'name' => Filter($request->element('name')),
								  'status' => $request->element('status'),
								  );
					$constructs->updateData($data,$id);
					
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_construct'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
					# Redirect to editing page
					header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=construct&mod=edit&lang=$lang&id=$id&rcode=7");
				}
			}
		}
	} else { # Load product information to edit
			$template->assign('item',$productInfo);
			
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	if($error['INPUT']['name']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>