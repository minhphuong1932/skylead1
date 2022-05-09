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
$userInfo->checkPermission('budgetexpenditure','edit');
//checkPermission();
$templateFile = 'budgetexpenditure.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
include_once(ROOT_PATH.'classes/dao/currencies.class.php');
$expenditures = new Expenditures($storeId);

$currencies = new Currencies($storeId);
$budgetCapitals = new BudgetCapitals($storeId);
$budgetCategories = new BudgetCategories($storeId);
$template->assign('budgetCategories',$budgetCategories);
$template->assign('budgetCapitals',$budgetCapitals);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
	$amessages['budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
	$amessages['bill_revenue'] => '/'.ADMIN_SCRIPT.'?op=budget&act=billexpenditure');

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget&act=billexpenditure';
$listTabs = array($amessages['tracking_balance'] => $tabLink.'&act=balance',
				$amessages['list_tracking_revenue_expenditure'] => $tabLink.'&act=expenditure&mod=list',
				$amessages['bill_revenue'] => $tabLink.'&act=billrevenue&mod=list',
				$amessages['add_bill_revenue'] => $tabLink.'&act=billrevenue&mod=add',
				$amessages['bill_expenditure'] => $tabLink.'&act=billexpenditure',
				$amessages['edit_bill_expenditure'] => '#'
				
				//$amessages['clean_trash'] => $tabLink.'&mod=cleantrash'
);				
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',6);
$currenciesPri=$currencies->getObjects(1,"`status` = 1 AND `primary` = 1","",1);
//var_dump($currenciesPri);
if($currenciesPri){
	$currenciesPriName=$currenciesPri[0]->getDisplay();
}

if($currenciesPriName) $template->assign('currenciesPriName',$currenciesPriName);
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$expendituresInfo = $expenditures->getObject($id);
if($expendituresInfo) $template->assign('item',$expendituresInfo);
if($expendituresInfo->getStatus()==0){
	header('location:'.'/'.ADMIN_SCRIPT."?op=accessdenied");
}
# budget categories combo box
$budgetCateCombo = $budgetCategories->generateCombo($request->element('budgetcate_id'),$userId);
if($budgetCateCombo) $template->assign('budgetCateCombo',$budgetCateCombo);

# budget capital combo box
$capitalInfo = $budgetCapitals->getPrimaryCapital();
// $budgetCapitalCombo1 = $budgetCapitals->generateCombo($capitalInfo->getId(),$userId);
if($userInfo->isSiteStaff()){
	$budgetCapitalCombo = $budgetCapitals->generateCombo($capitalInfo->getId());
	$budgetCapitalCombo1 = $budgetCapitals->generateCombo($capitalInfo->getId());
}else{
	$budgetCapitalCombo = $budgetCapitals->generateCombo($capitalInfo->getId());
	$budgetCapitalCombo1 = $budgetCapitals->generateCombo($capitalInfo->getId());
}	
if($budgetCapitalCombo) $template->assign('budgetCapitalCombo',$budgetCapitalCombo);
if($budgetCapitalCombo1) $template->assign('budgetCapitalCombo1',$budgetCapitalCombo1);
$gallery_root = ROOT_PATH."upload/";
$gallery_path = $gallery_root."files_att/";
if(!file_exists($gallery_root)) mkdir("$gallery_root");
if(!file_exists($gallery_path)) mkdir("$gallery_path");

$dateold = 0;
if(isset($_SESSION['date_load']) && $_SESSION['date_load']){
	if(strtotime(date("Y-m-d H:i:s"))- strtotime($_SESSION['date_load'])< 20) $dateold = 1;
	}
