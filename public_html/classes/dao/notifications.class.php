<?php
/*************************************************************************
Class Ads
----------------------------------------------------------------
Bido.vn Project
Company: Derasoft Co., Ltd                                  
Last updated:26/09/2011
Coder: Tran Thi My Xuyen
Checked by: Mai Mihn (28/09/2011)
**************************************************************************/
include_once(ROOT_PATH.'classes/database/model.class.php');
include_once(ROOT_PATH.'classes/dao/notificationinfo.class.php');

class Notifications extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."notification";	
		$this->store_id = $store_id;
	}
public function Notifications($store_id = 0, $database = '') {
		$this->__construct($store_id, $database);
	}


/*-----------------------------------------------------------------------*
* Function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	public function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*', "`store_id` = '".$this->store_id."' AND `$key` = '$value' AND ($condition)");
		if($result) {
			$payment = new NotificationInfo( 
					$result[0]['link'],
					$result[0]['to_id'],
					$result[0]['from_id'],
					$result[0]['properties'],
					$result[0]['updated'],
					$result[0]['created'],
					$result[0]['status'],
					$result[0]['details'],
					$result[0]['store_id'],
					$result[0]['id']
					);
			return $payment;
		}
		return '';
	}
	
	public function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page - 1) * $items_per_page;
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND ($condition)", $sort, $start, $items_per_page);
		if($results) {
			$paymentInfo = array();
			foreach($results as $key => $result) {
				$paymentInfo[] = new NotificationInfo (	
									$result['link'],
									$result['to_id'],
									$result['from_id'],
									$result['properties'],
									$result['updated'],
									$result['created'],
									$result['status'],
									$result['details'],
									$result['store_id'],
									$result['id']
												);
			}
			return $paymentInfo;		
		}
		return '';
	}


/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	# Add record
	public function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result) return $result;
		return 0;
	}
	
	public function deleteData($id) {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `id` = '".$id."'");
		if($result) return $result;
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
	# Change ads category
	
	# Clean trash
	public function cleanTrash() {
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($results) {
			foreach($results as $key => $result) {
				$properties = unserialize($result['properties']);
				if($properties['logo']) {
					unlink(ROOT_PATH."gallery/".$this->store_id."/resources/".$properties['logo']);
				}
			}
		}
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
		

}
?>