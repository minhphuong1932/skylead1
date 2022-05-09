<?php
// By luan
$id = $request->element('id'); 
if($id){
    include_once(ROOT_PATH.'classes/dao/ads.class.php');
    $ads = new ads($storeId);
    include_once(ROOT_PATH.'classes/dao/article.class.php');
    $article = new Articles($storeId);
    include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
    $articleCategories = new ArticleCategories($storeId);
    $detailVideo = $ads->getObject($id);
    if($detailVideo){
        $templateFile = 'detailvideo.tpl.html';
        $pageDescription = "";
        if(!empty($detailVideo->getProperty('custom_content_ads')))
            $pageDescription = $detailVideo->getProperty('custom_content_ads');
        $pageKeywords = "";
        if(!empty($detailVideo->getProperty('custom_keyword_ads')))
            $pageKeywords = $detailVideo->getProperty('custom_keyword_ads');
        $pageTitle = "";
        if(!empty($detailVideo->getProperty('custom_title_ads')))
        $pageTitle = $detailVideo->getProperty('custom_title_ads');
        if(!empty($detailVideo->getProperty('logo'))){
            $logoimg1 =  PROTOCOL.DOMAIN."/upload/1/resources/l_".$detailVideo->getProperty('logo');
            $template->assign('logoimg1', $logoimg1);
        }
        if($detailVideo)$template->assign('detailVideo',$detailVideo);
        #all Videos
        $listVideos = $ads->getObjects(1,"`status` = '1' AND `gid` = '123' ",array("position" => "DESC"),10000);
        if($listVideos)$template->assign('listVideos',$listVideos);
        #random news 
        $listNews = $article->RandomAll();
        if($listNews) $template->assign('listNews',$listNews);
        #get topnav
        $topNav=array();
        $topNav =[
        [
            "name"=>"Trang Chủ",
            "url"=>"/"
        ],
        [
            "name"=>$detailVideo->getProperty('custom_title_ads'),
            "url"=>"/video-$id"
        ],
        ];
        if($topNav)$template->assign('topNav',$topNav);
    }else{
        header('Location:/404.html');
    }
}



?>