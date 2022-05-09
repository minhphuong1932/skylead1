<?php
/*************************************************************************
budget Currency module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 28/05/2012
Coder: Mai Minh
**************************************************************************/
$templateFile = 'budgetcurrency.tpl.html';
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['system_currency'] => '');

if(!$mod) $mod = 'list';
if($mod) include_once(ROOT_PATH.'modules/admin/budget/'.strtolower($act).strtolower($mod).'.module.php');
?>