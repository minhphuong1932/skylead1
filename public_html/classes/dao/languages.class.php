<?php
/*************************************************************************
Class Languages
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 28/05/2012
Coder: Mai Minh
**************************************************************************/	
include_once(ROOT_PATH.'classes/database/model.class.php');
include_once(ROOT_PATH.'classes/dao/languageinfo.class.php');

class Languages extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0,$database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
			
		} else $this->_db = $database;
		
		$this->table = DB_PREFIX."languages";
		$this->store_id = $store_id;
	}
	public function Languages($store_id = 0,$database = '') {
		$this->__construct($store_id, $database);
	}

/*-----------------------------------------------------------------------*
* public function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	public function getObject($value = '0', $key = 'id', $condition = '1>0') {
		$result = $this->select('*',"(`store_id` = '".$this->store_id."' OR `store_id`=0) AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new LanguageInfo(
									$result[0]['prefix'],
									$result[0]['name'],
									$result[0]['currency'],
									$result[0]['primary'],
									$result[0]['position'],
									$result[0]['status'],
									$result[0]['store_id'],
									$result[0]['id']
									);
			return $object;
		}
		return '';
	}
	public function getPrimaryLanguage() {
		$result = $this->select('*',"`store_id` = '".$this->store_id."' AND `status`='1' AND `primary` = '1'");
		if($result) {
			$object = new LanguageInfo(
									$result[0]['prefix'],
									$result[0]['name'],
									$result[0]['currency'],
									$result[0]['primary'],
									$result[0]['position'],
									$result[0]['status'],
									$result[0]['store_id'],
									$result[0]['id']
									);
			return $object;
		}
		return '';
	}

/*-----------------------------------------------------------------------*
* public function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	public function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "(`store_id` = '".$this->store_id."' or `store_id`=0) AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new LanguageInfo(
									$result['prefix'],
									$result['name'],
									$result['currency'],
									$result['primary'],
									$result['position'],
									$result['status'],
									$result['store_id'],
									$result['id']
							);
			}
			return $objects;
			
		}
		return '';
	}
/*-----------------------------------------------------------------------*
* public function: addData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/
	public function addData($object,$key = 'id') {
			 $this->add($object,'$key','NULL');
	}
/*-----------------------------------------------------------------------*
* public function: updateData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/	
	public function updateData($object, $value = '', $key = 'id') {
			 $this->update($object,"(`store_id` = '".$this->store_id."' or `store_id`=0)  AND `$key` = '$value'");
	}
	
	# Change status
	public function changeStatus($id = 0, $status = '', $condition = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'".($condition?" AND $condition":""))) return 1;
		return 0;
	}
	# Change position category
	public function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Set primary
	public function setPrimary($id = 0) {
		if(!$id) return 0;
		if($this->update(array('primary' => '0'), "`store_id` = '".$this->store_id."'")) {
			if($this->update(array('primary' => '1'), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		}
		return 0;
	}
	# Clean trash
	public function cleanTrash() {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	

	# Return a prefix from provided ID
	public function getPrefixFromId($id='0') {
		if(!$id) return '';
		$result = $this->select('prefix'," id = '$id'");
		if($result) return $result[0]['prefix'];
		return '';
	}
	public function getNameFromId($id='0') {
		global $amessages;
		if(!$id) return '';
		$result = $this->select('name'," id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	public function checkPrimaryFromId($id='0') {
		if(!$id) return 0;
		$result = $this->select('`primary`'," id = '$id'");
		if($result) return $result[0]['primary'];
		return 0;
	}
	public function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	
	public function generateCombo($value='') {
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