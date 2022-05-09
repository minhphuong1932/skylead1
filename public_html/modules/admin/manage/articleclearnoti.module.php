<?php

checkPermission(array(2,3));
	$templateFile = 'managequotes.tpl.html';
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH . "classes/dao/users.class.php");
include_once(ROOT_PATH.'classes/dao/notifications.class.php');
$notifications = new Notifications($storeId);
$users = new Users($storeId);
$textFilter = new TextFilter();
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_article'] => '/'.ADMIN_SCRIPT.'?op=manage&act=article',
				$amessages['list_item'] => '');

if($_SESSION['userId']){
	$userIdC = $users->getObject($_SESSION['userId']);
	$curId=$userIdC->getId();
	$curType=$userIdC->getType();
	$curCusId=$userIdC->getCustomerId();
}

$listNotification = $notifications->getObjects(1,"`status` ='0' AND `to_id` = $curId",array("id" => "DESC"),200);
$id = $request->element('id')?$request->element('id'):'';
if($listNotification) {
	foreach ($listNotification as $key => $value) {
		$notifications->deleteData($value->getId());
	}
}
header('location:'.'/'.ADMIN_SCRIPT."?op=dashboard");





?>