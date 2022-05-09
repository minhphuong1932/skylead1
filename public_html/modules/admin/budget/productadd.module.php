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
#$userInfo->checkPermission('product','add');
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
				$amessages['products'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial&act=product';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => '#',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');
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
		# Category combo box
		$categoryCombo = $productCategories->generateCombo($request->element('cat_id'));
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
	} else { # Valid data input
		# check duplicate product name
		//if($estore->getProperty('check_duplicate_product_name')) {
			if($products->checkDuplicate($request->element('name'),'name',"cat_id = '".$request->element('cat_id')."'")) {
				$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
				$validate['INPUT']['name']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		//}
			
		# Check if duplicate slug
		//$slug = TextFilter::urlize($request->element('name'),false,'-');
		$slug = TextFilter::cleanVietnamese($request->element('name'));
		$slug = TextFilter::upperVietnamese($slug);
		$i = 0;
		$dup = 1;
		while($dup) {
			$dup = $products->checkDuplicate($slug.($i?'-'.$i:''),'slug',"cat_id = '".$request->element('cat_id')."'");
			if($dup) $i++;
		}
		$slug .= $i?'-'.$i:'';
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');

		
			# User upload
			 $userUpload = $userInfo->getUsername();
		
			
			$properties = array('user_upload' => $userUpload,
								'weight' => $request->element('weight',1),
								'root_price' => $request->element('root_price'),
								'unit' => $request->element('unit'));
			
			# Custom fields
			foreach($fieldList as $field) {
				$properties[$field->getName()] = $request->element($field->getName());
			}

			$data = array('store_id' => $storeId,
						  'cat_id' => $request->element('cat_id'),
						  'user_id' => $userInfo->getId(),
						  'slug' => $slug,
						  'name' => Filter($request->element('name')),
						  'keyword' => Filter($request->element('keyword')),
						  'sku' => Filter($request->element('sku')),
						  'position' => $request->element('position'),
						  'status' => $request->element('status'),
						  'currency' => $request->element('currency'),
						  'price' => str_replace(',','',$request->element('price')),
						  'market_price' => str_replace(',','',$request->element('market_price')),
						  'description' => $request->element('description'),
						  'detail' => $request->element('detail'),
						  'properties' => serialize($properties),
						  'created' => date("Y-m-d H:i:s"),
						  'warning' => $request->element('warning'));
			$newId = $products->addData($data);
					
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_product'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=product&mod=list&pId=".$request->element('cat_id')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['cat_id'] = $validate->pasteString($request->element('cat_id'));
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['unit'] = $validate->validString($request->element('unit'), $amessages['manage_product_unit']);
	$error['INPUT']['warning'] = $validate->pasteString($request->element('warning'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}
	
	if($error['INPUT']['cat_id']['error'] || $error['INPUT']['name']['error'] || $error['INPUT']['unit']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>