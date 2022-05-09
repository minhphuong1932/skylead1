<?php
/*************************************************************************
Login module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 02/07/2008
**************************************************************************/
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/security/checklogin.class.php');
include_once(ROOT_PATH.'classes/security/checkcustomerlogin.class.php');
$templateFile = 'login.tpl.html';
$template->assign('userTemplate',$userTemplate);
$error = '';
$site = $request->element("site");
if(!$site) $site = '';
if($_POST) {
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$_SESSION['userId'] = 0;
		$_SESSION['customerId'] = 0;
		$template->assign('error',$validate);	
	} else {
		$username = Filter($request->element('username'));
		$password = Filter($request->element('password'));
		$users = new Users($storeId);
		
		//$customers = new Customers($storeId);
		$preUserId = $users->getUserId("username='$username'");
		//$preCustomerId = $customers->getCustomerId("username='$username'");
		$checkLogin = new CheckLogin();
		//$checkCustomerLogin = new CheckCustomerLogin();
		$failLoginInfo = $checkLogin->getFailLoginInfo($preUserId);

		//$failLoginCustomerInfo = $checkCustomerLogin->getFailCustomerLoginInfo($preCustomerId);
		
		if($failLoginInfo && $failLoginInfo['fail_times'] >= MAX_FAIL_TIMES && $failLoginInfo['last_try'] >= date("Y-m-d H:i:s", time() - MAX_GRACE_TIME*60)) { # Vuot qua so lan login sai cho phep
			$_SESSION['userId'] = 0;
			$validate['message'] = $amessages['your_account_has_been_blocked'];
			$template->assign('error',$validate);
			
			# Operation tracking
			$trackings = new Trackings($storeId);
			$trackings->addData(array('store_id'=>$storeId,'username'=>$username,'action'=>$amessages['tracking']['lock_too_many_fail_logins'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
		} else { # Chua vuot qua so lan login sai cho phep
			$userId = $users->authenticateUser($username,$password);
			
			if($userId > 0) { # Kiem tra username va password so voi du lieu trong DB
				$_SESSION['userId'] = $userId;
				
				$trackings = new Trackings($storeId);

				# Operation tracking
				$trackings->addData(array('store_id'=>$storeId,'username'=>$username,'action'=>$amessages['tracking']['login_ok'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
				if($site == 'admin') {
					if($_SESSION['userId']){
						$userIdC = $users->getObject($_SESSION['userId']);
					}
					if($userIdC->getType()==0){
						header('location: '.ADMIN_SCRIPT.'?op=manage');
					}else{
						if($userIdC->getType()==3 || $userIdC->getType()==4){
							header('location: '.ADMIN_SCRIPT.'?op=dashboard&act=index&mod=list&ds=3');
						}elseif($userIdC->getType()==2){
							header('location: '.ADMIN_SCRIPT.'?op=dashboard&act=index&mod=list&ds=4');
						}else{
							header('location: '.ADMIN_SCRIPT.'?op=dashboard&act=index&mod=list&ds=5');
						}
						
					}
					
				} else {
					$url =$customDomain?PROTOCOL.$customDomain:'/';
					header('location: '.$url);
				}
			} else { # Sai username hoac password
				if($userId == -1) {	# Tai khoan da bi vo hieu hoa
					$_SESSION['userId'] = 0;
					$validate['message'] = $amessages['your_account_has_been_disabled'];
				} else {
					$fail = 0;
					$userId = $users->getUserId("username='$username'");
					if($userId) { # Lay ra userId tu username
						$failLoginInfo = $checkLogin->getFailLoginInfo($userId);
						if($failLoginInfo) { # Da ton tai thong tin login, tang so lan login sai len 1
							if($failLoginInfo['last_try'] < date("Y-m-d H:i:s", time() - MAX_GRACE_TIME*60)) # Thoi gian hien tai nam ngoai khoang gioi han kiem tra login sai, reset so lan login sai = 1
								$fail = 1;
							else # Nam trong khoang theo doi, tang so lan len 1
								$fail = $failLoginInfo['fail_times'] +1 ;	
							$checkLogin->updateData(array('uid' => $userId, 'fail_times' => $fail, 'last_try' => date('Y-m-d H:i:s'), 'last_ip' => $_SERVER['REMOTE_ADDR']),$failLoginInfo['id']);
						} else { # Chua ton tai thong tin login, them vao database
							$fail = 1;
							$checkLogin->addData(array('uid' => $userId, 'fail_times' => $fail, 'last_try' => date('Y-m-d H:i:s'), 'last_ip' => $_SERVER['REMOTE_ADDR']));
						}
					}
					$_SESSION['userId'] = 0;
					$validate['message'][] = $amessages['invalid_user_password'];
					if($fail) $validate['message'][] = sprintf($amessages['fail_login_times'],$fail);
				}
			}
			$template->assign('error',$validate);	
		}

		#khach hang dang nhap
		
		// if($failLoginCustomerInfo && $failLoginCustomerInfo['fail_times'] >= MAX_FAIL_TIMES && $failLoginCustomerInfo['last_try'] >= date("Y-m-d H:i:s", time() - MAX_GRACE_TIME*60)) { # Vuot qua so lan login sai cho phep

		// 	$_SESSION['customerId'] = 0;
		// 	$validate['message'] = $amessages['your_account_has_been_blocked'];
		// 	$template->assign('error',$validate);
			
		// 	# Operation tracking
		// 	$trackings = new Trackings($storeId);
		// 	$trackings->addData(array('store_id'=>$storeId,'username'=>$username,'action'=>$amessages['tracking']['lock_too_many_fail_logins'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
		// } else { # Chua vuot qua so lan login sai cho phep
		// 	$customerId = $customers->authenticateUser($username,$password);
			
		// 	if($customerId > 0) { # Kiem tra username va password so voi du lieu trong DB
		// 		$_SESSION['customerId'] = $customerId;
				
		// 		$trackings = new Trackings($storeId);

		// 		# Operation tracking
		// 		$trackings->addData(array('store_id'=>$storeId,'username'=>$username,'action'=>$amessages['tracking']['login_ok'],'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
		// 		if($site == 'admin') {
		// 			header('location: '.ADMIN_SCRIPT.'?op=dashboard');
		// 		} else {
		// 			$url =$customDomain?PROTOCOL.$customDomain:'/';
		// 			header('location: '.$url);
		// 		}
		// 	} else { # Sai username hoac password
		// 		if($customerId == -1) {	# Tai khoan da bi vo hieu hoa
		// 			$_SESSION['customerId'] = 0;
		// 			$validate['message'] = $amessages['your_account_has_been_disabled'];
		// 		} else {
		// 			$fail = 0;
		// 			$customerId = $customers->getCustomerId("username='$username'");
		// 			if($customerId) { # Lay ra userId tu username
		// 				$failLoginCustomerInfo = $checkCustomerLogin->getFailCustomerLoginInfo($customerId);
		// 				if($failLoginCustomerInfo) { # Da ton tai thong tin login, tang so lan login sai len 1
		// 					if($failLoginCustomerInfo['last_try'] < date("Y-m-d H:i:s", time() - MAX_GRACE_TIME*60)) # Thoi gian hien tai nam ngoai khoang gioi han kiem tra login sai, reset so lan login sai = 1
		// 						$fail = 1;
		// 					else # Nam trong khoang theo doi, tang so lan len 1
		// 						$fail = $failLoginCustomerInfo['fail_times'] +1 ;	
		// 					$checkCustomerLogin->updateData(array('uid' => $customerId, 'fail_times' => $fail, 'last_try' => date('Y-m-d H:i:s'), 'last_ip' => $_SERVER['REMOTE_ADDR']),$failLoginCustomerInfo['id']);
		// 				} else { # Chua ton tai thong tin login, them vao database
		// 					$fail = 1;
		// 					$checkCustomerLogin->addData(array('uid' => $customerId, 'fail_times' => $fail, 'last_try' => date('Y-m-d H:i:s'), 'last_ip' => $_SERVER['REMOTE_ADDR']));
		// 				}
		// 			}
		// 			$_SESSION['customerId'] = 0;
		// 			$validate['message'][] = $amessages['invalid_user_password'];
		// 			if($fail) $validate['message'][] = sprintf($amessages['fail_login_times'],$fail);
		// 		}
		// 	}
		// 	$template->assign('error',$validate);	
		// }
	}
} else {
	$template->assign('error',$error);
}


function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['username'] = $validate->validUsername(Filter($request->element('username')));
	$error['INPUT']['password'] = $validate->validPassword(Filter($request->element('password')));
	
	if($error['INPUT']['username']['error'] || $error['INPUT']['password']['error']) { # || $error['password']['error']
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>