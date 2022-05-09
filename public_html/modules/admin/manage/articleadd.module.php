<?php
/*************************************************************************
Adding article module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 01/05/2012
Coder: Mai Minh
Checked by: Mai Minh (19/05/2012)
**************************************************************************/
$userInfo->checkPermission('article','add');
$templateFile = 'managearticle.tpl.html';
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH.'classes/dao/articles.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH."classes/dao/searchs.class.php");
$articleCategories = new ArticleCategories($storeId);
$articles = new Articles($storeId);
$fields = new Fields($storeId);
$template->assign('selectPhoto',1);
$search= new Search($storeId);
$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."articles/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_article'] => '/'.ADMIN_SCRIPT.'?op=manage&act=article',
				$amessages['add_new_article'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=article';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['list_article_category'] => $tabLink.'&mod=listcategory',
				$amessages['add_article_category'] => $tabLink.'&mod=addcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$pId = $request->element('pId','-1');
# Category combo box
if($pId && $pId > 0){
	$categoryCombo = $articleCategories->generateCombo($pId);
}else{
	$categoryCombo = $articleCategories->generateCombo($request->element('cat_id'),1);
}

if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
$categoryCombo2 = $articleCategories->getObjects(1,"`parent_id` IN (26,27)",array("parent_id" => "ASC"),50);
		if($categoryCombo2) $template->assign('categoryCombo2',$categoryCombo2);
# Get list of custom fields
$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='article'",array('position' => 'ASC'));
if($fieldList) $template->assign('fieldList',$fieldList);

# Allow some javascript
$template->assign('ckEditor',1);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		# Category combo box
		$categoryCombo = $articleCategories->generateCombo($request->element('cat_id'));
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
	} else { # Valid data input
		# check duplicate article name
		if($estore->getProperty('check_duplicate_article_title')) {
			if($articles->checkDuplicate($request->element('title'),'title',"cat_id = '".$request->element('cat_id')."'")) {
				$validate['INPUT']['title']['message'] = $amessages['title_duplicated'];
				$validate['INPUT']['title']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		}
			
		# Check if duplicate slug
		$textFilter = new TextFilter();
		$slug = $textFilter->urlize($request->element('title'),false,'-');
		$i = 0;
		$dup = 1;
		while($dup) {
			$dup = $articles->checkDuplicate($slug.($i?'-'.$i:''),'slug',"cat_id = '".$request->element('cat_id')."'");
			if($dup) $i++;
		}
		$slug .= $i?'-'.$i:'';

		$textFilter = new TextFilter();
		$divimg = $textFilter->urlize($request->element('Cssimg'),false,'-');
	    if($divimg == 2){
			$slug1 .= 8;
		}else{
			$slug1 .= 4;
		}

		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			
			# Check if gallery folder is exists
			if(!file_exists($gallery_root)) mkdir("$gallery_root");
			if(!file_exists($gallery_path)) mkdir("$gallery_path");
					
			# User upload
			 $userUpload = $userInfo->getUsername();
		
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
						// if(isBmp($img)) {
						// 	$new_img = preg_replace("/(bmp$)/","jpg",$img);
						// 	resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
						// }
						// resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
						// if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
						$avatar = $img;
					} 
				} #/if (preg_match
			}

			$fileSlide = isset($_FILES['slide'])?$_FILES['slide']:'';
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
						if(isBmp($imgslide)) $new_imgslide = preg_replace("/(bmp$)/","jpg",$imgslide);
						resize($gallery_path,$gallery_path,'l_'.$imgslide,'l_'.$new_imgslide,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
						resize($gallery_path,$gallery_path,'l_'.$imgslide,'a_'.$new_imgslide,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
						if(CREATE_PRODUCT_AVATAR_CORNER) imageCreateCorners($gallery_path.'a_'.$new_imgslide, 9);
						resize($gallery_path,$gallery_path,'l_'.$imgslide,'m_'.$new_imgslide,DEFAULT_MEDIUM_SIZE,DEFAULT_MEDIUM_SQUARE,DEFAULT_PHOTO_QUALITY);
						resize($gallery_path,$gallery_path,'l_'.$imgslide,'t_'.$new_imgslide,DEFAULT_THUMBNAIL_SIZE,DEFAULT_THUMBNAIL_SQUARE,DEFAULT_PHOTO_QUALITY);
						if($imgslide != $new_imgslide) unlink($gallery_path.'l_'.$imgslide);	# Delete file if it's not a JPEG
						$slide = $new_imgslide;
					
					} 
				} #/if (preg_match
			}	
			# Files upload
			$files = isset($_FILES['files'])?$_FILES['files']:'';
			if($files) {
				$uphotos = array();
				$uvideos = array();
				$ufiles = array();
				for($i=0; $i<count($files['name']);$i++) {
					$filesname = TextFilter::urlize3($files['name'],false,'_');
					$img = addslashes(rand()."_".$filesname);
					// $img = addslashes(Filter(rand()."_".$files['name'][$i]));
					$tmp_img = $files['tmp_name'][$i];
					$size = $files['size'][$i];
					$type=strtolower(substr($img,-3));
					if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($type))) {
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
							$uphotos[] = $new_img;
						} elseif(isVideo($img)) {
							move_uploaded_file($tmp_img,$gallery_path.$img);
							$uvideos[] = $img;
						} else {
							move_uploaded_file($tmp_img,$gallery_path.$img);
							$ufiles[] = $img;
						}
					} #/if (preg_match
				} #/for($i=0;
			}

			$properties = array(
								'Cssimg' => $request->element('Cssimg'),
								'slug1' => $slug1,
								'avatar' => $avatar,
								'detail_en' => $request->element('detail_en'),
								'en_detail' => $request->element('en_detail'),
								'user_upload' => $userUpload);
			# Custom fields
			foreach($fieldList as $field) {
				$properties[$field->getName()] = stripslashes($request->element($field->getName()));
			}
			
			if($request->element('dateshow')){
				$dateshowformat = strtotime($request->element('dateshow'));
				$dateAfter = date("Y-m-d H:i:s",$dateshowformat);
			}else{
				$dateAfter = '';
			}
			
			$list_cat_id = array();
	    	$detail = addslashes($request->element('detail'));
	    	// if chưa tồn tại alt thì thêm vào 
	    	$pos = strpos($detail, "alt");
			if ($pos !== false) {
				$str = $detail;
			} else {
	    		//thêm alt vào img
				$str = str_replace( 'img', 'img alt="image"',$detail);
			}
			
			# End File upload
			$position = $request->element('position')?$request->element('position'):1;
			$data = array('store_id' => $storeId,
						  'cat_id' => $request->element('cat_id'),
						  'slug' => $slug,
						  'title' => Filter($request->element('title')),
						  'viewed' => Filter($request->element('viewed')),
						  'keyword' => Filter($request->element('keyword')),
						  'sapo' => Filter($request->element('sapo')),
						  'position' => $position,
						  'status' => 1,
						  'detail' => $str,
						  'properties' => serialize($properties),
						  'date_created' => date("Y-m-d H:i:s"),
						'dateshow' => date("Y-m-d H:i:s"));
			$newId = $articles->addData($data);
		
            #Add data search
         		
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_article'],$request->element('title')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=list&pId=".$request->element('cat_id')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['cat_id'] = $validate->pasteString($request->element('cat_id'));
	$error['INPUT']['title'] = $validate->validString($request->element('title'),$amessages['title']);
	// $error['INPUT']['keyword'] = $validate->validString($request->element('keyword'),$amessages['keyword']);
	// $error['INPUT']['sapo'] = $validate->validString($request->element('sapo'),$amessages['sapo']);
	$error['INPUT']['position'] = $validate->pasteString($request->element('position'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	$error['INPUT']['price1'] = $validate->pasteString($request->element('price1'));
	$error['INPUT']['price2'] = $validate->pasteString($request->element('price2'));
	$error['INPUT']['priceh2'] = $validate->pasteString($request->element('priceh2'));
	$error['INPUT']['priceh1'] = $validate->pasteString($request->element('priceh1'));
	// $error['INPUT']['qtlamviec'] = $validate->pasteString($request->element('qtlamviec'));
	
	
	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}
		
	if($error['INPUT']['title']['error']) {
		$error['invalid'] = 1;
        $error['message'] = '';
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>