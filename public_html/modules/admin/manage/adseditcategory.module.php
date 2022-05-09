<?php
/*************************************************************************
Editing Ads module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 19/09/2011
Coder: Mai Minh
**************************************************************************/
//$userInfo->checkPermission('banner','edit');
$templateFile = 'manageads.tpl.html';
include_once(ROOT_PATH.'classes/dao/adscategories.class.php');
include_once(ROOT_PATH.'classes/dao/estores.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles = new Articles($storeId);
#$adsCategories = new AdsCategories($storeId);
$adsCategories = new AdsCategories($storeId);
$estores = new EStores();
$listArticlePro = $articles->getObjects(1,"`cat_id` = '27'",array("id" => "ASC"),40);
$gallery_path = ROOT_PATH."upload/$storeId/resources/";

if($listArticlePro) $template->assign('listArticlePro',$listArticlePro);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_banner'] => '/'.ADMIN_SCRIPT.'?op=manage&act=ads',
				$amessages['update_banner_category'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=ads';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['list_ads_category'] => $tabLink.'&mod=listcategory',
				$amessages['edit_ads_category'] => '#',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',4);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

$id = $request->element('id');
if($id) $template->assign('id',$id);

	if($request->element('doo') == 'delFilesub') {
		$adsInfo = $adsCategories->getObject($id);
		$properties = $adsInfo->getProperties();
		foreach($properties['photos'] as $key => $value) {
			if($value == $request->element('photo')) {
				unlink($gallery_path."l_".$properties['photos'][$key]);
				unlink($gallery_path."a_".$properties['photos'][$key]);
				unset($properties['photos'][$key]);
				$data = array('properties' => serialize($properties));
				$adsCategories->updateData($data,$id);
				
				break;
			}
		}
	}
$categoryInfo = $adsCategories->getObject($id);
if(!$categoryInfo) {
	$template->assign('validItem',0);
} else {
	$template->assign('validItem',1);
	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
		$validate = validateData($request);
		$id = $request->element('id');
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$categoryInfo = $adsCategories->getObject($id);
			if($categoryInfo) {
				   $template->assign('catInfo',$categoryInfo);
			}
		
		} else { # Valid data input
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$categoryInfo = $adsCategories->getObject($id);
				$properties = $categoryInfo->getProperties();
				if(!$properties) $properties = array('');
				$files2 = isset($_FILES['bannersub'])?$_FILES['bannersub']:'';
					if($files2) {
						if(!isset($properties['photos'])) $properties['photos'] = array();
						for($i=0; $i<count($files2['name']);$i++) {
							$img = addslashes(Filter(rand()."_".$files2['name'][$i]));
							$tmp_img = $files2['tmp_name'][$i];
							$size = $files2['size'][$i];
							$type=strtolower(substr($img,-3));
							if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
								# Upload
								if(isImage($img)) {
									move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
									resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);									
									# Delete file if it's not a JPEG
									$properties['photos'][] = $img;
								} 
							} #/if (preg_match
						} #/for($i=0;
					}

				// $properties['ads_category'][$id] = array('enable' => $request->element('status'),'rows'=> $request->element('ipp'));
				$data = array('properties' => serialize($properties),
						  'pid' => $request->element('pid'),
						  'name' => Filter($request->element('name')),
						  'status' => $request->element('status')
			);
				# Update Estore properties
				$adsCategories->updateData($data,$id);
					
				
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_ads_category'],$adsCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				
				# Redirect to editing page
				header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=ads&mod=editcategory&lang=$lang&id=$id&rcode=7");
			}
		}
	} else { # Load product category information to edit
		   $template->assign('item',$categoryInfo);
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['status'] = $validate->validInteger($request->element('status'));
	$error['INPUT']['pid'] = $validate->pasteString($request->element('pid'));
	
	if($error['INPUT']['status']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>