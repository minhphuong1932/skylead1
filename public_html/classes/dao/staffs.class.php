<?php
/*************************************************************************
Class Staff
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/staffinfo.class.php");

class Staffs extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."staff";
		$this->store_id = $store_id;
	}
	function Staffs($store_id = 0, $database = '') {
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
			$object = new StaffInfo
						(	$result[0]['type'],
							$result[0]['fullname'],
							$result[0]['address'],
							$result[0]['email'],
							$result[0]['tel'],
							$result[0]['created'],
							$result[0]['updated'],
							$result[0]['position'],
							$result[0]['status'],
							$result[0]['properties'],
							$result[0]['user_id'],
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
				$objects[] = new StaffInfo
								(	$result['type'],
									$result['fullname'],
									$result['address'],
									$result['email'],
									$result['tel'],
									$result['created'],
									$result['updated'],
									$result['position'],
									$result['status'],
									$result['properties'],
									$result['user_id'],
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
	# Change customer position
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change customer position
	function changeName($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('fullname' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
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
		
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'fullname', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	
	function generateCombo($value='',$noroot = 0) {
		global $amessages;
		$combo = '';
		if($noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['root'].'</option>';
		$results = $this->select('id,fullname',"`store_id` = '".$this->store_id."' AND status = '1' ORDER BY `fullname` ASC");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['fullname']."'".($value==$result['fullname']?" selected":"").">".$result['fullname']."</option>";	
			}
		}
		return $combo;
	}
}
?>