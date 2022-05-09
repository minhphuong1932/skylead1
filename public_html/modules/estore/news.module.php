<?php
// Change by luan

include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);
include_once(ROOT_PATH.'classes/dao/article.class.php');
$article = new Articles($storeId);
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
$articleCategories = new ArticleCategories($sId);
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
$lang = $request->element('lang');
if(!$lang) $lang='vn';


$_SESSION["randcode"]=rand(0001,9999);
if(isset($_SESSION["randcode"])){
	$newRand=$_SESSION["randcode"];
	$template->assign('newRand',$newRand);
}
$_SESSION['checkFromCateNews'] = 0;


$getMenu = $menus->getObject(152);
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


$templateFile = 'news.tpl.html';



//Slide news all ... article->Slide tin tức : 192
$slideNews = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 192 ",array("position" => "DESC"),5000);
if($slideNews) $template->assign('slideNews',$slideNews);



//Article get NewsDay ... article->Tin tức trong ngày : 175
$newsDay = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 175 ",array("position" => "DESC"),3);
if($newsDay) $template->assign('newsDay',$newsDay);
$titleCateNewsDay = $articleCategories->getObjects(1,"`status` = '1'  AND `id` = 175 ",array("position" => "DESC"),1);//get cate name 
if($titleCateNewsDay) $template->assign('titleCateNewsDay',$titleCateNewsDay);

//Slide new course  all ... article->Slide khóa học mới : 193
$slideNewsCourse = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 193 ",array("position" => "DESC"),5000);
if($slideNewsCourse) $template->assign('slideNewsCourse',$slideNewsCourse);


#get Categories ... theo chủ đề
$listCategory = $articleCategories->getObjects(1,"`status` = '1' AND `parent_id` = '177' ",array("position" => "DESC"),2000);
$finalData = array();
if($listCategory)
{
    #getId cartegory child
	$arrayIdCategory=array();
	foreach($listCategory as $category){
		array_push($arrayIdCategory,$category->getId());
	}
	$listIdCategory="";
	if($arrayIdCategory)
	$listIdCategory=implode(",",$arrayIdCategory);
	if($listIdCategory!=""){
        #get ArticleChild
		// $listArticleChild = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory)",array("id" => "DESC"),9);
		if($listCategory){
			foreach($listCategory as $categoryItem){
				$arrayItem=array();
				$arrayItem["name"]=$categoryItem->getName($lang);
				$arrayItem["url"]=$categoryItem->getSlug($lang)."-".$categoryItem->getId();
				$id = $categoryItem->getId();
				$arrayListArticle=array();
				$listArticleChild = $article->getObjects(1,"`status` = '1' AND `cat_id` = $id",array("id" => "DESC"),3);
				foreach($listArticleChild as $itemArticleChild){
					if($itemArticleChild->getCatId() == $categoryItem->getId()){
						$articleItem=array();
						$articleItem["name"]=$itemArticleChild->getTitle($lang);
						$articleItem["avatar"]="/upload/".$storeId."/articles/l_".$itemArticleChild->getProperty('avatar');
						$articleItem["slug"]= $lang."/".$itemArticleChild->getSlug($lang)."-".$itemArticleChild->getId();
						$articleItem["date_created"]=$itemArticleChild->getDateCreated();
						$articleItem["sapo"]=$itemArticleChild->getSapo($lang);
						array_push($arrayListArticle,$articleItem);
					}
				}
				$arrayItem["listArticle"]=$arrayListArticle;
				array_push($finalData,$arrayItem);
			}
		}	
	}
}
if($finalData)$template->assign('finalData',$finalData);



#get Topnav
$topNav=array();
if($lang=="vn"){
$topNav =[
[
    "name"=>$messages['home'],
    "url"=>"/"
],
[
    "name"=>$messages['news'],
    "url"=>"/tintuc.html"
],
];
}
if($topNav) $template->assign('topNav',$topNav);
?>