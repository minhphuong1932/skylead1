<?php
/*************************************************************************
Advance payment  module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com

Coder: Quan Huynh
Last updated: 08/05/2018
**************************************************************************/
checkPermission(array(1,3,4));
if(!$act) $act = 'advancepayment';
if(!$mod) $mod = 'list';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_advance_payment'] => '');
include_once(ROOT_PATH.'modules/admin/manage/'.strtolower($act).strtolower($mod).'.module.php');

?>