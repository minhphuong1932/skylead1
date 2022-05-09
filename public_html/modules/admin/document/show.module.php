<?php
/*************************************************************************
System config module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 22/05/2012
Coder: Mai Minh
**************************************************************************/
checkPermission(array(1,2,3));
$templateFile = 'documentmanage.tpl.html';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['document'] => '/'.ADMIN_SCRIPT.'?op=document',
				$amessages['manage_document'] => '');

if(!$mod) $mod = 'list';
if($mod) include_once(ROOT_PATH.'modules/admin/document/'.strtolower($act).strtolower($mod).'.module.php');
?>