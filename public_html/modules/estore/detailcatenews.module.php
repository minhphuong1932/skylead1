<?php
// by luan
$id = $request->element('id'); 
if($id){
    include_once(ROOT_PATH.'classes/dao/article.class.php');
    $article = new Articles($storeId);
    include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
    $articleCategories = new ArticleCategories($sId);
    include_once(ROOT_PATH.'classes/http/url.class.php');
    $templateFile = 'totalnews.tpl.html';
    $lang = $request->element('lang');
    if(!$lang){
        $lang = "vn";
    }
    //Meta
    $cateArticle = $articleCategories->getObject($id);
    if($cateArticle) 
    {
        $pageDescription = "";
        if(!empty($cateArticle->getSapo($lang)))
            $pageDescription = $cateArticle->getSapo($lang);
        $pageKeywords = "";
        if(!empty($cateArticle->getKeyword($lang)))
            $pageKeywords = $cateArticle->getKeyword($lang);
        $pageTitle = "";
        if(!empty($cateArticle->getName($lang)))
            $pageTitle = $cateArticle->getName($lang);
        if(!empty($cateArticle->getProperty('avatar'))){
            $logoimg1 =  PROTOCOL.DOMAIN."/upload/1/articles/l_".$cateArticle->getProperty('avatar');
            $template->assign('logoimg1', $logoimg1);
        }
        $template->assign('cateArticle',$cateArticle);
        $template->assign('pageTitle',$pageTitle);
        $_SESSION['checkFromCateNews'] = 1;
        //end Meta
        
        //Get article = id cate
        $numberItem=100;
        $listArticle = $article->getObjects(1,"`status` = '1' AND `cat_id` = '$id' ",array("position" => "DESC"),$numberItem);
        if($listArticle)$template->assign('listArticle',$listArticle);
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
            $numpro = $estore->getProperty('custom_quantity_news');

        $conditionL = "`status` = '1' AND `cat_id`= '$id'";
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
        $rowsPages = $article->getNumItems('id',$conditionL,$numtpro);

        $template->assign('rowsPages',$rowsPages);
        if($page < 1) $page = 1;
        if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
        $listArticlessss = $article->getObjects($page,$conditionL,array($sorttypePro => $sortdirPro),$numtpro);
        $arrayFinalHome = array();
        if($listArticlessss){
            foreach ($listArticlessss as $keyf1 => $valuef1) {
                $proFinalItem1 = array();
                $proFinalItem1['img'] = "/upload/".$storeId."/articles/l_".$valuef1->getProperty('avatar');
                $proFinalItem1['sapo'] = $valuef1->getSapo($lang);
                $proFinalItem1['date_created'] = $valuef1->getDateCreated();
                $proFinalItem1['title'] = $valuef1->getTitle($lang);
                $proFinalItem1['slug'] = $valuef1->getSlug($lang).'-'.$valuef1->getId();
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
        $url = $slug."-".$id."&page=%d";
        $pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
        $template->assign('pager',$pager);
        }
        //end article
        #get topnav
        $topNav=array();
        if($lang =="vn"){
        $topNav =[
            [
                "name"=>$messages['home'],
                "url"=>"/$lang/index.html"
            ],
            [
                "name"=>$messages['news'],
                "url"=>"/$lang/tintuc.html"
            ],
            [
                "name"=>$cateArticle->getName($lang),
                "url"=>"/".$lang."/".$slug."-".$id.".html"
            ],

            ];
        }else{
        $topNav =[
            [
                "name"=>$messages['home'],
                "url"=>"/$lang/index.html"
            ],
            [
                "name"=>$messages['news'],
                "url"=>"/$lang/news.html"
            ],
            [
                "name"=>$cateArticle->getName($lang),
                "url"=>"/".$lang."/".$slug."-".$id.".html"
            ],

            ];
        }

        if($topNav) $template->assign('topNav',$topNav);

    }else{
        header('Location:/404.html');
    }
    
}else{
    header('Location:/404.html');
}


?>