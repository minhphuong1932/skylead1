<?php
/*************************************************************************
Article listing module
----------------------------------------------------------------
Derasoft CMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 05/05/2012
Coder: Mai Minh
**************************************************************************/
$userInfo->checkPermission('article','view');
$templateFile = 'managearticle.tpl.html';
include_once(ROOT_PATH.'classes/dao/articles.class.php');
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH."classes/dao/searchs.class.php");
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/notifications.class.php');
$users = new Users($storeId);
$notifications = new Notifications($storeId);
$articles = new Articles($storeId);
$search= new Search($storeId);
$articleCategories = new ArticleCategories($storeId);

if($_SESSION['userId']){
	$userIdC = $users->getObject($_SESSION['userId']);
	$curId=$userIdC->getId();
	$curUsername=$userIdC->getUserName();
	$typeuser=$userIdC->getType();
}
$pId = $request->element('pId','-1');
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_article'] => '/'.ADMIN_SCRIPT.'?op=manage&act=article',
				$amessages['list_item'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=article';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add&pId='.$pId,
				$amessages['list_article_category'] => $tabLink.'&mod=listcategory',
				$amessages['add_article_category'] => $tabLink.'&mod=addcategory',
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

$id = $request->element('id')?$request->element('id'):'';
if($id) $template->assign('id',$id);
if($pId>=0) {
	$gfId = $articleCategories->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
	$topNav[$amessages['list_item']] = '/'.ADMIN_SCRIPT.'?op=manage&act=article&mod=list';
	$topNav[$articleCategories->getNameFromId($pId)] = '';
}

# Build WHERE condition

$condition = $pId>0?"`cat_id` = '$pId'":"1>0 ";
if($pId && $pId > 0){
	$listIdFromCId = $articleCategories->getAllSubCategory($pId);
		if($listIdFromCId){
			$condition= "`cat_id` IN ($listIdFromCId)";
		}
}
if($id && $id !=0){
	$condition .= " AND `id` = '$id'";
}
if($kw) $condition .= " AND (`id`='$kw' OR `slug` LIKE '%$kw%' OR `title` LIKE '%$kw%' OR `sapo` LIKE '%$kw%')";
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $articles->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=manage&act=article&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $articles->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);
//echo "<pre>";
//print_r($listItems);
//echo "</pre>";
#add data search
//foreach($listItems as $list){
//    $dataSearch=array('store_id' => $storeId,
//                            'slug' => $list->slug,
//                            'title' => $list->title,
//                            'keyword' => $list->keyword,
//						  'sapo' => $list->sapo,
//						  'detail' => $list->detail,
//                          'status' => $list->status,
//                          'search_id'=>$list->id,
//                          'type'=>'article',
//                          'url'=>$list->getUrl
//            );
//           $search->addData($dataSearch);
//}
# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=manage&act=article&mod=list&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=$page";
$template->assign('link',$link);

# Show URL Popup
$template->assign('urlPopup',1);

#bottom Action Combo
$categoryCombo = $articleCategories->generateCombo($pId,1);
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);


