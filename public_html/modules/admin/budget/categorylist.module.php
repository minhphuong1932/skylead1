<?php
/*************************************************************************
Product category listing module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 23/08/2011
**************************************************************************/
$userInfo->checkPermission('budgetcategory','view');
$templateFile = 'budgetcategory.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
$budgetCategories = new BudgetCategories($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['budget_category'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=budget&act=category';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
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
$pId = $request->element('pId')?$request->element('pId'):0;
if($pId) {
	$gfId = $budgetCategories->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
	$topNav[$amessages['list_product_category']] = '/'.ADMIN_SCRIPT.'?op=budget&act=category&mod=list';
	$topNav[$budgetCategories->getNameFromId($pId)] = '';
}	

# Build WHERE condition
//$condition = "`parent_id` = '$pId'";
//if($kw) $condition .= " and (`slug` LIKE '%$kw%' OR `name` LIKE '%$kw%' OR `id` LIKE '%$kw%')";
$condition = "`parent_id` = '$pId'";
if($kw) $condition = "`slug` LIKE '%$kw%' OR `name` LIKE '%$kw%' OR `id` LIKE '%$kw%'";
if($userInfo->isSiteStaff()) $condition .= " and `user_id` = '$userId'";
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $budgetCategories->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=budget&act=category&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
//var_dump($page);
$template->assign('pager',$pager);

# Get objects
$listItems = $budgetCategories->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=budget&act=category&mod=list&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=$page";
$template->assign('link',$link);

#bottom Action Combo
$categoryCombo = $budgetCategories->generateCombo($pId);
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

/*#bottom Action Combo
$userCombo = $users->generateCombo();
if($userCombo) $template->assign('userCombo',$userCombo);*/
# ALlow URL popup
$template->assign('urlPopup', 1);

if($_POST) {
	switch($do) {
		case 'enable':
			$userInfo->checkPermission('budgetcategory','edit');
			//checkPermission(array(3,4));
			$id = $request->element('id');
			if($id) {
				$budgetCategories->changeStatus($id,S_ENABLED);
				$result_code = 1;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_budget_category'],$budgetCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listCategory = '';
					foreach ($ids as $id) {
						$budgetCategories->changeStatus($id,S_ENABLED);
						$listCategory .= ($listCategory?',&nbsp;':'').$budgetCategories->getNameFromId($id);
					}
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_budget_category'],$listCategory),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$userInfo->checkPermission('budgetcategory','edit');
			//checkPermission(array(3,4));
			$id = $request->element('id');
			if($id) {
				$budgetCategories->changeStatus($id,S_DISABLED);
				$result_code = 2;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_budget_category'],$budgetCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listCategory = '';
					foreach ($ids as $id) {
						$budgetCategories->changeStatus($id,S_DISABLED);
						$listCategory .= ($listCategory?',&nbsp;':'').$budgetCategories->getNameFromId($id);
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_budget_category'],$listCategory),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('budgetcategory','delete');
			//checkPermission(array(3,4));
			$id = $request->element('id');
			if($id) {
				$rowsPages = $budgetCategories->getNumItems('id', "`parent_id`='$id' AND `status` <> '".S_DELETED."'",1);
				if($rowsPages['rows']) {
					$error_code = 10;
				} else {
					$budgetCategories->changeStatus($id,S_DELETED);
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_budget_category'],$budgetCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				}
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listCategory = '';
					$warning = 0;
					foreach ($ids as $id) {
						$rowsPages = $budgetCategories->getNumItems('id', "`parent_id`='$id' AND `status` <> '".S_DELETED."'",1);
						if(!$rowsPages['rows']) {
							$budgetCategories->changeStatus($id,S_DELETED);
							$listCategory .= ($listCategory?',&nbsp;':'').$budgetCategories->getNameFromId($id);
						} else $warning = 1;
					}
					if($warning) $error_code = 10;
					else $result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_budget_category'],$listCategory),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'changegroup':
			$userInfo->checkPermission('budgetcategory','edit');
			//checkPermission(array(3,4));
			$ids = $request->element('ids');
			$parent_id = $request->element('parent_id');
			if($ids) {
				$listCategory = '';
				foreach ($ids as $id) {
					$budgetCategories->changePId($id,$parent_id);
					$listCategory .= ($listCategory?',&nbsp;':'').$budgetCategories->getNameFromId($id);
				}
				$result_code = 4;
				$pId = $parent_id;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_parent_budget_category'],$listCategory,$budgetCategories->getNameFromId($parent_id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cleantrash':
			checkPermission(array(3,4));
			$budgetCategories->cleanTrash();
			$result_code = 5;
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_budget_category'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			break;
		case 'changeposition':
			$userInfo->checkPermission('budgetcategory','edit');
			//checkPermission(array(3,4));
			$positions = $request->element('positions');
			$name = $request->element('names');
			if($positions || $name) {
				foreach ($positions as $key=>$value) {
					$budgetCategories->changePosition($key,$value);
				}
				foreach ($name as $key=>$value) {
					$budgetCategories->changeName($key,$value);
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['change_parent_budget_category'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=category&mod=list&lang=$lang&ecode=7&pId=$pId");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=category&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}
?>