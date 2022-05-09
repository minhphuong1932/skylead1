<?php
/*************************************************************************
Editing staff module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 10/08/2011
**************************************************************************/

$userInfo->checkPermission('budgetcategory','edit');
$templateFile = 'budgetcategory.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$budgetCategories = new BudgetCategories($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['budget_category'] => '/'.ADMIN_SCRIPT.'?op=budget&act=category',
				$amessages['edit_budget_category'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=budget&act=category';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['edit_budget_category'] => '#',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$categoryInfo = $budgetCategories->getObject($id);
if(!$categoryInfo) {
	$template->assign('validItem',0);
} else {
	# Check user manage
	if($userInfo->isSiteStaff()){
		if($categoryInfo->getUserId() != $userId)	header("location: /index.php?op=accessdenied");
	}
	$template->assign('validItem',1);

	# Allow some javascript
	$template->assign('ckEditor',1);

	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
	
			# Category combo box
			$categoryCombo = $budgetCategories->generateCombo($request->element('parent_id',0));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
			#bottom Action Combo
			$userCombo = $users->generateCombo($categoryInfo->getUserId());
			if($userCombo) $template->assign('userCombo',$userCombo);
		} else { # Valid data input
			# Category combo box
			$categoryCombo = $budgetCategories->generateCombo($request->element('parent_id',0));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
			
			# check duplicate category name
			if($budgetCategories->checkDuplicate($request->element('name'),'name',"`id` <> '$id'")) {
				$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
				$validate['INPUT']['name']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
			
			# Check if duplicate slug
			$slug = TextFilter::urlize($request->element('slug'),false,'-');
			if($budgetCategories->checkDuplicate($slug,'slug',"`id` <> '$id'")) {
				$validate['INPUT']['slug']['message'] = $amessages['slug_duplicated'];
				$validate['INPUT']['slug']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
			
						
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$properties = array('');
				$data = array('store_id' => $storeId,
							  'user_id' => $request->element('user_id'),
							  'parent_id' => $request->element('parent_id'),
							  'slug' => $request->element('slug'),
							  'name' => Filter($request->element('name')),
							  'position' => $request->element('position'),
							  'status' => $request->element('status'),
							  'properties' => serialize($properties));
				$budgetCategories->updateData($data,$id);
				
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_budget_category'],$budgetCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				
				# Redirect to editing page
				header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=category&mod=edit&lang=$lang&id=$id&rcode=7");
			}
		}
	} else { # Load product category information to edit
			$template->assign('item',$categoryInfo);
	
			# Category combo box
			$categoryCombo = $budgetCategories->generateCombo($categoryInfo->getParentId());
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
			#bottom Action Combo
			$userCombo = $users->generateCombo($categoryInfo->getUserId());
			if($userCombo) $template->assign('userCombo',$userCombo);
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['parent_id'] = $validate->pasteString($request->element('parent_id'));
	$error['INPUT']['slug'] = $validate->validString($request->element('slug'),$amessages['slug']);
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	if($error['INPUT']['name']['error'] || $error['INPUT']['slug']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>