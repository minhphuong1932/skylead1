<?php
// Change by luan
$id = $request->element('id'); 
if($id){
    include_once(ROOT_PATH.'classes/dao/ads.class.php');
    $ads = new Ads($storeId);
    include_once(ROOT_PATH.'classes/dao/article.class.php');
    $article = new Articles($storeId);
    include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
    $articleCategories = new ArticleCategories($storeId);
    include_once(ROOT_PATH.'classes/http/url.class.php');
    $lang = $request->element('lang'); 
    if(!$lang){
        $lang="vn";
    }
    #get Categories... Get all cate chỉld => get all id child
    $listCategory = $articleCategories->getObjects(1,"`status` = '1' AND `parent_id` = '185' ",array("position" => "DESC"),200);
    if($listCategory){
        #getId cartegory child
        $arrayIdCategory=array();
        foreach($listCategory as $category){
            array_push($arrayIdCategory,$category->getId());
        }
        $listIdCategory="";
        //push id 190 question
        array_push($arrayIdCategory,"190");
        if($arrayIdCategory)
        $listIdCategory=implode(",",$arrayIdCategory);
        $idCat = $article->getCatIdFromId($id);
        $cateArticle = $articleCategories->getObject($id);
        if($idCat){
            $template->assign('idCat',$idCat);
            //Check idCat exists in listIdCategory , check to split into two interfaces
            if(strpos($listIdCategory,$idCat) !== false){
                $templateFile = 'detailplane.tpl.html';
                $itemArticle = $article->getObject($id);
                if($itemArticle) 
                {
                    $pageDescription = "";
                    if(!empty($itemArticle->getSapo($lang)))
                        $pageDescription = $itemArticle->getSapo($lang);
                    $pageKeywords = "";
                    if(!empty($itemArticle->getKeyword($lang)))
                        $pageKeywords = $itemArticle->getKeyword($lang);
                    $pageTitle = "";
                    if(!empty($itemArticle->getTitle($lang)))
                    $pageTitle = $itemArticle->getTitle($lang);
                    if(!empty($itemArticle->getProperty('avatar'))){
                        $logoimg1 =  PROTOCOL.DOMAIN."/upload/1/articles/l_".$itemArticle->getProperty('avatar');
                        $template->assign('logoimg1', $logoimg1);
                    }
                    $template->assign('itemArticle',$itemArticle);
                    $position = $itemArticle->getPosition();
                    //Next , get news in sql greater news $id;
                    $listNewsNext = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory) AND `position` > $position",array("position" => "ASC"),1);
                    // if no exists id whichever is greater , then id next is first id
                    if($listNewsNext == '0'){
                        $listNewsNext = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory)",array("position" => "ASC"),1);
                        //get idNextGreater check with idBack , check duplicate if duplicate hide else show 
                        //if there are two article , when click into the second article , the next button will be lost because there are no article next only there are  button back  
                        foreach($listNewsNext as $itemId){
                            $idNextGreater = $itemId->getId();
                        }
                        if($idNextGreater)$template->assign('idNextGreater',$idNextGreater);
                        $template->assign('listNewsNext',$listNewsNext);
                    }
                    if($listNewsNext){
                        foreach($listNewsNext as $itemId){
                            $idNext = $itemId->getId();
                        }
                        if($idNext)$template->assign('idNext',$idNext);
                        $template->assign('listNewsNext',$listNewsNext);
                    }


                    //Back , get news in sql smaller news $id;
                    $listNewsBack = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory) AND `position` < $position",array("position" => "DESC"),1);
                    // if no exists id whichever is smaller , then id back is last id
                    if($listNewsBack == '0'){
                        $listNewsBack = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory)",array("position" => "DESC"),1);
                        //get IdidBackSmaller check with idNext , check duplicate if duplicate hide else show
                        //if there are two article , when click into the first article , the back button will be lost because there are no article back only there are  button next  
                        foreach($listNewsBack as $itemId){
                            $idBackSmaller = $itemId->getId();
                        }
                        if($idBackSmaller)$template->assign('idBackSmaller',$idBackSmaller);
                        $template->assign('listNewsBack',$listNewsBack);
                    }
                    if($listNewsBack){
                        foreach($listNewsBack as $itemId){
                            $idBack  = $itemId->getId();
                        }
                        if($idBack)$template->assign('idBack',$idBack);
                        $template->assign('listNewsBack',$listNewsBack);
                    }
                }
                //cat_id = idCat but News <> $id 
                // $listNews = $article->getObjects(1,"`status` = '1' AND `cat_id` IN ($listIdCategory) AND `id` <> $id ",array("position" => "DESC"),3);
                // if($listNews) $template->assign('listNews',$listNews);

            

                #get topnav
                $topNav=array();
                if($lang =="vn"){
                    $topNav =[
                        [
                            "name"=>$messages['home'],
                            "url"=>"/$lang/index.html"
                        ],
                        [
                            "name"=>$messages['become_a_pilot'],
                            "url"=>"/$lang/conduongtrothanhphicong.html"
                        ],
                        [
                            "name"=>$itemArticle->getTitle($lang),
                            "url"=>"/".$lang."/".$slug."-".$id
                        ],
                        ];
                }else{
                    $topNav =[
                        [
                            "name"=>$messages['home'],
                            "url"=>"/$lang/index.html"
                        ],
                        [
                            "name"=>$messages['become_a_pilot'],
                            "url"=>"/$lang/how.html"
                        ],
                        [
                            "name"=>$itemArticle->getTitle($lang),
                            "url"=>"/".$lang."/".$slug."-".$id
                        ],
                        ];
                }
                if($topNav)$template->assign('topNav',$topNav);
            }else{
                $templateFile = 'detailnews.tpl.html';
                $itemArticle = $article->getObject($id);
                if($itemArticle) 
                {
                    $pageDescription = "";
                    if(!empty($itemArticle->getSapo($lang)))
                        $pageDescription = $itemArticle->getSapo($lang);
                    $pageKeywords = "";
                    if(!empty($itemArticle->getKeyword($lang)))
                        $pageKeywords = $itemArticle->getKeyword($lang);
                    $pageTitle = "";
                    if(!empty($itemArticle->getTitle($lang)))
                    $pageTitle = $itemArticle->getTitle($lang);
                    if(!empty($itemArticle->getProperty('avatar'))){
                        $logoimg1 =  PROTOCOL.DOMAIN."/upload/1/articles/l_".$itemArticle->getProperty('avatar');
                        $template->assign('logoimg1', $logoimg1);
                    }
                    $template->assign('itemArticle',$itemArticle);
                }
                //Random news different != $id
                $listNews = $article->RanDom($idCat,$id);
                if($listNews) $template->assign('listNews',$listNews);
                //get Title cateArticle from idCat
                $cate = $articleCategories->getObject($idCat,'id');
                $titleCateArticle = $cate->getName($lang);
                if($titleCateArticle)$template->assign('titleCateArticle',$titleCateArticle);
                //from id get slug cateArticle -> click see more
                $slugCateArticle = $cate->getSlug($lang)."-".$cate->getId();
                if($slugCateArticle)$template->assign('slugCateArticle',$slugCateArticle);
                //check pass page totalnews 
                if(!empty($_SESSION['checkFromCateNews'])){
                    $checkExists = $_SESSION['checkFromCateNews'];
                    #get topnav
                    $topNav=array();
                    if($checkExists == 1){
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
                                    "name"=>$titleCateArticle,
                                    "url"=>$slugCateArticle
                                ],
                                [
                                    "name"=>$itemArticle->getTitle($lang),
                                    "url"=>"/".$lang."/".$slug."-".$id
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
                                    "name"=>$titleCateArticle,
                                    "url"=>$slugCateArticle
                                ],
                                [
                                    "name"=>$itemArticle->getTitle($lang),
                                    "url"=>"/".$lang."/".$slug."-".$id
                                ],
                                ];
                        }
                   
                    if($topNav)$template->assign('topNav',$topNav);
                    }
                }else{
                    if($lang == "vn"){
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
                                "name"=>$itemArticle->getTitle($lang),
                                "url"=>"/".$lang."/".$slug."-".$id
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
                                "name"=>$itemArticle->getTitle($lang),
                                "url"=>"/".$lang."/".$slug."-".$id
                            ],
                            ];
                    }
                 
                    if($topNav)$template->assign('topNav',$topNav);
                }
            }
        }elseif($cateArticle){
            $templateFile = 'totalnews.tpl.html';
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
                    "url"=>"/".$lang."/".$slug."-".$id
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
                    "url"=>"/".$lang."/".$slug."-".$id
                ],
    
                ];
            }
    
            if($topNav) $template->assign('topNav',$topNav);
        
        }else{
            header('Location:/404.html');
        }
    }
}else{
    header('Location:/404.html');
}


?>