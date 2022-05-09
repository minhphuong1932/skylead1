<?php
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);



$idVideo = '123';
$numberItem =100;

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
            $proFinalItem1['video'] = $valuef1->getProperty('custom_link_video');
            $proFinalItem1['content'] = $valuef1->getProperty('custom_content_ads');
            $proFinalItem1['title'] = $valuef1->getProperty('custom_title_ads');
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
    $url = "%d";
    $pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
    $template->assign('pager',$pager);

}

$result=array("arrayFinalHome" => $arrayFinalHome,"pager"=>$pager);
echo json_encode($result);

?>