<?php
/*************************************************************************
Admin staff listing module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 22/05/2012
Coder: Mai Minh
**************************************************************************/
checkPermission(array(4,3,2,7));
$templateFile = 'managestaff.tpl.html';

include_once(ROOT_PATH . "classes/dao/district.class.php");
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/users.class.php');
$district = new District();
$template->assign('district',$district);
$combotinh1 = $district->createComboSe('0','0', array('id' => 'ASC') );
$comboquan1 = $district->createComboSe('0','0', array('id' => 'ASC') );
$template->assign('combotinh1',$combotinh1);
$template->assign('comboquan1',$comboquan1);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				// $amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_staff'] => '/'.ADMIN_SCRIPT.'?op=manage&act=staff',
				$amessages['list_item'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=staff';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');
 if($userInfo->isSiteFounder() || $userInfo->isSiteAdmin()) $listTabs[$amessages['tracking_title']] = $tabLink.'&mod=listTracking';
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'date_created';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);

$gid = $request->element('gid')?$request->element('gid'):'';
if($do != 'search' && !$gid) $gid = 'all';
if(isset($gid)) $template->assign('gid',$gid);

$from = $request->element('from')?$request->element('from'):'';
if($from) $template->assign('from',$from);

$to = $request->element('to')?$request->element('to'):'';
if($to) $template->assign('to',$to);
# Build WHERE condition
$condition = '1>0';
$condition.= " AND `type` >0";
if($kw) $condition = "(id='$kw' OR `id_NV` LIKE '%$kw%' OR username LIKE '%$kw%' OR fullname LIKE '%$kw%' OR email LIKE '%$kw%')";
if(isset($gid)&& $gid != 'all') $condition .= " AND (`type`='$gid')";


//if(isset($ngoaingu)&& $ngoaingu != 'all') $condition .= " AND (`properties` LIKE '%$ngoaingu%')";
if(!$userInfo->isSiteFounder() && !$userInfo->isSiteAdmin()) $condition .= " AND `type` <> '".U_SITE_FOUNDER."'";
if(!$userInfo->isSiteAdmin()) $condition .= " AND `type` <> '".U_SITE_ADMINISTRATOR."'";
if(!$userInfo->isSiteFounder() && !$userInfo->isSiteSuperAdmin()) $condition .= " AND `type` <> '".U_SITE_SUPERADMIN."'";
// if($userInfo->getType() != 7) $condition .= " AND `type` <> 7";

$pages_condition = "`store_id` ='$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);
// var_dump($condition);
# Page navigation
$rowsPages = $users->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=manage&act=staff&mod=list&doo=$do&kw=$kw&gid=$gid&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);
//var_dump($condition);
# Get objects
// echo $condition;
// die();
$listItems = $users->getObjects($page,$condition,$sort,$items_per_page);
// var_dump($listItems);
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=manage&act=staff&mod=list&kw=$kw&gid=$gid&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page";
$template->assign('link',$link);

