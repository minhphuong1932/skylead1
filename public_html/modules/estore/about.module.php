<?php
// by luan
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);

include_once(ROOT_PATH.'classes/dao/article.class.php');
$article = new Articles($storeId);

include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
$articleCategories = new ArticleCategories($sId);
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
$getMenu = $menus->getObject(155);
if($getMenu){
	if($lang=="vn"){
		$pageDescription = "";
		if(!empty($getMenu->getProperty('custom_custom_desc_news_vn')))
		    $pageDescription = $getMenu->getProperty('custom_custom_desc_news_vn');
		$pageKeywords = "";
		if(!empty($getMenu->getProperty('custom_keyword_vn')))
		    $pageKeywords = $getMenu->getProperty('custom_keyword_vn');
	}else{
		$pageDescription = "";
		if(!empty($getMenu->getProperty('custom_desc_news_en')))
		    $pageDescription = $getMenu->getProperty('custom_desc_news_en');
		$pageKeywords = "";
		if(!empty($getMenu->getProperty('custom_keyword_en')))
		    $pageKeywords = $getMenu->getProperty('custom_keyword_en');
	}
		$pageTitle = "";
		if(!empty($getMenu->getName($lang)))
		    $pageTitle = $getMenu->getName($lang);
		if(!empty($getMenu->getProperty('custom_img_meta'))){
		    $logoimg1 =  PROTOCOL.DOMAIN.$getMenu->getProperty('custom_img_meta');
		    $template->assign('logoimg1', $logoimg1);
		}
}


$templateFile = 'about.tpl.html';
$pageTitle = $messages['about'];
if($pageTitle) $template->assign('pageTitle',$pageTitle);

//One images header ... AdsCate->Slide Leading your sky	 : 127
$imageHeader = $ads->getObject(127,'gid');
if($imageHeader) $template->assign('imageHeader',$imageHeader);

// slide ... AdsCate->Slide Cảm hứng	 : 130
$slideInspiration = $ads->getObjects(1,"`status` = '1' AND `gid` = 130",array("position" => "DESC"),5000);
if($slideInspiration) $template->assign('slideInspiration',$slideInspiration);

// slide ... AdsCate->Slide Người bạn đồng hành		 : 131
$slideCompanion = $ads->getObjects(1,"`status` = '1' AND `gid` = 131",array("position" => "DESC"),5000);
if($slideCompanion) $template->assign('slideCompanion',$slideCompanion);

//Image Footer	 ... AdsCate->Image Footer		 : 128
$imageFooter = $ads->getObjects(1,"`status` = '1' AND `gid` = 128",array("position" => "DESC"),5000);
if($imageFooter) $template->assign('imageFooter',$imageFooter);


?>