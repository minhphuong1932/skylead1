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
$userInfo->checkPermission('budgetexpenditure','view');
$templateFile = 'budgetexpenditure.tpl.html';
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
include_once(ROOT_PATH."classes/dao/trackingbalances.class.php");
$balances1 = new TrackingBalances();

$template->assign('balances1',$balances1);

$budgetCapitals = new BudgetCapitals($storeId);
$budgetCategories = new BudgetCategories($storeId);
$products = new Products($storeId);
$expenditures = new Expenditures($storeId);
$productCategories = new ProductCategories($storeId);
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
$template->assign('currentTab',2);
$budgetCateCombo = $budgetCategories->generateCombo($request->element('budgetcate_id'));
if($budgetCateCombo) $template->assign('budgetCateCombo',$budgetCateCombo);
# budget capital combo box
$budgetCapitalCombo = $budgetCapitals->generateCombo($request->element('capitalId'));
if($budgetCapitalCombo) $template->assign('budgetCapitalCombo',$budgetCapitalCombo);

$budgetCapitalList = $budgetCategories->getObjects(1,"`status` = '1'",array('slug'=>'DESC'),9999);
if($budgetCapitalList) $template->assign('budgetCapitalList',$budgetCapitalList);

$datenow = date("Y-m-d");
$template->assign('datenow',$datenow);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'created';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);
$uid = $request->element('uid')?$request->element('uid'):'';
if($uid) $template->assign('uid',$uid);
$type = $request->element('type')?$request->element('type'):'';
if($type) $template->assign('type',$type);
$capitalId = $request->element('capitalId')?$request->element('capitalId'):'';
if($capitalId) $template->assign('capitalId',$capitalId);
$budgetId = $request->element('budgetId')?$request->element('budgetId'):'';
if($budgetId) $template->assign('budgetId',$budgetId);

$statusBill = $request->element('statusBill')?$request->element('statusBill'):'';
if($statusBill)	$template->assign('statusBill',$statusBill);
$status = $request->element('status')?$request->element('status'):'';
if($status)	$template->assign('status',$status);
if($request->element('capitalId')){
	$cpId = $request->element('capitalId');
	$capitalInfo =$budgetCapitals->getObject($cpId);
	if($capitalInfo->getBalanceFact())$template->assign('balanceFact',$capitalInfo->getBalanceFact());
	if($capitalInfo->getBalanceFact1())$template->assign('balanceFact1',$capitalInfo->getBalanceFact1());
	if($capitalInfo->getBalance())$template->assign('balance',$capitalInfo->getBalance());
		$template->assign('curency',$capitalInfo->getCurrencyName());
}

$start = $request->element('start');
$end = $request->element('end');
if($start && $start != 'Từ') $dateStart = date("Y-m-d",strtotime($start));
else $dateStart = '';
if($end && $end != 'Đến') $dateEnd = date("Y-m-d",strtotime($end));
else $dateEnd = '';
$datediff = floor(abs(strtotime($dateStart) - strtotime($dateEnd))/(60*60*24));
if($datediff>=180){
	$error_code = 14;
	$template->assign('error_code',$error_code);
}

$template->assign('start',$start);
$template->assign('end',$end);
# Build WHERE condition
$condition = $uid>0?"`user_id` = '$uid'":"1>0";
if($type) $condition .= " and `type` = '$type'";
if($capitalId) $condition .= " and `capital_id` = '$capitalId'";
if($budgetId) $condition .= " and `budgetcate_id` = '$budgetId'";
//if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
if($userInfo->isSiteStaff()){
	$listAllUser = $budgetCapitals->getAllCapption("`user_id` = '$userId'");
	if($listAllUser)	$condition .= " and `capital_id` in ($listAllUser)";
	else $condition .= " and `user_id` = '$userId'";

}
if($do && $statusBill!=-1) $condition .= " AND `status_bill` = '$statusBill'";
if($do && $status!=-1) $condition .= " AND `status` = '$status'";
if($do && ($dateStart || $dateEnd) && $datediff<=180) $condition .= " AND `created` BETWEEN '".$dateStart." 00:00:00' and '".$dateEnd." 23:59:59'";

//if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
if($kw) $condition .= " and (`id`='$kw' OR `name` LIKE '%$kw%' OR `price` LIKE '%$kw%' OR `note` LIKE '%$kw%')";

$condition1 = $uid>0?"`user_id` = '$uid'":"1>0";
$condition1 .= " and `status` = '1' and `status_bill` = 0";
// if($type) $condition1 .= " and `type` = '$type'";
if($capitalId) $condition1 .= " and `capital_id` = '$capitalId'";
if($budgetId) $condition1 .= " and `budgetcate_id` = '$budgetId'";
//if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
if($userInfo->isSiteStaff()){
	$listAllUser = $budgetCapitals->getAllCapption("`user_id` = '$userId'");
	if($listAllUser)	$condition1 .= " and `capital_id` in ($listAllUser)";
	else $condition1 .= " and `user_id` = '$userId'";

}
// if($do && $statusBill!=-1) $condition1 .= " AND `status_bill` = '$statusBill'";
// if($do && $status!=-1) $condition1 .= " AND `status` = '$status'";
// if($do && ($dateStart || $dateEnd) && $datediff<=180) $condition1 .= " AND `created` BETWEEN '".$dateStart." 00:00:00' and '".$dateEnd." 23:59:59'";

