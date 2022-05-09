<?php
/*************************************************************************
Editing article module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
$userInfo->checkPermission('customer','info');
$templateFile = 'managecustomer.tpl.html';
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/groups.class.php');
$groups = new Groups();
$template->assign('groups',$groups);
$customers = new Customers($storeId);
$users = new Users($storeId);
$fields = new Fields($storeId);
$customerId = $request->element('id');
$customerId2 = $request->element('customerId');
$template->assign('customerId',$customerId);
$template->assign('users',$users);
if($customerId2){
	$customerId=$customerId2;
}
if($_SESSION['userId']){
	$userIdC = $users->getObject($_SESSION['userId']);
}
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_original_data'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_customer'] => '/'.ADMIN_SCRIPT.'?op=manage&act=customer',
				$amessages['view_info'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=customer';
if($userIdC->getType()==0 || $userIdC->getType()==2){
$listTabs = array($amessages['document_list'] => $tabLink.'&mod=show&id='.$customerId,
				$amessages['view_info'] => $tabLink.'&mod=info&id='.$customerId);
}elseif($userIdC->getType()==3  || $userIdC->getType()==4){
$listTabs = array($amessages['document_list'] => $tabLink.'&mod=show&id='.$customerId,
				$amessages['view_info'] => $tabLink.'&mod=info&id='.$customerId,
				$amessages['add_new_document'] => $tabLink.'&mod=adddocument&cid='.$customerId,
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrashdocument&cid='.$customerId);	
}else{
	$listTabs = array($amessages['document_list'] => $tabLink.'&mod=show&id='.$customerId,
				$amessages['view_info'] => $tabLink.'&mod=info&id='.$customerId,
				$amessages['add_new_document'] => $tabLink.'&mod=adddocument&cid='.$customerId);
}
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$userList = $users->getObjects(1,"`status`='1' AND `type`> '0'");
	if($userList) {
		$template->assign('userList',$userList);
		
	}
$result_code = $request->element('rcode'); 
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$customerInfo = $customers->getObject($id);
if(!$customerInfo) {
	$template->assign('validItem',0);
} else {
	$template->assign('validItem',1);
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='customer'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
		
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
		$customerInfo = $customers->getObject($id);
		$template->assign('customerInfo',$customerInfo);
	} else { 
		if($request->element('password')) {
				$new_password = md5($request->element('password'));
				$confirm_password = md5($request->element('confirm_password'));
				if($new_password != $confirm_password) { # New password is same as confirm password
					$validate['INPUT']['confirm_password']['message'] = $amessages['invalid_confirm_password'];
					$validate['INPUT']['confirm_password']['error'] = 1;
					$validate['invalid'] = 1;
					$template->assign('error',$validate);
				}
			}		
			# check duplicate email
			if($customers->checkDuplicate($request->element('email'),'email',"`id` <>'$id'")) {
				$validate['INPUT']['email']['message'] = $amessages['email_duplicated'];
				$validate['INPUT']['email']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		# Everything is ok. Update data to DB
		if(!$validate['invalid']) {
			$customerInfo = $customers->getObject($id);
			if($customerInfo) {			
				#User update
				$properties = $customerInfo->getProperties();
				$properties['tinh'] = Filter($request->element('tinh'));
				# Custom fields
					foreach($fieldList as $field) {
						$properties[$field->getName()] = $request->element($field->getName());
					}
			   $data = array('store_id' => $storeId,
			   			  'fullname' => Filter($request->element('fullname')),
			   			  'position' => Filter($request->element('position')),
						  'company_name' => Filter($request->element('company_name')),
						  'tax_code' => Filter($request->element('tax_code')),
						  'address' => Filter($request->element('address')),
						  'tel' => Filter($request->element('tel')),
						  'fax' => Filter($request->element('fax')),
						  'email' => Filter($request->element('email')),
						  'group_id' => $request->element('customer_group'),
						  'details' =>  Filter($request->element('staff')),
						  'properties' =>  serialize($properties),
						  'date_updated' => date("Y-m-d H:i:s"),
						  'status' => $request->element('status'));
			   if($request->element('password')) $data['password'] = md5($request->element('password'));
			
				$customers->updateData($data,$id);
				
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_customer'],$request->element('username')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			
				# Redirect to editing page
				header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=customer&mod=edit&lang=$lang&id=$id&rcode=7");
			}
		}
	}
} else { # Load customer information to edit
	$customerInfo = $customers->getObject($id);
	if($customerInfo) {
		$template->assign('item',$customerInfo);
	}
}
# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='customer'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['username'] = $validate->pasteString($request->element('username'));
	$error['INPUT']['fullname'] = $validate->validString($request->element('fullname'));
	if($request->element('password')) $error['INPUT']['password'] = $validate->validPassword($request->element('password'));
	else $error['INPUT']['password'] = $validate->pasteString($request->element('password'));
	if($request->element('confirm_password')) $error['INPUT']['confirm_password'] = $validate->validPassword($request->element('confirm_password'),$amessages['confirm_password']);
	else $error['INPUT']['confirm_password'] = $validate->pasteString($request->element('confirm_password'));
	$error['INPUT']['address'] = $validate->validString($request->element('address'));
	$error['INPUT']['email'] = $validate->validEmail($request->element('email'));
	$error['INPUT']['tel'] = $validate->validString($request->element('tel'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	
	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}
	
	if($error['INPUT']['username']['error'] || $error['INPUT']['fullname']['error'] || $error['INPUT']['password']['error'] || $error['INPUT']['address']['error'] || $error['INPUT']['tel']['error']  || $error['INPUT']['email']['error'] ){
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>