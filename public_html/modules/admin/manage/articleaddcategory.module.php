<?php
/*************************************************************************
Adding article category module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Coder: Mai Minh
Last updated: 05/05/2012
**************************************************************************/
$userInfo->checkPermission('category','add');
$templateFile = 'managearticle.tpl.html';
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/fields.class.php');
$fields = new Fields($storeId);
$articleCategories = new ArticleCategories($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_article'] => '/'.ADMIN_SCRIPT.'?op=manage&act=article',
				$amessages['add_article_category'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=article';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['list_article_category'] => $tabLink.'&mod=listcategory',
				$amessages['add_article_category'] => $tabLink.'&mod=addcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',4);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."articles/";
# Category combo box
$categoryCombo = $articleCategories->generateCombo($request->element('pId'));
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='articlecategories'",array('position' => 'ASC'));
if($fieldList) $template->assign('fieldList',$fieldList);

# Allow some javascript
$template->assign('ckEditor',1);
	
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate category name
		if($articleCategories->checkDuplicate($request->element('name'),'name',"`parent_id` = '".$request->element('parent_id')."'")) {
			$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
			$validate['INPUT']['name']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		
		# Check if duplicate slug
		$slug = TextFilter::urlize($request->element('name'),false,'-');
		$i = 0;
		$dup = 1;
		while($dup) {
			$dup = $articleCategories->checkDuplicate($slug.($i?'-'.$i:''),'slug');
			if($dup) $i++;
		}
		$slug .= $i?'-'.$i:'';
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			$properties = array('');
			
			# Check if gallery folder is exists
			if(!file_exists($gallery_root)) mkdir("$gallery_root");
			if(!file_exists($gallery_path)) mkdir("$gallery_path");
		
			# File Avatar
			$fileAvatr = isset($_FILES['avatar'])?$_FILES['avatar']:'';
			if($fileAvatr) {
				// $img = addslashes(Filter(rand()."_".$fileAvatr['name']));
				$filesname = TextFilter::urlize3($fileAvatr['name'],false,'_');
				$img = addslashes(rand()."_".$filesname);
				$tmp_img = $fileAvatr['tmp_name'];
				$size = $fileAvatr['size'];
				$type=strtolower(substr($img,-3));
				if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
					# Upload
					if(isImage($img)) {
						$new_img = $img;
						move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
						if(isBmp($img)) {
							$new_img = preg_replace("/(bmp$)/","jpg",$img);
							resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
						}
						resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
						if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
						$avatar = $new_img;
					} 
				} #/if (preg_match
			}
			$properties['avatar'] = $avatar;
			$properties['sort_type'] = $request->element('sort_type');
			$properties['sort_dir'] = $request->element('sort_dir');
			$properties['display'] = $request->element('display');
			$properties['ipp'] = $request->element('ipp');
			$properties['landing'] = $request->element('landing');
			$properties['landing_page'] = $request->element('landing_page');
			$properties['template'] = $request->element('template');
			
			# Custom fields
			foreach($fieldList as $field) {
				$properties[$field->getName()] = $request->element($field->getName());
			}
			$data = array('store_id' => $storeId,
						  'parent_id' => $request->element('parent_id'),
						  'slug' => $slug,
						  'name' => Filter($request->element('name')),
						  'keyword' => Filter($request->element('keyword')),
						  'sapo' => Filter($request->element('sapo')),
						  'position' => $request->element('position'),
						  'status' => $request->element('status'),
						  'properties' => serialize($properties));
			$articleCategories->addData($data);
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_article_category'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=listcategory&pId=".$request->element('parent_id')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['parent_id'] = $validate->pasteString($request->element('parent_id'));
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['keyword'] = $validate->validString($request->element('keyword'),$amessages['keyword']);
	$error['INPUT']['sapo'] = $validate->validString($request->element('sapo'),$amessages['sapo']);
	$error['INPUT']['position'] = $validate->pasteString($request->element('position'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	// $error['INPUT']['sort_type'] = $validate->pasteString($request->element('sort_type'));
	// $error['INPUT']['sort_dir'] = $validate->pasteString($request->element('sort_dir'));
	// $error['INPUT']['template'] = $validate->pasteString($request->element('template'));
	// $error['INPUT']['display'] = $validate->pasteString($request->element('display'));
	// $error['INPUT']['ipp'] = $validate->validInteger($request->element('ipp'),$amessages['items_per_page']);
	$error['INPUT']['landing'] = $validate->pasteString($request->element('landing'));
	if($error['INPUT']['landing']['value']) $error['INPUT']['landing_page'] = $validate->validString($request->element('landing_page'),$amessages['landing_page']);

	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}

	if($error['INPUT']['name']['error'] || $error['INPUT']['keyword']['error'] || $error['INPUT']['sapo']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>