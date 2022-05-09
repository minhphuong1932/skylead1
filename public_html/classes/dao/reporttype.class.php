<?php
/*************************************************************************
Class ReportType
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com
Author: Dai Pham
Last updated: 24/10/2013
************************************************************************** */

include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/reporttypeinfo.class.php");

class ReportType extends Model {
	var $table;
	var $_db;
    var $store_id;
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."reporttype";
		$this->store_id=$store_id;
	}
	function ReportType($store_id = 0, $database = '') {
		$this->__construct($store_id, $database);
	}
	/* Common methods
/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id') {
		if(!$key || !$value) return '';
		$result = $this->select('*',"`$key` = '$value'");
		if($result) {
			$object = new ReportTypeInfo
						(	$result[0]['store_id'],
							$result[0]['name'],
							$result[0]['start'],
							$result[0]['end'],
							$result[0]['status'],
							$result[0]['properties'],
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
function getObjects($page = 1, $condition = '`id` = 0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*',"`store_id`='".$this->store_id."' and $condition", $sort, $start, $items_per_page);		
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ReportTypeInfo
								(	$result['store_id'],
									$result['name'],
									$result['start'],
									$result['end'],
									$result['status'],
									$result['properties'],
									$result['id']							
								);
			}
			return $objects;			
		}
		return 0;
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
		$result = $this->update($fields,"`store_id`=".$this->store_id." and `$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'title', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Return a Report Type name from provided ID
	function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
    # Clean trash
	function cleanTrash() {	  
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result)
		  return 1;                            
		return 0;
	}		
}

?>