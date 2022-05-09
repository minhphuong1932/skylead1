<?php
# Create Google Sitemap for Viviann Shop
# Created by Mai Minh minh@maingo.com
# Date: 28/11/2006
# Update By PhanTom 19/12/2013
#---------------------------------
# Autodetect current root folder
if (!defined( "ROOT_PATH" )) {
	define("ROOT_PATH", dirname(__FILE__)."/");
}
include_once(ROOT_PATH.'includes/constant.inc.php');
include_once(ROOT_PATH.'includes/config.inc.php');
include_once(ROOT_PATH.'classes/data/translator.class.php');
include_once(ROOT_PATH.'includes/functions.inc.php');
include_once(ROOT_PATH.'classes/database/mysql.class.php');
include_once(ROOT_PATH.'classes/template/smarty.class.php');
include_once(ROOT_PATH.'classes/http/request.class.php');
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/estores.class.php');
include_once(ROOT_PATH.'classes/dao/languages.class.php');
//include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH.'classes/dao/articles.class.php');
include_once(ROOT_PATH.'classes/dao/menus.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');

$db = new DB();
$url = new Url();
$estores = new EStores();
$articleCategories = new ArticleCategories(1);
$articles = new Articles(1);
$estore = $estores->getObject(1);
$menus = new Menus(1);
$ads = new Ads(1);
$link = mysqli_connect($config["db_server"],$config["db_user"],$config["db_pwd"]);
mysqli_select_db ($link,$config["db_name"]) or die ("Cannot connect database!");
#getAllSubCategoryArray
//include_once(ROOT_PATH.'classes/dao/domains.class.php');
//$domains = new Domains(); 
# Table Prefix in the database
$tableprefix = 'dc_';

// $url = 'http://demo.msdland.vn/';

$url = PROTOCOL.DOMAIN;
#$domain = $rowdomain['name'];
# Path to the index (with trailing slash)
#$url = $_SERVER['HTTP_HOST'];
$sitemap_file = "sitemap.xml";

# Priotity settings
$week_prio = 0.5;
$item_prio = 0.3;
$cat_prio = 0.8;

# Update frequency
$weekly = 'weekly';
$item_update = 'weekly';
$cat_update = 'daily';
$content = "";


$content .= xml_head($url);

# Print XML header
$trangchu = $url;
$logo = $estore->getProperty('store_logo');
$defaultImg = $url.`/`.$logo;
$caption = $estore->getProperty('custom_title_seo');
$imgTitle = $estore->getProperty('custom_title_seo');
$captionEN = $estore->getProperty('custom_title_seo_en');
$imgTitleEN = $estore->getProperty('custom_title_seo_en');
$content .= print_xml($trangchu,$item_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$imgTitle);
$content .= print_xml($trangchu,$item_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$imgTitleEN);

// #------------------------List Video-------------------------------
// $slideVideo = $ads->getObjects(1,"`status` = 1  AND `gid` = 123 ",array("position" => "DESC"),10000);
// if($slideVideo){
// 	foreach ($slideVideo as $key => $value){
// 	$video = $url.'/video'.'-'.$value->getId();
// 	$img =  $value->getProperty('logo');
//     if($img){
// 	    	$img =$url."/upload/1/resources/l_".$img;
// 	}else{
// 		$img=$defaultImg;
// 	}
// 	$contentVideo= $value->getProperty('custom_title_ads');
// 	$content .= print_xml($video,$item_prio,date("Y-m-d"),$item_update,$img,$contentVideo,$contentVideo);
	
// 	}
// }

#------------------------List news-------------------------------
$articleAll = $articles->getObjects(1,"`status` = 1",array("position" => "DESC"),10000);
if($articleAll){
	foreach ($articleAll as $key => $value){
	$articlesss = $url.'/vn/'.$value->getSlug('vn').'-'.$value->getId();
	$articlesssEn = $url.'/en/'.$value->getSlug('en').'-'.$value->getId();
	$img =  $value->getProperty('avatar');
    if($img){
	    	$img =$url."/upload/1/articles/l_".$img;
	}else{
		$img=$defaultImg;
	}
	$contentArticle= $value->getTitle('vn');
	$contentArticleEn= $value->getTitle('en');
	$caption = $value->getSapo('vn');
	$captionEn = $value->getProperty('custom_tomtattienganh');
	$content .= print_xml($articlesss,$item_prio,date("Y-m-d"),$item_update,$img,$caption,$contentArticle);
	$content .= print_xml($articlesssEn,$item_prio,date("Y-m-d"),$item_update,$img,$captionEn,$contentArticleEn);
	}
}


