<?php
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);

$idVideo = $request->element('idVideo');
if($idVideo){
    $detailVideo = $ads->getObject($idVideo);
    if($detailVideo){
        $video = $detailVideo->getProperty('logo');
        $content = $detailVideo->getProperty('custom_content_ads');
        $title = $detailVideo->getProperty('custom_title_ads');
    }
    $gid = 123;
    $listVideos = $ads->Random($gid,$idVideo);
    if($listVideos){
        $arrayVideos = array();
        foreach($listVideos as $value){
            $arrayList = array();
            $arrayList['video'] = $value->getProperty('logo');
            $arrayList['content'] = $value->getProperty('custom_content_ads');
            $arrayList['title'] = $value->getProperty('custom_title_ads');
            array_push($arrayVideos,$arrayList);
        }
    }
}
$result=array("video" => $video,"content" => $content,"title" => $title,"arrayVideos"=>$arrayVideos);
echo json_encode($result);

?>