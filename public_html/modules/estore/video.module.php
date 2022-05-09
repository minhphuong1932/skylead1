<?php
// by luan
$templateFile = "video.tpl.html";
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);
include_once(ROOT_PATH.'classes/dao/article.class.php');
$article = new Articles($storeId);
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
$lang = $request->element('lang');
if(!$lang){
    $lang = "vn";
}
$pageTitle= "Video";
if($pageTitle) $template->assign('pageTitle',$pageTitle);

$getMenu = $menus->getObject(153);
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


$idVideo = '123';
$numberItem =1000;
// Slide video all ... AdsCate->Slide video : 123
$slideVideo = $ads->getObjects(1,"`status` = 1  AND `gid` = $idVideo ",array("position" => "DESC"),$numberItem);//get video = properties->custom_link_video
if($slideVideo) $template->assign('slideVideo',$slideVideo);

$page = $request->element('page');
$linkRedirect = "";
if($page) $linkRedirect .= "&page=".$page; 
$sort_type = $estore->getProperty('sort_type');
if(!$sort_type || $sort_type == ''){
    $sort_type = 'position';
}
$sort_dir = $estore->getProperty('sort_dir');
if(!$sort_dir || $sort_dir == ''){
    $sort_dir = 'ASC';
}
    if(!isset($numpro) || $numpro < 1){
        $numpro = $estore->getProperty('custom_quantity_video');

    $conditionL = "`status` = '1' AND `gid`= '$idVideo'";
    if(isset($_SESSION['decen']) && isset($_SESSION['ippde'])){
        $numtpro = $_SESSION['ippde'];
        if($_SESSION['decen'] != '0'){
            $sortdirPro = $_SESSION['decen'];
            $sorttypePro = 'after_discount';
        }else{
            $sortdirPro = $sort_dir;
            $sorttypePro = $sort_type;
        }
    }else{
        $sorttypePro = $sort_type;
        $sortdirPro = $sort_dir;
        $numtpro = $numpro;
    }
    $rowsPages = $ads->getNumItems('id',$conditionL,$numtpro);

    $template->assign('rowsPages',$rowsPages);
    if($page < 1) $page = 1;
    if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
    $listProductsx = $ads->getObjects($page,$conditionL,array($sorttypePro => $sortdirPro),$numtpro);
    $arrayFinalHome = array();
    if($listProductsx){
        foreach ($listProductsx as $keyf1 => $valuef1) {
            $proFinalItem1 = array();
            $proFinalItem1['idVideo'] = $valuef1->getId();
            $proFinalItem1['video'] = $valuef1->getProperty('custom_link_video');
            $proFinalItem1['content'] = $valuef1->getProperty('custom_content_ads');
            $proFinalItem1['content_en'] = $valuef1->getProperty('custom_en_sapo');
            $proFinalItem1['title'] = $valuef1->getProperty('custom_title_ads');
            $proFinalItem1['title_en'] = $valuef1->getProperty('custom_en_title');
            $proFinalItem1['videoclip'] = $valuef1->getProperty('logo');
            array_push($arrayFinalHome, $proFinalItem1);
        }
    }
    if($arrayFinalHome)$template->assign('arrayFinalHome',$arrayFinalHome);
    $end = $page * $numpro;
    if($end > $numpro) $start  = $end -  $numpro +1;
    else $start = 1;
    if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
    $template->assign('end',$end);
    $template->assign('start',$start);
    /// end page
    $url = "video&page=%d";
    $pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
    $template->assign('pager',$pager);
    //random video
    $listVideos = $ads->Random(123);
    if($listVideos)$template->assign('listVideos',$listVideos);
    #random news 
    $listNews = $article->RandomAll();
    if($listNews) $template->assign('listNews',$listNews);
}
#get topnav
$topNav=array();
$topNav =[
[
    
    "name"=>$messages['home'],
    "url"=>"/$lang/index.html"
],
[
    "name"=>"Video",
    "url"=>"/$lang/video.html"
],
];

if($topNav) $template->assign('topNav',$topNav);
?>