if($_POST) {
	switch($do) {
		case 'duplicate':
			$userInfo->checkPermission('article','add');
			$id = $request->element('id');
			if($id) {
				$articleInfo = $articles->getObject($id);
				$property = $articleInfo->getProperties();
				$properties = array('user_upload' =>  $userInfo->getUsername(),
									'avatar' => '',
									'photos' => '',
									'videos' => '',
									'files' =>  ''
									);
				$slug = $articleInfo->getSlug();
				$cat_id = $articleInfo->getCatId();
				# Check if duplicate slug
				include_once(ROOT_PATH.'classes/data/textfilter.class.php');
				$textFilter = new TextFilter();
				$slug = $textFilter->urlize($slug,false,'-');
				$i = 0;
				$dup = 1;
				while($dup) {
					$dup = $articles->checkDuplicate($slug.($i?'-'.$i:''),'slug',"cat_id = '$cat_id'");
					if($dup) $i++;
				}
				$slug .= $i?'-'.$i:'';

				$data = array('store_id' => $storeId,
						  'cat_id' => $articleInfo->getCatId(),
						  'slug' => $slug,
						  'title' => $articleInfo->getTitle(),
						  'keyword' => $articleInfo->getKeyword(),
						  'sapo' => $articleInfo->getSapo(),
						  'detail' => $articleInfo->getDetails(),
						  'position' =>$articleInfo->getPosition(),
						  'status' => $articleInfo->getStatus(),
						  'properties' => serialize($properties),
						  'date_created' => date("Y-m-d H:i:s"));
				$articles->addData($data);
				$result_code = 8;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['duplicate_article'],$articleInfo->getTitle()),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} 
			break;

			case 'sendrequest':
			$id = $request->element('id');
			if($id) {
				
				$articles->changeStatus($id,3);

				
				$adminaccount = $users->getObjects(1,"`type`= '2'",array("id" => "DESC"),5000);
				$arrayIdStaff = array();
				if($adminaccount){
					foreach ($adminaccount as $keyd => $valued) {
						array_push($arrayIdStaff, $valued->getId());
					}
				}

				$superadminaccount = $users->getObjects(1,"`type`= '7'",array("id" => "DESC"),5000);
				$arrayIdStaffSuper = array();
				if($superadminaccount){
					foreach ($superadminaccount as $keys => $values) {
						array_push($arrayIdStaffSuper, $values->getId());
					}
				}
				$titlebv = $articles->getNameFromId($id);
				// $catIdUser =  $users->getCatIdFromId($curId);
				// if($catIdUser !=0){
				// 	$dataNotifi = array(
				// 	'store_id' => $storeId,
				// 	'details' => 'Nhân viên <span class="size-14">'.$curUsername.'</span> đã gửi yêu cầu duyệt cho hợp đồng số <span class="size-14">'.$contractCode.'</span>',
				// 	'status' => 0,
				// 	'created' => date("Y-m-d"),
				// 	'updated' => '',
				// 	'properties' => '',
				// 	'from_id' => $curId,
				// 	'to_id' => $catIdUser,
				// 	'link' => '/admin.php?op=manage&act=fcontract&mod=list&id='.$id,
				// 	);
				// 	$notifications->addData($dataNotifi);
				// }

				if($arrayIdStaff){
					foreach ($arrayIdStaff as $key => $value) {
						$dataNotifi = array(
							'store_id' => $storeId,
							'details' => 'Nhân viên <span class="size-14">'.$curUsername.'</span> đã gửi yêu cầu duyệt cho bài viết <span class="size-14">'.$titlebv.'</span>',
							'status' => 0,
							'created' => date("Y-m-d"),
							'updated' => '',
							'properties' => '',
							'from_id' => $curId,
							'to_id' => $value,
							'link' => '/admin.php?op=manage&act=article&mod=list&id='.$id,
						);
						$notifications->addData($dataNotifi);
					}
				}

				if($arrayIdStaffSuper){
					foreach ($arrayIdStaffSuper as $keysup => $valuesup) {
						$dataNotifiSup = array(
							'store_id' => $storeId,
							'details' => 'Nhân viên <span class="size-14">'.$curUsername.'</span> đã gửi yêu cầu duyệt cho bài viết <span class="size-14">'.$titlebv.'</span>',
							'status' => 0,
							'created' => date("Y-m-d"),
							'updated' => '',
							'properties' => '',
							'from_id' => $curId,
							'to_id' => $valuesup,
							'link' => '/admin.php?op=manage&act=article&mod=list&id='.$id,
						);
						$notifications->addData($dataNotifiSup);
					}
				}

				
				$result_code = 1;
				# Operation tracking
				// $trackings->addData(array('username'=>$userInfo->getUsername(),'action'=>sprintf('Gửi yêu cầu duyệt ',$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				$trackings->addData(array('store_id'=>$storeId,'contract_id'=>$id,'username'=>$userInfo->getUsername(),'action'=> $amessages['tracking']['sendrequest'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;

			case 'confirmrequest':
			$id = $request->element('id');
			if($id) {
				$articles->changeStatus($id,1);
				$result_code = 21;

				// $arOb=$articles->getObject($id);
				// if($arOb){
				// 	$nameStaff=$arOb->getProperty('user_upload');
				// 	$idStaff = $users->getIdFromUserName($nameStaff);
				// }
				// if($typeuser == '7'){
				// 	$articles->changeStatusDuyet($id,1);
				// }

				// $titlebv = $articles->getNameFromId($id);
				// if($idStaff !=0){
				// 		$dataNotifi = array(
				// 			'store_id' => $storeId,
				// 			'details' => 'Nhân viên quản lý <span class="size-14">'.$curUsername.'</span> đã duyệt bài viết <span class="size-14">'.$titlebv.'</span>',
				// 			'status' => 0,
				// 			'created' => date("Y-m-d"),
				// 			'updated' => '',
				// 			'properties' => '',
				// 			'from_id' => $curId,
				// 			'to_id' => $idStaff,
				// 			'link' => '/admin.php?op=manage&act=article&mod=list&id='.$id,
				// 		);
				// 		$notifications->addData($dataNotifi);

				// }
				# Operation tracking
				// $trackings->addData(array('username'=>$userInfo->getUsername(),'action'=>sprintf('Duyệt hợp đồng ',$id),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				$trackings->addData(array('store_id'=>$storeId,'contract_id'=>$id,'username'=>$userInfo->getUsername(),'action'=> $amessages['tracking']['confir'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;
		case 'enable':
			$userInfo->checkPermission('article','edit');
			$id = $request->element('id');
			if($id) {
				$articles->changeStatus($id,S_ENABLED);
                $search->changeStatus('article',$id,S_ENABLED);
				$result_code = 1;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listArticle = '';
					foreach ($ids as $id) {
						$articles->changeStatus($id,S_ENABLED);
                        $search->changeStatus('article',$id,S_ENABLED);
						$listArticle .= ($listArticle?',&nbsp;':'').$articles->getNameFromId($id);
					}
					$result_code = 8;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_article'],$listArticle),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$userInfo->checkPermission('article','edit');
			$id = $request->element('id');
			if($id) {
				$articles->changeStatus($id,S_DISABLED);
                $search->changeStatus('article',$id,S_DISABLED);
				$result_code = 2;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listArticle = '';
					foreach ($ids as $id) {
						$articles->changeStatus($id,S_DISABLED);
                        $search->changeStatus('article',$id,S_DISABLED);
						$listArticle .= ($listArticle?',&nbsp;':'').$articles->getNameFromId($id);
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_article'],$listArticle),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('article','delete');
			$id = $request->element('id');
			if($id) {
				$articles->changeStatus($id,S_DELETED);
                $search->changeStatus('article',$id,S_DELETED);
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listArticle = '';
					foreach ($ids as $id) {
						$articles->changeStatus($id,S_DELETED);
                        $search->changeStatus('article',$id,S_DELETED);
						$listArticle .= ($listArticle?',&nbsp;':'').$articles->getNameFromId($id);
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_article'],$listArticle),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'sethome':
			$userInfo->checkPermission('article','edit');
			$id = $request->element('id');
			if($id) {
				$articles->changeHome($id,S_ENABLED);
				$result_code = 7;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['set_home_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} 
			break;

		case 'setbanner':
		$userInfo->checkPermission('article','edit');
		$id = $request->element('id');
		if($id) {
			$articles->changeBanner($id,S_ENABLED);
			$result_code = 7;
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['set_banner_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
		} 
		break;

		case 'deletehome':
			$userInfo->checkPermission('article','edit');
			$id = $request->element('id');
			if($id) {
				$articles->changeHome($id,S_DISABLED);
				$result_code = 7;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_home_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;

			case 'deletebanner':
			$userInfo->checkPermission('article','edit');
			$id = $request->element('id');
			if($id) {
				$articles->changeBanner($id,S_DISABLED);
				$result_code = 7;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_home_article'],$articles->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;
		case 'changegroup':
			$userInfo->checkPermission('article','edit');
			$ids = $request->element('ids');
			$parent_id = $request->element('parent_id');
			if(!$parent_id) $error_code = 9;
			else {
				if($ids) {
					$listArticle = '';
					foreach ($ids as $id) {
						$articles->changeCatId($id,$parent_id);
						$listArticle .= ($listArticle?',&nbsp;':'').$articles->getNameFromId($id);
					}
					$result_code = 4;
					$pId = $parent_id;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_article_group'],$listArticle,$articleCategories->getNameFromId($parent_id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'changeposition':
			$userInfo->checkPermission('article','edit');
			$positions = $request->element('positions');
			if($positions) {
				foreach ($positions as $key=>$value) {
					$articles->changePosition($key,$value);
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['change_article_position'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cleantrash':
			$userInfo->checkPermission('article','clean',0);
			$cleanCategories = $request->element('categories'); 
			$cleanItems = $request->element('items');
			if($cleanCategories == 1) { 
				$articleCategories->cleanTrash();
               // $search->cleanTrash('article');
				$result_code = 5;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_article_category'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			if($cleanItems == 1) {
				$articles->cleanTrash();
				$result_code = 5;
				# Operation tracking
                $search->cleanTrash('article');
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['clean_trash_article'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			break;		
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=list&lang=$lang&ecode=7&pId=$pId");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}
?>