if(!$expendituresInfo) {
	$template->assign('validItem',0);
} else {
	if($request->element('doo') == 'delFile') {
		$expendituresInfo = $expenditures->getObject($id);
		$properties = $expendituresInfo->getProperties();
		foreach($properties['files'] as $key => $value) {
			if($value == $request->element('file')) {
				unlink($gallery_path.$properties['files'][$key]);
				unset($properties['files'][$key]);
				$data = array('properties' => serialize($properties));
				$expenditures->updateData($data,$id);
				$expendituresInfo = $expenditures->getObject($id);
				break;
			}
		}
	}
	if($request->element('doo') == 'delPhoto') {
		$expendituresInfo = $expenditures->getObject($id);
		$properties = $expendituresInfo->getProperties();
		foreach($properties['photos'] as $key => $value) {
			if($value == $request->element('photo')) {
				unlink($gallery_path.$properties['photos'][$key]);
				unset($properties['photos'][$key]);
				$data = array('properties' => serialize($properties));
				$expenditures->updateData($data,$id);
				$expendituresInfo = $expenditures->getObject($id);
				break;
			}
		}
	}
	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			# Category combo box
			if($expendituresInfo) $template->assign('item',$expendituresInfo);
			$budgetCapitalCombo = $budgetCapitals->generateCombo($request->element('capital_id'));
			if($budgetCapitalCombo) $template->assign('budgetCapitalCombo',$budgetCapitalCombo);
		} else { # Valid data input
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$properties = $expendituresInfo->getProperties();
				$gallery_root = ROOT_PATH."upload/";
				$gallery_path = $gallery_root."files_att/";
				if(!file_exists($gallery_root)) mkdir("$gallery_root");
				if(!file_exists($gallery_path)) mkdir("$gallery_path");
				$files = isset($_FILES['files'])?$_FILES['files']:'';
				if($files) {
					if(!isset($properties['photos'])) $properties['photos'] = array();
					if(!isset($properties['files'])) $properties['files'] = array();
					for($i=0; $i<count($files['name']);$i++) {
						$filesname = TextFilter::urlize2($files['name'][$i],false,'_');
						$img = addslashes(Filter(rand()."_".$filesname));
						$tmp_img = $files['tmp_name'][$i];
						$size = $files['size'][$i];
						$type=strtolower(substr($img,-3));
						if(preg_match("/".ALLOW_FILE_TYPES1."/",strtolower($img))) {
							# Upload
							if(isImage($img)) {
								$new_img = $img;
								move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
								if(isBmp($img)) {
									$new_img = preg_replace("/(bmp$)/","jpg",$img);
									resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
								}
								resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);									
								if($img != $new_img) unlink($gallery_path.'l_'.$img);	# Delete file if it's not a JPEG
								$properties['photos'][] = $new_img;
							}else {
								move_uploaded_file($tmp_img,$gallery_path.$img);
								$properties['files'][] = $img;
							}
						} #/if (preg_match
					} #/for($i=0;
				}#end files
				$id = $request->element('id');
				$properties['vouchers'] = Filter($request->element('vouchers'));
				$properties['address'] = $expendituresInfo->getProperty('address');
				$properties['name_receive'] = $expendituresInfo->getProperty('name_receive');
				$properties['print2nd'] = $expendituresInfo->getProperty('print2nd');
				$fields = array(
							'note'			=> Filter($request->element('note')),
							'updated'		=> date("Y-m-d H:i:s"),
							'status'		=> 1,
							'properties'	=> serialize($properties)	
							);
				$expenditureId = $expenditures->updateData($fields,$id);
				header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=billexpenditure&mod=edit&id=$id&rcode=7");
			}
		}
	} else { # Load product category information to edit
			$template->assign('item',$expendituresInfo);
	
			# Category combo box
			$budgetCapitalCombo = $budgetCapitals->generateCombo($request->element('capital_id'));
			if($budgetCapitalCombo) $template->assign('budgetCapitalCombo',$budgetCapitalCombo);
	}#end post

}


# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	// $error['INPUT']['capital_id'] = $validate->validString($request->element('capital_id'),$amessages['tkno']);
	// $error['INPUT']['debt_account_id'] = $validate->validString($request->element('debt_account_id'),$amessages['tkco']);
	// $error['INPUT']['budgetcate_id'] = $validate->validString($request->element('budgetcate_id'),$amessages['budget_category']);
	// $error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	// $error['INPUT']['price'] = $validate->validNumber(str_replace(",","",$request->element('amount')),$amessages['amount_price']);
	
	// $error['INPUT']['address'] = $validate->pasteString($request->element('address'),$amessages['address']);

	// $error['INPUT']['name_receive'] = $validate->pasteString($request->element('name_receive'));
	
	$error['INPUT']['note'] = $validate->validString($request->element('note'),$amessages['addon_description']);
	$error['INPUT']['vouchers'] = $validate->pasteString($request->element('vouchers'),$amessages['vouchers']);
	// if($error['INPUT']['capital_id']['error'] || $error['INPUT']['budgetcate_id']['error'] || $error['INPUT']['name']['error'] || $error['INPUT']['price']['error'] || $error['INPUT']['note']['error'] ) {
	if($error['INPUT']['note']['error']){
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>