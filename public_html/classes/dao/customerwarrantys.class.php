<?php
/*************************************************************************
Class Customers
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
include_once(ROOT_PATH."classes/datebase/model.class.php");
include_once(ROOT_PATH."classes/dao/customerwarrantyinfo.class.php");

class CustomerWarrantys extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."warranty_customer";
		$this->store_id = $store_id;
	}
	function CustomerWarrantys($store_id = 0, $database = '') {
		$this->__construct($store_id, $database);
	}

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
			$object = new CustomerWarrantyInfo
						(	$result[0]['type'],
							$result[0]['username'],
							$result[0]['password'],
							$result[0]['fullname'],
							$result[0]['address'],
							$result[0]['email'],
							$result[0]['tel'],
							$result[0]['properties'],
							$result[0]['date_created'],
							$result[0]['last_login'],
							$result[0]['status'],
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
				$objects[] = new CustomerWarrantyInfo
								(	$result['type'],
									$result['username'],
									$result['password'],
									$result['fullname'],
									$result['address'],
									$result['email'],
									$result['tel'],
									$result['properties'],
									$result['date_created'],
									$result['last_login'],
									$result['status'],
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
* Function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	# Add record
	function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result) return $result;
		return 0;
	}

	# Update record
	function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`store_id` = '".$this->store_id."' AND `$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}
	
	function getUserId($condition = '1=1') {
		$result = $this->select('`id`',"`store_id` = '".$this->store_id."' AND $condition");
		if($result) return $result[0]['id'];
		return 0;
	}
	
	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change customer area
	function changeAreaId($id = 0, $areaId = 0) {
		if(!$id) return 0;
		if($this->update(array('area_id' => $areaId), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change customer position
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

	# Clean trash
	function cleanTrash() {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
		
	# Return a Customer name from provided ID
	function getFullNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('fullname',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['fullname'];
		return '';
	}
	# Return a Customer username from provided ID
	function getUserNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('username',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['username'];
		return '';
	}	
	# Return a Customer AreaId from provided ID
	function getAreaIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('area_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['area_id'];
		return '';
	}	
	# Return a Customer AreaId from provided ID
	function getAddressFromId($id='') {
		if(!$id) return '';
		$result = $this->select('address',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['address'];
		return '';
	}		
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'username', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	function authenticateUser($username,$password) {
		if(!$username || !$password) return 0;
		$username = str_replace(" ",'',$username);
		$username = str_replace("\\",'',$username);
		$username = str_replace("\"",'',$username);
		$username = str_replace("'",'',$username);	
		$password = md5($password);
		$result = $this->select('`id`,`status`',"`store_id` = '".$this->store_id."' AND `username` = '$username' AND `password` = '$password'");# AND `status` = 1");
		if($result) { # User o trang thai kich hoat, cho phep dang nhap
			if($result[0]['status'] == 1) {
				$last_login = array('last_login'=>date("Y-m-d H:i:s"));
				$this->update($last_login,"`id`='".$result[0]['id']."'");
				return $result[0]['id'];
			} else return '-1';
		}
		return 0;
	}
	function generateCombo($value='',$condition = "1=1", $noroot = 0) {
		global $amessages;
		$combo = '';
		
		$results = $this->select('id,fullname',"`store_id` = '".$this->store_id."' AND status = '1' and $condition ORDER BY `fullname` ASC");
		if($results) {
			if($noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['root'].'</option>';
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">".$result['fullname']."</option>";	
			}
		}
		return $combo;
	}
}
?>