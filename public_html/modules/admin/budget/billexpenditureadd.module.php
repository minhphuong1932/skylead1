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
$userInfo->checkPermission('budgetexpenditure','add');
$templateFile = 'budgetbillrevenue.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcategories.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
$expenditures = new Expenditures($storeId);
$budgetCategories = new BudgetCategories($storeId);
$budgetCapitals = new BudgetCapitals($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['bill_expenditure'] => '/'.ADMIN_SCRIPT.'?op=budget&act=billexpenditure',
				$amessages['add_bill_expenditure'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget';
$listTabs = array($amessages['tracking_balance'] => $tabLink.'&act=balance',
				$amessages['list_tracking_revenue_expenditure'] => $tabLink.'&act=expenditure&mod=list',
				$amessages['bill_revenue'] => $tabLink.'&act=billrevenue&mod=list',
				$amessages['add_bill_revenue'] => $tabLink.'&act=billrevenue&mod=add',
				$amessages['bill_expenditure'] => $tabLink.'&act=billexpenditure',
				$amessages['add_bill_expenditure'] => $tabLink.'&act=billexpenditure&mod=add'
				//$amessages['clean_trash'] => $tabLink.'&mod=cleantrash'
				);			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',6);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
if(isset($_SESSION["randkey"])){
	$template->assign('randkey',$_SESSION["randkey"]);
}else{
	$_SESSION["randkey"] = md5(rand());
	$template->assign('randkey',$_SESSION["randkey"]);
}
# budget categories combo box
$budgetCateCombo = $budgetCategories->generateCombo($request->element('budgetcate_id'));
if($budgetCateCombo) $template->assign('budgetCateCombo',$budgetCateCombo);
# budget capital combo box
$capitalInfo = $budgetCapitals->getPrimaryCapital();
if($userInfo->isSiteStaff()){
	// $budgetCapitalCombo = $budgetCapitals->generateCombo($capitalInfo->getId(),$userId);
	$budgetCapitalCombo = $budgetCapitals->generateCombo($capitalInfo->getId());
	$budgetCapitalCombo1 = $budgetCapitals->generateCombo($capitalInfo->getId());
}
else{
	$budgetCapitalCombo = $budgetCapitals->generateCombo($capitalInfo->getId());
	$budgetCapitalCombo1 = $budgetCapitals->generateCombo($capitalInfo->getId());
}
if($budgetCapitalCombo) $template->assign('budgetCapitalCombo',$budgetCapitalCombo);
if($budgetCapitalCombo1) $template->assign('budgetCapitalCombo1',$budgetCapitalCombo1);
$dateold = 0;
if(isset($_SESSION['date_load']) && $_SESSION['date_load']){
	if(strtotime(date("Y-m-d H:i:s"))- strtotime($_SESSION['date_load'])< 20) $dateold = 1;
}
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
if($dateold != 1){
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
		# budget capital combo box
		$budgetCapitalCombo = $budgetCapitals->generateCombo($request->element('capital_id'));
		if($budgetCapitalCombo) $template->assign('budgetCapitalCombo',$budgetCapitalCombo);	
	} else { # Valid data input
		# Everything is ok. Add data to DB
		$amount = str_replace(",","",$request->element('amount'));
		$capitalInfo = $budgetCapitals->getObject($request->element('capital_id'),'id');
		$balance = $capitalInfo->getBalance();
		if($balance < $amount ){
			if(!$capitalInfo->getExcess()){
				$validate['INPUT']['price']['message'] = 'Số tiền chi vượt quá quỹ';
				$validate['INPUT']['price']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		}
		if(!$validate['invalid']) {
			$randkeyrq=$request->element('randkey');
			if(isset($_SESSION["randkey"])==$randkeyrq){
				$_SESSION["randkey"] = md5(rand());
				$template->assign('randkey',$_SESSION["randkey"]);
			$properties = array('');
			$gallery_root = ROOT_PATH."upload/";
			
			$gallery_path = $gallery_root."files_att/";
			if(!file_exists($gallery_root)) mkdir("$gallery_root");
			if(!file_exists($gallery_path)) mkdir("$gallery_path");
		
			$files = isset($_FILES['files'])?$_FILES['files']:'';
			if($files) {
				if(!isset($properties['photos'])) $properties['photos'] = array();
				if(!isset($properties['videos'])) $properties['videos'] = array();
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
			}
			$properties['vouchers'] = Filter($request->element('vouchers'));
			$properties['address'] = Filter($request->element('address'));
			$properties['name_receive'] = Filter($request->element('name_receive'));
			$properties['print2nd'] = 0;
			// add bill
			$fields = array('store_id'		=> $storeId,
							'user_id'		=> $userId,
							'budgetcate_id'	=> Filter($request->element('budgetcate_id')),
							'capital_id'	=> Filter($request->element('capital_id')),
							'debt_account_id'	=> Filter($request->element('debt_account_id')),
							'type'			=> 2,
							'name'			=> Filter($request->element('name')),
							'payee'			=> Filter($request->element('name_receive')),
							'price'			=> -str_replace(",","",Filter($request->element('amount'))),
							'note'			=> Filter($request->element('note')),
							'created'		=> date("Y-m-d H:i:s"),
							'status'		=> 1,
							'real_st'		=> 1,
							'properties'	=> serialize($properties)	
							);
			$expenditureId = $expenditures->addData($fields);
			$fields1 = array('store_id'		=> $storeId,
							'user_id'		=> $userId,
							'budgetcate_id'	=> Filter($request->element('budgetcate_id')),
							'capital_id'	=> Filter($request->element('debt_account_id')),
							'debt_account_id'	=> Filter($request->element('capital_id')),
							'type'			=> 1,
							'name'			=> Filter($request->element('name')),
							'payee'			=> Filter($request->element('name_receive')),
							'price'			=> -str_replace(",","",Filter($request->element('amount'))),
							'note'			=> Filter($request->element('note')),
							'created'		=> date("Y-m-d H:i:s"),
							'status'		=> 1,
							'properties'	=> serialize($properties)	
							);
			$expenditureId1 = $expenditures->addData($fields1);
			
			// add tracking expenditure
			
			include_once(ROOT_PATH."classes/dao/trackingbalances.class.php");
			$trackingBalances = new TrackingBalances();
			
			 $pbalance = $trackingBalances->getPbalanceProduct($request->element('capital_id'));
			 $quantity =  str_replace(",","",Filter($request->element('amount')));
			$data = array(	'store_id'		=> $storeId,
							'user_id'		=> $userId,
							'expenditure_id'=> $expenditureId,
							'budgetcate_id' => Filter($request->element('budgetcate_id')),
							'capital_id' 	=> Filter($request->element('capital_id')),
							'debt_account_id'	=> Filter($request->element('debt_account_id')),
							'type'			=> 2,
							'pbalance'		=> $pbalance,
							'quantity'		=> $quantity,
							'balance'		=> $pbalance - $quantity,
							'datetime'		=> date("Y-m-d H:i:s")
							);
			$trackingBalances->addData($data);
			$pbalance1 = $trackingBalances->getPbalanceProduct($request->element('debt_account_id'));
			$data1 = array(	'store_id'		=> $storeId,
							'user_id'		=> $userId,
							'expenditure_id'=> $expenditureId1,
							'budgetcate_id' => Filter($request->element('budgetcate_id')),
							'capital_id' 	=> Filter($request->element('debt_account_id')),
							'debt_account_id'	=> Filter($request->element('capital_id')),
							'type'			=> 2,
							'pbalance'		=> $pbalance1,
							'quantity'		=> $quantity,
							'balance'		=> $pbalance1 + $quantity,
							'datetime'		=> date("Y-m-d H:i:s")
							);
			$trackingBalances->addData($data1);
			// end add tracking expenditure
			$_SESSION['date_load'] = date("Y-m-d H:i:s");	
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_billexpenditure'],$expenditureId),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&rcode=9");
		}else{
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&ecode=23");
		} 
		#end check key
		}
		#end if(!$validate['invalid'])
	}
}else header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=expenditure&mod=list&Id=".$expenditureId."");
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['capital_id'] = $validate->validString($request->element('capital_id'),$amessages['tkno']);
	$error['INPUT']['debt_account_id'] = $validate->validString($request->element('debt_account_id'),$amessages['tkco']);
	$error['INPUT']['budgetcate_id'] = $validate->validString($request->element('budgetcate_id'),$amessages['budget_category']);
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['price'] = $validate->validNumber(str_replace(",","",$request->element('amount')),$amessages['amount_price']);
	$error['INPUT']['vouchers'] = $validate->pasteString($request->element('vouchers'),$amessages['vouchers']);
	$error['INPUT']['address'] = $validate->pasteString($request->element('address'),$amessages['address']);
	$error['INPUT']['name_receive'] = $validate->pasteString($request->element('name_receive'));
	$error['INPUT']['note'] = $validate->validString($request->element('note'),$amessages['addon_description']);
	if($error['INPUT']['capital_id']['error'] || $error['INPUT']['budgetcate_id']['error'] || $error['INPUT']['name']['error'] || $error['INPUT']['price']['error'] || $error['INPUT']['note']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>