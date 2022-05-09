<?php
/*************************************************************************
Adding product module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 10/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
$templateFile = 'managematerialproduct.tpl.html';
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/productunits.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$productCategories = new ProductCategories($storeId);
$productunits = new ProductUnits($storeId);
$products = new Products($storeId);
$fields = new Fields($storeId);
$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."products/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=managematerial&act=product',
				$amessages['list_unit'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial&act=product';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=listunit',
				$amessages['add_new'] => '#',
				//$amessages['list_category'] => $tabLink.'&mod=listcategory',
				//$amessages['add_product_category'] => $tabLink.'&mod=addcategory',
				//$amessages['list_weight'] => $tabLink.'&mod=listweight',
				//$amessages['add_product_weight'] => $tabLink.'&mod=addweight',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrashunit');
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# Category combo box
$categoryCombo = $productCategories->generateCombo($request->element('cat_id'),1);
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

# Product unit combo box
$unitCombo = $productunits->generateCombo();
if($unitCombo) $template->assign('unitCombo',$unitCombo);
# Get list of custom fields
$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='product'",array('position' => 'ASC'));
if($fieldList) $template->assign('fieldList',$fieldList);

# Allow some javascript
$template->assign('ckEditor',1);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
	} else { # Valid data input
		# check duplicate product name
		//if($estore->getProperty('check_duplicate_product_name')) {
			if($productunits->checkDuplicate($request->element('name'),'name')) {
				$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
				$validate['INPUT']['name']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		//}
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$data = array('store_id' => $storeId,
						  'name' => Filter($request->element('name')),
						  'status' => Filter($request->element('status')));
			$newId = $productunits->addData($data);
					
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_product_unit'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=product&mod=listunit&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	
	if($error['INPUT']['name']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>