// #------------------------List cate news------------------------------- K lấy id 185 và 177 và parent_id 185
$articleCateNewsDay = $articleCategories->getObjects(1,"`status` = 1 AND `id` <> 185 AND `id` <> 190 AND `id` <> 177 AND `parent_id` <> 185",array("position" => "DESC"),10000);
if($articleCateNewsDay){
	foreach ($articleCateNewsDay as $key => $value){
	$articleCate = $url.'/vn/'.$value->getSlug('vn').'-'.$value->getId();
	$articleCateEN = $url.'/en/'.$value->getSlug('en').'-'.$value->getId();
	$img =  $value->getProperty('avatar');
    if($img){
	    	$img =$url."/upload/1/articles/l_".$img;
	}else{
		$img=$defaultImg;
	}
	$contentArticleCateNewsDay= $value->getName('vn');
	$contentArticleCateNewsDayEN= $value->getName('en');
	$caption = $value->getSapo('vn');
	$captionEn = $value->getSapo('en');
	$content .= print_xml($articleCate,$item_prio,date("Y-m-d"),$item_update,$img,$caption,$contentArticleCateNewsDay);
	$content .= print_xml($articleCateEN,$item_prio,date("Y-m-d"),$item_update,$img,$captionEn,$contentArticleCateNewsDayEN);
	}
}



#menu right
$menus = $menus->getObjects(1,"`status` = '1' AND `parent_id`=0",array("id" => "DESC"),2000);
foreach ($menus as $key => $value){
	if($value->getUrl()!=""){
		if($value->getProperty('custom_img_meta') && $value->getProperty('custom_img_meta')!=""){
			$defaultImg = $value->getProperty('custom_img_meta');
		}else{
			$defaultImg = $url.`/`.$logo;
		}
		$contentartice= "/vn/".$value->getUrl('vn');
		$contentartice1= str_replace("<br>","",$value->getName('vn'));
		$contentarticeEN= "/en/".$value->getUrl('en');
		$contentartice1EN= str_replace("<br>","",$value->getName('en'));
		if($value->getProperty('custom_desc_news_en') && $value->getProperty('custom_desc_news_en')!=""){
			$captionEN = $value->getProperty('custom_desc_news_en');
		}else{
			$captionEN = $estore->getProperty('custom_title_seo_en');
		}
		if($value->getProperty('custom_custom_desc_news_vn') && $value->getProperty('custom_custom_desc_news_vn')!=""){
			$caption = $value->getProperty('custom_custom_desc_news_vn');
		}else{
			$caption = $estore->getProperty('custom_title_seo');
		}
		$menus = $url.$contentartice;
		$menusEN = $url.$contentarticeEN;
		$content .= print_xml($menus,$item_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$contentartice1);	
		$content .= print_xml($menusEN,$item_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$contentartice1EN);	
	}
}

// #main
$main = $url."/vn/landingpage.html";
$content .= print_xml($main,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$imgTitle);
$mainEN = $url."/en/landingpage.html";
$content .= print_xml($mainEN,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$imgTitleEN);
// #how
// $main = $url."/vn/conduongtrothanhphicong.html";
// $main1 = $url."/en/conduongtrothanhphicong.html";
// $main2 = $url."/vn/how.html";
// $main3 = $url."/en/how.html";
// $content .= print_xml($main,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$imgTitle);
// $content .= print_xml($main1,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$imgTitleEN);
// $content .= print_xml($main2,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$imgTitle);
// $content .= print_xml($main3,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$imgTitleEN);
// #about
// $main = $url."/vn/vechungtoi.html";
// $main1 = $url."/en/vechungtoi.html";
// $main2 = $url."/vn/about.html";
// $main3 = $url."/en/about.html";
// $content .= print_xml($main,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$imgTitle);
// $content .= print_xml($main1,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$imgTitleEN);
// $content .= print_xml($main2,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$caption,$imgTitle);
// $content .= print_xml($main3,$cat_prio,date("Y-m-d"),$item_update,$defaultImg,$captionEN,$imgTitleEN);


# Print XML footer
$content .= xml_foot();
write_local_file($sitemap_file,$content);
echo "Success!";

function xml_head($url) {
	$freq = 'daily';
	$priority = '1.0';
	//$mod = date('c', time());
	$mod = date("Y-m-d")."T".date("H:i:s")."+00:00";
	$str = "<?xml version='1.0' encoding='UTF-8'?>
	<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:image=\"http://www.google.com/schemas/sitemap-image/1.1\">	
<url>
  <loc>$url</loc>
  <lastmod>$mod</lastmod>
  <changefreq>$freq</changefreq>
  <priority>$priority</priority>
</url>";
	return $str;
}
#-----------------------------------------------
# xml_foot
#-----------------------------------------------
function xml_foot() {
	$str = "
</urlset>";
	return $str;
}

#-----------------------------------------------
# print_xml
#-----------------------------------------------
function print_xml($url,$priority,$lastmod,$changefreq,$defaultImg,$caption,$imgTitle) {
	if($url != ''){
			$str = "
<url>
  <loc>$url</loc>
  <priority>$priority</priority>
  <lastmod>$lastmod</lastmod>
  <changefreq>$changefreq</changefreq>
  <image:image>
      <image:loc>$defaultImg</image:loc>
      <image:caption>$caption</image:caption>
      <image:title>$imgTitle</image:title>
    </image:image>
</url>";
	return $str;
}
	}

?>
