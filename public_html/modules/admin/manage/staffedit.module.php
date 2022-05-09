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
$templateFile = 'managestaff.tpl.html';
include_once(ROOT_PATH . "classes/dao/district.class.php");
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH."classes/dao/searchs.class.php");
include_once(ROOT_PATH."classes/dao/users.class.php");
$users = new Users($storeId);

$userInfoTmp = $users->getObject($request->element('id'),'id');

if($userInfo->getType()==3||$userInfo->getType()==4){

}else{
	if($userInfo->getId()!=$request->element('id')&&$userInfo->getType()!=2){
		header("location: /admin.php?op=accessdenied");
	}elseif($userInfo->getType()==2){
		if(($userInfoTmp->getType()==2&&$userInfo->getId()!=$request->element('id'))||$userInfoTmp->getType()==3){
			header("location: /admin.php?op=accessdenied");
		}

	}elseif($userInfo->getType()!=2){
		header("location: /admin.php?op=accessdenied");
	}
   	
}

$template->assign('users',$users);
$district = new District();
$fields = new Fields($storeId);
$search= new Search($storeId);
$template->assign('BHYT',S_BHYT);
$template->assign('BHXH',S_BHXH);
$template->assign('BHTN',S_BHTN);
$template->assign('district',$district);
$combotinh1 = $district->createComboSe('0','0', array('id' => 'ASC') );
$comboquan1 = $district->createComboSe('0','0', array('id' => 'ASC') );
$template->assign('combotinh1',$combotinh1);
$template->assign('comboquan1',$comboquan1);
$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."users/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
//				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_staff'] => '/'.ADMIN_SCRIPT.'?op=manage&act=staff',
				$amessages['edit_item'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=staff';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['edit_item'] => '#',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode'); 
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$uInfo = $users->getObject($id);
if($uInfo) $template->assign('item1',$uInfo);
$ava=$uInfo->getProperty('avatar');
if($ava) $template->assign('ava',$ava);
if(!$uInfo) {
	$template->assign('validItem',0);
} else{
	$template->assign('validItem',1);

	# Allow some javascript
	$template->assign('ckEditor',1);
	
	if($request->element('doo') == 'delPhoto') { 
		$uInfo = $users->getObject($id);
		$properties = $uInfo->getProperties();
		foreach($properties['photos'] as $key => $value) {
			if($value == $request->element('photo')) {
				unlink($gallery_path."l_".$properties['photos'][$key]);
				unlink($gallery_path."a_".$properties['photos'][$key]);
				unlink($gallery_path."m_".$properties['photos'][$key]);
				unlink($gallery_path."t_".$properties['photos'][$key]);
				unset($properties['photos'][$key]);
				$data = array('properties' => serialize($properties));
				$users->updateData($data,$id);
				$uInfo = $users->getObject($id);
				break;
			}
		}
	}
	if($request->element('doo') == 'delAvatar') {
		$uInfo = $users->getObject($id);
		$properties = $uInfo->getProperties();
		if($uInfo->getProperty('avatar')) {
			unlink($gallery_path.'l_'.$uInfo->getProperty('avatar'));
			unlink($gallery_path.'a_'.$uInfo->getProperty('avatar'));
			unlink($gallery_path.'m_'.$uInfo->getProperty('avatar'));
			unlink($gallery_path.'t_'.$uInfo->getProperty('avatar'));
			unset($properties['avatar']);
			$data = array('properties' => serialize($properties));
			$users->updateData($data,$id);
			$uInfo = $users->getObject($id);
		}
	}	
	
	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$uInfo = $users->getObject($id);
			$template->assign('uInfo',$uInfo);
		} else {  
			if($request->element('password')) {
					$new_password = md5($request->element('password'));
					$confirm_password = md5($request->element('confirm_password'));
					if($new_password != $confirm_password) { # New password is same as confirm password
						$validate['INPUT']['confirm_password']['message'] = $amessages['invalid_confirm_password'];
						$validate['INPUT']['confirm_password']['error'] = 1;
						$validate['invalid'] = 1;
						$template->assign('error',$validate);
					}
				}
				# check duplicate username		
				if($users->checkDuplicate($request->element('username'),'username',"`id` <>'$id'")) {
					$validate['INPUT']['username']['message'] = $amessages['username_duplicated'];
					$validate['INPUT']['username']['error'] = 1;
					$validate['invalid'] = 1;
					$template->assign('error',$validate);
				}
				# check duplicate email
				// if($users->checkDuplicate($request->element('email'),'email',"`id` <>'$id'")) {
				// 	$validate['INPUT']['email']['message'] = $amessages['email_duplicated'];
				// 	$validate['INPUT']['email']['error'] = 1;
				// 	$validate['invalid'] = 1;
				// 	$template->assign('error',$validate);
				// }
				if($users->checkDuplicate($request->element('idNV'),'id_NV',"`id` <>'$id'")) {
					$validate['INPUT']['idNV']['message'] =$amessages['idNV_duplicated'];
					$validate['INPUT']['idNV']['error'] = 1;
					$validate['invalid'] = 1;
					$template->assign('error',$validate);
		}

		# Valid data input
			# Category combo box
			if(!$validate['invalid']) {
				$uInfo = $users->getObject($id);
				if($uInfo) {			
					$properties = $uInfo->getProperties();
					
					# Check if gallery folder is exists
					if(!file_exists($gallery_root)) mkdir("$gallery_root");
					if(!file_exists($gallery_path)) mkdir("$gallery_path");
					
					#User update
					$properties['user_update'] = $userInfo->getUsername();
					#File Avatar
					$fileAvatr = isset($_FILES['avatar'])?$_FILES['avatar']:'';
					if($fileAvatr) {
						$img = addslashes(Filter(rand()."_".$fileAvatr['name']));
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
								resize($gallery_path,$gallery_path,'l_'.$img,'m_'.$new_img,DEFAULT_MEDIUM_SIZE,DEFAULT_MEDIUM_SQUARE,DEFAULT_PHOTO_QUALITY);
								resize($gallery_path,$gallery_path,'l_'.$img,'t_'.$new_img,DEFAULT_THUMBNAIL_SIZE,DEFAULT_THUMBNAIL_SQUARE,DEFAULT_PHOTO_QUALITY);
								if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
								if($uInfo->getProperty('avatar')) {
									unlink($gallery_path.'a_'.$uInfo->getProperty('avatar'));
									unlink($gallery_path.'l_'.$uInfo->getProperty('avatar'));
									unlink($gallery_path.'m_'.$uInfo->getProperty('avatar'));
									unlink($gallery_path.'t_'.$uInfo->getProperty('avatar'));
								}
								$properties['avatar'] = $new_img;
							} 
						} #/if (preg_match
					}
					# Files upload
					$files = isset($_FILES['files'])?$_FILES['files']:'';
					if($files) {
						if(!isset($properties['photos'])) $properties['photos'] = array();
						if(!isset($properties['videos'])) $properties['videos'] = array();
						if(!isset($properties['files'])) $properties['files'] = array();
						for($i=0; $i<count($files['name']);$i++) {
							$img = addslashes(Filter(rand()."_".$files['name'][$i]));
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
					# End File upload
			//   $properties['tomtat'] =$request->element('tomtat');
//			$properties['listbrother'] =$request->element('listbrother');
		// 	$properties['tiensu']=$request->element('tiensu');
		// 	$properties['lichsulamviec'] =$request->element('lamviec');	
		// 	$properties['anh'] = $request->element('anh');
		// 	$properties['phap'] = $request->element('phap');
		// 	$properties['duc'] = $request->element('duc');
		// 	$properties['hoa'] = $request->element('hoa');
		// 	$properties['nhat'] = $request->element('nhat');
		// 	$properties['han'] = $request->element('han');
		// 	$properties['nga'] = $request->element('nga');
		// 	$properties['CCNV'] = $request->element('CCNV');
		//   $properties['PCCC'] = $request->element('PCCC');
		//   $properties['syll'] = $request->element('syll');
		// 	$properties['gksk'] = $request->element('gksk');
		// 	$properties['dxv'] = $request->element('dxv');
		// 	$properties['hk'] = $request->element('hk');
		// 	$properties['bc'] = $request->element('bc');
		// 	$properties['xnhk'] = $request->element('xnhk');
		// 	$properties['chungminh'] = $request->element('chungminh');
		// 	$properties['knbv'] = $request->element('knbv');
		// 	$properties['cap1'] = $request->element('cap1');
		// 	$properties['cap2'] = $request->element('cap2');
		// 	$properties['cap3'] = $request->element('cap3');
		// 	$properties['trungcap'] = $request->element('trungcap');
		// 	$properties['caodang'] = $request->element('caodang');
		// 	$properties['daihoc'] = $request->element('daihoc');
		// 	$properties['saudaihoc'] = $request->element('saudaihoc');
		// 	$properties['bckhac'] = $request->element('bckhac');
			 $uType = $request->element('user_group');
			
		  if($uType == U_SITE_FOUNDER && (!$userInfo->isSiteFounder() && !$userInfo->isSiteAdmin())) $uType = U_SITE_STAFF;	# chi co founder moi co quyen them user dang Founder
		  $date_join = $request->element('date_join');
			// $date_join1 = date('Y-m-d', strtotime($date_join));
			// $date_leave = $request->element('date_leave');
			// $date_leave1 = date('Y-m-d', strtotime($date_leave));
			$date_birth = $request->element('date');
			$date_birth1 = date('Y-m-d', strtotime($date_birth));
			// $date_cap = $request->element('datecap');
			// $date_cap1 = date('Y-m-d', strtotime($date_cap));
			// $tinhthanh = $request->element('province');
			// $quanhuyen = $request->element('national');
			// $tinhthanh1 = $request->element('province1');
			// $quanhuyen1 = $request->element('national1');
			$data = array('store_id' => Filter($storeId),
						  'username' => Filter($request->element('username')),
						  
						//   'email' => Filter($request->element('email')),
						  'fullname' => Filter($request->element('fullname')),
						//   'address' => Filter($request->element('address')),
						//   'tel' => Filter($request->element('telephone')),
						  'id_NV'=>Filter($request->element('idNV')),
						//   'date_joining'=>$date_join1,
						//   'date_leaving'=>$date_leave1,
						  'date_birth'=>$date_birth,
						//   'gender'=> Filter($request->element('user_gioitinh')),
						//   'height'=> Filter($request->element('height')),
						//   'weight'=> Filter($request->element('weight')),
						//   'address_tt'=> $request->element('addresstt'),
						//   'tinhthanh_tt'=>$tinhthanh,
						//   'quanhuyen_tt' =>$quanhuyen,
						//   'address_lh'=>$request->element('addresslh'),
						//   'tinhthanh_lh'=>$tinhthanh1,
						//   'quanhuyen_lh' =>$quanhuyen1,
						//   'CMND'=>$request->element('CMND'),
						//   'date_cap'=> $date_cap1,
						//   'id_gioithieu'=>Filter($request->element('id_angt')),
						//   'id_target'=>Filter($request->element('id_target')),
						//   'noi_cap' => $request->element('noicap'),
						//   'contact_person'=> $request->element('contact_person'),
						//   'contact_relationship'=> $request->element('contact_relationship'),
						//   'contact_phone'=> $request->element('contact_phone'),
						//   'type_marry'=> $request->element('honnhan'),
						//   'name_vochong'=> $request->element('vochong'),
						//   'trinhdoVH'=> $request->element('vanhoa'),
						//   'tdvhkhac'=> $request->element('tdkhac'),
						//   'cuu_quannhan'=> $request->element('quannhan'),
						//   'kinhnghiem'=> $request->element('kinhnghiem'),
						//   'baohiem'=> $request->element('baohiem'),
						//   'luong_BH'=>  $request->element('luong_baohiem'),
						//   'luongcd_BH' =>$request->element('luongcd'),
						//   'nguoidongthue'=> $request->element('nguoidongthue'),
						//   'BHYT'=>$request->element('BHYT'),
						//   'BHXH' =>$request->element('BHXH'),
						//   'BHTN' =>$request->element('BHTN'),
						//   'thue_TNCN'=>$request->element('TNCN'),
						//   'luongcd_TNCN'=>$request->element('luongthuecd'),
						//   'luong_TNCN'=>$request->element('thueTNCN'),
						//   'STK'=>$request->element('STK'),
//						  'name_tk'=>$request->element('chutk'),
						//   'name_ngh'=>$request->element('name_nh'),
//						  'chinhanh'=>$request->element('chinhanh'),
						//   'ngoaingu'=>$request->element('ngoaingu'),
						//   'properties' => serialize($properties),
						//   'dantoc' =>$request->element('dantoc'),
						//   'tongiao'=>$request->element('tongiao'),
						//   'doanvien'=>$request->element('doanvien'),
						//   'dangvien'=>$request->element('dangvien'),
						//   'thigiac'=>$request->element('thigiac'),
						  'type' => Filter($uType),
						  'status' => S_ENABLED,
						  'date_created' => date("Y-m-d H:i:s"));
			if($request->element('password')) $data['password'] = md5($request->element('password'));
								$users->updateData($data,$id);

			// if($userInfo->getType()!=4&&$userInfo->getType()!=3){
			// 	if($uType!=4&&$uType!=2&&$uType!=3)
			// 		$users->updateData($data,$id);


			// }elseif($userInfo->getType()==3){
			// 	if($uType!=4&&$uType!=3)
			// 		$users->updateData($data,$id);
			// }elseif($userInfo->getType()==4){
			// 	$users->updateData($data,$id);

			// }
			
					// #Update table search
     //                $newItem = $articles->getObject($id,'id');
     //                $url='';
     //                if($newItem);
     //                {
     //                    $url = $newItem->getUrl();
     //                }
     //                $dataSearch=array('store_id' => $storeId,
     //                                'slug' => $slug,
     //                                'title' => Filter($request->element('title')),
					// 			    'keyword' => Filter($request->element('keyword')),
					// 			    'sapo' => Filter($request->element('sapo')),
					// 			    'detail' => addslashes($request->element('detail')),
     //                                'status' => $request->element('status'),
     //                                'url'=>$url
     //                );

     //                $search->updateData($dataSearch,'article',$id);
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_article'],$request->element('title')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
					# Redirect to editing page
					header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=staff&mod=edit&lang=$lang&id=$id&rcode=7");
				}
			}
		}
	} else { # Load article category information to edit
		$template->assign('item',$uInfo);
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['username'] = $validate->validUsername($request->element('username'));
	if($request->element('password')){
		$error['INPUT']['password'] = $validate->validPassword($request->element('password'));
	}
	if($request->element('cpassword')){
		$error['INPUT']['confirm_password'] = $validate->validTestPass($request->element('confirm_password'),$amessages['cpassword']);
	}
	$error['INPUT']['fullname'] = $validate->validString($request->element('fullname'),$amessages['fullname']);
	// $error['INPUT']['email'] = $validate->validEmail($request->element('email'));
	$error['INPUT']['idNV'] = $validate->validString($request->element('idNV'));
	$error['INPUT']['email'] = $validate->validString($request->element('email'));
	
	if($error['INPUT']['username']['error'] || $error['INPUT']['fullname']['error'] || $error['INPUT']['idNV']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>