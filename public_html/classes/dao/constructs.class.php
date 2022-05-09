<?php
/*************************************************************************
Class Product Unit
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Last updated: 01/08/2012
**************************************************************************/	
include_once(ROOT_PATH.'classes/database/model.class.php');
include_once(ROOT_PATH.'classes/dao/constructinfo.class.php');

class Constructs extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0,$database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
			
		} else $this->_db = $database;
		
		$this->table = DB_PREFIX."construct";
		$this->store_id = $store_id;
	}
	function Constructs($store_id = 0,$database = '') {
		$this->__construct($store_id, $database);
		
	}

/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id', $condition = '1>0') {
		$result = $this->select('*',"(`store_id` = '".$this->store_id."' or `store_id`=0) AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new ConstructInfo(
									$result[0]['slug'],
									$result[0]['name'],
									$result[0]['primary'],
									$result[0]['position'],
									$result[0]['status'],
									$result[0]['user_id'],
									$result[0]['store_id'],
									$result[0]['id']
									);
			return $object;
		}
		return '';
	}
	function getPrimaryProductUnit() {
		$result = $this->select('*',"`store_id` = '".$this->store_id."' AND `status` = '1' AND `primary` = '1'");
		if($result) {
			$object = new ConstructInfo(
									$result[0]['slug'],
									$result[0]['name'],
									$result[0]['primary'],
									$result[0]['position'],
									$result[0]['status'],
									$result[0]['user_id'],
									$result[0]['store_id'],
									$result[0]['id']
									);
			return $object;
		}
		return '';
	}

/*-----------------------------------------------------------------------*
* Function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "(`store_id` = '".$this->store_id."' or `store_id`=0) AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ConstructInfo(
									$result['slug'],
									$result['name'],
									$result['primary'],
									$result['position'],
									$result['status'],
									$result['user_id'],
									$result['store_id'],
									$result['id']
							);
			}
			return $objects;
			
		}
		return '';
	}
/*-----------------------------------------------------------------------*
* Function: addData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/
	function addData($object,$key = 'id') {
			 $this->add($object,'$key','NULL');
	}
/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/	
	function updateData($object, $value = '', $key = 'id') {
			 $this->update($object,"(`store_id` = '".$this->store_id."' or `store_id`=0)  AND `$key` = '$value'");
	}
	
	# Change status
	function changeStatus($id = 0, $status = '', $condition = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'".($condition?" AND $condition":""))) return 1;
		return 0;
	}
	# Change position category
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change product name
	function changeName($id = 0, $name = 0) {
		if(!$id) return 0;
		if($this->update(array('name' => $name), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	
	# Change exchange rate to the primary currency
	function changeRate($id = 0, $rate = 0,$condition = '') {
		if(!$id) return 0;
		if($this->update(array('rate' => $rate), "`store_id` = '".$this->store_id."' AND `id` = '$id'".($condition?" AND $condition":""))) return 1;
		return 0;
	}
	# Clean trash
	function cleanTrash() {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	

	# Return a currency name from provided ID
	function getNameFromId($id='0') {
		global $amessages;
		if(!$id) return '';
		$result = $this->select('name'," id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	function checkPrimaryFromId($id='0') {
		if(!$id) return 0;
		$result = $this->select('`primary`'," id = '$id'");
		if($result) return $result[0]['primary'];
		return 0;
	}
	function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	
	function generateCombo($value='') {
		global $amessages;
		$combo = '';
		$results = $this->select('id,name',"`store_id` = '".$this->store_id."' AND status = '1'");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">".$result['name']."</option>";	
			}
		}
		return $combo;
	}

}
?>