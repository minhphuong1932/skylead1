<?php
/*************************************************************************
Menus listing module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 19/09/2011
Coder: Tran Thi My Xuyen
Checked by: Mai Minh (07/05/2012)
**************************************************************************/

$userInfo->checkPermission('menu','view');
$templateFile = 'managemenu.tpl.html';
include_once(ROOT_PATH.'classes/dao/menus.class.php');
include_once(ROOT_PATH.'classes/dao/menucategories.class.php');
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH.'classes/dao/articles.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');


function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',	  
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau
function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}

$menus = new Menus($storeId);
$menuCategories = new MenuCategories();
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_menu'] => '/'.ADMIN_SCRIPT.'?op=manage&act=menu',
				$amessages['list_item'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=menu';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['list_menu_category'] => $tabLink.'&mod=listcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);


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
$cId = $request->element('cId','-1');
if($cId>0) $template->assign('cId',$cId);

$pId = $request->element('pId')?$request->element('pId'):0;
if($pId) {
	$gfId = $menus->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
}
# Build WHERE condition
$condition = $cId>0?"`mc_id` = '$cId'":"1>0";
$condition .= " AND `parent_id` = '$pId'";
if($kw) $condition = "(`id`='$kw'  OR `name` LIKE '%$kw%')";
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $menus->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=manage&act=menu&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&cId=$cId&pId=$pId&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
#Khi ở trang thái active menu mới lấy submenu

if($pId){
	$ParentItem=$menus->getObject($pId);
	if($ParentItem->getStatus()==5){
		$slug=changeTitle($ParentItem->getName());
		#6.	Đối tượng dành cho chuyên mục tin tức
		$articleCategories = new ArticleCategories($storeId);
		#7. Đối tương dành cho tin tức
		$articles= new Articles($storeId);
		#9.	Đối tượng dành cho sản phẩm(product)
		$products = new Products($storeId);
		#10. Đối tượng dành cho chuyên mục sản phẩm(Product detail)
		$productCategories = new ProductCategories($storeId);

		$IdArticles=$articleCategories->getIdFromSlug($slug);
		$IdProduct=$productCategories->getIdFromSlug($slug);
		#Get Submenu của chuyên mục 
		$ObjectSubmenu=$menus->getObjects(1,'`parent_id` ='.$pId.'');
		$arr_sub=array();
		if($ObjectSubmenu){
			foreach ($ObjectSubmenu as $key => $itemsub) {
				$arr_item=explode('.', $itemsub->getUrl());
				$arr_slug=explode('/',$arr_item[0]);
				$arr_sub=array_merge($arr_sub,$arr_slug);

			}
		}
		if($IdArticles)
		{
			//$CatIdArticles=$articles->getCatIdFromId($IdArticles);
			$CataArticles=$articleCategories->getObjects(1,'`parent_id`='.$IdArticles.'');
			foreach ($CataArticles as $key => $value) {
				$url_check=$value->getSlug()."-c".$value->getId();
				$url="/".$value->getSlug()."-c".$value->getId().".htm";
				if(!in_array($url_check, $arr_sub)){
				$data = array('store_id' => $storeId,
						  'parent_id' => $pId,
						  'mc_id' => $cId,
						  'name' => Filter($value->getName()),
						  'position' => 1,
						  'status' => 1,
						  'url' => Filter($url),
						  'properties' => "",
						  'date_created' => date("Y-m-d H:i:s"));
				$newId = $menus->addData($data);
				}
			}
		}	
		if($IdProduct)
		{
			//$CarIdProduct=$products->getCatIdFromId($IdProduct);
			$CataProduct=$productCategories->getObjects(1,'`parent_id`='.$IdProduct.'');
			foreach ($CataProduct as $key => $value) {
				$url_check=$value->getSlug()."-c".$value->getId();
				$url="/".$value->getSlug()."-c".$value->getId().".html";
				if(!in_array($url_check, $arr_sub)){
				$data = array('store_id' => $storeId,
						  'parent_id' => $pId,
						  'mc_id' => $cId,
						  'name' => Filter($value->getName()),
						  'position' => 1,
						  'status' => 1,
						  'url' => Filter($url),
						  'properties' => "",
						  'date_created' => date("Y-m-d H:i:s"));
				$newId = $menus->addData($data);
				}
			}
			
		}	
	}
}
$listItems = $menus->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=manage&act=menu&mod=list&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&cId=$cId&pId=$pId&pg=$page";
$template->assign('link',$link);

#bottom Action Combo
$categoryCombo = $menuCategories->generateCombo($cId,1);
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

if($_POST) {
	switch($do) {
		case 'enable':
			$userInfo->checkPermission('menu','edit');
			$id = $request->element('id');
			if($id) {
				$menus->changeStatus($id,S_ENABLED);
				$result_code = 1;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_menu'],$menus->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listItems = '';
					foreach ($ids as $id) {
						$menus->changeStatus($id,S_ENABLED);
						$listItems .= ($listItems?',&nbsp;':'').$menus->getNameFromId($id);
					}
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_menu'],$listItems),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$userInfo->checkPermission('menu','edit');
			$id = $request->element('id');
			if($id) {
				$menus->changeStatus($id,S_DISABLED);
				$result_code = 2;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_menu'],$menus->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listItems = '';
					foreach ($ids as $id) {
						$menus->changeStatus($id,S_DISABLED);
						$listItems .= ($listItems?',&nbsp;':'').$menus->getNameFromId($id);
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_menu'],$listItems),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('menu','delete');
			$id = $request->element('id');
			if($id) {
				$menus->changeStatus($id,S_DELETED);
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_menu'],$menus->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listItems = '';
					foreach ($ids as $id) {
						$menus->changeStatus($id,S_DELETED);
						$listItems .= ($listItems?',&nbsp;':'').$menus->getNameFromId($id);
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_menu'],$listItems),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;

		case 'submenu':
			$userInfo->checkPermission('menu','delete');
			$id = $request->element('id');
			if($id) {
				$menus->changeStatus($id,S_MENU);
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_menu'],$menus->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listItems = '';
					foreach ($ids as $id) {
						$menus->changeStatus($id,S_MENU);
						$listItems .= ($listItems?',&nbsp;':'').$menus->getNameFromId($id);
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_menu'],$listItems),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;


		case 'changegroup':
			$userInfo->checkPermission('menu','edit');
			$ids = $request->element('ids');
			$parent_id = $request->element('parent_id');
			if($ids) {
				$listItems = '';
				foreach ($ids as $id) {
					$menus->changeCId($id,$parent_id);
					$listItems .= ($listItems?',&nbsp;':'').$menus->getNameFromId($id);
				}
				$result_code = 4;
				$pId = $parent_id;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_menu_group'],$listItems,$menuCategories->getNameFromId($parent_id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'changeposition':
			$userInfo->checkPermission('menu','edit');
			$positions = $request->element('positions');
			if($positions) {
				foreach ($positions as $key=>$value) {
					$menus->changePosition($key,$value);
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['change_menu_position'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cleantrash':
			$userInfo->checkPermission('menu','clean',0);
			$menus->cleanTrash();
			$result_code = 5;
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_menu'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			break;
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=menu&mod=list&lang=$lang&ecode=7&mId=$mId&cId=$cId");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=menu&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&mId=$mId&cId=$cId");
} else {

}
?>
