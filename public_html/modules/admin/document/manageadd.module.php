<?php
/*************************************************************************
Adding customer module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
$userInfo->checkPermission('document','add');
$templateFile = 'documentmanage.tpl.html';
include_once(ROOT_PATH.'classes/dao/documents.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/documenttypes.class.php');
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/documenttrackings.class.php');
$documenttrackings = new DocumentTrackings($storeId);
$documents = new Documents($storeId);
$customers = new Customers($storeId);
$template->assign('customers',$customers);
$documentTypes = new DocumentType();
$users = new Users($storeId);
$fields = new Fields($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_document'] => '/'.ADMIN_SCRIPT.'?op=document',
				$amessages['add_new'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=document&act=manage';
if($_SESSION['userId']){
	$userIdC = $users->getObject($_SESSION['userId']);
	$currentStaffType=$userIdC->getType();
	$currentStaffId=$userIdC->getId();
	$ListCustomerFromUser=$customers->getAllCustomerFromUserid($currentStaffId);
	$arr_ListCusFromUser=explode(',',$ListCustomerFromUser);
			array_splice($arr_ListCusFromUser,count($arr_ListCusFromUser)-1,1);
			$ListCustomerFromUser=implode(',',$arr_ListCusFromUser);
			
}
if($userIdC->getType()==3 || $userIdC->getType()==4){
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => '',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');
}else{
	$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => '');
}
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
if($request->element('document_type_id') != ""){
		$_SESSION['docutypeid']= $request->element('document_type_id');
}
if(isset($_SESSION['docutypeid'])){
	$template->assign('docutypeid',$_SESSION['docutypeid']);
}
if($request->element('customer_id') != ""){
		$_SESSION['customid']= $request->element('customer_id');
}
if(isset($_SESSION['customid'])){
	$template->assign('customid',$_SESSION['customid']);
}

if($request->element('processed_from') != ""){
		$_SESSION['processfrom']= $request->element('processed_from');
}
if(isset($_SESSION['processfrom'])){
	$template->assign('processfrom',$_SESSION['processfrom']);
}
if($request->element('processed_to') != ""){
		$_SESSION['processto']= $request->element('processed_to');
}
if(isset($_SESSION['processto'])){
	$template->assign('processto',$_SESSION['processto']);
}
// ---
if($request->element('financial_year') != ""){
		$_SESSION['finanyear']= $request->element('financial_year');
}
if(isset($_SESSION['finanyear'])){
	$template->assign('finanyear',$_SESSION['finanyear']);
}
if($request->element('month_processed') != ""){
		$_SESSION['monpro']= $request->element('month_processed');
}
if(isset($_SESSION['monpro'])){
	$template->assign('monpro',$_SESSION['monpro']);
}
if($request->element('document_name') != ""){
		$_SESSION['docuname']= $request->element('document_name');
}
if(isset($_SESSION['docuname'])){
	$template->assign('docuname',$_SESSION['docuname']);
}
if($request->element('keywords') != ""){
		$_SESSION['keywod']= $request->element('keywords');
}
if(isset($_SESSION['keywod'])){
	$template->assign('keywod',$_SESSION['keywod']);
}
if($request->element('user_processed') != ""){
		$_SESSION['userproce']= $request->element('user_processed');
}
if(isset($_SESSION['userproce'])){
	$template->assign('userproce',$_SESSION['userproce']);
}

if($request->element('user_processed_temporary') != ""){
		$_SESSION['userprotem']= $request->element('user_processed_temporary');
}
if(isset($_SESSION['userprotem'])){
	$template->assign('userprotem',$_SESSION['userprotem']);
}
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$userList = $users->getObjects(1,"`status`='1' AND `type`> '0'");
	if($userList) {
		$template->assign('userList',$userList);
	}
	$userListProc = $users->getObjects(1,"`status`='1' AND `type`='2'");
	if($userListProc) {
		$template->assign('userListProc',$userListProc);
	}
$documentTypeList= $documentTypes->getObjects(1,"`status` IN (1,3,4)",array("id" => "ASC"),100);
if($documentTypeList) {
		$template->assign('documentTypeList',$documentTypeList);
	}
if($currentStaffType==1) {
	if($ListCustomerFromUser){
		$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0' AND `id` IN ($ListCustomerFromUser)");
	}else{
		$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0' AND `id`<'0'");
		$template->assign('customerNotExist','Chưa có khách hàng');
	}
}
if($currentStaffType==3 || $currentStaffType==4) {
$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0'");
}
if($customerList) {
		$template->assign('customerList',$customerList);
	}
# Get list of custom fields
$fieldList = $fields->getObjects(1,"`module`='document'");
if($fieldList) $template->assign('fieldList',$fieldList);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted

	# Validate the data input
	
	
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		
	} else { # Valid data input
			$properties = array('');
			
			$gallery_root = ROOT_PATH."upload/";
			$folder=$request->element('customer_id');
			$gallery_path = $gallery_root."$folder/";
			if(!file_exists($gallery_root)) mkdir("$gallery_root");
			if(!file_exists($gallery_path)) mkdir("$gallery_path");
		
			$files = isset($_FILES['files'])?$_FILES['files']:'';
			if($files) {
				if(!isset($properties['photos'])) $properties['photos'] = array();
				if(!isset($properties['videos'])) $properties['videos'] = array();
				if(!isset($properties['files'])) $properties['files'] = array();
				for($i=0; $i<count($files['name']);$i++) {
					$filesname = TextFilter::urlize2($files['name'][$i],false,'_');
					$img = addslashes(Filter(rand()."_".$filesname));
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
			$getdatefrom = $request->element('processed_from');
			$getdateto = $request->element('processed_to');
			$datefrom = date('Y-m-d', strtotime($getdatefrom));
			$dateto = date('Y-m-d', strtotime($getdateto));
			$properties['user_processed_temporary'] = $request->element('user_processed_temporary');
			$properties['processed_from'] = $datefrom;
			$properties['processed_to'] = $dateto;
			# Custom fields
			foreach($fieldList as $field) {
				$properties[$field->getName()] = $request->element($field->getName());
			}
			# End property
			
			$data = array('store_id' => $storeId,
						  'name' => Filter($request->element('document_name')),
						  'customer_id' => $request->element('customer_id'),
						  'document_type_id' => $request->element('document_type_id'),
						  'financial_year' => $request->element('financial_year'),
						  'month_processed' => $request->element('month_processed'),
						  'keywords' => Filter($request->element('keywords')),
						  'properties' =>  serialize($properties),
						  'status' => $request->element('status'),
						  'date_created' => date("Y-m-d H:i:s"),
						  'user_processed' => $request->element('user_processed'),
						  'user_processed_temporary' => $request->element('user_processed_temporary'),
						  'processed_from' => $datefrom,
						  'processed_to' => $dateto,
						  'last_updated' => date("Y-m-d H:i:s")
						  // 'date_processed' => $request->element('date_processed'),
						  // 'date_approved' => $request->element('date_approved'),
						  // 'user_processed' => $request->element('user_processed'),
						  // 'user_approved' => $request->element('user_approved')
						  );
			$newId = $documents->addData($data);
					
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_customer'],$request->element('document_name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$newId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document'],$request->element('document_name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=document&act=manage&mod=list&rcode=6");
		
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['name'] = $validate->validString($request->element('document_name'),$amessages['name']);
	$error['INPUT']['customer_id'] = $validate->validString($request->element('customer_id'),$amessages['customer_id']);
	$error['INPUT']['document_type_id'] = $validate->validString($request->element('document_type_id'),$amessages['document_type_id']);
	$error['INPUT']['financial_year'] = $validate->validString($request->element('financial_year'),$amessages['financial_year']);
	$error['INPUT']['keywords'] = $validate->validString($request->element('keywords'),$amessages['keywords']);
	// $error['INPUT']['date_processed'] = $validate->validString($request->element('date_processed'),$amessages['date_processed']);
	// $error['INPUT']['user_processed'] = $validate->validString($request->element('user_processed'),$amessages['user_processed']);
	// $error['INPUT']['date_approved'] = $validate->validString($request->element('date_approved'),$amessages['date_approved']);
	// $error['INPUT']['user_approved'] = $validate->validString($request->element('user_approved'),$amessages['user_approved']);
	$error['INPUT']['user_processed_temporary'] = $validate->pasteString($request->element('user_processed_temporary'));
	$error['INPUT']['processed_from'] = $validate->pasteString($request->element('processed_from'));
	$error['INPUT']['processed_to'] = $validate->pasteString($request->element('processed_to'));
	$error['INPUT']['month_processed'] = $validate->pasteString($request->element('month_processed'));
	$error['INPUT']['user_processed'] = $validate->pasteString($request->element('user_processed'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	
	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}
	
	if($error['INPUT']['name']['error'] || $error['INPUT']['document_type_id']['error'] || $error['INPUT']['financial_year']['error'] || $error['INPUT']['keywords']['error'] ){
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>