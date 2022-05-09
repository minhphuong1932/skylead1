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
$templateFile = 'managematerialstore.tpl.html';
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/constructs.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/orders.class.php');
include_once(ROOT_PATH.'classes/dao/orderitems.class.php');
$orders = new Orders($storeId);
$constructs = new Constructs($storeId);
$productCategories = new ProductCategories($storeId);
$products = new Products($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_material'] => '/'.ADMIN_SCRIPT.'?op=managematerial',
				$amessages['manage_store'] => '/'.ADMIN_SCRIPT.'?op=managematerial&act=store',
				$amessages['export_storeinvent'] => '');
$tabLink = '/'.ADMIN_SCRIPT.'?op=managematerial&act=store';
$listTabs = array($amessages['manage_list_storeinvent'] => $tabLink.'&mod=report',
				$amessages['list_import_export'] => $tabLink.'&mod=list',
				$amessages['import_storeinvent'] => $tabLink.'&mod=import',
				$amessages['export_storeinvent'] => $tabLink.'&mod=export'
				//$amessages['clean_trash'] => $tabLink.'&mod=cleantrash'
				);			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',4);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# Product unit combo box
$groupCombo = $constructs->generateCombo($request->element('group'));
if($groupCombo) $template->assign('groupCombo',$groupCombo);

# product combo box
$condition = '';
if($userInfo->isSiteStaff()){
	$listProCate = $productCategories->getAllIdSubCate("`user_id` = '$userId'");
	if($listProCate) $condition = " and cat_id in ($listProCate)";
	else $condition = '';
}
$listProduct = $products->getObjects(1,"`status` = 1".$condition,array('slug'=>'asc'),'');
if($listProduct) $template->assign('listProduct',$listProduct);
	
# Allow some javascript
$template->assign('ckEditor',1);
$template->assign('multiUpload',1);
$template->assign('multiUploadForm','formAdd');
$template->assign('multiUploadControl','files');

