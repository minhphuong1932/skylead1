<?php
/*************************************************************************
Estore main module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 27/04/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/


#Load các class vào module
include_once(ROOT_PATH.'classes/dao/templates.class.php');
include_once(ROOT_PATH.'classes/dao/menus.class.php');
include_once(ROOT_PATH.'classes/dao/menucategories.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH.'classes/dao/articles.class.php');
include_once(ROOT_PATH."classes/dao/users.class.php");
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$crpg=getCurrentPage();
$lang=$request->element('lang');
if(!$lang){
	$lang='vn';
}
if(isset($_SESSION['checkShow']) && $_SESSION['checkShow'] == 1){
	$_SESSION['checkShow'] += 1;
}elseif(isset($_SESSION['checkShow']) && $_SESSION['checkShow'] == 0) {
	$_SESSION['checkShow'] += 1;

}else{
	if(!isset($_SESSION['checkShow'])){
		$_SESSION['checkShow'] = 0;
	}
}
$template->assign('checkShow',$_SESSION['checkShow']);


$captchakey = KEY_OF_SITE;
$template->assign('captchakey',$captchakey);
$_SESSION["randcode"]=rand(0001,9999);
if(isset($_SESSION["randcode"])){
	$newRand=$_SESSION["randcode"];
	$template->assign('newRand',$newRand);
}
$slug=$request->element('slug');
$template->assign('slug',$slug);
$page=$request->element('page');
$template->assign('page',$page);
$id=$request->element('id');
$template->assign('id',$id);

$action=$request->element('act');
$template->assign('action',$action);


$slug=$request->element('slug');
$template->assign('slug',$slug);



$timenow2 = date("Y-m-d H:i:s");
$timenow3 = strtotime($timenow2) + 415;
$timenow = date("Y-m-d H:i:s",$timenow3);

if(DEBUG && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {
$template->assign('currentOff',1);
}
$subCrpg = substr($crpg,0,27);
if($subCrpg == PROTOCOL.DOMAIN.':443/'){
	$link = substr($crpg,29);

}else{
	$link = substr($crpg,25);
}
$template->assign('link',$link);
$template->assign('lang',$lang);
if($crpg == PROTOCOL.DOMAIN.':443/'){
	$crpg = PROTOCOL.DOMAIN.":443/index.html";
}
if($subCrpg)$template->assign('subCrpg',$subCrpg);
// $template->assign('crpg',$crpg);
// $currentUrlx = getCurrentUrlNoLang($crpg,"skylead.vn");
// if($currentUrlx && $currentUrlx != ''){
// 	$currentUrlx1 = PROTOCOL.DOMAIN.'/'.$currentUrlx;
// }else{
// 	$currentUrlx1 = PROTOCOL.DOMAIN.'/';
// }
// if($currentUrlx1)$template->assign('currentUrlx1',$currentUrlx1);
$template->assign('crpg',$crpg);
$currentpage= "/".$lang."/".getCurrentURlLg($crpg,$lang);

$template->assign('currentpage',$currentpage);
if(getCurrentURlLg($crpg,$lang) && getCurrentURlLg($crpg,$lang) != ''){
	$currentUrlx1 = PROTOCOL.DOMAIN.$currentpage;
}else{
	$currentUrlx1 = PROTOCOL.DOMAIN.'/';
}
if($currentUrlx1)$template->assign('currentUrlx1',$currentUrlx1);
# Khởi tạo đối tượng cho các class : Các đối tượng này sẽ dùng cho toàn bộ teamplate nên không cần phải khởi tạo lại trong các module khác
	#1. Đối tượng dành cho class teamplate
	$estores = new EStores();
	$estore  = $estores->getObject(1);
	$template->assign("estore",$estore);
	$templates = new Templates();


	#3.	Đối tượng dành cho menu
	$menus = new Menus($storeId);
	$menucategories=new Menucategories();
	#4.	Đối tượng dành cho hình ảnh/banner
	$ads = new Ads($storeId);

	#5.	Đối tượng dảnh cho sportx

	#6.	Đối tượng dành cho chuyên mục tin tức
	$articleCategories = new ArticleCategories($sId);

	#7. Đối tương dành cho tin tức
	$articles= new Articles($storeId);


	$users = new Users($storeId);

$cId = 0;
$cCategory = '';
$pCategory = '';
$namear = '';
$permiss = '';
# Checking if this estore is enable
if($estore->getStatus() == S_EXPIRED) $act = 'suspended';
elseif($estore->getStatus() != S_ENABLED) $act = 'disabled';
if(isset($_SESSION['userId'])&& $_SESSION['userId'] != 0){

	$userIdC = $users->getObject($_SESSION['userId']);
	$permiss=$userIdC->getProperty('permissions');
	$namear=array_keys($permiss);
	foreach ($namear as $key => $value) {
		if($value == 'article'){
		$artiview=$permiss[''.$value.''];
		$namear=array_keys($artiview);
		}
		
	}
	$template->assign("arrayPer",$namear);


	$typeuser=$users->getTypeFromId($_SESSION['userId']);
	$last = date_create($userIdC->getLastLogin());
	$last1=date_format($last,'H:i:s');
	$idu=$_SESSION['userId'];
}


#Get user template
$templateId = $estore->getProperty('domain_template_id');
$userTemplate = $templates->getTemplateFolderFromId($templateId);
if(isset($_SESSION['template']))
$userTemplate=$_SESSION['template'];
if($request->element('template'))
$_SESSION['template']=$request->element('template');
if(!$userTemplate) $userTemplate = STANDARD_TEMPLATE;
//$userTemplate = 'tiffanyhotel';
# Add the template path of this estore to the template paths array
$template_dir[] = ROOT_PATH.TEMPLATE_PATH.'/'.$userTemplate.'/';
$template->assign('userTemplate',$userTemplate);
#Allow order
$orderOn = $estore->getProperty('order_on');
$template->assign('orderOn',$orderOn);


if(isset($_SESSION['userId']) && $_SESSION['userId'] !=0){
$currentUser= $users->getObject($_SESSION['userId']);
  if($currentUser){
    $template->assign('currentUser',$currentUser);
  }
}

# Include the appropriated action module
if ($act) include_once(ROOT_PATH.'modules/estore/'.strtolower($act).'.module.php');
#if ($act) include_once(ROOT_PATH.'modules/admin/login.module.php');
#var_dump(strtolower($act));
#Current Date
$date=date("l F j, Y");
$template->assign("date",$date);
# Assign the template variables
// $template->assign("carts",$carts);
$template->assign('userTemplate',$userTemplate);
$template->assign('estore',$estore);
$estore->setProperty('currency',1);
$estore->setProperty('rate',19000);
$estore->setProperty('accept_payment_wire',1);
$estore->setProperty('accept_payment_payoo',1);
$estore->setProperty('accept_payment_mobivi',1);
$estore->setProperty('accept_payment_nganluong',1);
$estore->setProperty('accept_payment_paypal',1);
$estore->setProperty('accept_payment_onepay',1);
$estore->setProperty('accept_payment_zingpay',1);
$logoimg =  PROTOCOL.DOMAIN.$estore->getProperty('custom_img_share');
$template->assign('logoimg',$logoimg);

// Change by Luan
$usingIE = 2;
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
	$usingIE = 1;
}
$template->assign('usingIE',$usingIE);


//One images header ... AdsCate->Images (Header) : 132
$imageNewsHeader = $ads->getObject(132,'gid');
if($imageNewsHeader) $template->assign('imageNewsHeader',$imageNewsHeader);

# Get the list Menus right
$menuRight = $menus->getObjects(1,"`status` = '1' AND `store_id` = 1 AND `mc_id` = '4' AND `parent_id` = 0",array("position" => "ASC"),20);
if($menuRight)$template->assign('menuRight',$menuRight);
//End change by Luan
?>