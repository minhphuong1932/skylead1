<?php
/*************************************************************************
Admin manage module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 18\08\2012
**************************************************************************/
checkPermission(array(1,3,4));
if(!$act) $act = 'budget';
if(!$mod) $mod = 'list';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '');
include_once(ROOT_PATH.'modules/admin/budget/'.strtolower($act).strtolower($mod).'.module.php');

?>