if($_POST) {
	switch($do) {
		case 'enable':
			$id = $request->element('id');
			if($id) {
				$uType = $users->getUserType("`id`='$id'");
				
				if($uType == U_SITE_FOUNDER || $uType == U_SITE_ADMINISTRATOR) { # Neu user can kich hoat la Founder thi chi co founder moi co quyen enable
					if(!$userInfo->isSiteFounder() && !$userInfo->isSiteAdmin() ) {
						header("location: /admin.php?op=accessdenied");
						exit;
					}else {
						$users->changeStatus($id,S_ENABLED);
						$result_code = 1;
						# Operation tracking
						$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_user'],$users->getUsername("`id`='$id'")),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					}
				} else {
					$users->changeStatus($id,S_ENABLED);
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_user'],$users->getUsername("`id`='$id'")),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				}
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listUser = '';
					foreach ($ids as $id) {
						$uType = $users->getUserType("`id`='$id'");
						if($uType == U_SITE_FOUNDER || $uType == U_SITE_ADMINISTRATOR) {	# Neu user can kich hoat la Founder thi chi co founder moi co quyen enable
							if($userInfo->isSiteFounder() || $userInfo->isSiteAdmin()) {
								$users->changeStatus($id,S_ENABLED);
								$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
							}else {
							$users->changeStatus($id,S_ENABLED);
							$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
						}
						} else {
							$users->changeStatus($id,S_ENABLED);
							$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
						}
					}
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_user'],$listUser),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$id = $request->element('id');
			if($id) {
				$uType = $users->getUserType("`id`='$id'");
				if($uType == U_SITE_FOUNDER || $uType == U_SITE_ADMINISTRATOR) { # Neu user can kich hoat la Founder thi chi co founder moi co quyen enable
					if(!$userInfo->isSiteFounder() && !$userInfo->isSiteAdmin()) {
						header("location: /admin.php?op=accessdenied");
						exit;
					}else {
						$users->changeStatus($id,S_DISABLED);
						$result_code = 2;
						# Operation tracking
						$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_user'],$users->getUsername("`id`='$id'")),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					}
				} else {
					$users->changeStatus($id,S_DISABLED);
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_user'],$users->getUsername("`id`='$id'")),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				}
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listUser = '';
					foreach ($ids as $id) {
						$uType = $users->getUserType("`id`='$id'");
						if($uType == U_SITE_FOUNDER || $uType == U_SITE_ADMINISTRATOR) {	# Neu user bi xoa la Founder thi chi co founder moi co quyen disable
							if($userInfo->isSiteFounder() || $userInfo->isSiteAdmin()) {
								$users->changeStatus($id,S_DISABLED);
								$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
							}
						} else {
							$users->changeStatus($id,S_DISABLED);
							$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
						}
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_user'],$listUser),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$id = $request->element('id');
			if($id) {
				$uType = $users->getUserType("`id`='$id'");
				# if(($uType == U_SITE_FOUNDER && !$userInfo->isSiteFounder())||($uType == U_SITE_ADMINISTRATOR && !$userInfo->isSiteAdmin())) { 
				if(($uType == U_SITE_FOUNDER && !$userInfo->isSiteAdmin()) || $uType == U_SITE_ADMINISTRATOR ||($uType == U_SITE_FOUNDER && !$userInfo->isSiteSuperAdmin())){ 
				# Neu user bi xoa la Founder thi chi co founder moi co quyen xoa
					header("location: /admin.php?op=accessdenied");
					exit;
				} else {
					$users->changeStatus($id,S_DELETED);
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_user'],$users->getUsername("`id`='$id'")),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				}
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listUser = '';
					foreach ($ids as $id) {
						$uType = $users->getUserType("`id`='$id'");
						if($uType == U_SITE_FOUNDER) {	# Neu user bi xoa la Founder thi chi co founder moi co quyen xoa
							if($userInfo->isSiteAdmin()){
								$users->changeStatus($id,S_DELETED);
								$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
							}else{
								header("location: /admin.php?op=accessdenied");
								exit;
							}
						} else {
							$users->changeStatus($id,S_DELETED);
							$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
						}
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_user'],$listUser),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'exportexcel':
		include_once(ROOT_PATH.'PHPExcel.php');
include_once(ROOT_PATH.'PHPExcel/IOFactory.php');
include_once(ROOT_PATH.'PHPExcel/Writer/Excel5.php');
		
			$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Danh sách vé của sự kiện');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(90);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);

$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'STT');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'MÃ NHÀ PHÂN PHỐI');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'MÃ VÉ MỜI');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'SỐ SERIAL');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'LINK DOWNLOAD VÉ');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'HỌ TÊN KHÁCH HÀNG');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'SỐ ĐIỆN THOẠI');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'EMAIL');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'NGÀY CHECK-IN');


  header( 'Content-Type: application/vnd.ms-excel' );
  header( 'Content-Disposition: attachment;filename="Danhsach1.xls"' );
  header( 'Cache-Control: max-age=0' );

    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    $objWriter->save( 'php://output' );   
        //header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=event&mod=listnpp&uId=$eid&rcode=6");

exit();
		break;
		case 'changegroup':
			$ids = $request->element('ids');
			$type = $request->element('type');
			$listType = array();
			if($userInfo->isSiteAdmin()) $listType = array(U_SITE_STAFF,U_SITE_ADMINISTRATOR,U_SITE_FOUNDER,U_SITE_ADMIN,U_SITE_SUPERADMIN,U_SITE_MEMBER,U_SITE_KHACH);
			if($userInfo->isSiteFounder()) $listType = array(U_SITE_STAFF,U_SITE_ADMIN,U_SITE_FOUNDER,U_SITE_SUPERADMIN,U_SITE_MEMBER,U_SITE_KHACH);
			if($ids) {
				if($type && in_array($type,$listType)) {
					$listUser = '';
					foreach ($ids as $id) {
						$users->changeType($id,$type);
						$listUser .= ($listUser?',&nbsp;':'').$users->getUsername("`id`='$id'");
					}
					$result_code = 4;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_user_group'],$listUser,$amessages['type_user'][$type]),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 6;
			} else $error_code = 5;
			break;
		case 'cleantrash':
			checkPermission(array(3,4));
			$users->cleanTrash();
			$result_code = 5;
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_user'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			break;
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=staff&mod=list&lang=$lang&ecode=7");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=staff&mod=list&doo=$do&kw=$kw&gid=$gid&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code");
} else {

}
?>