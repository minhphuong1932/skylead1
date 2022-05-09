<?php
/*************************************************************************
Class Articles
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Mai Minh
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/documentinfo.class.php");

class Documents extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."document";
		$this->store_id = $store_id;
	}
	public function Documents($store_id = 0, $database = '') {
		$this->__construct($store_id, $database);
	}

/* Common methods
/*-----------------------------------------------------------------------*
* public function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	public function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*', "`store_id` = '".$this->store_id."' AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new DocumentInfo
						(	$result[0]['name'],
							$result[0]['customer_id'],
							$result[0]['document_type_id'],
							$result[0]['financial_year'],
							$result[0]['month_processed'],
							$result[0]['keywords'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['date_created'],
							$result[0]['last_updated'],
							$result[0]['date_processed'],
							$result[0]['user_processed'],
							$result[0]['user_processed_temporary'],
							$result[0]['processed_from'],
							$result[0]['processed_to'],
							$result[0]['date_approved'],
							$result[0]['user_approved'],
							$result[0]['store_id'],
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
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new DocumentInfo
								(	$result['name'],
									$result['customer_id'],
									$result['document_type_id'],
									$result['financial_year'],
									$result['month_processed'],
									$result['keywords'],
									$result['properties'],
									$result['status'],
									$result['date_created'],
									$result['last_updated'],
									$result['date_processed'],
									$result['user_processed'],
									$result['user_processed_temporary'],
									$result['processed_from'],
									$result['processed_to'],
									$result['date_approved'],
									$result['user_approved'],
									$result['store_id'],
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
	# Add record
	public function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result) return $result;
		return 0;
	}
	public function getDocumentId($condition = '1=1') {
		$result = $this->select('`id`',"`store_id` = '".$this->store_id."' AND $condition");
		if($result) return $result[0]['id'];
		return 0;
	}
	public function getDocumentStatus($id = 0) {
		$result = $this->select('`status`',"`store_id` = '".$this->store_id."' AND `id`= '$id'");
		if($result) return $result[0]['status'];
		return 0;
	}
	# Update record
	public function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`store_id` = '".$this->store_id."' AND `$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}

	# Change status
	public function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Clean trash
	public function cleanTrash() {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
	public function changeCustomerId($id = 0, $customer_id = '') {
		if(!$id) return 0;
		if($this->update(array('`customer_id`' => $customer_id), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}	
	public function changeDocumentTypeId($id = 0, $document_type_id = '') {
		if(!$id) return 0;
		if($this->update(array('`document_type_id`' => $document_type_id), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}	
	# Return a Customer username from provided ID
	public function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	public function getCustomerIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('customer_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['customer_id'];
		return '';
	}
	public function getDocumentTypeIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('document_type_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['document_type_id'];
		return '';
	}
	public function getUserProcessedFromId($id='') {
		if(!$id) return '';
		$result = $this->select('user_processed',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['user_processed'];
		return '';
	}
	public function getUserApprovedFromId($id='') {
		if(!$id) return '';
		$result = $this->select('user_approved',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['user_approved'];
		return '';
	}
    
    # Return a Customer username from provided ID
		
/*-----------------------------------------------------------------------*
* public function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	// public function checkDuplicate($value = '', $key = 'username', $condition = '') {
	// 	$result = $this->select("`$key`,`id`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
	// 	if($result) return $result[0]['id'];
	// 	return 0;
	// }
}
?>