$idImport = $request->element('Id');
$numberItems = $request->element('numberitem',10);
$template->assign('numberItems',$numberItems);
if($idImport){
	$orderInfo = $orders->getObject($idImport,'id');
	if($orderInfo) $template->assign('item',$orderInfo);
	$orderItems = new OrderItems($idImport);
	$listOrderItems = $orderItems->getObjects(1,"`order_id` = '$idImport'",array('id'=>'asc'),'');
	if($listOrderItems) $template->assign('listOrderItems',$listOrderItems);
}else{
if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request,$storeId);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		
		# product combo box
		$productCombo = $products->generateCombo($request->element('pro_id'));
		if($productCombo) $template->assign('productCombo',$productCombo);
	} else { # Valid data input
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			// export bill
			$fields = array('store_id'		=> $storeId,
							'user_id'		=> $userId,
							'group_construct'=> Filter($request->element('group')),
							'name_team'		=> Filter($request->element('name_team')),
							'rname'			=> Filter($request->element('rname')),
							'rnote'			=> Filter($request->element('note')),
							'u_type'		=> 2,
							'created'		=> date("Y-m-d H:i:s"),
							'properties'	=> serialize($properties),
							'status'		=> 1	
							);
			$orderId = $orders->addData($fields);
			// add product import -> orderitem
				
			$totalPrice = 0;
			for ($i=1; $i<=20;$i++) {
			include_once(ROOT_PATH."classes/dao/products.class.php");
			$orderItems = new OrderItems($orderId);
				if($request->element('pro_id'.$i)){
					//$quantity = Filter($request->element('quantity'.$i));
					$quantity = str_replace(",","",Filter($request->element('quantity'.$i)));
					$productItem = $products->getObject($request->element('pro_id'.$i),'id');
					if($productItem) {
						$name = $productItem->getName();
						$price = $productItem->getPrice();
						$totalPrice = $totalPrice + ($price*$quantity);
						// add order items
						$fields = array('order_id'	=> $orderId,
										'product_id' => Filter($request->element('pro_id'.$i)),
										'name' => $name,
										'quantity'	=> $quantity ,
										'price'	=> $price,
										);
						$orderItems->addData($fields);
						// end add order items
						// add store inventory
						include_once(ROOT_PATH."classes/dao/productinvents.class.php");
						$productInvents = new ProductInvents();
						$pbalance = $productInvents->getPbalanceProduct($request->element('pro_id'.$i));
						$data = array(	'user_id' => $userId,
										'product_id' => $request->element('pro_id'.$i),
										'type'	=> 2,
										'pbalance'	=> $pbalance,
										'quantity'	=> $quantity,
										'balance'	=> $pbalance - $quantity,
										'datetime'	=> date("Y-m-d H:i:s")
										);
						$productInvents->addData($data);
						// end add store inventory
						$products->updateData(array('series'=>''),$request->element('pro_id'.$i));
					}
				}
			}
			
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['import_store'],$orderId),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=managematerial&act=store&mod=view&Id=".$orderId."&rcode=10");
		}
	}
}


}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request,$storeId) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	include_once(ROOT_PATH.'classes/dao/products.class.php');
	$products = new Products($storeId);
	$error = array();
	$validate = new Validate();
	$idcount = $request->element('ids');
	$count = 0;
	$start = 1;
	$end = count($idcount);
	$error['INPUT']['group'] = $validate->validString($request->element('group'),$amessages['constructs']);
	$error['INPUT']['name_team'] = $validate->validString($request->element('name_team'),$amessages['team_constructs']);
	$error['INPUT']['rname'] = $validate->validString($request->element('rname'),$amessages['rname']);
	$error['INPUT']['note'] = $validate->pasteString($request->element('note'),$amessages['addon_description']);
	if($error['INPUT']['group']['error'] || $error['INPUT']['name_team']['error'] || $error['INPUT']['rname']['error']) 	{
		$error['invalid'] = 1;
		for($i=$start; $i<=$end;$i++) {
			if($request->element('pro_id'.$i) || $request->element('quantity'.$i) || $i == 1){
				$error['INPUT']['pro_id'][$i] = $validate->validString($request->element('pro_id'.$i),$amessages['product']);
				$quantity = str_replace(",","",$request->element('quantity'.$i));
				$error['INPUT']['quantity'][$i] = $validate->validNumber($quantity,$amessages['quantity']); 
				//$error['INPUT']['quantity'][$i] = $validate->validNumber($request->element('quantity'.$i),$amessages['quantity']);
				$productInfo = $products->getObject($request->element('pro_id'.$i),'id');
				if($productInfo){
						$error['INPUT']['unit'][$i] = $productInfo->getUnit();
						$error['INPUT']['invent'][$i] = $productInfo->getProductInvents();
				}
				$count = $count +1;
			}
		}
		$error['INPUT']['count'] = $count; 
		return $error;
	}else{
		$arrayProduct = array();
		for($i=$start; $i<=$end;$i++) {
			if($request->element('pro_id'.$i) || $request->element('quantity'.$i) || $i == 1){
				$error['INPUT']['pro_id'][$i] = $validate->validString($request->element('pro_id'.$i),$amessages['product']);
				$quantity = str_replace(",","",$request->element('quantity'.$i));
				$error['INPUT']['quantity'][$i] = $validate->validNumber($quantity,$amessages['quantity']); 
				//$error['INPUT']['quantity'][$i] = $validate->validNumber($request->element('quantity'.$i),$amessages['quantity']); 
				$productInfo = $products->getObject($request->element('pro_id'.$i),'id');
				$arrayProduct[] = $request->element('pro_id'.$i);
				if($productInfo){
						$error['INPUT']['unit'][$i] = $productInfo->getUnit();
						$error['INPUT']['invent'][$i] = $productInfo->getProductInvents();
				}
				$count = $count +1;
				if($error['INPUT']['pro_id'][$i]['error'] || $error['INPUT']['quantity'][$i]['error'] ) {
					$error['INPUT']['input']['message'] = $amessages['error_input'];
					$error['INPUT']['backgroup'][$i] = " bgcolor=\"#FCC\"";
					$error['INPUT']['input']['error'] = 1;
					$error['invalid'] = 1;
				}else{
					/// check pbalance of product
					$productInfo = $products->getObject($request->element('pro_id'.$i),'id');
					if($productInfo) $pbalance = $productInfo->getProductInvents();
					else $pbalance = 0;
					
					if($quantity > $pbalance){
						$error['INPUT']['invent']['message'] = "Số lượng hàng không đủ để xuất kho";
						$error['INPUT']['backgroup'][$i] = " bgcolor=\"#FCC\"";
						$error['INPUT']['invent']['error'] = 1;
						$error['invalid'] = 1;
					}/*else{
						if(in_array($request->element('pro_id'.$i),$arrayProduct)){
							$pbalance = $productInfo->getSeries() - $request->element('quantity'.$i);
							if($request->element('quantity'.$i) > $pbalance){
								$error['INPUT']['invent']['message'] = "Số lượng hàng không đủ để xuất kho";
								$error['INPUT']['backgroup'][$i] = " bgcolor=\"#FCC\"";
								$error['INPUT']['invent']['error'] = 1;
								$error['invalid'] = 1;
							}	
						}
					}
					if(in_array($request->element('pro_id'.$i),$arrayProduct))	$products->updateData(array('series'=>$productInfo->getSeries() - $request->element('quantity'.$i)),$request->element('pro_id'.$i));
					else $products->updateData(array('series'=>$productInfo->getProductInvents()),$request->element('pro_id'.$i));*/
					
				}
			}
		}
		$error['INPUT']['count'] = $count; 
		
	}
	return $error;
}
?>