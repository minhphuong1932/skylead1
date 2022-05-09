<?php
/*************************************************************************
Article clean trash module
----------------------------------------------------------------
Derasoft CMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 05/05/2012
Coder: Mai Minh
**************************************************************************/
checkPermission();
$templateFile = 'managematerialproduct.tpl.html';
include_once(ROOT_PATH.'classes/dao/productunits.class.php');
$productUnits = new ProductUnits($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=managematerial&act=product',
				$amessages['list_unit'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial&act=product';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=listunit',
				$amessages['add_new'] => $tabLink.'&mod=addunit',
				//$amessages['list_category'] => $tabLink.'&mod=listcategory',
				//$amessages['add_product_category'] => $tabLink.'&mod=addcategory',
				//$amessages['list_weight'] => $tabLink.'&mod=listweight',
				//$amessages['add_product_weight'] => $tabLink.'&mod=addweight',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',3);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'id';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);
$pId = $request->element('pId','-1');
if($pId>=0) {
	$gfId = $articleCategories->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
	$topNav[$amessages['list_item']] = '/'.ADMIN_SCRIPT.'?op=managematerial&act=product&mod=list';
	$topNav[$articleCategories->getNameFromId($pId)] = '';
}

# Link
$link = '/'.ADMIN_SCRIPT."?op=managematerial&act=product&mod=listunit&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=$page";
$template->assign('link',$link);
?>