<?php
/*************************************************************************
Admin index page
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 02/06/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
$time_start = microtime(true);
error_reporting(9);
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', dirname(__FILE__).'/');
}
include_once(ROOT_PATH.'includes/constant.inc.php');
include_once(ROOT_PATH.'classes/security/boot.class.php');
$boots = new Boot();
# Initialize query count variable
$query_count = 0;

# Set the debug options
if(DEBUG && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {
	$debug_file = ROOT_PATH.'debug/'.DEBUG_IP.'.txt';
	file_put_contents($debug_file, "***** Start runtime: ".date("Y-m-d H:i:s")." *****\n", DEBUG_FILE_APPEND);
	$debugText = '';
	$time_start = microtime(true);
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
} else {
	error_reporting(0);
	ini_set('display_errors', FALSE);
	ini_set('display_startup_errors', FALSE);
}

include_once(ROOT_PATH.'includes/config.inc.php');
include_once(ROOT_PATH.'classes/data/translator.class.php');
include_once(ROOT_PATH.'includes/admin/functions.inc.php');
include_once(ROOT_PATH.'classes/database/mysql.class.php');
include_once(ROOT_PATH.'classes/template/smarty.class.php');
include_once(ROOT_PATH.'classes/http/request.class.php');
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/estores.class.php');
include_once(ROOT_PATH.'classes/dao/trackings.class.php');
include_once(ROOT_PATH.'classes/dao/storeusers.class.php');
# Setting time zone
if(function_exists('date_default_timezone_set')) date_default_timezone_set(TIME_ZONE);

# Database connection
$db = new DB();

# Template engine
$template = new Smarty;
$template->compile_check = true;
$template->debugging = false;

# HTTP Request manager
$request = new Request;
$op = $request->element('op');
$act = $request->element('act');
$mod = $request->element('mod');
$site = $request->element('site');

# Template configuration
$templateFolder = 'admin/';
$userTemplate = 'admin';
$templateFile = 'index.tpl.html';
	
# Language manager
$lang = $request->element('lang');
if(!$lang) $lang = DEFAULT_ADMIN_LANGUAGE;
include_once(ROOT_PATH.'languages/admin/'.$lang.'.php');
$template->assign('amessages',$amessages);
$template->assign('lang',$lang);
# Translate messages
$translator = new Translator($amessages);
$template->assign('locale',$translator);

# Bootstrap
#$sCode = $boots->checkBootstrapLoaded();
$sCode="estore";

# Action check

if(!$op || !in_array($op,$aops)) $op = 'login';
if($op=='admin' && !$userInfo->isAdmin()) $op = DEFAULT_ADMIN_OP;

# Session manager
include_once(ROOT_PATH.'includes/admin/sessions.inc.php');

# Load module
include_once(ROOT_PATH.'modules/admin/'.$op.'.module.php');

# Global variable
$template->assign('aScript',ADMIN_SCRIPT);
$template->assign('domain',DOMAIN);
// var_dump($_SESSION['userId']);
// include_once(ROOT_PATH.'classes/dao/customers.class.php');
// if($_SESSION['userId']){
	
// $sessCustomers = new Customers($storeId);
// $sessUserIdC = $users->getObject($_SESSION['userId']);
// $sessStaffType=$sessUserIdC->getType();
// $sessStaffId=$sessUserIdC->getId();
// $listCusOfStaff=$sessCustomers->getAllCustomerFromUserid($sessStaffId);
// if($listCusOfStaff)
// 	{
// 		$arr_listCusOfStaff=explode(',',$listCusOfStaff);
// 			array_splice($arr_listCusOfStaff,count($arr_listCusOfStaff)-1,1);
// 			$listCusOfStaff=implode(',',$arr_listCusOfStaff);
// 	}

// if($sessStaffType==1) {
// 	if($listCusOfStaff){
// 		$sessCustomerList= $sessCustomers->getObjects(1,"`status`='1' AND `type`='0' AND `id` IN ($listCusOfStaff)");
// 	}else{
// 		$sessCustomerList= $sessCustomers->getObjects(1,"`status`='1' AND `type`='0' AND `id`<'0'");
// 	}
// }else{
// 	$sessCustomerList= $sessCustomers->getObjects(1,"`status`='1' AND `type`='0'");
// }
// if($sessCustomerList) {
// 	$template->assign('sessCustomerList',$sessCustomerList);
// }
// 	if(isset($_SESSION["SessionCus"])){
// 		$sessionCustom=$_SESSION["SessionCus"];
// 		$template->assign('sessionCustom',$sessionCustom);
// 	}else{
// 		$_SESSION["SessionCus"]=0;
// 		$sessionCustom=0;
// 		$template->assign('sessionCustom',$sessionCustom);
// 	}
// }
# Operations
if(isset($op)) $template->assign('op',$op);
if(isset($act)) $template->assign('act',$act);
if(isset($mod)) $template->assign('mod',$mod);

if(isset($storeId)) $template->assign('storeId',$storeId);

# Navigation bar
if(isset($topNav)) $template->assign('topNav',$topNav);

# Display the web page
$template->assign('templatePath',TEMPLATE_PATH);
$template->assign('userTemplate',$userTemplate);
$template->display($templateFolder.$templateFile);

# Close database connection
$db->close();

$time_end = microtime(true);
$time = $time_end - $time_start;
if(DEBUG && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {	
$template->assign('incompany',1);
}
if(DEBUG && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {	
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	if(!isset($plus)) $plus = '';
	$debugText .= "* op-act-plus-email: $op-$act-$plus<br />\n";
	$debugText .= "* Templates: ".print_r($userTemplate,true)."<br />\n";
	$debugText .= "* Template file: ".$templateFile."<br />\n";
	// $debugText .= "* Session: ".print_r($_SESSION,true)."<br />\n";
	$debugText .= "* Last errors: ".print_r(error_get_last(),true)."<br />\n";
	$debugText .= "* Queries: ".$query_count.'-'.memory_get_usage()." <br />\n";
	$debugText .= "* Execute time: ".$time."s <br />\n";
	if(DEBUG_DISPLAY) echo $debugText;
	
	# Write to debug file
	file_put_contents($debug_file, $debugText, FILE_APPEND);		
	file_put_contents($debug_file, "***** End runtime *****\n\n", FILE_APPEND);
	
}
if($act != 'payroll') unset($_SESSION['listuser']);
?>