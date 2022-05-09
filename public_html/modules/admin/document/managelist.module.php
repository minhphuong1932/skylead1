<?php
/*************************************************************************
Document listing module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
$userInfo->checkPermission('document','view');

$templateFile = 'documentmanage.tpl.html';
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/documenttypes.class.php');
include_once(ROOT_PATH.'classes/dao/documents.class.php');
include_once(ROOT_PATH.'classes/dao/documenttrackings.class.php');
include_once(ROOT_PATH.'classes/dao/chats.class.php');
$chats = new Chats();
$template->assign('chats',$chats);
date_default_timezone_set('Asia/Saigon');
$timezone = date('Y/m/d', time());
$documenttrackings = new DocumentTrackings($storeId);
$documents = new Documents($storeId);
$customers = new Customers($storeId);
$template->assign('customers',$customers);
$documentTypes = new DocumentType();
$template->assign('documentTypes',$documentTypes);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_document'] => '/'.ADMIN_SCRIPT.'?op=document',
				$amessages['list_item'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=document&act=manage';
if(isset($_SESSION["notifi"]) && isset($_SESSION["notifiOf"]))
{
	$template->assign('notifi','1');
	$template->assign('notifiOf',$_SESSION["notifiOf"]);
}
if(isset($_SESSION["SessionCus"]) && $_SESSION["SessionCus"] != 0){
	
}
$documentTypeList= $documentTypes->getObjects(1,"`status` IN (1,3,4)","",300);
if($documentTypeList) {
		$template->assign('documentTypeList',$documentTypeList);
	}
if($_SESSION['userId']){
	$userIdC = $users->getObject($_SESSION['userId']);
	$currentStaffType=$userIdC->getType();
	$currentStaffId=$userIdC->getId();
	$ListCustomerFromUser=$customers->getAllCustomerFromUserid($currentStaffId);
	if($ListCustomerFromUser)
	{
		$arr_ListCusFromUser=explode(',',$ListCustomerFromUser);
			array_splice($arr_ListCusFromUser,count($arr_ListCusFromUser)-1,1);
			$ListCustomerFromUser=implode(',',$arr_ListCusFromUser);
	}
}
if($currentStaffType==1) {
	if($ListCustomerFromUser){
		$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0' AND `id` IN ($ListCustomerFromUser)","",300);
	}else{
		$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0' AND `id`<'0'","",300);
	}
}else{
	$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0'","",300);
}
if($customerList) {
		$template->assign('customerList',$customerList);
}
if($userIdC->getType()==3 || $userIdC->getType()==4){
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');	
}elseif($userIdC->getType()==1){
	$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
					$amessages['add_new'] => $tabLink.'&mod=add');
}else{
	$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list');
}		
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);
# Get parameters

$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'id';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);
$cid = $request->element('cid')?$request->element('cid'):'';
if($cid) $template->assign('cid',$cid);
$dt = $request->element('dt')?$request->element('dt'):'';
if($dt) $template->assign('dt',$dt);
$fy = $request->element('fy')?$request->element('fy'):'';
if($fy) $template->assign('fy',$fy);
$dp = $request->element('dp')?$request->element('dp'):'';
if($dp) $template->assign('dp',$dp);
$da = $request->element('da')?$request->element('da'):'';
if($da) $template->assign('da',$da);
$ds = $request->element('ds')?$request->element('ds'):'';

if($ds){
	$template->assign('ds',$ds);
}
$_SESSION['cid']='';
if(!$cid)
{
    $cid= $_SESSION['cid'];
}
$_SESSION['cid']=$cid;
# Build WHERE condition
$condition = "1>0";
// if($kw) $condition = "(`id`='$kw' OR `name` LIKE '%$kw%' OR `keywords` LIKE '%$kw%' OR `date_processed` LIKE '%$kw%' OR `date_approved` LIKE '%$kw%')";
// if($ds) $condition .=" AND (`status`='$ds')";
// if($currentStaffType==1) {
// 	if($ListCustomerFromUser){
// 		$condition.= " AND (`status` IN ('',1,2,4,5)) AND (`customer_id` IN ($ListCustomerFromUser))";
// 	}else{
// 		$condition.= " AND (`customer_id` < '0')";
// 	}
// }

// if($currentStaffType==2) {
// 		$condition.= " AND (`status` IN (1,3,4)) AND (`user_processed` = $currentStaffId OR (`user_processed_temporary` = $currentStaffId AND `processed_from` <= '$timezone' AND `processed_to` >= '$timezone'))";
// }
if(isset($_SESSION['SessionCus']) && $_SESSION['SessionCus']!=0){
	$sescus=$_SESSION['SessionCus'];
	$condition .= " AND (`customer_id`='$sescus')";
} 
if($kw) $condition .=" AND (`id`='$kw' OR `name` LIKE '%$kw%' OR `keywords` LIKE '%$kw%')";
if($cid) $condition .= " AND (`customer_id`='$cid')";
if($dt) $condition .=" AND (`document_type_id`='$dt')";
if($fy) $condition .=" AND (`financial_year`='$fy')";
if($dp) $condition .=" AND (`date_processed` BETWEEN '$dp' AND '$dp 23:59:59')";
if($da) $condition .=" AND (`date_approved` BETWEEN '$da' AND '$da 23:59:59')";
if($ds) $condition .=" AND (`status`='$ds')";

if($currentStaffType==1) {
	if($ListCustomerFromUser){
		$condition.= " AND (`customer_id` IN ($ListCustomerFromUser)) AND (`status` IN ('',1,2,4,5))";
	}else{
		$condition.= " AND (`customer_id` < '0')";
	}
}
if($currentStaffType==2) {
		$condition.= " AND (`status` IN (1,3,4)) AND (`user_processed` = $currentStaffId OR (`user_processed_temporary` = $currentStaffId AND `processed_from` <= '$timezone' AND `processed_to` >= '$timezone'))";
}
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $documents->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
// $linkurl="&mod=list";	
// 	if($ds) $linkurl .="&ds=$ds";
// $url = '/'.ADMIN_SCRIPT."?op=document&act=manage$linkurl&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=%d";
$linkurl="&mod=list";
	if($cid) $linkurl .="&cid=$cid";
	if($dt) $linkurl .="&dt=$dt";
	if($fy) $linkurl .="&fy=$fy";
	if($dp) $linkurl .="&dp=$dp";
	if($da) $linkurl .="&da=$da";
	if($ds) $linkurl .="&ds=$ds";
	if($do) $linkurl .="&doo=$do";
	if($kw) $linkurl .="&kw=$kw";
$url = '/'.ADMIN_SCRIPT."?op=dashboard&act=index$linkurl&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $documents->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=document&act=manage$linkurl&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page";
$template->assign('link',$link);



if($_POST) {
	switch($do) {
		case 'enable':
			$userInfo->checkPermission('document','edit');
			$id = $request->element('id');
			$docuInfo= $documents->getObject($id);
			if($id) {
				if($userIdC->getType()==1){
					if($docuInfo->getStatus()==2){
						header("location: /admin.php?op=accessdenied");
						exit();
					}else{
						$documents->changeStatus($id,S_EXPIRED);
					}
				}elseif($userIdC->getType()==2){
					$data = array('date_processed' => date("Y-m-d H:i:s"),
						 'user_processed' => $_SESSION['userId'],
						 'last_updated' => date("Y-m-d H:i:s"));
					$documents->changeStatus($id,S_WAITING);
					$documents->updateData($data,$id);
				}else{
					if($documents->getDocumentStatus($id)==3){
						$data = array('date_approved' => date("Y-m-d H:i:s"),
						 'user_approved' => $_SESSION['userId'],
						 'last_updated' => date("Y-m-d H:i:s"));
						$documents->changeStatus($id,S_ENABLED);
						$documents->updateData($data,$id);
					}
					
				}
				$result_code = 1;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				$docuInfo= $documents->getObject($ids);
				if($ids) {
					$listDocument = '';

					foreach ($ids as $id) {
						if($userIdC->getType()==1){
							$documents->changeStatus($id,S_EXPIRED);
							$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
						}elseif($userIdC->getType()==2){
							$data = array('date_processed' => date("Y-m-d H:i:s"),
						 'user_processed' => $_SESSION['userId'],
						 'last_updated' => date("Y-m-d H:i:s"));
							$documents->changeStatus($id,S_WAITING);
							$documents->updateData($data,$id);
							$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
						}else{
							if($documents->getDocumentStatus($id)==3){
								$data = array('date_approved' => date("Y-m-d H:i:s"),
							 'user_approved' => $_SESSION['userId'],
							 'last_updated' => date("Y-m-d H:i:s"));
							$documents->changeStatus($id,S_ENABLED);
							$documents->updateData($data,$id);
							$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
							}
						}
						$listDocument .= ($listDocument?',&nbsp;':'').$documents->getNameFromId($id);
					}
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_document'],$listDocument),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$userInfo->checkPermission('document','edit');
			$id = $request->element('id');
			if($id) {
				if($userIdC->getType()==1){
					$documents->changeStatus($id,S_DISABLED);
				}elseif($userIdC->getType()==2){
					if($documents->getDocumentStatus($id)==4){
					$documents->changeStatus($id,S_MENU);
					}
				}else{
					if($documents->getDocumentStatus($id)!=1){
					$documents->changeStatus($id,S_DISABLED);
					}
				}
				
				$result_code = 2;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listDocument = '';
					foreach ($ids as $id) {
						if($userIdC->getType()==1){
							$documents->changeStatus($id,S_DISABLED);
							$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
						}elseif($userIdC->getType()==2){
							if($documents->getDocumentStatus($id)==4){
							$documents->changeStatus($id,S_MENU);
							$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
							}
						}else{
							if($documents->getDocumentStatus($id)!=1){
							$documents->changeStatus($id,S_DISABLED);
							$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
							}
						}
						$listDocument .= ($listDocument?',&nbsp;':'').$documents->getNameFromId($id);
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document'],$listDocument),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('document','delete');
			$id = $request->element('id');
			if($id) {
				if($userIdC->getType()==1){
					$documents->changeStatus($id,S_DELETED);
				}elseif($userIdC->getType()==2){
					$documents->changeStatus($id,S_MENU);
				}else{
					if($documents->getDocumentStatus($id)!=1){
					$documents->changeStatus($id,S_DELETED);
					}
				}
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listDocument = '';
					foreach ($ids as $id) {
						$documents->changeStatus($id,S_DELETED);
						$listDocument .= ($listDocument?',&nbsp;':'').$documents->getNameFromId($id);
						$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_document'],$listDocument),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));

				} else $error_code = 5;
			}
			break;
		case 'cleantrash':
			$userInfo->checkPermission('document','clean',0);
			$documents->cleanTrash();
			$result_code = 5;
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_document'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			$documenttrackings->addData(array('store_id'=>$storeId,'document_id'=>$id,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['clean_trash_document']),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			break;
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=document&act=manage&mod=list&lang=$lang&ecode=7");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=document&act=manage$linkurl&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code");
} else {

}
?>