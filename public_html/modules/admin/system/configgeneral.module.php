<?php
/*************************************************************************
System general config module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 22/05/2012
Coder: Mai Minh
**************************************************************************/
checkPermission(array(3,4));
include_once(ROOT_PATH.'classes/dao/templates.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH.'classes/dao/color.class.php');
$color = new Color();


	
$colorItem = $color->getObjects(1,'`status` = 1','',999);
if($colorItem) $template->assign('colorItem',$colorItem);

$css_1 = "<style id='changeColor'>
			:root{
				--primary-color: ";
// add primary_color (template)
$css_2 = ";
				--primary-color-opacity:";
// add primary_color_opacity (template)
$css_3 = ";
			}
		</style>";
$template->assign('css_1',$css_1);
$template->assign('css_2',$css_2);
$template->assign('css_3',$css_3);

$templates = new Templates();
$fields = new Fields($storeId);
$templateFile = 'systemconfig.tpl.html';

$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['system'] => '/'.ADMIN_SCRIPT.'?op=system',
				$amessages['system_config'] => '/'.ADMIN_SCRIPT.'?op=system&act=config',
				$amessages['system_config_general'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=system&act=config';
$listTabs = array($amessages['general_config'] => $tabLink.'&mod=general'
				// $amessages['site_down'] => $tabLink.'&mod=down',
				// $amessages['rate_config'] => $tabLink.'&mod=rate',
				// $amessages['sale_off_config'] => $tabLink.'&mod=saleoff',
				// $amessages['order_config'] => $tabLink.'&mod=order'
				);
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$error_code = $request->element('ecode');
if($error_code) $template->assign('error_code',$error_code);

# Load KFM to set Admin logo
$template->assign('selectPhoto',1);
# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='estore'",array('position' => 'ASC'),1000);
		if($fieldList)$template->assign('fieldList',$fieldList);
		
if($_POST) { # if form is submitted
	if($request->element('doo') == 'cancel') {	# Cancel
		header('location:'.'/'.ADMIN_SCRIPT."?op=system&act=config&mod=general&lang=$lang&ecode=7");
		exit;
	}
	if($request->element('doo') == 'submit') {
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$template->assign('estore',$estore);
		} else { # Valid data input
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$properties = $estore->getProperties();
				if(!$properties) $properties = array('');

				
				$properties['price_room']=$request->element('price_room');
				$properties['domain_template_id'] = $request->element('domain_template_id');
				$properties['check_duplicate_product_name'] = $request->element('check_duplicate_product_name');
				$properties['currency'] = $request->element('currency','VND');
				$properties['max_advance_payment'] = $request->element('max_advance_payment');
				$properties['tien_congdoan'] = $request->element('tien_congdoan');
				$properties['admin_logo'] = $request->element('admin_logo');
				$properties['store_logo'] = $request->element('store_logo');
				$properties['logo_footer'] = $request->element('logo_footer');
				$properties['background_menuright'] = $request->element('background_menuright');
				$properties['img_index'] = $request->element('img_index');
				$properties['img_quytrinhsanxuat'] = $request->element('img_quytrinhsanxuat');
				$properties['img_en_quytrinhsanxuat'] = $request->element('img_en_quytrinhsanxuat');
				$properties['img_quanlychatluongsanpham'] = $request->element('img_quanlychatluongsanpham');
				$properties['color_theme'] = $request->element('color_theme');
				$properties['ggmap'] = $request->element('ggmap');
				$properties['headerhtml'] = $request->element('headerhtml');
				$properties['footerhtml'] = $request->element('footerhtml');
				$properties['email2'] = $request->element('email2');
				$properties['aboutus'] = $request->element('aboutus');
				$properties['address_en'] = $request->element('address_en');
				$properties['aboutusen'] = $request->element('aboutusen');
				$properties['css_1'] = $css_1;
				$properties['css_2'] = $css_2;
				$properties['css_3'] = $css_3;
				foreach($colorItem as $colorI) {
					$theme_color = $request->element('color_theme');
					$id_color = $colorI->getId();
					if ($theme_color == $id_color){
						$properties['rgb'] = $colorI->getPrimaryColorFromId($id_color);
						$properties['rgba'] = $colorI->getPrimaryColorOpacityFromId($id_color);
					}
				}
				# Custom fields
					foreach($fieldList as $field) {
						$properties[$field->getName()] = $request->element($field->getName());
					}




					
					$data = array('name' => Filter($request->element('site_name')),
					'keywords' => Filter($request->element('keywords')),
					'description' => Filter($request->element('site_description')),
					'company' => $request->element('company'),
					'address' => $request->element('address'),
					'tel' => Filter($request->element('tel')),
					'cell' => Filter($request->element('cell')),
					'email' => Filter($request->element('email')),
					'properties' => serialize($properties));
			
				// # End change by Thai Nguyen
				// $data = array('name' => Filter($request->element('site_name')),
				// 			  'keywords' => Filter($request->element('keywords')),
				// 			  'description' => Filter($request->element('site_description')),
				// 			  'company' => Filter($request->element('company')),
				// 			  'address' => Filter($request->element('address')),
				// 			  'tel' => Filter($request->element('tel')),
				// 			  'cell' => Filter($request->element('cell')),
				// 			  'email' => Filter($request->element('email')),
				// 			  'properties' => serialize($properties));
				$stores->updateData($data,$storeId);
				$estore = $stores->getObject($storeId);
				$template->assign('item',$estore);
				
				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>$amessages['tracking']['update_general_setting_ok'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
				# Redirect to editing page
				header('location:'.'/'.ADMIN_SCRIPT."?op=system&act=config&mod=general&lang=$lang&rcode=7");
			}
		}
	} else if($estore) $template->assign('item',$estore);
} else if($estore) $template->assign('item',$estore);

#$standardTemplates = $templates->getObjects(1,'`status` = 1 AND `owner_id` = 0','',1000);
#if($standardTemplates) $template->assign('standardTemplates',$templates->generateCombo($standardTemplates,$estore->getProperty('template_id')));
$domainTemplates = $templates->getObjects(1,'`status` = 1 AND (`owner_id` = 0 OR `owner_id` = '.$estore->getId().')','',1000);
if($domainTemplates) $template->assign('domainTemplates',$templates->generateCombo($domainTemplates,$estore->getProperty('domain_template_id')));

function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['site_name'] = $validate->validString($request->element('site_name'),$amessages['site_name']);
	$error['INPUT']['keywords'] = $validate->validString($request->element('keywords'),$amessages['site_keywords']);
	$error['INPUT']['site_description'] = $validate->validString($request->element('site_description'),$amessages['site_description']);
	$error['INPUT']['currency'] = $validate->pasteString($request->element('currency'),$amessages['currency']);
	$error['INPUT']['company'] = $validate->pasteString($request->element('company'));
	$error['INPUT']['address'] = $validate->pasteString($request->element('address'));
	$error['INPUT']['email'] = $validate->pasteString($request->element('email'));
	$error['INPUT']['tel'] = $validate->pasteString($request->element('tel'));
	$error['INPUT']['cell'] = $validate->pasteString($request->element('cell'));
	$error['INPUT']['allow_duplicate_product_name'] = $validate->pasteString($request->element('allow_duplicate_product_name'));
	$error['INPUT']['admin_logo'] = $validate->pasteString($request->element('admin_logo'));
	$error['INPUT']['store_logo'] = $validate->pasteString($request->element('store_logo'));
	$error['INPUT']['img_index'] = $validate->pasteString($request->element('img_index'));		
	
	$error['INPUT']['img_quytrinhsanxuat'] = $validate->pasteString($request->element('img_quytrinhsanxuat'));
	$error['INPUT']['img_quanlychatluongsanpham'] = $validate->pasteString($request->element('img_quanlychatluongsanpham'));		
	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}
	if($error['INPUT']['site_name']['error'] || $error['INPUT']['keywords']['error'] || $error['INPUT']['site_description']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>