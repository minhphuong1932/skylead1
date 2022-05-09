<?php
/*************************************************************************
Class License
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 01/11/2013
Coder: Pham Quoc Dai
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/licenseinfo.class.php");

class License extends Model {
	var $table;
	var $_db;
	
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."license";
		
	}
	function License($store_id = 0, $database = '') {
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
		$result = $this->select('*', "`$key` = '$value' AND ($condition)");
		if($result) {

			$object = new LicenseInfo
						(	$result[0]['properties'],
							$result[0]['status'],
							$result[0]['versionphp'],
							$result[0]['domain'],
							$result[0]['subdomain'],
							$result[0]['customer_name'],
							$result[0]['customer_email'],
							$result[0]['customer_phone'],
							$result[0]['id_user'],
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
		$results = $this->select('*', "$condition", $sort, $start, $items_per_page);
		if($results) {			
			$objects = array();
			foreach($results as $key => $result) {		
				
				$objects[] = new LicenseInfo
								(	$result['properties'],
									$result['status'],
									$result['versionphp'],
									$result['domain'],
									$result['subdomain'],
									$result['customer_name'],
									$result['customer_email'],
									$result['customer_phone'],
									$result['id_user'],
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
		$result = $this->update($fields,"`$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}
	
	function getId($condition = '1=1') {
		$result = $this->select('`id`',"$condition");
		if($result) return $result[0]['id'];
		return 0;
	}
	
	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`id` = '$id'")) return 1;
		return 0;
	}
	
	

	# Clean trash
	function cleanTrash() {
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
	# Clean trash
	function deleteData($id) {
		if($id){
			$result = $this->delete("`id` = '$id'");
		}
		if($result) return 1;
		return 0;
	}	
		
	# Return a Customer name from provided ID
	function getDomain($id='') {
		if(!$id) return '';
		$result = $this->select('domain',"id = '$id'");
		if($result) return $result[0]['doamain'];
		return '';
	}
		
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'domain', $condition = '1>0') {
		$result = $this->select("`$key`","`$key` = '$value' and $condition");			
		if($result) return 1;
		return '';
	}
	
	function generateCombo($value='',$noroot = 0) {
		global $amessages;
		$combo = '';
		if($noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['root'].'</option>';
		$results = $this->select('id,fullname',"status = '1' ORDER BY `fullname` ASC");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['fullname']."'".($value==$result['fullname']?" selected":"").">".$result['fullname']."</option>";	
			}
		}
		return $combo;
	}
}
?>