<?php
/*************************************************************************
Admin change password module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 16/07/2008
**************************************************************************/
$templateFile = 'systemarea.tpl.html';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['system'] => '/'.ADMIN_SCRIPT.'?op=system',
				$amessages['manage_area'] => '');

if(!$mod) $mod = 'list';
if($mod) include_once(ROOT_PATH.'modules/admin/system/'.strtolower($act).strtolower($mod).'.module.php');
?>