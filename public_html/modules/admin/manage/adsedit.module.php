<?php
/*************************************************************************
Editing ads module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 01/05/2012
Coder: Mai Minh
Checked by: Mai Minh (07/05/2012)
**************************************************************************/
$userInfo->checkPermission('banner','edit');
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
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=manage&act=ads',
				$amessages['update_banner_category'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=ads';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['edit_ads'] => '#',
				$amessages['list_ads_category'] => $tabLink.'&mod=listcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$template->assign('selectPhoto',1);

# Allow some javascript
$template->assign('ckEditor',1);
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
$listArticlePro = $articles->getObjects(1,"1>0 AND `cat_id` = '27'",array("id" => "ASC"),40);
if($listArticlePro) $template->assign('listArticlePro',$listArticlePro);
$listAdsCate =  $adsCategories->getObjects(1,"1>0",array("id" => "ASC"),50);
if($listAdsCate) $template->assign('listAdsCate',$listAdsCate);
if($id) $template->assign('id',$id);
	if($request->element('doo') == 'delFile') {
		$adsInfo = $ads->getObject($id);
		$properties = $adsInfo->getProperties();
		if($adsInfo->getProperty('logo')) {
			// unlink($gallery_path.'a_'.$adsInfo->getProperty('logo'));
			// unlink($gallery_path.'l_'.$adsInfo->getProperty('logo'));
			unset($properties['logo']);
			$data = array('properties' => serialize($properties));
			$ads->updateData($data,$id);
			$adsInfo = $ads->getObject($id);
		}
	}
	if($request->element('doo') == 'delPlane') {
		$adsInfo = $ads->getObject($id);
		$properties = $adsInfo->getProperties();
		if($adsInfo->getProperty('logo')) {
			// unlink($gallery_path.'a_'.$adsInfo->getProperty('logo'));
			// unlink($gallery_path.'l_'.$adsInfo->getProperty('logo'));
			unset($properties['the_plane']);
			$data = array('properties' => serialize($properties));
			$ads->updateData($data,$id);
			$adsInfo = $ads->getObject($id);
		}
	}
	
	if($request->element('doo') == 'delFilesub') {
		$adsInfo = $ads->getObject($id);
		$properties = $adsInfo->getProperties();
		foreach($properties['photos'] as $key => $value) {
			if($value == $request->element('photo')) {
				// unlink($gallery_path."l_".$properties['photos'][$key]);
				// unlink($gallery_path."a_".$properties['photos'][$key]);
				unset($properties['photos'][$key]);
				$data = array('properties' => serialize($properties));
				$ads->updateData($data,$id);
				
				break;
			}
		}
	}
	

$adsInfo = $ads->getObject($id);
if(!$adsInfo) {
	$template->assign('validItem',0);
} else {
	$template->assign('validItem',1);
		# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='ads'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$template->assign('itemInfo',$adsInfo);
			print_r($adsInfo);
			
			# Category combo box
			$categoryCombo = $adsCategories->generateCombo($request->element('gid',1));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
		} else { # Valid data input
			# Category combo box
			$categoryCombo = $adsCategories->generateCombo($request->element('gid',1));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);	
						
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$adsInfo = $ads->getObject($id);
				if($adsInfo) {			
					$properties = $adsInfo->getProperties();
					# Files upload
					$files = isset($_FILES['logo'])?$_FILES['logo']:'';
					
					$logo = '';
					$type = '';
					if($files) {
						$img = TextFilter::urlize3($files['name'],false,'_');
						// $img = addslashes(Filter(rand()."_".$files['name']));
						
						$tmp_img = $files['tmp_name'];
						$size = $files['size'];
						$type=strtolower(substr($img,-3));
						$properties['type_file'] = $type;

						if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
							if(isImage($img)) {
								$move = move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
								resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
								$logo = $img;
							}elseif(isVideo($img)) {
								move_uploaded_file($tmp_img,$gallery_path.$img);
								$logo = $img;
							}elseif(isMusic($img)){
								move_uploaded_file($tmp_img,$gallery_path.$img);
								$logo = $img;
							} else {
								move_uploaded_file($tmp_img,$gallery_path.$img);
								$logo = $img;
							}
						} #/if (preg_match				
					}
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
					// $files2 = isset($_FILES['bannersub'])?$_FILES['bannersub']:'';
					// if($files2) {
					// 	if(!isset($properties['photos'])) $properties['photos'] = array();
					// 	for($i=0; $i<count($files2['name']);$i++) {
					// 		$img2 = addslashes(Filter(rand()."_".$files2['name'][$i]));
					// 		$tmp_img = $files2['tmp_name'][$i];
					// 		$size = $files2['size'][$i];
					// 		$type=strtolower(substr($img2,-3));
					// 		if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img2))) {
					// 			# Upload
					// 			if(isImage($img2)) {
					// 				move_uploaded_file($tmp_img,$gallery_path.'l_'.$img2);
					// 				resize($gallery_path,$gallery_path,'l_'.$img2,'a_'.$img2,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);									
					// 				# Delete file if it's not a JPEG
					// 				$properties['photos'][] = $img2;
					// 			} 
					// 		} #/if (preg_match
					// 	} #/for($i=0;
					// }

				# Custom fields
		

					$properties['url_logo'] = Filter($request->element('urllogo'));
					$properties['url_logo_type'] = $request->element('typeurl');
					$properties['width'] = Filter($request->element('width'));
					$properties['height'] = Filter($request->element('height'));
					$properties['url'] = Filter($request->element('url'));
					$properties['detail_en'] = $request->element('detail_en');
					$properties['caption_en'] = $request->element('caption_en');
					$properties['articleimg'] = $request->element('articleimg');
					$properties['detail'] = $request->element('detail');
					$properties['caption'] = $request->element('caption');
					$properties['list_expert'] = $listexpertid;
					if($logo) {
						$properties['logo'] = $logo;
						$properties['logo_type'] = $type;	
					}
					foreach($fieldList as $field) {
						$properties[$field->getName()] = stripslashes($request->element($field->getName()));
					}
					
					# End File upload
					$data = array('store_id' => $storeId,
						'gid' => $request->element('gId'),
						'position' => $request->element('position'),
						'status' => $request->element('status'),
						'properties' => serialize($properties),
						'date_created' => date("Y-m-d H:i:s"));
						// var_dump($data);exit();
					$ads->updateData($data,$id);
					
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_ads'],$request->element('id')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
					# Redirect to editing page
					header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=ads&mod=edit&lang=$lang&id=$id&rcode=7");
				}
			}
		}
	} else { # Load ads category information to edit
		$template->assign('item',$adsInfo);

		$list_selected_expert = $adsInfo->getProperty('list_expert');
		if($list_selected_expert && $list_selected_expert != ''){	
			$arraylistExpert = explode(",", $list_selected_expert);
			if($arraylistExpert)$template->assign('arraylistExpert',$arraylistExpert);
        }

		# Category combo box
		$categoryCombo = $adsCategories->generateCombo($adsInfo->getGId(),1);
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

		# Get list expert from artilces
		$listExpert = $articles->getObjects(1,"cat_id = 33",array("id" => "ASC"),50);
		if($listExpert) $template->assign('listExpert',$listExpert);

	}
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['tid'] = $validate->pasteString($request->element('tid'));
	$error['INPUT']['gid'] = $validate->pasteString($request->element('gId'));
	$error['INPUT']['position'] = $validate->validNumber($request->element('position'),$amessages['position']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	$error['INPUT']['urllogo'] = $validate->pasteString($request->element('urllogo'));
	$error['INPUT']['altcontent'] = $validate->pasteString($request->element('altcontent'));
	$error['INPUT']['url'] = $validate->pasteString($request->element('url'),$amessages['url']);
	$error['INPUT']['logo'] = $validate->pasteString($request->element('logo'),$amessages['logourl']);
	$error['INPUT']['width'] = $validate->pasteString($request->element('width'));
	$error['INPUT']['height'] = $validate->pasteString($request->element('height'));
	$error['INPUT']['detail_en'] = $validate->pasteString($request->element('detail_en'));
	$error['INPUT']['caption'] = $validate->pasteString($request->element('caption'));
	$error['INPUT']['caption_en'] = $validate->pasteString($request->element('caption_en'));
	$error['INPUT']['articleimg'] = $validate->pasteString($request->element('articleimg'));
	
	
if($error['INPUT']['position']['error'] ) {
		$error['invalid'] = 1;
		$error['message'] = '';
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>
