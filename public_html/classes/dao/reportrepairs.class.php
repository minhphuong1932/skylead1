<?php
/*************************************************************************
Class Requestforms
----------------------------------------------------------------
DeraPortal Project
Last updated: 06/23/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/reportrepairinfo.class.php");

class Reportrepairs extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table =DB_PREFIX."report_repair";
		$this->store_id = $store_id;
	}
	function Reportrepairs($store_id = 0, $database = '') {
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
			$object = new Reportrepairinfo
						(	$result[0]['model'],
							$result[0]['series'],							
							$result[0]['cause'],
							$result[0]['work'],						
							$result[0]['state_completed'],
							$result[0]['replacement'],	
							$result[0]['node'],							
							$result[0]['created'],									
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['customer_id'],	
							$result[0]['area_id'],						
							$result[0]['repair_id'],							
							$result[0]['product_id'],
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
		/* echo '<pre>';
			print_r($results);
			echo '</pre>';*/
		if($results) {
			$objects = array();
			foreach($results as $key => $result)
			
			 {		
				$objects[] = new Reportrepairinfo
								(	
									$result['model'],
									$result['series'],
									$result['cause'],
									$result['work'],
									$result['state_completed'],							
									$result['replacement'],
									$result['node'],
									$result['created'],
									$result['properties'],
									$result['status'],
									$result['customer_id'],
									$result['area_id'],
									$result['repair_id'],																
									$result['product_id'],									
									$result['store_id'],
									$result['id']
								);
			}
			return $objects;
			
		}
		return 0;
	}
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
/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Return a Product name from provided ID
	function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	function checkModeSeri($model=0,$series=0,$storeId=0) {
		include_once(ROOT_PATH.'classes/dao/tradeproducts.class.php');
		$tradeProducts = new TradProducts($storeId);		
		$product = $tradeProducts->getObjects('',"`series`='$series' and `model`='$model' and `status` = 1",'','');
		if($product)
			return 1;
		else return 0;
	}
	# Clean trash
	function cleanTrash() {
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($results) {
			$objects = array();
			/*foreach($results as $key => $result) {
				$properties = unserialize($result['properties']);
				if($properties['photos1']){
					unlink(ROOT_PATH."upload/".$this->store_id."/products/l_".$properties['photos1']);					
				}
				if($properties['photos2']){
					unlink(ROOT_PATH."upload/".$this->store_id."/products/l_".$properties['photos2']);					
				}
				if($properties['photos3']){
					unlink(ROOT_PATH."upload/".$this->store_id."/products/l_".$properties['photos3']);					
				}
				foreach($properties['photos'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/products/l_".$pvalue);
						
				}
				foreach($properties['videos'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/products/".$pvalue);					
				}
				foreach($properties['files'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/products/".$pvalue);					
				}
			}*/
		}
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}
	function checkDuplicate($value = '', $key = 'repair_id', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}	
	function getrIdFromRpairId($repair_id='') {
		if(!$repair_id) return '';
		$result = $this->select('id',"`store_id` = '".$this->store_id."' AND repair_id = '$repair_id'");
		if($result) return $result[0]['id'];
		return '';
	}	
	
}
?>