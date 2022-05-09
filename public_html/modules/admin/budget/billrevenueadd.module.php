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
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
include_once(ROOT_PATH.'classes/dao/orders.class.php');
include_once(ROOT_PATH.'classes/dao/construc.class.php');
include_once(ROOT_PATH.'classes/dao/orderitems.class.php');
include_once(ROOT_PATH.'classes/dao/customers.class.php');
$orders = new Orders($storeId);
$customers = new Customers($storeId);
$construc = new Construc();
$expenditures = new Expenditures($storeId);
$budgetCapitals = new BudgetCapitals($storeId);
$budgetCategories = new BudgetCategories($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_budget'] => '/'.ADMIN_SCRIPT.'?op=budget',
				$amessages['bill_revenue'] => '/'.ADMIN_SCRIPT.'?op=budget&act=billrevenue',
				$amessages['add_bill_revenue'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget';
$listTabs = array($amessages['tracking_balance'] => $tabLink.'&act=balance',
				$amessages['list_tracking_revenue_expenditure'] => $tabLink.'&act=expenditure&mod=list',
				$amessages['bill_revenue'] => $tabLink.'&act=billrevenue&mod=list',
				$amessages['add_bill_revenue'] => $tabLink.'&act=billrevenue&mod=add',
				$amessages['bill_expenditure'] => $tabLink.'&act=billexpenditure',
				$amessages['add_bill_expenditure'] => $tabLink.'&act=billexpenditure&mod=add'
				);			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',4);
if(isset($_SESSION["randkey"])){
	$template->assign('randkey',$_SESSION["randkey"]);
}else{
	$_SESSION["randkey"] = md5(rand());
	$template->assign('randkey',$_SESSION["randkey"]);
}


$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$oid = $request->element('oid');
if($oid){
	$template->assign('oid',$oid);
	$orderItems = new OrderItems($oid);
	$ListOrderItem=$orderItems->getObjects(1,"`order_id`= '".$oid."'",array('id' => 'ASC'),99999);
	if($ListOrderItem){
		$template->assign('ListOrderItem',$ListOrderItem);
	} 
	$orderOb=$orders->getObject($oid);
	if($orderOb){
		$customerId1=$orderOb->getIdCustomer();
		$customerName1=$customers->getFullnameFromId($customerId1);
		$customerAddress1=$orderOb->getProperty('address');
		$customerLicenseplate=$orderOb->getProperty('licenseplate');
		$customerConstrucId=$construc->getIdFromOrderId($oid);
		if($customerName1) $template->assign('customerName1',$customerName1);
		if($customerAddress1) $template->assign('customerAddress1',$customerAddress1);
		if($customerLicenseplate) $template->assign('customerLicenseplate',$customerLicenseplate);
		if($customerConstrucId) $template->assign('customerConstrucId',$customerConstrucId);
	}
} 


# budget categories combo box
$budgetCateCombo = $budgetCategories->generateCombo($request->element('budgetcate_id'),$oid);
if(isset($budgetCateCombo)) $template->assign('budgetCateCombo',$budgetCateCombo);

# budget capital combo box
$capitalInfo = $budgetCapitals->getPrimaryCapital();
if($userInfo->isSiteStaff()){
	$budgetCapitalCombo = $budgetCapitals->generateCombo($capitalInfo->getId());
	$budgetCapitalCombo1 = $budgetCapitals->generateCombo($capitalInfo->getId());
}else{
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
					} #if 
				} #for
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
							'type'			=> 1,
							'name'			=> Filter($request->element('name')),
							'payee'			=> Filter($request->element('name_receive')),
							'price'			=> str_replace(",","",Filter($request->element('amount'))),
							'note'			=> Filter($request->element('note')),
							'created'		=> date("Y-m-d H:i:s"),
							'status'		=> 1,
							'real_st'		=> 1,
							'status_bill'	=> $request->element('chkStatus'),
							'properties'	=> serialize($properties)	
							);
			$expenditureId = $expenditures->addData($fields);
			$fields1 = array('store_id'		=> $storeId,
							'user_id'		=> $userId,
							'budgetcate_id'	=> Filter($request->element('budgetcate_id')),
							'capital_id'	=> Filter($request->element('debt_account_id')),
							'debt_account_id'	=> Filter($request->element('capital_id')),
							'type'			=> 2,
							'name'			=> Filter($request->element('name')),
							'payee'			=> Filter($request->element('name_receive')),
							'price'			=> str_replace(",","",Filter($request->element('amount'))),
							'note'			=> Filter($request->element('note')),
							'created'		=> date("Y-m-d H:i:s"),
							'status'		=> 1,
							'status_bill'	=> $request->element('chkStatus'),
							'properties'	=> serialize($properties)	
							);
			$expenditureId1 = $expenditures->addData($fields1);
			# add tracking expenditure
			include_once(ROOT_PATH."classes/dao/trackingbalances.class.php");
			$trackingBalances = new TrackingBalances();
			
			$pbalance = $trackingBalances->getPbalanceProduct($request->element('capital_id'));
			$quantity =  str_replace(",","",Filter($request->element('amount')));
			if($request->element('chkStatus')==1){
				$balance=$pbalance;
			}else{
				$balance=$pbalance + $quantity;
			}
			$data = array(	'store_id'		=> $storeId,
							'user_id'		=> $userId,
							'expenditure_id'=> $expenditureId,
							'budgetcate_id' => Filter($request->element('budgetcate_id')),
							'capital_id' 	=> Filter($request->element('capital_id')),
							'debt_account_id'	=> Filter($request->element('debt_account_id')),
							'type'			=> 1,
							'pbalance'		=> $pbalance,
							'quantity'		=> $quantity,
							'balance'		=> $balance,
							'datetime'		=> date("Y-m-d H:i:s")
							);
			$trackingBalances->addData($data);
			$pbalance1 = $trackingBalances->getPbalanceProduct($request->element('debt_account_id'));
			if($request->element('chkStatus')==1){
				$balance1=$pbalance1;
			}else{
				$balance1=$pbalance1 - $quantity;
			}
			$dataafter = array(	'store_id'		=> $storeId,
							'user_id'		=> $userId,
							'expenditure_id'=> $expenditureId1,
							'budgetcate_id' => Filter($request->element('budgetcate_id')),
							'capital_id' 	=> Filter($request->element('debt_account_id')),
							'debt_account_id'	=> Filter($request->element('capital_id')),
							'type'			=> 1,
							'pbalance'		=> $pbalance1,
							'quantity'		=> $quantity,
							'balance'		=> $balance1,
							'datetime'		=> date("Y-m-d H:i:s")
							);
			$trackingBalances->addData($dataafter);
			# end add tracking expenditure
			$_SESSION['date_load'] = date("Y-m-d H:i:s");	
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_billrevenue'],$expenditureId),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			$oid = $request->element('oid');
			if($oid){
				$ConstrucId1=$construc->getIdFromOrderId($oid);
				$contrucItem = $construc->getObject($ConstrucId1);
				$billValue = $contrucItem->getBill();
				if($billValue==''){
					$billValue=0;
				}
				$newbill= $billValue + 1;
				$dataupdate=array("bill" => $newbill);
				$construc->updateData($dataupdate,$ConstrucId1);
			}
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=billrevenue&mod=list&rcode=9");
		}else{
			header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=billrevenue&mod=list&ecode=23");
		}
		#end randkeyrq
		}
		#end !$validate['invalid']
	}
}else header('location:'.'/'.ADMIN_SCRIPT."?op=budget&act=billrevenue&mod=list&Id=".$expenditureId."");
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
	$error['INPUT']['note'] = $validate->validString($request->element('note'),$amessages['addon_description']);
	$error['INPUT']['name_receive'] = $validate->pasteString($request->element('name_receive'));
	$error['INPUT']['chkStatus'] = $validate->pasteString($request->element('chkStatus'));
	if($error['INPUT']['capital_id']['error'] || $error['INPUT']['budgetcate_id']['error'] || $error['INPUT']['name']['error'] || $error['INPUT']['price']['error'] || $error['INPUT']['note']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>