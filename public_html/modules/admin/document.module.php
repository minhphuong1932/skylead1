<?php
/*************************************************************************
Admin manage module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 16/07/2008
**************************************************************************/
checkPermission(array(1,2,3,4));
if(!$act) $act = 'manage';
if(!$mod) $mod = 'list';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['document'] => '');
if(file_exists(ROOT_PATH.'modules/admin/document/'.strtolower($act).strtolower($mod).'.module.php')) {
	include_once(ROOT_PATH.'modules/admin/document/'.strtolower($act).strtolower($mod).'.module.php');
}
?>