//if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
// if($kw) $condition1 .= " and (`id`='$kw' OR `name` LIKE '%$kw%' OR `price` LIKE '%$kw%' OR `note` LIKE '%$kw%')";

$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $expenditures->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&uid=$uid&type=$type&capitalId=$capitalId&budgetId=$budgetId&statusBill=$statusBill&status=$status&start=$dateStart&end=$dateEnd&ecode=$error_code&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $expenditures->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);
$listItemsToSum = $expenditures->getObjects(1,$condition1,$sort,999999);
if($listItemsToSum){
	$sumThu=0;
	$sumChi=0;
	foreach ($listItemsToSum as $key => $ItemToSum) {
		if($ItemToSum->getType()==2){
			$sumChi=$sumChi + $ItemToSum->getPrice();
		}
		if($ItemToSum->getType()==1){
			$sumThu=$sumThu + $ItemToSum->getPrice();
		}
	}
	$template->assign('sumThu',$sumThu);
	$template->assign('sumChi',$sumChi);
}
if(isset($cpId)){
	$lastItem = $expenditures->getObjects(1,"`capital_id` = '$cpId' AND `status_bill` = '1'",array('id'=>"DESC"),9999);
	if($lastItem) $template->assign('lastItem',$lastItem);

}


# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&uid=$uid&type=$type&capitalId=$capitalId&statusBill=$statusBill&budgetId=$budgetId&status=$status&start=$dateStart&end=$dateEnd&ecode=$error_code&pg=$page";
$template->assign('link',$link);

#bottom Action Combo
$categoryCombo = $productCategories->generateCombo();
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

