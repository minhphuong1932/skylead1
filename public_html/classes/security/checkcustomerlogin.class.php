<?php
/*************************************************************************
Class Check Login Times
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com
Author: Mai Minh
Last updated: 07/06/2012
**************************************************************************/

include_once(ROOT_PATH."classes/database/model.class.php");

class CheckCustomerLogin extends Model {
	var $table;
	var $_db;
	
    function __construct($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."customer_login_times";
    }

	function CheckCustomerLogin($database = '') {
		$this->__construct($database);
	}	

	function getFailCustomerLoginInfo($value= '0', $key = 'uid') {
		$result = $this->select('*',"`$key` = '$value'");
		if($result) {
			return $result[0];
		}
		return '';
	}

/*-----------------------------------------------------------------------*
* Function: addData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result)
			return $result;
		return 0;
	}
		
/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}



# Below method are not modified


/* Common methods
/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*', "`store_id` = '".$this->store_id."' AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new CustomerInfo
						(	$result[0]['type'],
							$result[0]['username'],
							$result[0]['password'],
							$result[0]['fullname'],
							$result[0]['position'],
							$result[0]['company_name'],
							$result[0]['tax_code'],
							$result[0]['address'],
							$result[0]['tel'],
							$result[0]['fax'],
							$result[0]['email'],
							$result[0]['group_id'],
							$result[0]['details'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['date_created'],
							$result[0]['date_updated'],
							$result[0]['last_login'],
							$result[0]['area_id'],
							$result[0]['store_id'],
							$result[0]['id']
						);
			return $object;
		}
		return 0;
	}
/*-----------------------------------------------------------------------*
* Function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new CustomerInfo
								(	
									$result['type'],
									$result['username'],
									$result['password'],
									$result['fullname'],
									$result['position'],
									$result['company_name'],
									$result['tax_code'],
									$result['address'],
									$result['tel'],
									$result['fax'],
									$result['email'],
									$result['group_id'],
									$result['details'],
									$result['properties'],
									$result['status'],
									$result['date_created'],
									$result['date_updated'],
									$result['last_login'],
									$result['area_id'],
									$result['store_id'],
									$result['id']
								);
			}
			return $objects;
			
		}
		return 0;
	}
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'username') {
		$value = str_replace(" ",'',$value);
		$value = str_replace("\\",'',$value);
		$value = str_replace("\"",'',$value);
		$value = str_replace("'",'',$value);
		$result = $this->select("`$key`,`id`","`store_id` = '".$this->store_id."' AND `$key` = '$value'");
		if($result) return $result[0]['id'];
		return 0;
	}
	

	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	function cleanTrash() {
		$result = $this->delete('status = '.S_DELETED);
		if($result) return 1;
		return 0;
	}

/* Special methods	
/*-----------------------------------------------------------------------*
* Function: change password
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	function changePassword($id = 0, $password = '') {
		if(!$id) return 0;
		if($this->update(array('password' => $password), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	function getCustomerId($condition = '1=1') {
		$result = $this->select('id',$condition);
		if($result) return 1;
		return 0;
	}
	function getUsername($condition = '1=1') {
		$result = $this->select('username',$condition);
		if($result) return 1;
		return '';
	}
	function authenticateUser($username,$password) {
		if(!$username || !$password) return 0;
		$username = str_replace(" ",'',$username);
		$username = str_replace("\\",'',$username);
		$username = str_replace("\"",'',$username);
		$username = str_replace("'",'',$username);	
		$password = md5($password);
		$result = $this->select('id',"`store_id` = '".$this->store_id."' AND `username` = '$username' AND `password` = '$password' AND `status` = 1");
		if($result) {
			$last_login = array('last_login'=>date("Y-m-d H:i:s"));
			$this->update($last_login,"`id`='".$result[0]['id']."'");
			return $result[0]['id'];
		}
		return 0;
	}
	function authenticateUserAdmin($username,$password) {
		if(!$username || !$password) return 0;
		$username = str_replace(" ",'',$username);
		$username = str_replace("\\",'',$username);
		$username = str_replace("\"",'',$username);
		$username = str_replace("'",'',$username);
		$password = md5($password);
		$result = $this->select('id',"`store_id` = '".$this->store_id."' AND `username` = '$username' AND `password` = '$password' AND type >= '".U_MERCHANT."'");
		if($result) {
			$last_login = array('last_login'=>date("Y-m-d H:i:s"));
			$this->update($last_login,"`id`='".$result[0]['id']."'");
			return $result[0]['id'];
		}
		return 0;
	}	
}
?>
