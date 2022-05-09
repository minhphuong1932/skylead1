<?php
/*************************************************************************
Editing product module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 09/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
#$userInfo->checkPermission('product','edit');
$templateFile = 'managematerialproduct.tpl.html';
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/orders.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/productunits.class.php');
include_once(ROOT_PATH.'classes/dao/productinvents.class.php');
$productunits = new ProductUnits($storeId);
$productInvents = new ProductInvents();
$productCategories = new ProductCategories($storeId);
$products = new Products($storeId);
$orders = new Orders($storeId);
$fields = new Fields($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=managematerial&act=product',
				$amessages['edit_product'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial';
$listTabs = array($amessages['manage_list_storeinvent'] => $tabLink.'&act=store&mod=list',
				$amessages['product_invent'] => '#',
				$amessages['list_item'] => $tabLink.'&act=product&mod=list'
				//$amessages['list_category'] => $tabLink.'&mod=listcategory',
				//$amessages['add_product_category'] => $tabLink.'&mod=addcategory',
				//$amessages['clean_trash'] => $tabLink.'&mod=cleantrash'
				);			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'datetime';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);
$uid = $request->element('uid')?$request->element('uid'):'';
if($uid) $template->assign('uid',$uid);
$type = $request->element('type')?$request->element('type'):'';
if($type) $template->assign('type',$type);
$filter_date = $request->element('filter_date');
if($filter_date) $template->assign('filter_date',$filter_date);

$id = $request->element('id');
if($id) $template->assign('id',$id);
$productInfo = $products->getObject($id);
if($productInfo) 
{ 
# Check user manage
if($userInfo->isSiteStaff()){
	$idProCate = $productInfo->getCatId();
	$proCateInfo = $productCategories->getObject($idProCate,'id');
	if($proCateInfo->getUserId() != $userId)	header("location: /index.php?op=accessdenied");
}
	
$template->assign('productItem',$productInfo);
# list invent
$condition = $uid>0?"`user_id` = '$uid'":"1>0";
if($id) $condition .= " and `product_id` = '$id'";
if($type) $condition .= " and `type` = '$type'";
$duration = '';
if($filter_date) {
	if($filter_date == 'today') {
		$duration = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d"),date("Y")));
		$condition .= " AND `datetime` >= '$duration'";
	} elseif($filter_date != 'all') {
		$duration = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d"),date("Y"))-86400*$filter_date);
		$condition .= " AND `datetime` >= '$duration'";
	}
}
$pages_condition = $condition;
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $productInvents->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=managematerial&act=product&mod=detail&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&filter_date=$filter_date&sd=$sort_direction&uid=$uid&type=$type&pg=%d";
$pager = Url::genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $productInvents->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);

}
/*header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=product&mod=detail&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&filter_date=$filter_date&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");*/
?>