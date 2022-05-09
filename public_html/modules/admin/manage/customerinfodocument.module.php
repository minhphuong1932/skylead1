<?php
/*************************************************************************
Editing article module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
$userInfo->checkPermission('customer','infodocument');
$templateFile = 'managecustomer.tpl.html';
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/documenttypes.class.php');
include_once(ROOT_PATH.'classes/dao/documents.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/chats.class.php');
include_once(ROOT_PATH.'classes/dao/documenttrackings.class.php');
$documenttrackings = new DocumentTrackings($storeId);
$customers = new Customers($storeId);
$chats = new Chats();
$template->assign('customers',$customers);
$documents = new Documents($storeId);
$documentTypes = new DocumentType();
$template->assign('documentTypes',$documentTypes);
$customerId = $request->element('cid');
$customerId2 = $request->element('customerId');
$template->assign('customerId',$customerId);
if($customerId2){
	$customerId=$customerId2;
}
$id = $request->element('id');
$users = new Users($storeId);
$template->assign('users',$users);
$fields = new Fields($storeId);
$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."articles/";
$documentInfo2 = $documents->getObject($id);
$chatList = $chats->getObjects(1,"`document_id` = '$id'",array('date_created' => 'DESC'),80);
	if($chatList) {
		$template->assign('chatList',$chatList);
	}
if($_SESSION['userId']){
	$userIdC = $users->getObject($_SESSION['userId']);
}
$ListCustomerFromUser=$customers->getAllCustomerFromUserid($_SESSION['userId']);
	$arr_ListCusFromUser=explode(',',$ListCustomerFromUser);
	array_splice($arr_ListCusFromUser,count($arr_ListCusFromUser)-1,1);
	$ListCustomerFromUser=implode(',',$arr_ListCusFromUser);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_original_data'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_customer'] => '/'.ADMIN_SCRIPT.'?op=manage&act=customer',
				$amessages['view_document'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=customer';
if($userIdC->getType()==0 || $userIdC->getType()==2){
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=show&id='.$customerId,
				$amessages['view_document'] => '');
}else{
	if($userIdC->getType()==3  || $userIdC->getType()==4){
		if($documentInfo2->getStatus()!=1){
		$listTabs = array($amessages['list_item'] => $tabLink.'&mod=show&id='.$customerId,
					$amessages['view_document'] => '',
					$amessages['edit_document'] => $tabLink.'&mod=editdocument&id='.$id.'&cid='.$customerId);
		}else{
			$listTabs = array($amessages['list_item'] => $tabLink.'&mod=show&id='.$customerId,
					$amessages['view_document'] => '');
		}
	}else{
		if($documentInfo2->getStatus()!=2 && $documentInfo2->getStatus()!=4){
		$listTabs = array($amessages['list_item'] => $tabLink.'&mod=show&id='.$customerId,
					$amessages['view_document'] => '',
					$amessages['edit_document'] => $tabLink.'&mod=editdocument&id='.$id.'&cid='.$customerId);
		}else{
			$listTabs = array($amessages['list_item'] => $tabLink.'&mod=show&id='.$customerId,
					$amessages['view_document'] => '');
		}
	}
}
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$userList = $users->getObjects(1,"`status`='1' AND `type`> '0'");
	if($userList) {
		$template->assign('userList',$userList);
	}
$documentTypeList= $documentTypes->getObjects(1,"`status` IN (1,3,4)");
if($documentTypeList) {
		$template->assign('documentTypeList',$documentTypeList);
	}
$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0'");
if($customerList) {
		$template->assign('customerList',$customerList);
	}
$result_code = $request->element('rcode'); 
if($result_code) $template->assign('result_code',$result_code);

$cid = $request->element('cid');
if($id) $template->assign('id',$id);
$documentInfo = $documents->getObject($id);
$sort_key = $request->element('sk')?$request->element('sk'):'id';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$sortlog = array($sort_key => $sort_direction);
$documenttrackingslist= $documenttrackings->getObjects(1,"`document_id`='$id'",$sortlog);
if($documenttrackingslist) {
$template->assign('documenttrackingslist',$documenttrackingslist);
}
if(!$documentInfo) {
	$template->assign('validItem',0);
} else {
	$template->assign('validItem',1);
	if($request->element('doo') == 'delFile') {
		$documentInfo = $documents->getObject($id);
		$properties = $documentInfo->getProperties();
		foreach($properties['files'] as $key => $value) {
			if($value == $request->element('file')) {
				unlink($gallery_path.$properties['files'][$key]);
				unset($properties['files'][$key]);
				$data = array('properties' => serialize($properties));
				$documents->updateData($data,$id);
				$documentInfo = $documents->getObject($id);
				break;
			}
		}
	}
	if($request->element('doo') == 'delPhoto') {
		$documentInfo = $documents->getObject($id);
		$properties = $documentInfo->getProperties();
		foreach($properties['photos'] as $key => $value) {
			if($value == $request->element('photo')) {
				unlink($gallery_path."l_".$properties['photos'][$key]);
				unlink($gallery_path."a_".$properties['photos'][$key]);
				unset($properties['photos'][$key]);
				$data = array('properties' => serialize($properties));
				$documents->updateData($data,$id);
				$documentInfo = $documents->getObject($id);
				break;
			}
		}
	}
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Get list of custom fields
		#$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='manage'");
		#if($fieldList) $template->assign('fieldList',$fieldList);
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
		$documentInfo = $documents->getObject($id);
		$template->assign('documentInfo',$documentInfo);
	} else { 
		
		# Everything is ok. Update data to DB
		if(!$validate['invalid']) {
			$documentInfo = $documents->getObject($id);
			if($documentInfo) {			
				$properties = $documentInfo->getProperties();
				if(!file_exists($gallery_root)) mkdir("$gallery_root");
				if(!file_exists($gallery_path)) mkdir("$gallery_path");
				$files = isset($_FILES['files'])?$_FILES['files']:'';
					if($files) {
						if(!isset($properties['photos'])) $properties['photos'] = array();
						if(!isset($properties['videos'])) $properties['videos'] = array();
						if(!isset($properties['files'])) $properties['files'] = array();
						for($i=0; $i<count($files['name']);$i++) {
							$img = addslashes(Filter(rand()."_".$files['name'][$i]));
							$tmp_img = $files['tmp_name'][$i];
							$size = $files['size'][$i];
							$type=strtolower(substr($img,-3));
							if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
								# Upload
								if(isImage($img)) {
									$new_img = $img;
									move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
									if(isBmp($img)) {
										$new_img = preg_replace("/(bmp$)/","jpg",$img);
										resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
									}
									resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);									
									if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
									$properties['photos'][] = $new_img;
								} elseif(isVideo($img)) {
									move_uploaded_file($tmp_img,$gallery_path.$img);
									$properties['videos'][] = $img;
								} else {
									move_uploaded_file($tmp_img,$gallery_path.$img);
									$properties['files'][] = $img;
								}
							} #/if (preg_match
						} #/for($i=0;
					}
			
				
				#User update
				
				
				# Custom fields
					#foreach($fieldList as $field) {
					#	$properties[$field->getName()] = $request->element($field->getName());
					#
			   $data = array('store_id' => $storeId,
			   			  'name' => Filter($request->element('document_name')),
						  'customer_id' => $customerId,
						  'document_type_id' => $request->element('document_type_id'),
						  'financial_year' => $request->element('financial_year'),
						  'keywords' => Filter($request->element('keywords')),
						  'properties' =>  serialize($properties),
						  'status' => $request->element('status'),
						  'date_created' => date("Y-m-d H:i:s"),
						  'last_updated' => date("Y-m-d H:i:s"),
						  'date_processed' => $request->element('date_processed'),
						  'user_processed' => $request->element('user_processed'),
						  'date_approved' => $request->element('date_approved'),
						  'user_approved' => $request->element('user_approved'));
				$documents->updateData($data,$id);
				
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document'],$request->element('id')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document'],$request->element('document_name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			//var_dump($id);
				# Redirect to editing page
				header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=customer&mod=editdocument&id=$id&cid=$customerId&lang=$lang&rcode=7");
			}
		}
	}
}elseif($_POST && $request->element('doo') == 'submitchat') {
	 $datachat = array('document_id' => $request->element('id'),
	 				'user_id' => $_SESSION['userId'],
	 				'message' => Filter($request->element('message')),
					'properties' =>  '',
					'date_created' =>date("Y-m-d H:i:s"));
	$chats->addData($datachat);
	$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document'],$request->element('id')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
	
	header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=customer&mod=infodocument&id=$id&cid=$customerId&lang=$lang&rcode=7");
}else { # Load customer information to edit
	if($userIdC->getType()==1){
		$allowList=$documents->getObjects(1,"`status` IN ('',2,4,5) AND `customer_id` IN ($ListCustomerFromUser)");
		$arr_list1=array();
		foreach($allowList as $key => $value) {
			array_push($arr_list1,$value->getId());
		}
		//$listAllow=implode(',',$arr_list1);
		if(in_array($id,$arr_list1)){
			$documentInfo = $documents->getObject($id);
			if($documentInfo) {$template->assign('item',$documentInfo);}
		}else{
			header('location:'.'/'.ADMIN_SCRIPT."?op=dashboard");
		}

	}elseif($userIdC->getType()==2){
		$allowList=$documents->getObjects(1,"`status` IN (4,3)");
		$arr_list1=array();
		foreach($allowList as $key => $value) {
			array_push($arr_list1,$value->getId());
		}
		//$listAllow=implode(',',$arr_list1);
		if(in_array($id,$arr_list1)){
			$documentInfo = $documents->getObject($id);
			if($documentInfo) {$template->assign('item',$documentInfo);}
		}else{
			header('location:'.'/'.ADMIN_SCRIPT."?op=dashboard");
		}
	}else{
		// $allowList=$documents->getObjects(1,"`status` IN ('',0,1,2,3,4,5)");
		// $arr_list1=array();
		// foreach($allowList as $key => $value) {
		// 	array_push($arr_list1,$value->getId());
		// }
		// if(in_array($id,$arr_list1)){
		// 	$documentInfo = $documents->getObject($id);
		// 	if($documentInfo) {$template->assign('item',$documentInfo);}
		// }else{
		// 	header('location:'.'/'.ADMIN_SCRIPT."?op=dashboard");
		// }
			$documentInfo = $documents->getObject($id);
		 	if($documentInfo) {$template->assign('item',$documentInfo);}
	}
}
# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='manage'");
		if($fieldList) $template->assign('fieldList',$fieldList);
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['name'] = $validate->validString($request->element('document_name'),$amessages['name']);
	
	$error['INPUT']['document_type_id'] = $validate->validString($request->element('document_type_id'),$amessages['document_type_id']);
	$error['INPUT']['financial_year'] = $validate->validString($request->element('financial_year'),$amessages['financial_year']);
	$error['INPUT']['keywords'] = $validate->validString($request->element('keywords'),$amessages['keywords']);
	
	
	# Paste value of custom fields
	global $fieldList;
	// foreach($fieldList as $field) {
	// 	$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
	// 	if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
	// 		$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
	// 	}
	// }
	
	if($error['INPUT']['name']['error'] || $error['INPUT']['document_type_id']['error'] || $error['INPUT']['financial_year']['error'] || $error['INPUT']['keywords']['error'] ){
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>