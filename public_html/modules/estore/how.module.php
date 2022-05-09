<?php
// By luan
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);

include_once(ROOT_PATH.'classes/dao/article.class.php');
$article = new Articles($storeId);

include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
$articleCategories = new ArticleCategories($sId);
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
$getMenu = $menus->getObject(154);
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



$templateFile = 'how.tpl.html';
$pageTitle = $messages['become_a_pilot'];
if($pageTitle) $template->assign('pageTitle',$pageTitle);
// get Con đường trở thành phi công ... Ads->Con đường trở thành phi công : 	125
$newsPilot = $ads->getObjects(1,"`status` = '1'  AND `gid` = 125 ",array("position" => "DESC"),1);//get image = properties->logo
if($newsPilot) $template->assign('newsPilot',$newsPilot);

// $cateSchool = $articleCategories->getObject(178,'id');//get image = properties->logo
// if($cateSchool) $template->assign('cateSchool',$cateSchool);

// $cateRegister = $articleCategories->getObject(179,'id');//get image = properties->logo
// if($cateRegister) $template->assign('cateRegister',$cateRegister);

// $cateAccumulation = $articleCategories->getObject(180,'id');//get image = properties->logo
// if($cateAccumulation) $template->assign('cateAccumulation',$cateAccumulation);

// $cateConnected = $articleCategories->getObject(184,'id');//get image = properties->logo
// if($cateConnected) $template->assign('cateConnected',$cateConnected);

// //One images header ... AdsCate->Images (Header) : 132
// $imageHeader = $ads->getObject(125,'gid');//get image = properties->logo
// if($imageHeader) $template->assign('imageHeader',$imageHeader);

// //Article get School ... AdsCate->trường học : 	178
// $newsSchool = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 178 ",array("position" => "DESC"),99999);//get image = properties->logo
// if($newsSchool) $template->assign('newsSchool',$newsSchool);

// //Article get Register ... AdsCate->đăng ký : 	179
// $newsRegister = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 179 ",array("position" => "DESC"),99999);//get image = properties->logo
// if($newsRegister) $template->assign('newsRegister',$newsRegister);

// //Article get Accumulation ... AdsCate->đăng ký : 	180
// $newsAccumulation = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 180 ",array("position" => "DESC"),99999);//get image = properties->logo
// if($newsAccumulation) $template->assign('newsAccumulation',$newsAccumulation);

// //Article get Connected ... AdsCate->kết nối: 	184
// $newsConnected = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 184 ",array("position" => "DESC"),99999);//get image = properties->logo
// if($newsConnected) $template->assign('newsConnected',$newsConnected);

#get Categories ... 
$listCategory = $articleCategories->getObjects(1,"`status` = '1' AND `parent_id` = '185' ",array("position" => "ASC"),5000);
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
		$listArticleChild = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory)",array("position" => "ASC"),5000);
		if($listArticleChild){
			foreach($listCategory as $categoryItem){
				$arrayItem=array();
				$arrayItem["name"]=$categoryItem->getName($lang);
				$arrayItem["id"]=$categoryItem->getId();
				$arrayItem["position"]=$categoryItem->getPosition();
				$arrayItem["url"]=$categoryItem->getUrl();
				$arrayItem["avatar"]=$categoryItem->getProperty('avatar');
				$arrayItem["css"]=$categoryItem->getProperty('custom_css');
				$arrayListArticle=array();
				foreach($listArticleChild as $itemArticleChild){
					if($itemArticleChild->getCatId() == $categoryItem->getId()){
						$articleItem=array();
						$articleItem["name"]=$itemArticleChild->getTitle($lang);
						$articleItem["id"]=$itemArticleChild->getId();
						$articleItem["slug"]=$itemArticleChild->getSlug($lang);
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
 //Article get Question ... AdsCate->câu hỏi : 		190
$newsquestion = $article->getObjects(1,"`status` = '1'  AND `cat_id` = 190 ",array("position" => "ASC"),5000);//get image = properties->logo
if($newsquestion) $template->assign('newsquestion',$newsquestion);

?>