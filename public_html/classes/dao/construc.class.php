<?php
/*************************************************************************
Class Voucher Type
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                   
Last updated: 18/09/2011
**************************************************************************/	
include_once(ROOT_PATH.'classes/database/model.class.php');
include_once(ROOT_PATH.'classes/dao/construcinfo.class.php');

class Construc extends Model {
	public $table;
	public $_db;
	
	public function __construct($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."construc";
	}
	public function Construc($database = '') {
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
		$result = $this->select('*', "`$key` = '$value' AND ($condition)");
		if($result) {
			$object = new ConstrucInfo
						(	$result[0]['order_id'],
							$result[0]['user_id'],
							$result[0]['status'],
							$result[0]['payment_status'],
							$result[0]['properties'],
							$result[0]['bill'],
							$result[0]['import'],
							$result[0]['export'],
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
		$results = $this->select('*', "$condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ConstrucInfo
								(	$result['order_id'],
									$result['user_id'],
									$result['status'],
									$result['payment_status'],
									$result['properties'],
									$result['bill'],
									$result['import'],
									$result['export'],
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

	# Update record
	public function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}

	# Change status
	public function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`id` = '$id'")) return 1;
		return 0;
	}
	public function changeImport($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('import' => $status), "`id` = '$id'")) return 1;
		return 0;
	}
	public function changeExport($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('export' => $status), "`id` = '$id'")) return 1;
		return 0;
	}
	public function changePaymentStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('payment_status' => $status), "`id` = '$id'")) return 1;
		return 0;
	}

# Clean trash
	public function cleanTrash() {
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}
	
	public function getIdFromOrderId($orderid='') {
		if(!$orderid) return '';
		$result = $this->select('id',"order_id = '$orderid'");
		if($result) return $result[0]['id'];
		return '';
	}
	public function getOrderIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('order_id',"id = '$id'");
		if($result) return $result[0]['order_id'];
		return '';
	}	
	function CountProNoQuotaFromId($id='') {
		if(!$id) return '';
		$orid = $this->select('order_id',"id = '$id'");
		$result = $orid[0]['order_id'];
		
		if($result) {
			include_once(ROOT_PATH."classes/dao/orderitems.class.php");
			$orderitems = new OrderItems();
			include_once(ROOT_PATH.'classes/dao/products.class.php');
			$products = new Products(1);
			$listProOr = $orderitems->getObjects(1,"`order_id` = '$result'",array("id" => "DESC"),9999);
			$count=0;
			foreach ($listProOr as $key => $value) {
				$ProId=$value->getProductId();
				if($ProId!=0){
					$quotaFromId= $products->getQuotaFromId($ProId);
					if($quotaFromId==0){
						$count=$count+1;
					}
				}
				
			}
			return $count;
		}
		
		return 0;
	}	
}
?>