<?php
/*************************************************************************
Class EStores
----------------------------------------------------------------
Bido.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/19/2010
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/estoreinfo.class.php");

class EStores extends Model{
	 public $table;
	 public $_db;

	public function __construct($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."estores";	
	}
	public function EStores($database = '') {
		$this->__construct($database);
	}	

/* Common methods
/*-----------------------------------------------------------------------*
* public function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	public function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*',"`$key` = '$value' AND ($condition)");
		if($result) {
			$object = new EStoreInfo
						(	$result[0]['owner_id'],
							$result[0]['area_id'],
							$result[0]['cat_id'],
							$result[0]['subdomain'],
							$result[0]['domain'],
							$result[0]['name'],
							$result[0]['keywords'],
							$result[0]['description'],
							$result[0]['company'],
							$result[0]['address'],
							$result[0]['tel'],
							$result[0]['cell'],
							$result[0]['email'],
							$result[0]['created'],
							$result[0]['expire'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['id']
						);
			return $object;
			
		}
		return 0;
	}
/*-----------------------------------------------------------------------*
* public function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	public function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', $condition, $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new EStoreInfo
								(	$result['owner_id'],
									$result['area_id'],
									$result['cat_id'],
									$result['subdomain'],
									$result['domain'],
									$result['name'],
									$result['keywords'],
									$result['description'],
									$result['company'],
									$result['address'],
									$result['tel'],
									$result['cell'],
									$result['email'],
									$result['created'],
									$result['expire'],
									$result['properties'],
									$result['status'],
									$result['id']
								);
			}
			return $objects;
		}
		return 0;
	}

/*-----------------------------------------------------------------------*
* public function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	public function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}

/*-----------------------------------------------------------------------*
* public function: addData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	public function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result)
			return $result;
		return 0;
	}
	
	public function duplicateUsername($username) {		
		$result = $this->select('`id`',"`name` = '$username'");
		if($result) {
			return 1;
		}
		return 0;
	}
	
	public function duplicateSubDomain($subdomain) {		
		$result = $this->select('`id`',"`subdomain` = '$subdomain'");
		if($result) {
			return 1;
		}
		return 0;
	}
	public function duplicateDomain($domain) {		
		$result = $this->select('`id`',"`domain` = '$domain'");
		if($result) {
			return 1;
		}
		return 0;
	}
	public function getStoreId($condition = '1=1') {
		$result = $this->select('`id`',$condition);
		if($result) return $result[0]['id'];
		return 0;
	}
	public function getSubdomainFromId($id='0') {
		$result = $this->select('`subdomain`',"`id` = '$id'");
		if($result) return $result[0]['subdomain'];
		return 0;
	}
/*-----------------------------------------------------------------------*
* public function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	public function checkDuplicate($value = '', $key = 'username', $condition = '') {
		$value = str_replace(" ",'',$value);
		$value = str_replace("\\",'',$value);
		$value = str_replace("\"",'',$value);
		$value = str_replace("'",'',$value);
		$result = $this->select("`$key`","`$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	# Change status
	public function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`id` = '$id'")) return 1;
		return 0;
	}
	# Change product category
	public function changeCatId($id = 0, $catId = 0) {
		if(!$id) return 0;
		if($this->update(array('cat_id' => $catId), "`id` = '$id'")) return 1;
		return 0;
	}
	# Clean trash
	public function cleanTrash() {
		$results = $this->select('*', "`status` = ".S_DELETED);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				# Delete gallery
				rrmdir(ROOT_PATH."gallery/".$result['id']);
				rrmdir(ROOT_PATH."uploads/".$result['id']);
								
				# Delete article categories
				
				# Delete entires
				
				# Delete product categories
				
				# Delete products
				
				# Delete menus
				
				# Delete ads
				
				# Delete static pages
				
				# Delete orders
				
				# Delete comments
				
				# Delete customers
				
				# Delete users
			}
		}
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}
}
?>