<?php
/*************************************************************************
Admin manage module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 16/07/2008
**************************************************************************/
checkPermission(array(1,2,3,4,5,6,7));
if(!$act) $act = 'index';
if(!$mod) $mod = 'list';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_original_data'] => '');
if(file_exists(ROOT_PATH.'modules/admin/manage/'.strtolower($act).strtolower($mod).'.module.php')) {
	include_once(ROOT_PATH.'modules/admin/manage/'.strtolower($act).strtolower($mod).'.module.php');
}
?>