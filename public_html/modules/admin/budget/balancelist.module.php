<?php
/*************************************************************************
Product listing module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 10/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
//checkPermission();
$userInfo->checkPermission('budgetexpenditure','view');
$templateFile = 'budgetbalance.tpl.html';
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
include_once(ROOT_PATH.'classes/dao/trackingbalances.class.php');
$expenditures = new Expenditures($storeId);
$trackingBalances = new TrackingBalances();
$budgetCategories = new BudgetCategories($storeId);
$budgetCapitals = new BudgetCapitals($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['list_tracking_revenue_expenditure'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget';
$listTabs = array($amessages['tracking_balance'] => $tabLink.'&act=balance',
				$amessages['list_tracking_revenue_expenditure'] => $tabLink.'&act=expenditure&mod=list',
				$amessages['bill_revenue'] => $tabLink.'&act=billrevenue',
				$amessages['add_bill_revenue'] => $tabLink.'&act=billrevenue&mod=add',
				$amessages['bill_expenditure'] => $tabLink.'&act=billexpenditure',
				$amessages['add_bill_expenditure'] => $tabLink.'&act=billexpenditure&mod=add'
				);			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);
$template->assign('expenditures',$expenditures);
$arrid=array('id'=>"DESC");
$template->assign('arrid',$arrid);
# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'id';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);
$uid = $request->element('uid')?$request->element('uid'):'';
if($uid) $template->assign('uid',$uid);
$type = $request->element('type')?$request->element('type'):'';
if($type) $template->assign('type',$type);
# Build WHERE condition
$condition = $uid>0?"`user_id` = '$uid'":"1>0";
if($type) $condition .= " and `type` = '$type'";
//if($userInfo->isSiteAccount())	$condition .= " and `user_id` = '$userId'";
if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
//if($kw) $condition = "(`id`='$kw' OR `slug` LIKE '%$kw%' OR `sku` LIKE '%$kw%' OR `name` LIKE '%$kw%')";
if($kw) $condition .= " and (`code` LIKE '%$kw%' OR `name` LIKE '%$kw%' OR `id` = '$kw')";
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $budgetCapitals->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=budget&act=balance&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&uid=$uid&type=$type&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $budgetCapitals->getObjects($page,$condition,$sort,$items_per_page); 
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=budget&act=balance&mod=list&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&uid=$uid&type=$type&pg=$page";
$template->assign('link',$link);


# ALlow URL popup
$template->assign('urlPopup', 1);
if($_POST) {
	switch($do) {
		case 'complete':
			$userInfo->checkPermission('order','edit');
			// Change status => orderpaid (5)
			$id = $request->element('id');
			if($id) {
				$expenditures->changeStatus($id,S_COMPLETE_ORDER);
				$result_code = 7;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['complete_order'],$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listOrder = '';
					foreach ($ids as $id) {
						$expenditures->changeStatus($id,S_COMPLETE_ORDER);
						$listOrder .= ($listOrder?',&nbsp;':'').$id;
					}
					$result_code = 7;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['complete_order'],$listOrder),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		// chang don hang sang trang thai huy => lap mot phieu nhap voi noi dung, nhap lai san pham vua xuat o don hang huy
		case 'disable':
			#$userInfo->checkPermission('order','edit');
			$id = $request->element('id');
			if($id) {
				$expenditures->changeStatus($id,S_DISABLED_ORDER);
				$result_code = 11;
				$orderInfo = $expenditures->getObject($id,'id');
				
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['destroy_order'],$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listOrder = '';
					foreach ($ids as $id) {
						$expenditures->changeStatus($id,S_DISABLED);
						$listOrder .= ($listOrder?',&nbsp;':'').$id;
					}
					$result_code = 11;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_order'],$listOrder),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('order','delete');
			$id = $request->element('id');
			if($id) {
				$expenditures->changeStatus($id,S_DELETED_ORDER);
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_order'],$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listOrder = '';
					foreach ($ids as $id) {
						$expenditures->changeStatus($id,S_DELETED_ORDER);
						$listOrder .= ($listOrder?',&nbsp;':'').$id;
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_order'],$listOrder),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'changegroup':
			$userInfo->checkPermission('order','edit');
			$ids = $request->element('ids');
			$status = $request->element('status');
			if($ids) {
				$listOrder = '';
				foreach ($ids as $id) {
					$expenditures->changeStatus($id,$status);
					$listOrder .= ($listOrder?',&nbsp;':'').$id;
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_order_group'],$listOrder,$expenditures->getStatusPayment($status)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cleantrash':
			$userInfo->checkPermission('order','clean',0);
			$expenditures->cleanTrash();
			$result_code = 5;
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_order'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			break;
		case 'cancel':
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&lang=$lang&ecode=7&uId=$uId");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=balance&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}


?>