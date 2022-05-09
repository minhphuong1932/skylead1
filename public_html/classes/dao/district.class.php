<?php
/*************************************************************************
Class District
----------------------------------------------------------------
BiDo.vn Project
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
Eit by Quang Tri
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/districtinfo.class.php");

class District extends Model {
	var $table;
	var $_db;

	function __construct($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."district";
		// print_r(DB_PREFIX."district");die;
	}
	function District($database = '') {
		$this->__construct($database);
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
			$object = new DisctrictInfo
						(	
							$result[0]['name'],
							$result[0]['shipprice'],
							$result[0]['provinceid'],
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
	function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = 10000) {
		// ddd($condition);
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "$condition", $sort, $start, $items_per_page);

		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new DisctrictInfo
								(	$result['name'],
									$result['shipprice'],
									$result['provinceid'],
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

	# Return a ProductCategory name from provided ID
	function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name',"`id` = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	function getPriceFromId($id='') {
		if(!$id) return '';
		$result = $this->select('shipprice',"`id` = '$id'");
		if($result) return $result[0]['shipprice'];
		return '';
	}
	function createComboBox($id = 0, $sort = array('id' => 'ASC')) {
		$options = '';
		$results = $this->select("`id`, `name`", "`id` = '$id'", $sort, 0, 500);
		if($results) {
			foreach($results as $key => $result)
				$options .= '<option value="'.$result['id'].'">'.$result['name'].'</option>';
		}
		return $options;		
	}
	function createComboSe($selected=0,$provinceid = 0, $sort = array('id' => 'ASC')) {
		$options = '';
		$results = $this->select("`id`, `name`", "`provinceid` = '$provinceid'", $sort, 0, 500);
		if($results) {
			foreach($results as $key => $result)
				if($selected==$result['id']){
					$options .= '<option value="'.$result['id'].'"selected>'.$result['name'].'</option>';
				}else{
					$options .= '<option value="'.$result['id'].'">'.$result['name'].'</option>';
				}
				
		}
		return $options;		
	}

		# Change product price
	function changePrice($id = 0, $price = 0) {
		if(!$id) return 0;
		
		if($this->update(array('shipprice' => str_replace(',','',$price)), "`id` = '$id'")) return 1;
		
		return 0;

	}
}
?>