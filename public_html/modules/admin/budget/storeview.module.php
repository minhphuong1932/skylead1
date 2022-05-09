<?php
/*************************************************************************
Adding product category module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 29/08/2011
**************************************************************************/
$templateFile = 'managematerialstore.tpl.html';
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/orders.class.php');
include_once(ROOT_PATH.'classes/dao/orderitems.class.php');
$orders = new Orders($storeId);
$productCategories = new ProductCategories($storeId);
$products = new Products($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_store'] => '/'.ADMIN_SCRIPT.'?op=managematerial&act=store',
				$amessages['view_storeinvent'] => '');

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# product combo box
$productCombo = $products->generateCombo($request->element('pro_id'));
if($productCombo) $template->assign('productCombo',$productCombo);
		
# Allow some javascript
$template->assign('ckEditor',1);
$template->assign('multiUpload',1);
$template->assign('multiUploadForm','formAdd');
$template->assign('multiUploadControl','files');

$idImport = $request->element('Id');
$numberItems = $request->element('numberitem',5);
$template->assign('numberItems',$numberItems);
if($idImport){
	$orderInfo = $orders->getObject($idImport,'id');
	if($orderInfo) $template->assign('item',$orderInfo);
	# Check user manage
	if($userInfo->isSiteStaff()){
		if($orderInfo->getUserId() != $userId)	header("location: /index.php?op=accessdenied");
	}
	$orderItems = new OrderItems($idImport);
	$listOrderItems = $orderItems->getObjects(1,"`order_id` = '$idImport'",array('id'=>'asc'),'');
	if($listOrderItems) $template->assign('listOrderItems',$listOrderItems);
}
?>