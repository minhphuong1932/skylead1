<?php
/*************************************************************************
Class Products
----------------------------------------------------------------
DeraPortal Project
Last updated: 06/23/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/trackingwarrantyinfo.class.php");

class TrackingWarrantys extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."tracking_product";
		$this->store_id = $store_id;
	}
	function TrackingWarrantys($store_id = 0, $database = '') {
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
			$object = new TrackingWarrantyInfo
						(	$result[0]['type'],
							$result[0]['name'],
							$result[0]['type_id'],
							$result[0]['created'],
							$result[0]['updated'],
							$result[0]['number_contract'],
							$result[0]['time_contract'],
							$result[0]['date_start'],
							$result[0]['date_end'],
							$result[0]['note'],
							$result[0]['status'],
							$result[0]['properties'],
							$result[0]['product_id'],
							$result[0]['customer_id'],
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
				$objects[] = new TrackingWarrantyInfo
								(	$result['type'],
									$result['name'],
									$result['type_id'],
									$result['created'],
									$result['updated'],
									$result['number_contract'],
									$result['time_contract'],
									$result['date_start'],
									$result['date_end'],
									$result['note'],
									$result['status'],
									$result['properties'],
									$result['product_id'],
									$result['customer_id'],
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

	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	
	# Change product position
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
	function increaseViewed($viewed,$pId) {
		$sql = $this->update(array('viewed'=>$viewed), "id='$pId'");
		if($sql) return 1;
		return 0;
	}
	
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}

	# Return a Product name from provided ID
	function getProIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('product_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['product_id'];
		return '';
	}
	function getProductFromPid($pId) {
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND status =1 AND `product_id`=$pId", array('created' => 'DESC'),  $start, '');
		if($results) {
			$productInfos = array();
			foreach($results as $key => $result) {
				$trackingWarrantyInfos[] = new TrackingWarrantyInfo ($result['type'],
																	$result['name'],
																	$result['type_id'],
																	$result['created'],
																	$result['updated'],
																	$result['number_contract'],
																	$result['time_contract'],
																	$result['date_start'],
																	$result['date_end'],
																	$result['note'],
																	$result['status'],
																	$result['properties'],
																	$result['product_id'],
																	$result['customer_id'],
																	$result['user_id'],
																	$result['store_id'],
																	$result['id']
																);
			}
			return $trackingWarrantyInfos;
		}
		return '';
	}
	
	function generateCombo($value='') {
		global $amessages;
		$combo = '';
		$results = $this->select('id,name,model',"`store_id` = '".$this->store_id."' and `status` = 1"); 
		if($results) { 
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['model']."'".($value==$result['model']?" selected":"").">".$result['model']."</option>";	
			}
		}
		return $combo;
	}
	
}
?>