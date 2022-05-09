<?php
// Change by luan
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);
include_once(ROOT_PATH.'classes/dao/article.class.php');
include_once(ROOT_PATH.'classes/dao/consultant.class.php');
$consultant = new Consultant($storeId);
$article = new Articles($storeId);
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
$articleCategories = new ArticleCategories($storeId);
include_once(ROOT_PATH.'classes/http/url.class.php');
$lang = $request->element('lang'); 
if(!$lang){
    $lang="vn";
}
// var_dump(1);die;
// var_dump($consultant);die;
$templateFile = 'landingpage.tpl.html';

$objArticle = $article->getObject(981);
if($objArticle){
    $pageDescription = "";
    if(!empty($objArticle->getSapo($lang)))
        $pageDescription = $objArticle->getSapo($lang);
    $pageKeywords = "";
    if(!empty($objArticle->getKeyword($lang)))
        $pageKeywords = $objArticle->getKeyword($lang);
    $pageTitle = "";
    if(!empty($objArticle->getTitle($lang)))
    $pageTitle = $objArticle->getTitle($lang);
    if(!empty($objArticle->getProperty('avatar'))){
        $logoimg1 =  PROTOCOL.DOMAIN."/upload/1/articles/l_".$objArticle->getProperty('avatar');
        $template->assign('logoimg1', $logoimg1);
    }
    $template->assign('objArticle',$objArticle);
}else{
    header('Location:/404.html');
}



if($_POST && $request->element('doo') == 'submit') {
     # if form is submitted
    $validate = validateData($request);
    
    if($validate['invalid']) {
        # data input is not in valid form
        $template->assign('error',$validate);	
        $template->assign("infoClass","error");
        $template->assign('note',$messages["register_error"]);
        // var_dump($validate);die;
    } else { # Valid data input
        // if($customers->checkDuplicate($request->element('tel'),'tel')) {
        // 	$validate['INPUT']['tel']['message'] = $amessages['tel_duplicated'];
        // 	$validate['INPUT']['tel']['error'] = 1;
        // 	$validate['invalid'] = 1;
        // 	$template->assign('error',$validate);
        // }
    
        
        // $emailnew = $request->element('email');
        // if($customers->checkDuplicate($emailnew,'email')) {
        //     $validate['INPUT']['email']['message'] = $amessages['email_duplicated'];
        //     $validate['INPUT']['email']['error'] = 1;
        //     $validate['invalid'] = 1;
        //     $template->assign('error',$validate);
        // }
        // if($customers->checkDuplicate($request->element('tel'),'tel')) {
        // 	$validate['INPUT']['tel']['message'] = "Số điện thoại đã được đăng ký";
        // 	$validate['INPUT']['tel']['error'] = 1;
        // 	$validate['invalid'] = 1;
        // 	$template->assign('error',$validate);
        // }
        

        // $template->assign('error',$validate);	
        // $template->assign("infoClass","error");
        // // var_dump($validate);
        // $template->assign('note',$messages["register_error"]);
        # Everything is ok. Add data to DB
        if(!$validate['invalid']) {
            
            $properties = array();
    
            $data = array('store_id' => $storeId,
                      'type' => 0,
                      'fullname' => $request->element('planename'),
                      'phone' => $request->element('planephone'),
                      'email' => $request->element('planeemail'),
                      'properties' =>  serialize($properties),
                      'date_created' => date("Y-m-d H:i:s"),
                      'status' => 1,
                        'province'=>$request->element('planeprovinces')
                    );
                    // var_dump($data);die;
        $newId = $consultant->addData($data);
        if($newId){
            $_SESSION['customerid'] =$newId;
        }
            $errMsg = 'Gửi đơn tư vấn Thành Công.';
            $template->assign('errMsg',$errMsg);
            $template->assign('popup',1);
            //  header('location:/'.$lang.'/landingpage.html');
        }
    }  
}
function validateData($request) {
    global $amessages;
        include_once(ROOT_PATH.'classes/data/validate.class.php');
        $error = array();
        $validate = new Validate();
         $error['INPUT']['planephone'] = $validate->validPhone($request->element('planephone'),$amessages['phone']);
        $error['INPUT']['planeprovinces'] = $validate->validString($request->element('planeprovinces'),$amessages['provinces']);
        $error['INPUT']['planename'] = $validate->validString($request->element('planename'),$amessages['fullname']);
        $error['INPUT']['planeemail'] = $validate->validEmail($request->element('planeemail'),$amessages['email']);
        if($error['INPUT']['planename']['error'] || $error['INPUT']['planeemail']['error'] || $error['INPUT']['planeprovinces']['error']||$error['INPUT']['planephone']['error'])
        {
            $error['invalid'] = 1;
            return $error;
        }
        $error['invalid'] = 0;
        return $error;
    }
?>