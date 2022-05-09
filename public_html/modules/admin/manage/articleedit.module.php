<?php
/*************************************************************************
Editing article module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Last updated: 01/05/2012
Coder: Mai Minh
Checked by: Mai Minh (19/05/2012)
**************************************************************************/
$userInfo->checkPermission('article','edit');
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
if(DEBUG && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {	
$template->assign('incompany',1);
}
$search= new Search($storeId);
$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."articles/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_article'] => '/'.ADMIN_SCRIPT.'?op=manage&act=article',
				$amessages['edit_article'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=article';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['edit_article'] => '#',
				$amessages['list_article_category'] => $tabLink.'&mod=listcategory',
				$amessages['add_article_category'] => $tabLink.'&mod=addcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$categoryCombo2 = $articleCategories->getObjects(1,"`parent_id` IN (26,27)",array("parent_id" => "ASC"),50);
		if($categoryCombo2) $template->assign('categoryCombo2',$categoryCombo2);

$result_code = $request->element('rcode'); 
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$articleInfo = $articles->getObject($id);
if(!$articleInfo) {
	$template->assign('validItem',0);
} else{
	$template->assign('validItem',1);

	# Allow some javascript
	$template->assign('ckEditor',1);
	
	if($request->element('doo') == 'delPhoto') { 
		$articleInfo = $articles->getObject($id);
		$properties = $articleInfo->getProperties();
		foreach($properties['photos'] as $key => $value) {
			if($value == $request->element('photo')) {
				unlink($gallery_path."l_".$properties['photos'][$key]);
				unlink($gallery_path."a_".$properties['photos'][$key]);
				unset($properties['photos'][$key]);
				$data = array('properties' => serialize($properties));
				$articles->updateData($data,$id);
				$articleInfo = $articles->getObject($id);
				break;
			}
		}
	}
	if($request->element('doo') == 'delAvatar') {
		$articleInfo = $articles->getObject($id);
		$properties = $articleInfo->getProperties();
		if($articleInfo->getProperty('avatar')) {
			unlink($gallery_path.'l_'.$articleInfo->getProperty('avatar'));
			unlink($gallery_path.'a_'.$articleInfo->getProperty('avatar'));
			unset($properties['avatar']);
			$data = array('properties' => serialize($properties));
			$articles->updateData($data,$id);
			$articleInfo = $articles->getObject($id);
		}
	}	

	if($request->element('doo') == 'delSlide') {
		$articleInfo = $articles->getObject($id);
		$properties = $articleInfo->getProperties();
		if($articleInfo->getProperty('slide')) {
			unlink($gallery_path.'l_'.$articleInfo->getProperty('slide'));
			unlink($gallery_path.'a_'.$articleInfo->getProperty('slide'));
			unset($properties['slide']);
			$data = array('properties' => serialize($properties));
			$articles->updateData($data,$id);
			$articleInfo = $articles->getObject($id);
		}
	}	
	if($request->element('doo') == 'delMovie') {
		$articleInfo = $articles->getObject($id);
		$properties = $articleInfo->getProperties();
		foreach($properties['movies'] as $key => $value) {
			if($value == $request->element('movie')) {
				unlink($gallery_path.$properties['movies'][$key]);
				unset($properties['movies'][$key]);
				$data = array('properties' => serialize($properties));
				$articles->updateData($data,$id);
				$articleInfo = $articles->getObject($id);
				break;
			}
		}
	}
	if($request->element('doo') == 'delFile') {
		$articleInfo = $articles->getObject($id);
		$properties = $articleInfo->getProperties();
		foreach($properties['files'] as $key => $value) {
			if($value == $request->element('file')) {
				unlink($gallery_path.$properties['files'][$key]);
				unset($properties['files'][$key]);
				$data = array('properties' => serialize($properties));
				$articles->updateData($data,$id);
				$articleInfo = $articles->getObject($id);
				break;
			}
		}
	}
	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='article'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
		
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$articleInfo = $articles->getObject($id);
			$template->assign('itemInfo',$articleInfo);
			
			# Category combo box
			$categoryCombo = $articleCategories->generateCombo($request->element('cat_id',0));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
		} else { # Valid data input
			# Category combo box
			$categoryCombo = $articleCategories->generateCombo($request->element('cat_id',0));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
			
			# check duplicate category name
			if($estore->getProperty('check_duplicate_article_name')) {
				if($articles->checkDuplicate($request->element('name'),'name',"`id` <> '$id' AND `cat_id` = '".$request->element('cat_id')."'")) {
					$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
					$validate['INPUT']['name']['error'] = 1;
					$validate['invalid'] = 1;
					$template->assign('error',$validate);
				}
			}
			# Check if duplicate slug
			$textFilter = new TextFilter();
			$slug = $textFilter->urlize($request->element('slug'),false,'-');
			$i = 0;
			$dup = 1;
			while($dup) {
				$dup = $articles->checkDuplicate($slug.($i?'-'.$i:''),'slug',"`id` <> '$id' AND `cat_id` = '".$request->element('cat_id')."'");
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



			$gallery_rootpdf = ROOT_PATH."upload/";
			$gallery_pathpdf = $gallery_rootpdf."pdf/";
			if(!file_exists($gallery_rootpdf)) mkdir("$gallery_rootpdf");
			if(!file_exists($gallery_pathpdf)) mkdir("$gallery_pathpdf");
			      
      $articleInfo = $articles->getObject($id);
		  $properties = $articleInfo->getProperties();
		 //  if($articleInfo->getProperty('pdf')) {
			// 	unlink($gallery_pathpdf.$articleInfo->getProperty('pdf'));
			// 	unset($properties['pdf']);
			// 	$data = array('properties' => serialize($properties));
			// 	$articles->updateData($data,$id);
			// 	$articleInfo = $articles->getObject($id);
			// }

			
		  
      

			
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$articleInfo = $articles->getObject($id);
				if($articleInfo) {			
					$properties = $articleInfo->getProperties();
					# Check if gallery folder is exists
					if(!file_exists($gallery_root)) mkdir("$gallery_root");
					if(!file_exists($gallery_path)) mkdir("$gallery_path");
					
					#User update
					$properties['user_update'] = $userInfo->getUsername();
					#File Avatar
					$fileAvatr = isset($_FILES['avatar'])?$_FILES['avatar']:'';
					if($fileAvatr) {
						$filesname = TextFilter::urlize3($fileAvatr['name'],false,'_');
						$img = addslashes(rand()."_".$filesname);
						// $img = addslashes(Filter(rand()."_".$fileAvatr['name']));
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
								// if($articleInfo->getProperty('avatar')) {
								// 	unlink($gallery_path.'a_'.$articleInfo->getProperty('avatar'));
								// 	unlink($gallery_path.'l_'.$articleInfo->getProperty('avatar'));
								// }
								$properties['avatar'] = $img;
							} 
							if(isImageJPEG($img)) {
								$new_img = $img;
								move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
								// if(isBmp($img)) {
								// 	$new_img = preg_replace("/(bmp$)/","jpg",$img);
								// 	resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
								// }
								// resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
								// if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
								// if($articleInfo->getProperty('avatar')) {
								// 	unlink($gallery_path.'a_'.$articleInfo->getProperty('avatar'));
								// 	unlink($gallery_path.'l_'.$articleInfo->getProperty('avatar'));
								// }
								$properties['avatar'] = $img;
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
								if(isBmp($imgslide)) {
									$new_imgslide = preg_replace("/(bmp$)/","jpg",$imgslide);
									resize($gallery_path,$gallery_path,'l_'.$imgslide,'l_'.$new_imgslide,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
								}
								resize($gallery_path,$gallery_path,'l_'.$imgslide,'a_'.$new_imgslide,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
								if($imgslide != $new_imgslide) unlink($gallery_path.'l_'.$imgslide);	# Delete file if it's not a JPEG
								if($articleInfo->getProperty('slide')) {
									unlink($gallery_path.'a_'.$articleInfo->getProperty('slide'));
									unlink($gallery_path.'l_'.$articleInfo->getProperty('slide'));
								}
								$properties['slide'] = $new_imgslide;

							} 
						} #/if (preg_match
					}
					# Files upload
					$files = isset($_FILES['files'])?$_FILES['files']:'';
					if($files) {
						if(!isset($properties['photos']) || $properties['photos'] == "") $properties['photos'] = array();
						if(!isset($properties['videos']) || $properties['videos'] == "") $properties['videos'] = array();
						if(!isset($properties['files']) || $properties['files'] == "") $properties['files'] = array();
						for($i=0; $i<count($files['name']);$i++) {
							// $img = addslashes(Filter(rand()."_".$files['name'][$i]));
							$filesname = TextFilter::urlize3($files['name'][$i],false,'_');
							$img = addslashes(rand()."_".$filesname);
							$tmp_img = $files['tmp_name'][$i];
							$size = $files['size'][$i];
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
									$properties['photos'][] = $new_img;
								} elseif(isVideo($img)) {
									move_uploaded_file($tmp_img,$gallery_path.$img);
									$properties['videos'][] = $img;
								} else {
									move_uploaded_file($tmp_img,$gallery_path.$img);
									$properties['files'][] = $img;
								}
							} #/if (preg_match
						} #/for($i=0;
					}
					
					$properties['en_detail'] = $request->element('en_detail');
					$properties['Cssimg'] = $request->element('Cssimg');
					$properties['slug1'] = $request->element('slug1');
					# Custom fields
					foreach($fieldList as $field) {
						$properties[$field->getName()] = stripslashes($request->element($field->getName()));
					}
			    	$dateshowformat = strtotime($request->element('dateshow'));
			    	if($request->element('dateshow')){
			    		$dateshow2 = date("Y-m-d H:i:s",$dateshowformat);
			    	}else{
			    		$dateshow2 ='';
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
					$position = $request->element('position')?$request->element('position'):1;
					$data1 = array('store_id' => $storeId,
								  'cat_id' => $request->element('cat_id'),
								  'slug' => $slug,
								  'title' => Filter($request->element('title')),
								  'keyword' => Filter($request->element('keyword')),
								  'viewed' => Filter($request->element('viewed')),
								  'sapo' => Filter($request->element('sapo')),
								  'position' => $position,
								  'status' => $articleInfo->getStatus(),
								  'detail' => $str,
								  'properties' => serialize($properties),
								  'date_update' => date("Y-m-d H:i:s"),
								  'dateshow' => date("Y-m-d H:i:s")

					);
				
					$articles->updateData($data1,$id);
					
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_article'],$request->element('title')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
					# Redirect to editing page
					header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=edit&lang=$lang&id=$id&rcode=7");
				}
			}
		}
	} else { # Load article category information to edit
		$template->assign('item',$articleInfo);
		$listCatId1 = $articleInfo->getListCat();
		if($listCatId1 && $listCatId1 != ''){
			$arraylistCat1 = explode(",", $listCatId1);
			if($arraylistCat1)$template->assign('arraylistCat1',$arraylistCat1);
			//var_dump($arraylistCat1);
		}
		# Category combo box
		$categoryCombo = $articleCategories->generateCombo($articleInfo->getCatId());
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
		
		
		# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='article'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
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

	if($error['INPUT']['slug']['error'] || $error['INPUT']['title']['error']) {
		$error['invalid'] = 1;
		$error['message'] = '';
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>