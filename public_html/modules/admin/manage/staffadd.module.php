<?php
/*************************************************************************
Staff permission module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 22/05/2012
Edit log:
- 29/09/2011 - Mai Minh: Check ID, add filter to form's fields
- 22/05/2012 - Mai Minh: Modify the tabs
**************************************************************************/

checkPermission(array(4,3,2,7));
$templateFile = 'managestaff.tpl.html';
include_once(ROOT_PATH . "classes/dao/district.class.php");
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$district = new District();
$fields = new Fields($storeId);
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
				// $amessages['manage_we'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_staff'] => '/'.ADMIN_SCRIPT.'?op=manage&act=staff',
				$amessages['add_new'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=staff';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => '',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');
if($userInfo->isSiteFounder() || $userInfo->isSiteAdmin()) $listTabs[$amessages['tracking_title']] = $tabLink.'&mod=listTracking';
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate username
		if($users->checkDuplicate($request->element('username'),'username')) {
			$validate['INPUT']['username']['message'] = $amessages['username_duplicated'];
			$validate['INPUT']['username']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		if($users->checkDuplicate($request->element('idNV'),'id_NV')) {
			$validate['INPUT']['idNV']['message'] =$amessages['idNV_duplicated'];
			$validate['INPUT']['idNV']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		# check duplicate email
		// if($users->checkDuplicate($request->element('email'),'email')) {
		// 	$validate['INPUT']['email']['message'] = $amessages['email_duplicated'];
		// 	$validate['INPUT']['email']['error'] = 1;
		// 	$validate['invalid'] = 1;
		// 	$template->assign('error',$validate);
		// }

					# User upload
	 
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			if(!file_exists($gallery_root)) mkdir("$gallery_root");
			if(!file_exists($gallery_path)) mkdir("$gallery_path");

			$userUpload = $userInfo->getUsername();
		
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
						if(isBmp($img)) $new_img = preg_replace("/(bmp$)/","jpg",$img);
						resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
						resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
						if(CREATE_PRODUCT_AVATAR_CORNER) imageCreateCorners($gallery_path.'a_'.$new_img, 9);
						resize($gallery_path,$gallery_path,'l_'.$img,'m_'.$new_img,DEFAULT_MEDIUM_SIZE,DEFAULT_MEDIUM_SQUARE,DEFAULT_PHOTO_QUALITY);
						resize($gallery_path,$gallery_path,'l_'.$img,'t_'.$new_img,DEFAULT_THUMBNAIL_SIZE,DEFAULT_THUMBNAIL_SQUARE,DEFAULT_PHOTO_QUALITY);
						if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
						$avatar = $new_img;
					} 
				} #/if (preg_match
			}
			

			$files = isset($_FILES['files'])?$_FILES['files']:'';
			if($files) {
				$uphotos = array();
				$uvideos = array();
				$ufiles = array();
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
							if(isBmp($img)) $new_img = preg_replace("/(bmp$)/","jpg",$img);
							resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
							resize($gallery_path,$gallery_path,'l_'.$img,'m_'.$new_img,DEFAULT_MEDIUM_SIZE,DEFAULT_MEDIUM_SQUARE,DEFAULT_PHOTO_QUALITY);
							resize($gallery_path,$gallery_path,'l_'.$img,'t_'.$new_img,DEFAULT_THUMBNAIL_SIZE,DEFAULT_THUMBNAIL_SQUARE,DEFAULT_PHOTO_QUALITY);
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
		$properties['avatar']= $avatar;
		$properties['photos']= $uphotos;
		$properties['videos']= $uvideos;
		$properties['files']= $ufiles;
		$properties['tomtat'] =$request->element('tomtat');
//		$properties['listbrother'] =$request->element('listbrother');
		$properties['tiensu']=$request->element('tiensu');
		$properties['lichsulamviec'] =$request->element('lamviec');	
		$properties['anh'] = $request->element('anh');
		$properties['phap'] = $request->element('phap');
		$properties['duc'] = $request->element('duc');
		$properties['hoa'] = $request->element('hoa');
		$properties['nhat'] = $request->element('nhat');
		$properties['han'] = $request->element('han');
		$properties['nga'] = $request->element('nga');
		$properties['CCNV'] = $request->element('CCNV');
		$properties['PCCC'] = $request->element('PCCC');
		$properties['syll'] = $request->element('syll');
		$properties['gksk'] = $request->element('gksk');
		$properties['dxv'] = $request->element('dxv');
		$properties['hk'] = $request->element('hk');
		$properties['bc'] = $request->element('bc');
		$properties['xnhk'] = $request->element('xnhk');
		$properties['chungminh'] = $request->element('chungminh');
		$properties['knbv'] = $request->element('knbv');
		$properties['cap1'] = $request->element('cap1');
		$properties['cap2'] = $request->element('cap2');
		$properties['cap3'] = $request->element('cap3');
		$properties['trungcap'] = $request->element('trungcap');
		$properties['caodang'] = $request->element('caodang');
		$properties['daihoc'] = $request->element('daihoc');
		$properties['saudaihoc'] = $request->element('saudaihoc');
		$properties['bckhac'] = $request->element('bckhac');
			 $uType = $request->element('user_group');
			// $permissions = array();
			// if($uType==1){
			// 	$permissions['customer'] = $request->element('customer');
			// 		$permissions['document-type'] = $request->element('document-type');
			// 		$permissions['groups'] = $request->element('groups');
			// 		$permissions['document'] = $request->element('document1');
			// 		$permissions['dashboard'] = $request->element('dashboard');
			// 		$properties['permissions'] = $permissions;
			// }
			// if($uType==2){
				
			// 		$permissions['document'] = $request->element('document1');
			// 		$permissions['dashboard'] = $request->element('dashboard');
			// 		$properties['permissions'] = $permissions;
			// }

			if($uType == U_SITE_FOUNDER && (!$userInfo->isSiteFounder() && !$userInfo->isSiteAdmin())) $uType = U_SITE_STAFF;	# chi co founder moi co quyen them user dang Founder
			$date_join = $request->element('date_join');
			$date_join1 = date('Y-m-d', strtotime($date_join));
			$date_leave = $request->element('date_leave');
			$date_leave1 = date('Y-m-d', strtotime($date_leave));
			$date_birth = $request->element('date');
			$date_birth1 = date('Y-m-d', strtotime($date_birth));
			$date_cap = $request->element('datecap');
			$date_cap1 = date('Y-m-d', strtotime($date_cap));
			$tinhthanh = $request->element('province');
			$quanhuyen = $request->element('national');
			$tinhthanh1 = $request->element('province1');
			$quanhuyen1 = $request->element('national1');
			$data = array('store_id' => Filter($storeId),
						  'username' => Filter($request->element('username')),
						  'password' => md5($request->element('password')),
						  'email' => Filter($request->element('email')),
						  'fullname' => Filter($request->element('fullname')),
						  'address' => Filter($request->element('address')),
						  'tel' => Filter($request->element('telephone')),
						  'id_NV'=>Filter($request->element('idNV')),
						  'date_joining'=>$date_join1,
						  'date_leaving'=>$date_leave1,
						  'date_birth'=>$date_birth1,
						  'id_gioithieu'=>Filter($request->element('id_angt')),
						  'id_target'=>Filter($request->element('id_target')),
						  'gender'=> Filter($request->element('user_gioitinh')),
						  'height'=> Filter($request->element('height')),
						  'weight'=> Filter($request->element('weight')),
						  'address_tt'=> $request->element('addresstt'),
						  'tinhthanh_tt'=>$tinhthanh,
						  'quanhuyen_tt' =>$quanhuyen,
						  'address_lh'=>$request->element('addresslh'),
						  'tinhthanh_lh'=>$tinhthanh1,
						  'quanhuyen_lh' =>$quanhuyen1,
						  'CMND'=>$request->element('CMND'),
						  'date_cap'=> $date_cap1,
						  'noi_cap' => $request->element('noicap'),
						  'contact_person'=> $request->element('contact_person'),
						  'contact_relationship'=> $request->element('contact_relationship'),
						  'contact_phone'=> $request->element('contact_phone'),
						  'type_marry'=> $request->element('honnhan'),
						  'name_vochong'=> $request->element('vochong'),
						  'trinhdoVH'=> $request->element('vanhoa'),
						  'tdvhkhac'=> $request->element('tdkhac'),
						  'cuu_quannhan'=> $request->element('quannhan'),
						  'kinhnghiem'=> $request->element('kinhnghiem'),
						  'baohiem'=> $request->element('baohiem'),
						  'luong_BH'=>  $request->element('luong_baohiem'),
						  'luongcd_BH' =>$request->element('luongcd'),
						  'BHYT'=>$request->element('BHYT'),
						  'BHXH' =>$request->element('BHXH'),
						  'BHTN' =>$request->element('BHTN'),
						  'thue_TNCN'=>$request->element('TNCN'),
						  'STK'=>$request->element('STK'),
//						  'name_tk'=>$request->element('chutk'),
						  'name_ngh'=>$request->element('name_nh'),
//						  'chinhanh'=>$request->element('chinhanh'),
						  'luongcd_TNCN'=>$request->element('luongthuecd'),
						  'luong_TNCN'=>$request->element('thueTNCN'),
						  'nguoidongthue'=>$request->element('nguoidongthue'),
						  'ngoaingu'=>$request->element('ngoaingu'),
						  'properties' => serialize($properties),
						  'dantoc' =>$request->element('dantoc'),
						  'tongiao'=>$request->element('tongiao'),
						  'doanvien'=>$request->element('doanvien'),
						  'dangvien'=>$request->element('dangvien'),
						  'thigiac'=>$request->element('thigiac'),
						  'type' => Filter($uType),
						  'status' => S_ENABLED,
						  'date_created' => date("Y-m-d H:i:s"));
		
			if($userInfo->getType()!=4&&$userInfo->getType()!=3){
				if($uType!=4&&$uType!=2&&$uType!=3)
					$users->addData($data);


			}elseif($userInfo->getType()==3){
				if($uType!=4&&$uType!=3)
					$users->addData($data);
			}elseif($userInfo->getType()==4){
				$users->addData($data);

			}
			# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_user'],$request->element('username')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=staff&mod=add&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['username'] = $validate->validUsername($request->element('username'));
	$error['INPUT']['password'] = $validate->validPassword($request->element('password'));
	$error['INPUT']['confirm_password'] = $validate->validPassword($request->element('confirm_password'),$amessages['confirm_password']);	
	$error['INPUT']['idNV'] = $validate->validString($request->element('idNV'),$amessages['idNV']);
	$error['INPUT']['fullname'] = $validate->validString($request->element('fullname'),$amessages['fullname']);
	$error['INPUT']['date'] = $validate->pasteString($request->element('date'));
	$error['INPUT']['user_gioitinh'] = $validate->pasteString($request->element('user_gioitinh'));
	$error['INPUT']['dantoc'] = $validate->pasteString($request->element('dantoc'));
	$error['INPUT']['tongiao'] = $validate->pasteString($request->element('tongiao'));
	$error['INPUT']['weight'] = $validate->pasteString($request->element('weight'));
	$error['INPUT']['height'] = $validate->pasteString($request->element('height'));
	$error['INPUT']['telephone'] = $validate->pasteString($request->element('telephone'));
	$error['INPUT']['email'] = $validate->pasteString($request->element('email'));
	$error['INPUT']['CMND'] = $validate->pasteString($request->element('CMND'));
	$error['INPUT']['datecap'] = $validate->pasteString($request->element('datecap'));
	$error['INPUT']['noicap'] = $validate->pasteString($request->element('noicap'));
	$error['INPUT']['doanvien'] = $validate->pasteString($request->element('doanvien'));
	$error['INPUT']['dangvien'] = $validate->pasteString($request->element('dangvien'));
	$error['INPUT']['contact_person'] = $validate->pasteString($request->element('contact_person'));
	$error['INPUT']['contact_relationship'] = $validate->pasteString($request->element('contact_relationship'));
	$error['INPUT']['contact_phone'] = $validate->pasteString($request->element('contact_phone'));
	$error['INPUT']['honnhan'] = $validate->pasteString($request->element('honnhan'));
	$error['INPUT']['vanhoa'] = $validate->pasteString($request->element('vanhoa'));
	
	$error['INPUT']['addresstt'] = $validate->pasteString($request->element('addresstt'));
	$error['INPUT']['province'] = $validate->pasteString($request->element('province'));
	$error['INPUT']['national'] = $validate->pasteString($request->element('national'));
	$error['INPUT']['addresslh'] = $validate->pasteString($request->element('addresslh'));
	$error['INPUT']['province1'] = $validate->pasteString($request->element('province1'));
	$error['INPUT']['national1'] = $validate->pasteString($request->element('national1'));
	$error['INPUT']['user_group'] = $validate->pasteString($request->element('user_group'));
	$error['INPUT']['gioithieu'] = $validate->pasteString($request->element('gioithieu'));
	$error['INPUT']['muctieu'] = $validate->pasteString($request->element('muctieu'));
	$error['INPUT']['id_angt'] = $validate->pasteString($request->element('id_angt'));
	$error['INPUT']['id_target'] = $validate->pasteString($request->element('id_target'));
	$error['INPUT']['date_join'] = $validate->pasteString($request->element('date_join'));
	$error['INPUT']['date_leave'] = $validate->pasteString($request->element('date_leave'));
	// $error['INPUT']['email'] = $validate->validEmail($request->element('email'));
	$error['INPUT']['vochong'] = $validate->pasteString($request->element('vochong'));
	$error['INPUT']['quannhan'] = $validate->pasteString($request->element('quannhan'));
	$error['INPUT']['kinhnghiem'] = $validate->pasteString($request->element('kinhnghiem'));
	$error['INPUT']['baohiem'] = $validate->pasteString($request->element('baohiem'));
	$error['INPUT']['luong_baohiem'] = $validate->pasteString($request->element('luong_baohiem'));
	$error['INPUT']['luongcd'] = $validate->pasteString($request->element('luongcd'));
	$error['INPUT']['BHYT'] = $validate->pasteString($request->element('BHYT'));
	$error['INPUT']['BHXH'] = $validate->pasteString($request->element('BHXH'));
	$error['INPUT']['BHTN'] = $validate->pasteString($request->element('BHTN'));
	$error['INPUT']['TNCN'] = $validate->pasteString($request->element('TNCN'));
//	$error['INPUT']['TNCN'] = $validate->pasteString($request->element('TNCN'));
	$error['INPUT']['thueTNCN'] = $validate->pasteString($request->element('thueTNCN'));
	$error['INPUT']['luongthuecd'] = $validate->pasteString($request->element('luongthuecd'));
	$error['INPUT']['nguoidongthue'] = $validate->pasteString($request->element('nguoidongthue'));
	$error['INPUT']['STK'] = $validate->pasteString($request->element('STK'));
//	$error['INPUT']['chutk'] = $validate->pasteString($request->element('chutk'));
	$error['INPUT']['name_nh'] = $validate->pasteString($request->element('name_nh'));
//	$error['INPUT']['chinhanh'] = $validate->pasteString($request->element('chinhanh'));
	$error['INPUT']['anh'] = $validate->pasteString($request->element('anh'));
	$error['INPUT']['phap'] = $validate->pasteString($request->element('phap'));
	$error['INPUT']['duc'] = $validate->pasteString($request->element('duc'));
	$error['INPUT']['hoa'] = $validate->pasteString($request->element('hoa')); 
	$error['INPUT']['nhat'] = $validate->pasteString($request->element('nhat'));
	$error['INPUT']['han'] = $validate->pasteString($request->element('han'));
	$error['INPUT']['nga'] = $validate->pasteString($request->element('nga'));
	$error['INPUT']['syll'] = $validate->pasteString($request->element('syll'));
	$error['INPUT']['gksk'] = $validate->pasteString($request->element('gksk'));
	$error['INPUT']['dxv'] = $validate->pasteString($request->element('dxv'));
	$error['INPUT']['hk'] = $validate->pasteString($request->element('hk'));
	$error['INPUT']['bc'] = $validate->pasteString($request->element('bc'));
	$error['INPUT']['xnhk'] = $validate->pasteString($request->element('xnhk'));
	$error['INPUT']['chungminh'] = $validate->pasteString($request->element('chungminh'));
	$error['INPUT']['knbv'] = $validate->pasteString($request->element('knbv'));
	$error['INPUT']['cap1'] = $validate->pasteString($request->element('cap1'));
	$error['INPUT']['cap2'] = $validate->pasteString($request->element('cap2'));
	$error['INPUT']['cap3'] = $validate->pasteString($request->element('cap3'));
	$error['INPUT']['trungcap'] = $validate->pasteString($request->element('trungcap'));
	$error['INPUT']['caodang'] = $validate->pasteString($request->element('caodang'));
	$error['INPUT']['daihoc'] = $validate->pasteString($request->element('daihoc'));
	$error['INPUT']['saudaihoc'] = $validate->pasteString($request->element('saudaihoc'));
	$error['INPUT']['bckhac'] = $validate->pasteString($request->element('bckhac'));
	$error['INPUT']['CCNV'] = $validate->pasteString($request->element('CCNV'));
	$error['INPUT']['PCCC'] = $validate->pasteString($request->element('PCCC'));
//	$error['INPUT']['province'] = $validate->pasteString($request->element('province'));
//	$error['INPUT']['province1'] = $validate->pasteString($request->element('province1'));
//	$error['INPUT']['national'] = $validate->pasteString($request->element('national'));
//	$error['INPUT']['national1'] = $validate->pasteString($request->element('national1'));
	$error['INPUT']['tomtat'] = $validate->pasteString($request->element('tomtat'));
//	$error['INPUT']['listbrother'] = $validate->pasteString($request->element('listbrother'));
	$error['INPUT']['thigiac'] = $validate->pasteString($request->element('thigiac'));
	$error['INPUT']['tiensu'] = $validate->pasteString($request->element('tiensu'));
	$error['INPUT']['lamviec'] = $validate->pasteString($request->element('lamviec'));
	$error['INPUT']['real_employee'] = $validate->pasteString($request->element('real_employee'));

	if($error['INPUT']['username']['error'] || $error['INPUT']['password']['error'] || $error['INPUT']['confirm_password']['error'] || $error['INPUT']['idNV']['error'] || $error['INPUT']['fullname']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>