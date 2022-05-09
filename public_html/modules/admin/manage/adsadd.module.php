<?php
/*************************************************************************
Adding Ads module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 21/09/2011
Coder: Tran Thi My Xuyen
Checkeb by: Mai Minh (07/05/2012)
**************************************************************************/
$userInfo->checkPermission('banner','add');
$templateFile = 'manageads.tpl.html';
include_once(ROOT_PATH.'classes/dao/adscategories.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles = new Articles($storeId);
$template->assign('articles',$articles);
include_once(ROOT_PATH.'classes/dao/fields.class.php');
$fields = new Fields($storeId);
$adsCategories = new AdsCategories($storeId);
$ads = new Ads($storeId);
$gallery_path = ROOT_PATH."upload/$storeId/resources/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_banner'] => '/'.ADMIN_SCRIPT.'?op=manage&act=ads',
				$amessages['add_new'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=ads';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => '#',
				$amessages['list_ads_category'] => $tabLink.'&mod=listcategory',
				"Thêm nhóm banner" => $tabLink.'&mod=addcategory',
				
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$template->assign('selectPhoto',1);
# Allow some javascript
$template->assign('ckEditor',1);
$listArticlePro = $articles->getObjects(1,"`status` = '1' AND `cat_id` = '27'",array("id" => "ASC"),40);
if($listArticlePro) $template->assign('listArticlePro',$listArticlePro);

// $listExpert = $articles->getObjects(1,"`status` = '1' AND `cat_id` = '33'",array("id" => "ASC"),40);
// if($listExpert) $template->assign('listExpert',$listExpert);

# Get list expert from artilces
$listExpert = $articles->generateComboListExpert();
if($listExpert) $template->assign('listExpert',$listExpert);
// var_dump($listExpert);
// exit();
# Get list of custom fields
$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='ads'",array('position' => 'ASC'));
if($fieldList) $template->assign('fieldList',$fieldList);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
# Category combo box
$categoryCombo = $adsCategories->generateCombo($request->element('gId'),1);  
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
$listAdsCate =  $adsCategories->getObjects(1,"`status` = '1'",array("id" => "ASC"),50);
if($listAdsCate) $template->assign('listAdsCate',$listAdsCate);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		# Category combo box
		$categoryCombo = $adsCategories->generateCombo($request->element('gId'),1);
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
	} else { # Valid data input
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			$width = $request->element('width');
			$height = $request->element('height');
			# Files upload
			$files = isset($_FILES['logo'])?$_FILES['logo']:'';
			if($files) {

			
				// $img = addslashes(Filter(rand()."_".$files['name']));
				$img = TextFilter::urlize3($files['name'],false,'_');
				$tmp_img = $files['tmp_name'];
				$size = $files['size'];
				$type=strtolower(substr($img,-3));
				if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
					# Upload
					if(isImage($img)) {
					move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
					resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
					$logo = $img;
					} elseif(isVideo($img)) {
						move_uploaded_file($tmp_img,$gallery_path.$img);
						$logo = $img;
					} else {
						move_uploaded_file($tmp_img,$gallery_path.$img);
						$logo = $img;
					}
				} #/if (preg_match
			}

			// the plane
			$fileSlide = isset($_FILES['the_plane'])?$_FILES['the_plane']:'';
			if($fileSlide) {
				$imgslide = addslashes(Filter(rand()."_".$fileSlide['name']));
				$tmp_imgslide = $fileSlide['tmp_name'];
				$sizeslide = $fileSlide['size'];
				$typeslide=strtolower(substr($imgslide,-3));
				if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($imgslide))) {
					# Upload
					if(isImage($imgslide)) {
						$new_imgslide = $imgslide;
						move_uploaded_file($tmp_imgslide,$gallery_path.'l_'.$imgslide);
						if(isBmp($imgslide)) {
							$new_imgslide = preg_replace("/(bmp$)/","jpg",$imgslide);
							resize($gallery_path,$gallery_path,'l_'.$imgslide,'l_'.$new_imgslide,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
						}
						resize($gallery_path,$gallery_path,'l_'.$imgslide,'a_'.$new_imgslide,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
						if($imgslide != $new_imgslide) unlink($gallery_path.'l_'.$imgslide);	# Delete file if it's not a JPEG
						$properties['the_plane'] = $new_imgslide;

					} 
				} #/if (preg_match
			}
			
				
			$expert_id_list = array();
			foreach($request->element("expert_id_list") as $expert_id){
				if($expert_id > 0){
					array_push($expert_id_list, $expert_id);
				}
			}	
			if($expert_id_list) {
				$listexpertid = implode(",", $expert_id_list);
			}else{
				$listexpertid='';
			}
			
	
			$properties = array('logo' => $logo,
								'logo_type' => $type,
								'url_logo' => Filter($request->element('urllogo')),
								'url_logo_type' => $request->element('typeurl'),
								'width' => Filter($request->element('width')),
								'height' => Filter($request->element('height')),
								'url' => Filter($request->element('url')),
								'caption_en' => $request->element('caption_en'),
								'caption' => $request->element('caption'),
								'articleimg' => $request->element('articleimg'),
								'detail' => $request->element('detail'),
								'detail_en' => $request->element('detail_en'),
								'list_expert' => $listexpertid,
								);
			// $files2 = isset($_FILES['bannersub'])?$_FILES['bannersub']:'';
			// 		if($files2) {
			// 			$properties['photos'] = array();
						
			// 			for($i=0; $i<count($files2['name']);$i++) {
			// 				$img2 = addslashes(Filter(rand()."_".$files2['name'][$i]));
			// 				$tmp_img = $files2['tmp_name'][$i];
			// 				$size = $files2['size'][$i];
			// 				$type=strtolower(substr($img2,-3));
			// 				if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img2))) {
			// 					# Upload
			// 					if(isImage($img2)) {
			// 						move_uploaded_file($tmp_img,$gallery_path.'l_'.$img2);
			// 						resize($gallery_path,$gallery_path,'l_'.$img2,'a_'.$img2,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);									
			// 							# Delete file if it's not a JPEG
			// 						$properties['photos'][] = $img2;
			// 					}
			// 				} #/if (preg_match
			// 			} #/for($i=0;
			// 		}
			
			#tid' => $request->element('tid'),
# Custom fields
foreach($fieldList as $field) {
	$properties[$field->getName()] = stripslashes($request->element($field->getName()));
}
			$data = array('store_id' => $storeId,
				'gid' => $request->element('gId'),
				'tid' => $request->element('tid'),
				'position' => $request->element('position'),
				'status' => $request->element('status'),
				'properties' => serialize($properties),
				'date_created' => date("Y-m-d H:i:s"),
				'content' => $request->element('altcontent'));

			
			$newId = $ads->addData($data);
			
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_ads'],$newId),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=ads&mod=list&gId=".$request->element('gId')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['gid'] = $validate->pasteString($request->element('gid'));
	$error['INPUT']['tid'] = $validate->pasteString($request->element('tid'));
	$error['INPUT']['position'] = $validate->validNumber($request->element('position'),$amessages['position']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	$error['INPUT']['urllogo'] = $validate->pasteString($request->element('urllogo'));
	$error['INPUT']['altcontent'] = $validate->pasteString($request->element('altcontent'));
	$error['INPUT']['url'] = $validate->pasteString($request->element('url'),$amessages['url']);
	$error['INPUT']['logo'] = $validate->pasteString($request->element('logo'),$amessages['logourl']);
	$error['INPUT']['detail_en'] = $validate->pasteString($request->element('detail_en'));
	$error['INPUT']['caption'] = $validate->pasteString($request->element('caption'));
	$error['INPUT']['caption_en'] = $validate->pasteString($request->element('caption_en'));
	$error['INPUT']['articleimg'] = $validate->pasteString($request->element('articleimg'));
	
	if( $error['INPUT']['position']['error']) {
		$error['invalid'] = 1;
		$error['message'] = '';
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}

?>