# ALlow URL popup
$template->assign('urlPopup', 1);
$id = $request->element('id');

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
			checkPermission();
			#$userInfo->checkPermission('order','edit');
			$id = $request->element('id');
			if($id) {
				$expenditures->changeStatus($id,S_DISABLED_ORDER);
				$result_code = 11;
				$expenditureInfo = $expenditures->getObject($id,'id');
				if($expenditureInfo->getType() == 2){
				/////////////////////////////////
					$properties = $expenditureInfo->getProperties();
					 $quantity =  $expenditureInfo->getPrice()*(-1);
					// add bill
					$fields = array('store_id'		=> $storeId,
									'user_id'		=> $userId,
									'budgetcate_id'	=>  $expenditureInfo->getBudgetCateId(),
									'capital_id'	=> $expenditureInfo->getCapitalId(),
									'debt_account_id'	=> $expenditureInfo->getDebtAccountId(),
									'type'			=> 3,
									'name'			=> $expenditureInfo->getName(),
									'price'			=> $quantity,
									'note'			=> $expenditureInfo->getNote(),
									'created'		=> date("Y-m-d H:i:s"),
									'status'		=> 1,
									'properties'	=> serialize($properties)	
									);
					$expenditureId = $expenditures->addData($fields);
					$fields1 = array('store_id'		=> $storeId,
									'user_id'		=> $userId,
									'budgetcate_id'	=>  $expenditureInfo->getBudgetCateId(),
									'capital_id'	=> $expenditureInfo->getDebtAccountId(),
									'debt_account_id'	=> $expenditureInfo->getCapitalId(),
									'type'			=> 4,
									'name'			=> $expenditureInfo->getName(),
									'price'			=> $quantity,
									'note'			=> $expenditureInfo->getNote(),
									'created'		=> date("Y-m-d H:i:s"),
									'status'		=> 1,
									'properties'	=> serialize($properties)	
									);
					$expenditureId1 = $expenditures->addData($fields1);
					
					// add tracking expenditure
					
					include_once(ROOT_PATH."classes/dao/trackingbalances.class.php");
					$trackingBalances = new TrackingBalances();
					$capitalId = $expenditureInfo->getCapitalId();
					 $pbalance = $trackingBalances->getPbalanceProduct($capitalId);
					
					$data = array(	'store_id'		=> $storeId,
									'user_id'		=> $userId,
									'expenditure_id'=> $expenditureId,
									'budgetcate_id' => $expenditureInfo->getBudgetCateId(),
									'capital_id' 	=> $expenditureInfo->getCapitalId(),
									'debt_account_id'	=> $expenditureInfo->getDebtAccountId(),
									'type'			=> 3,
									'pbalance'		=> $pbalance,
									'quantity'		=> $quantity,
									'balance'		=> $pbalance + $quantity,
									'datetime'		=> date("Y-m-d H:i:s")
									);
					$trackingBalances->addData($data);
					$debtAccountId = $expenditureInfo->getDebtAccountId();
					$pbalance1 = $trackingBalances->getPbalanceProduct($debtAccountId);
					$data1 = array(	'store_id'		=> $storeId,
									'user_id'		=> $userId,
									'expenditure_id'=> $expenditureId1,
									'budgetcate_id' => $expenditureInfo->getBudgetCateId(),
									'capital_id' 	=> $expenditureInfo->getDebtAccountId(),
									'debt_account_id'	=> $expenditureInfo->getCapitalId(),
									'type'			=> 3,
									'pbalance'		=> $pbalance1,
									'quantity'		=> $quantity,
									'balance'		=> $pbalance1 - $quantity,
									'datetime'		=> date("Y-m-d H:i:s")
									);
					$trackingBalances->addData($data1);
					// end add tracking expenditure
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['destroy_bill_expend'],$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					///////////////////////////////////////
					}else{
						$properties = $expenditureInfo->getProperties();
						// add bill
						$fields = array('store_id'		=> $storeId,
										'user_id'		=> $userId,
										'budgetcate_id'	=>  $expenditureInfo->getBudgetCateId(),
										'capital_id'	=> $expenditureInfo->getCapitalId(),
										'debt_account_id'	=> $expenditureInfo->getDebtAccountId(),
										'type'			=> 4,
										'name'			=> $expenditureInfo->getName(),
										'price'			=> $expenditureInfo->getPrice(),
										'note'			=> $expenditureInfo->getNote(),
										'created'		=> date("Y-m-d H:i:s"),
										'status'		=> 1,
										'properties'	=> serialize($properties)	
										);
						$expenditureId = $expenditures->addData($fields);
						$fields1 = array('store_id'		=> $storeId,
										'user_id'		=> $userId,
										'budgetcate_id'	=>  $expenditureInfo->getBudgetCateId(),
										'capital_id'	=> $expenditureInfo->getDebtAccountId(),
										'debt_account_id'	=> $expenditureInfo->getCapitalId(),
										'type'			=> 3,
										'name'			=> $expenditureInfo->getName(),
										'price'			=> $expenditureInfo->getPrice(),
										'note'			=> $expenditureInfo->getNote(),
										'created'		=> date("Y-m-d H:i:s"),
										'status'		=> 1,
										'properties'	=> serialize($properties)	
										);
						$expenditureId1 = $expenditures->addData($fields1);
						
						// add tracking expenditure
						
						include_once(ROOT_PATH."classes/dao/trackingbalances.class.php");
						$trackingBalances = new TrackingBalances();
						$capitalId = $expenditureInfo->getCapitalId();
						 $pbalance = $trackingBalances->getPbalanceProduct($capitalId);
						 $quantity =  $expenditureInfo->getPrice();
						$data = array(	'store_id'		=> $storeId,
										'user_id'		=> $userId,
										'expenditure_id'=> $expenditureId,
										'budgetcate_id' => $expenditureInfo->getBudgetCateId(),
										'capital_id' 	=> $expenditureInfo->getCapitalId(),
										'debt_account_id'	=> $expenditureInfo->getDebtAccountId(),
										'type'			=> 4,
										'pbalance'		=> $pbalance,
										'quantity'		=> $quantity,
										'balance'		=> $pbalance - $quantity,
										'datetime'		=> date("Y-m-d H:i:s")
										);
						$trackingBalances->addData($data);
						$debtAccountId = $expenditureInfo->getDebtAccountId();
						$pbalance1 = $trackingBalances->getPbalanceProduct($debtAccountId);
						$data1 = array(	'store_id'		=> $storeId,
										'user_id'		=> $userId,
										'expenditure_id'=> $expenditureId1,
										'budgetcate_id' => $expenditureInfo->getBudgetCateId(),
										'capital_id' 	=> $expenditureInfo->getDebtAccountId(),
										'debt_account_id'	=> $expenditureInfo->getCapitalId(),
										'type'			=> 4,
										'pbalance'		=> $pbalance1,
										'quantity'		=> $quantity,
										'balance'		=> $pbalance1 + $quantity,
										'datetime'		=> date("Y-m-d H:i:s")
										);
						$trackingBalances->addData($data1);
						// end add tracking expenditure
						# Operation tracking
						$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['destroy_revenue'],$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
						///////////////////////////////////////
					}
				
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
		case 'checkBill':
			//$userInfo->checkPermission('order','edit');
			$id = $request->element('id');
			if($id) {
				$expenditures->changeStatusBill($id);
				$result_code = 15;
				$orderInfo = $expenditures->getObject($id,'id');

				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['check_order'],$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
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
	header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&capitalId=$capitalId&statusBill=$statusBill&budgetId=$budgetId&status=$status&start=$dateStart&end=$dateEnd&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}
?>