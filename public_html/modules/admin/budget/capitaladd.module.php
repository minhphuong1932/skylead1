<?php
/*************************************************************************
capital Adding module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 29/05/2012
Coder: Mai Minh
**************************************************************************/
$userInfo->checkPermission('budgetcapital','add');
//checkPermission();
$templateFile = 'budgetcapital.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
include_once(ROOT_PATH.'classes/dao/currencies.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$budgetCapitals = new BudgetCapitals($storeId);
$currencies = new Currencies($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['capital'] => '/'.ADMIN_SCRIPT.'?op=budget&act=capital',
				$amessages['add_new'] => '',);

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget&act=capital';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# Currencies combo box
$currencyCombo = $currencies->generateCombo($request->element('currency'));
if($currencyCombo) $template->assign('currencyCombo',$currencyCombo);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate prefix
		if($budgetCapitals->checkDuplicate($request->element('name'),'name')) {
			$validate['INPUT']['name']['message'] = $amessages['capital_name_duplicated'];
			$validate['INPUT']['name']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		
		# Check file capital
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$data = array('store_id' => $storeId,
						  'user_id' => $userId,
						  'code' => Filter($request->element('code')),	
						  'name' => Filter($request->element('name')),		
						  'amount' => Filter($request->element('amount')),
						  'warning' => $request->element('warning'),				  
						  'excess' 	=> Filter($request->element('excess')),
						  'currency' => Filter($request->element('currency')),
						  'position' => Filter($request->element('position')),
						  'status' => Filter($request->element('status')));
			$budgetCapitals->addData($data);
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_budget_capital'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=capital&mod=list&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['warning'] = $validate->validString($request->element('warning'),$amessages['warning']);
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['currency'] = $validate->validNumber($request->element('currency'));	
	$error['INPUT']['position'] = $validate->pasteString($request->element('position'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	$error['INPUT']['code'] = $validate->pasteString($request->element('code'));
	
	if($error['INPUT']['name']['error'] || $error['INPUT']['currency']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>