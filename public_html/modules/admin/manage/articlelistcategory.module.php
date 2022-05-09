<?php
/*************************************************************************
Acticle category listing module
----------------------------------------------------------------
Derasoft CMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 01/05/2012
Coder: Mai Minh
Checked by: Mai Minh (05/05/2012)
**************************************************************************/
$userInfo->checkPermission('category','view');
$templateFile = 'managearticle.tpl.html';
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH.'classes/dao/articles.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
include_once(ROOT_PATH.'classes/dao/adscategories.class.php');
$adsCategories = new AdsCategories($storeId);
$ads = new Ads($storeId);
$articleCategories = new ArticleCategories($storeId);
$articles = new Articles($storeId);;
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_article'] => '/'.ADMIN_SCRIPT.'?op=manage&act=article',
				$amessages['list_article_category'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=article';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['list_article_category'] => $tabLink.'&mod=listcategory',
				$amessages['add_article_category'] => $tabLink.'&mod=addcategory',
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
$pId = $request->element('pId')?$request->element('pId'):0;
if($pId) {
	$gfId = $articleCategories->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
	$topNav[$amessages['list_article_category']] = '/'.ADMIN_SCRIPT.'?op=manage&act=article&mod=listcategory';
	$topNav[$articleCategories->getNameFromId($pId)] = '';
}	

# Build WHERE condition
$condition = "`parent_id` = '$pId'";
if($kw) $condition = "(`id`='$kw' OR `slug` LIKE '%$kw%' OR `name` LIKE '%$kw%')";
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $articleCategories->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=manage&act=article&mod=listcategory&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=%d";
$urls = new Url();
$pager = $urls->genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $articleCategories->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);

# Result code
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Link
$link = '/'.ADMIN_SCRIPT."?op=manage&act=article&mod=listcategory&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=$page";
$template->assign('link',$link);

# Show URL Popup
$template->assign('urlPopup',1);

#bottom Action Combo
$categoryCombo = $articleCategories->generateCombo($pId);
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

