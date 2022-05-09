<?php
/*************************************************************************
Adding product category module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 10/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
//checkPermission();
$userInfo->checkPermission('budgetcategory','add');
$templateFile = 'budgetcategory.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$budgetCategories = new BudgetCategories($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['budget_category'] => '/'.ADMIN_SCRIPT.'?op=budget&act=category',
				$amessages['add_new'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget&act=category';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# Category combo box
$categoryCombo = $budgetCategories->generateCombo($request->element('pId'));
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

# Allow some javascript
$template->assign('ckEditor',1);
	
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate category name
		if($budgetCategories->checkDuplicate($request->element('name'))) {
			$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
			$validate['INPUT']['name']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		
		# Check if duplicate slug
		$slug = TextFilter::urlize($request->element('name'),false,'-');
		$i = 0;
		$dup = 1;
		while($dup) {
			$dup = $budgetCategories->checkDuplicate($slug.($i?'-'.$i:''),'slug');
			if($dup) $i++;
		}
		$slug .= $i?'-'.$i:'';
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			$data = array('store_id' => $storeId,
						  'parent_id' => $request->element('parent_id'),
						  'user_id' => $userInfo->getId(),
						  'slug' => $slug,
						  'name' => Filter($request->element('name')),
						  'position' => $request->element('position'),
						  'status' => $request->element('status'),
						  'properties' => serialize($properties));
			$budgetCategories->addData($data);
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_budget_category'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=category&mod=list&pId=".$request->element('parent_id')."&rcode=6");
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
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	
	if($error['INPUT']['name']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>