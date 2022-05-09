<?php
/*************************************************************************
Product listing module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 10/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
#$userInfo->checkPermission('product','view');
$templateFile = 'managematerialstoreprintreport.tpl.html';
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
$products = new Products($storeId);
$productCategories = new ProductCategories($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_list_storeinvent'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial&act=store';
$listTabs = array($amessages['manage_list_storeinvent'] => $tabLink.'&mod=report',
				$amessages['list_import_export'] => $tabLink.'&mod=list',
				$amessages['import_storeinvent'] => $tabLink.'&mod=import',
				$amessages['export_storeinvent'] => $tabLink.'&mod=export'
				//$amessages['clean_trash'] => $tabLink.'&mod=cleantrash'
				);			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'slug';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'ASC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';

$idate = $request->element('idate')?$request->element('idate'):'';
$edate = $request->element('edate')?$request->element('edate'):'';
if($kw) $template->assign('kw',$kw);
$pId = $request->element('pId','-1');
if($pId>0) {
	$gfId = $productCategories->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
	$topNav[$amessages['list_item']] = '/'.ADMIN_SCRIPT.'?op=managematerial&act=store&mod=report';
	$topNav[$productCategories->getNameFromId($pId)] = '';
}

# Build WHERE condition
$condition = $pId>0?"`cat_id` = '$pId'":"1>0";
if($kw) $condition = "(`id`='$kw' OR `slug` LIKE '%$kw%' OR `sku` LIKE '%$kw%' OR `name` LIKE '%$kw%')";
if($userInfo->isSiteStaff()){
	$listProCate = $productCategories->getAllIdSubCate("`user_id` = '$userId'");
	if($listProCate) $condition .= " and cat_id in ($listProCate)";
}

$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $products->getNumItems('id', $pages_condition,'');
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=managematerial&act=store&mod=report&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=%d";
$pager = Url::genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $products->getObjects($page,$condition,$sort,''); 
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=managematerial&act=store&mod=report&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=$page";
$template->assign('link',$link);

#bottom Action Combo
$categoryCombo = $productCategories->generateCombo($pId,1);
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

# ALlow URL popup
$template->assign('urlPopup', 1);

if($_POST) {
	switch($do) {
		case 'duplicate':
			$userInfo->checkPermission('product','add');
			$id = $request->element('id');
			if($id) {
				$productInfo = $products->getObject($id);
				$property = $productInfo->getProperties();
				$properties = array('user_upload' =>  $userInfo->getUsername(),
									'avatar' => '',
									'photos' => '',
									'videos' => '',
									'files' =>  ''
									);
				$slug = $productInfo->getSlug();
				$cat_id = $productInfo->getCatId();
				# Check if duplicate slug
				include_once(ROOT_PATH.'classes/data/textfilter.class.php');
				$slug = TextFilter::urlize($slug,false,'-');
				$i = 0;
				$dup = 1;
				while($dup) {
					$dup = $products->checkDuplicate($slug.($i?'-'.$i:''),'slug',"cat_id = '$cat_id'");
					if($dup) $i++;
				}
				$slug .= $i?'-'.$i:'';

				$data = array('store_id' => $storeId,
							  'cat_id' => $productInfo->getCatId(),
							  'slug' => $slug,
							  'name' => $productInfo->getName(),
							  'keyword' => $productInfo->getKeyword(),
							  'sku' => $productInfo->getSku(),
							  'position' => $productInfo->getPosition(),
							  'status' => $productInfo->getStatus(),
							  'currency' => $productInfo->getCurrency(),
							  'price' => $productInfo->getPrice(),
							  'market_price' => $productInfo->getMarketPrice(),
							  'description' => $productInfo->getDescription(),
							  'detail' => $productInfo->getDetail(),
							  'properties' => serialize($properties),
							  'created' => date("Y-m-d H:i:s"));
				$products->addData($data);
				$result_code = 8;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['duplicate_product'],$productInfo->getName()),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} 
			break;
		case 'enable':
			$userInfo->checkPermission('product','edit');
			$id = $request->element('id');
			if($id) {
				$products->changeStatus($id,S_ENABLED);
				$result_code = 1;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_product'],$products->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listProduct = '';
					foreach ($ids as $id) {
						$products->changeStatus($id,S_ENABLED);
						$listProduct .= ($listProduct?',&nbsp;':'').$products->getNameFromId($id);
					}
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_product'],$listProduct),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$userInfo->checkPermission('product','edit');
			$id = $request->element('id');
			if($id) {
				$products->changeStatus($id,S_DISABLED);
				$result_code = 2;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_product'],$products->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listProduct = '';
					foreach ($ids as $id) {
						$products->changeStatus($id,S_DISABLED);
						$listProduct .= ($listProduct?',&nbsp;':'').$products->getNameFromId($id);
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_product'],$listProduct),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('product','delete');
			$id = $request->element('id');
			if($id) {
				$products->changeStatus($id,S_DELETED);
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_product'],$products->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listProduct = '';
					foreach ($ids as $id) {
						$products->changeStatus($id,S_DELETED);
						$listProduct .= ($listProduct?',&nbsp;':'').$products->getNameFromId($id);
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_product'],$listProduct),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'sethome':
			$userInfo->checkPermission('product','edit');
			$id = $request->element('id');
			if($id) {
				$products->changeHome($id,S_ENABLED);
				$result_code = 7;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['set_home_product'],$products->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} 
			break;
		case 'deletehome':
			$userInfo->checkPermission('product','edit');
			$id = $request->element('id');
			if($id) {
				$products->changeHome($id,S_DISABLED);
				$result_code = 7;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_home_product'],$products->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;
		case 'changegroup':
			$userInfo->checkPermission('product','edit');
			$ids = $request->element('ids');
			$parent_id = $request->element('parent_id');
			if(!$parent_id) $error_code = 9;
			else {
				if($ids) {
					$listProduct = '';
					foreach ($ids as $id) {
						$products->changeCatId($id,$parent_id);
						$listProduct .= ($listProduct?',&nbsp;':'').$products->getNameFromId($id);
					}
					$result_code = 4;
					$pId = $parent_id;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_product_group'],$listProduct,$productCategories->getNameFromId($parent_id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'changeposition':
			$userInfo->checkPermission('product','edit');
			$positions = $request->element('positions');
			$prices = $request->element('prices');
			if($positions) {
				foreach ($positions as $key=>$value) {
					$products->changePosition($key,$value);
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['change_product_position'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			if($prices) {
				foreach ($prices as $key=>$value) {
					$products->changePrice($key,$value);
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['change_product_price'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cleantrash':
			$userInfo->checkPermission('product','clean',0);
			$cleanCategories = $request->element('categories'); 
			$cleanItems = $request->element('items');
			if($cleanCategories == 1) { 
				$productCategories->cleanTrash();
				$result_code = 5;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_product_category'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			if($cleanItems == 1) {
				$products->cleanTrash();
				$result_code = 5;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_product'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;		
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=store&mod=report&lang=$lang&ecode=7&pId=$pId");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=store&mod=report&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}
?>