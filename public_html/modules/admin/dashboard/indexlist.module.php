<?php
/*************************************************************************
Dashboard module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Last updated: 27/12/2011
Coder: Mai Minh
**************************************************************************/
checkPermission(array(1,2,3,4,5,6,7));
$templateFile = 'dashboard.tpl.html';
include_once(ROOT_PATH.'classes/dao/orders.class.php');
// include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/documenttypes.class.php');
include_once(ROOT_PATH.'classes/dao/documents.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
date_default_timezone_set('Asia/Saigon');
$timezone = date('Y/m/d', time());
$documents = new Documents($storeId);
// $customers = new Customers($storeId);
$users = new Users($storeId);
// $template->assign('customers',$customers);
$documentTypes = new DocumentType();
$template->assign('documentTypes',$documentTypes);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['summary'] => '');

$documentTypeList= $documentTypes->getObjects(1,"`status` IN (1,3,4)","",300);
if($documentTypeList) {
		$template->assign('documentTypeList',$documentTypeList);
	}
if(isset($_SESSION["notifi"]) && isset($_SESSION["notifiOf"]))
{
	$template->assign('notifi','1');
	$template->assign('notifiOf',$_SESSION["notifiOf"]);
}
// if($_SESSION['userId']){
// 	$userIdC = $users->getObject($_SESSION['userId']);
// 	$currentStaffType=$userIdC->getType();
// 	$currentStaffId=$userIdC->getId();
// 	$ListCustomerFromUser=$customers->getAllCustomerFromUserid($currentStaffId);
// 	if($ListCustomerFromUser)
// 	{
// 		$arr_ListCusFromUser=explode(',',$ListCustomerFromUser);
// 			array_splice($arr_ListCusFromUser,count($arr_ListCusFromUser)-1,1);
// 			$ListCustomerFromUser=implode(',',$arr_ListCusFromUser);
// 	}
// }
// if($currentStaffType==1) {
// 	if($ListCustomerFromUser){
// 		$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0' AND `id` IN ($ListCustomerFromUser)","",300);
// 	}else{
// 		$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0' AND `id`<'0'","",300);
// 	}
// }else{
// 	$customerList= $customers->getObjects(1,"`status`='1' AND `type`='0'","",300);
// }
// if($customerList) {
// 		$template->assign('customerList',$customerList);
// }
if($_POST && $request->element('doo') == 'session'){
	$_SESSION['SessionCus']= $request->element('sessioncid');
}
$op1 = $request->element('op1')?$request->element('op1'):'dashboard';
$act1 = $request->element('act1')?$request->element('act1'):'index';
$mod1 = $request->element('mod1')?$request->element('mod1'):'list';
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

$condition = "1>0";
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

// if($currentStaffType==1) {
// 	if($ListCustomerFromUser){
// 		$condition.= " AND (`customer_id` IN ($ListCustomerFromUser)) AND (`status` IN ('',1,2,4,5))";
// 	}else{
// 		$condition.= " AND (`customer_id` < '0')";
// 	}
// }
// if($currentStaffType==2) {
// 		$condition.= " AND (`status` IN (1,3,4)) AND (`user_processed` = $currentStaffId OR (`user_processed_temporary` = $currentStaffId AND `processed_from` <= '$timezone' AND `processed_to` >= '$timezone'))";
// }

$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $documents->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$linkurl="&mod=$mod1";
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

