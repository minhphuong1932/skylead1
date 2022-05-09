<?php

/*************************************************************************
Estore index module
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/19/2010
 **************************************************************************/
$templateFile = 'index.tpl.html';

include_once(ROOT_PATH . 'classes/dao/templates.class.php');
include_once(ROOT_PATH . 'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH . 'classes/dao/articles.class.php');
include_once(ROOT_PATH . 'classes/dao/static.class.php');
include_once(ROOT_PATH . 'classes/dao/products.class.php');
include_once(ROOT_PATH . 'classes/dao/static.class.php');
include_once(ROOT_PATH . "classes/dao/estores.class.php");
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);
$articles = new Articles($storeId);


#create static
if (isset($_SESSION['checkout'])) {
	$_SESSION['checkout'] = "1";
} else {
	$_SESSION['checkout'] = "0";

	header('location:/');
	

}

if (isset($_SESSION['video'])) {
	$_SESSION['video'] = "1";
} else {
	if ($_SESSION['checkout'] != "0")
		$_SESSION['video'] = "0";
}
if (isset($_SESSION['video'])) {
	$template->assign('checkout',	$_SESSION['video']);
}





// Change by luan
# Get the list Menus top left
$menuTopLeft = $menus->getObjects(1,"`status` = '1' AND `store_id` = 1 AND `mc_id` = '1' AND `parent_id` = 0",array("position" => "ASC"),2);
if($menuTopLeft)$template->assign('menuTopLeft',$menuTopLeft);

# Get the list Menus top right
$menuTopRight = $menus->getObjects(1,"`status` = '1' AND `store_id` = 1 AND id > '155' AND `mc_id` = '1' AND `parent_id` = 0",array("position" => "ASC"),2);
if($menuTopRight)$template->assign('menuTopRight',$menuTopRight);

#Slide Khóa học
$slidesss = $articles->getObjects(1,"`status` = '1' AND `cat_id` = 193",array("position" => "ASC"),999);
if($slidesss)$template->assign('slidesss',$slidesss);

#Only video Fly an Plane  ( ID 626 )
$videoFlyPlane= $ads->getObject(626);
if($videoFlyPlane)$template->assign('videoFlyPlane',$videoFlyPlane);

#Only img thePlane  ( ID 627 )
$videoPlane = $ads->getObject(627);
if($videoPlane)$template->assign('videoPlane',$videoPlane);

#video thePlane 
$videoPlanesss = $ads->getObjects(1,"`status` = '1' AND `gid` = 133",array("position" => "ASC"),999);
if($videoPlanesss)$template->assign('videoPlanesss',$videoPlanesss);

#np3 ( ID 675)
$mp3Planesss= $ads->getObjects(1,"`status` = '1' AND `gid` = 134",array("position" => "ASC"),3);
if($mp3Planesss)$template->assign('mp3Planesss',$mp3Planesss);

#np3 ( ID 674)
// $mp3Planesss2= $ads->getObject(674);
// if($mp3Planesss2)$template->assign('mp3Planesss2',$mp3Planesss2);

#about ( ID 628)
$about= $ads->getObject(629);
if($about)$template->assign('about',$about);

#Become a pilot ( ID 629)
$becomeAPilot= $ads->getObject(628);
if($becomeAPilot)$template->assign('becomeAPilot',$becomeAPilot);
//End change by luan

?>