if($_POST) {
	switch($do) {
		case 'duplicate':
			$userInfo->checkPermission('category','add');
			$id = $request->element('id');
			if($id) {
				$articleCategoriesInfo = $articleCategories->getObject($id);
				if($articleCategoriesInfo){
					$property = $articleCategoriesInfo->getProperties();
					$properties = $property;
					$slug1 = $articleCategoriesInfo->getSlug();
					$parent_id = $articleCategoriesInfo->getParentId();
					$slug = $slug1.'-copy';
					# Check if duplicate slug
					include_once(ROOT_PATH.'classes/data/textfilter.class.php');
					$textFilter = new TextFilter();
					$slug = $textFilter->urlize($slug,false,'-');
					$i = 0;
					$dup = 1;
					while($dup) {
						$dup = $articleCategories->checkDuplicate($slug.($i?'-'.$i:''),'slug',"parent_id = '$parent_id'");
						if($dup) $i++;
					}
					$slug .= $i?'-copy-'.$i:'';
					$name1 = $articleCategoriesInfo->getName();
					$name = $name1.'-copy';
					$data = array('store_id' => $storeId,
							  'parent_id' => $parent_id,
							  'slug' => $slug,
							  'name' => $name,
							  'keyword' => $articleCategoriesInfo->getKeyword(),
							  'sapo' => $articleCategoriesInfo->getSapo(),
							  'position' => $articleCategoriesInfo->getPosition(),
							  'status' => 0,
							  'properties' => serialize($properties));
					$articleIdFromSlug = $articles->getIdFromSlug($slug1);
					$articleInfo = $articles->getObject($articleIdFromSlug);
					if($articleInfo){
						$propertiesAr = array();
						$propertiesAr['detail_en'] = $articleInfo->getProperty('detail_en');
						$propertiesAr['detailmore'] = $articleInfo->getProperty('detailmore');
						$propertiesAr['detailmore_en'] = $articleInfo->getProperty('detailmore_en');
						$propertiesAr['custom_linkduan'] = $articleInfo->getProperty('custom_linkduan');
						$propertiesAr['custom_en_title'] = $articleInfo->getProperty('custom_en_title');
						$propertiesAr['custom_en_slug'] = $articleInfo->getProperty('custom_en_slug');
						$propertiesAr['custom_en_keyword'] = $articleInfo->getProperty('custom_en_keyword');
						$propertiesAr['custom_en_sapo'] = $articleInfo->getProperty('custom_en_sapo');

						$dataArticle = array('store_id' => $storeId,
								  'cat_id' => 27,
								  'slug' => $slug,
								  'title' => $name,
								  'keyword' => $name,
								  'sapo' => $name,
								  'detail' => $articleInfo->getDetails(),
								  'date_created' => date("Y-m-d H:i:s"),
								  'status' => 0,
								  'properties' => serialize($propertiesAr));

					
					$articleCategories->addData($data);
					$newArticleId = $articles->addData($dataArticle);
					$listAdCateOf = $adsCategories->getObjects(1,"`status` = '1' AND `pid` IN (0,".$articleIdFromSlug.")",array("id" => "ASC"),100);
					if($listAdCateOf){
						foreach ($listAdCateOf as $key1 => $value1) {
							$idAdCate = $value1->getId();
							$nameAdCate = $value1->getName();
							$propertiesAdCate = $value1->getProperties();
							$pidAdCate = $value1->getPId();
							$newGidorAds = $idAdCate;
							if($pidAdCate != 0){
								$newNameAdCate = $nameAdCate.'-copy';
								$dataAdCate  = array('store_id' => $storeId,
									  'name' => $newNameAdCate,
									  'properties' => serialize($propertiesAdCate),
									  'pid' => $newArticleId,
									  'status' => 0);
								$newAdCateItem = $adsCategories->addData($dataAdCate);
								
								$newGidorAds = $newAdCateItem;
								$listAdOfCate1 = $ads->getObjects(1,"`status` = '1' AND `gid` = '".$idAdCate."' AND `tid` = '".$articleIdFromSlug."'",array("id" => "ASC"),100);
								if($listAdOfCate1){
									foreach ($listAdOfCate1 as $key2 => $value2) {
										$propertiAdI = $value2->getProperties();
										$contentAdI = $value2->getContent();
										$dataAds  = array('store_id' => $storeId,
										  'gid' => $newAdCateItem,
										  'properties' => serialize($propertiAdI),
										  'tid' => $newArticleId,
										  'date_created' => date("Y-m-d H:i:s"),
										  'content' => $contentAdI);
									$ads->addData($dataAds);

									}
								}
							}else{
								$listAdOfCate1 = $ads->getObjects(1,"`status` = '1' AND `gid` = '".$idAdCate."' AND `tid` = '".$articleIdFromSlug."'",array("id" => "ASC"),100);
								if($listAdOfCate1){
									foreach ($listAdOfCate1 as $key2 => $value2) {
										$propertiAdI = $value2->getProperties();
										$contentAdI = $value2->getContent();
										$dataAds  = array('store_id' => $storeId,
										  'gid' => $idAdCate,
										  'properties' => serialize($propertiAdI),
										  'tid' => $newArticleId,
										  'date_created' => date("Y-m-d H:i:s"),
										  'content' => $contentAdI);
									$ads->addData($dataAds);

									}
								}
							}
							

							

						}
					}
						
						
						$result_code = 8;
						# Operation tracking
						$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['duplicate_article'],$articleCategoriesInfo->getName()),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					}else{
						$error_code = 26;
					}
					
				}
			} 
			break;

		case 'enable':
			$userInfo->checkPermission('category','edit');
			$id = $request->element('id');
			if($id) {
				$articleCategories->changeStatus($id,S_ENABLED);
				$result_code = 1;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_article_category'],$articleCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {		
				$ids = $request->element('ids');
				if($ids) {
					$listCategory = '';
					foreach ($ids as $id) {
						$articleCategories->changeStatus($id,S_ENABLED);
						$listCategory .= ($listCategory?',&nbsp;':'').$articleCategories->getNameFromId($id);
					}
					$result_code = 1;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['enable_article_category'],$listCategory),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'disable':
			$userInfo->checkPermission('category','edit');
			$id = $request->element('id');
			if($id) {
				$articleCategories->changeStatus($id,S_DISABLED);
				$result_code = 2;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_article_category'],$articleCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listCategory = '';
					foreach ($ids as $id) {
						$articleCategories->changeStatus($id,S_DISABLED);
						$listCategory .= ($listCategory?',&nbsp;':'').$articleCategories->getNameFromId($id);
					}
					$result_code = 2;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['disable_article_category'],$listCategory),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'delete':
			$userInfo->checkPermission('category','delete');
			$id = $request->element('id');
			if($id) {
				$articleCategories->changeStatus($id,S_DELETED);
				$result_code = 3;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_article_category'],$articleCategories->getNameFromId($id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else {
				$ids = $request->element('ids');
				if($ids) {
					$listCategory = '';
					foreach ($ids as $id) {
						$articleCategories->changeStatus($id,S_DELETED);
						$listCategory .= ($listCategory?',&nbsp;':'').$articleCategories->getNameFromId($id);
					}
					$result_code = 3;
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['delete_article_category'],$listCategory),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				} else $error_code = 5;
			}
			break;
		case 'changegroup':
			$userInfo->checkPermission('category','edit');
			$ids = $request->element('ids');
			$parent_id = $request->element('parent_id');
			if($ids) {
				$listCategory = '';
				foreach ($ids as $id) {
					$articleCategories->changePId($id,$parent_id);
					$listCategory .= ($listCategory?',&nbsp;':'').$articleCategories->getNameFromId($id);
				}
				$result_code = 4;
				$pId = $parent_id;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['change_parent_article_category'],$listCategory,$articleCategories->getNameFromId($parent_id)),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'changeposition':
			$userInfo->checkPermission('category','edit');
			$positions = $request->element('positions');
			if($positions) {
				foreach ($positions as $key=>$value) {
					$articleCategories->changePosition($key,$value);
				}
				$result_code = 4;
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['change_position_article_category'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			} else $error_code = 5;
			break;
		case 'cancel':		
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=listcategory&lang=$lang&ecode=7&pId=$pId");
			exit;
			break;
	}
	header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=article&mod=listcategory&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page&ecode=$error_code&rcode=$result_code&pId=$pId");
} else {

}
?>