if($_POST) {
	header('location:'.'/'.ADMIN_SCRIPT."?op=$op1&act=$act1$linkurl&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page");
	// header('location:'.'/'.ADMIN_SCRIPT."?op=dashboard&act=index&mod=list&cid=$cid&dt=$dt&fy=$fy&dp=$dp&da=$da&ds=$ds&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}

// if($request->element('doo') == 'updateStatistic') {
// 	$yesterday = date("Y-m-d 00:00:00", time() - 86400);
// 	$session = date("Y-m-d h:i:s", time() - SESSION_TIME*60);
// 	$today = date("Y-m-d 00:00:00");
// 	$month = date("Y-m-01 00:00:00");
// 	$year = date("Y-01-01 00:00:00");
// 	$sql = "SELECT count(id) FROM `".DB_PREFIX."products` WHERE store_id = '$storeId' AND `status`='1'";
// 	$results = $db->query($sql);
// 	$row=$db->fetchRow($results);
// 	$tp = $row[0];
// 	$results = $db->query($sql." AND `created` > '$month'");
// 	$row=$db->fetchRow($results);
// 	$tpim = $row[0];
// 	$sql = "SELECT count(id) FROM `".DB_PREFIX."orders` WHERE store_id = '$storeId'";
// 	$results = $db->query($sql." AND `created` > '$year'");
// 	$row=$db->fetchRow($results);
// 	$oiy = $row[0];
// 	$results = $db->query($sql." AND `created` > '$month'");
// 	$row=$db->fetchRow($results);
// 	$oim = $row[0];
// 	$sql = "SELECT SUM(oi.quantity*oi.price) FROM `".DB_PREFIX."order_items` oi, `".DB_PREFIX."orders` o WHERE o.id=oi.order_id AND o.status=1 AND o.store_id = '$storeId'";
// 	$results = $db->query($sql." AND `created` > '$year'");
// 	$row=$db->fetchRow($results);
// 	$riy = $row[0];
// 	$results = $db->query($sql." AND `created` > '$month'");
// 	$row=$db->fetchRow($results);
// 	$rim = $row[0];
// 	$sql = "SELECT count(id) FROM `".DB_PREFIX."articles` WHERE store_id = '$storeId'";
// 	$results = $db->query($sql);
// 	$row=$db->fetchRow($results);
// 	$te = $row[0];
// 	$results = $db->query($sql." AND `date_created` > '$month'");
// 	$row=$db->fetchRow($results);
// 	$eim = $row[0];

// 	$db->query("UPDATE `".DB_PREFIX."estore_statistics` SET tp='$tp',tpim='$tpim',oiy='$oiy',oim='$oim',riy='$riy',rim='$rim',te='$te',eim='$eim',last_updated='".date("Y-m-d H:i:s")."' WHERE id='$storeId'");
	
// # Clean the online list
// 	$db->query("DELETE FROM `".DB_PREFIX."estore_online_users` WHERE `store_id`='$storeId' AND `last_updated` < '$session'");	
// }

// # Get latest orders
// $orders = new Orders($storeId);
// $latestOrders = $orders->getObjects(1,'1>0',array('created' => 'DESC'),10);
// if($latestOrders) $template->assign('latestOrders',$latestOrders);

// # Get top ordered products
// $topOrderedProducts = array();
// $last30days = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d"),date("Y"))-86400*300);
// $results = $db->query("SELECT oi.product_id,p.sku,oi.name,AVG(oi.price) AS price,count(oi.product_id) AS total FROM `".DB_PREFIX."order_items` oi,`".DB_PREFIX."orders` o,`".DB_PREFIX."products` p WHERE p.id = oi.product_id AND o.store_id = '$storeId' AND oi.order_id=o.id and o.created >='$last30days' group by oi.product_id ORDER BY total DESC LIMIT 0,10");
// if($db->numRows($results)) {
// 	while($row=$db->fetchArray($results)) {
// 		$topOrderedProducts[] = $row;

// 	}
// }
// $template->assign('topOrderedProducts',$topOrderedProducts);

// # Get top viewed products
// $topViewedProducts = array();
// $results = $db->query("SELECT id,`name`,sku,price,viewed FROM `".DB_PREFIX."products` WHERE store_id = '$storeId' AND status=1 ORDER BY viewed DESC LIMIT 0,10");
// if($db->numRows($results)) {
// 	while($row=$db->fetchArray($results)) {
// 		$topViewedProducts[] = $row;
// 	}
// }
// $template->assign('topViewedProducts',$topViewedProducts);

// # Get number of online users
// $onlineUsers = 0;
// $results = $db->query("SELECT count(store_id) FROM `".DB_PREFIX."estore_online_users` WHERE store_id = '$storeId'");
// if($db->numRows($results)) {
// 	$row=$db->fetchRow($results);
// 	$onlineUsers = $row[0];
// }
// $template->assign('onlineUsers',$onlineUsers);

// # Get store statistic
// $statistic = '';
// $results = $db->query("SELECT * FROM `".DB_PREFIX."estore_statistics` WHERE id = '$storeId'");
// if($db->numRows($results)) {
// 	$row=$db->fetchArray($results);
// 	$statistic = $row;
// }
// $template->assign('statistic',$statistic);
?>