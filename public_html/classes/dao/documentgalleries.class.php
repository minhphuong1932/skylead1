<?php
/*************************************************************************
Class AdsCategories
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                   
Last updated: 18/09/2011
**************************************************************************/	
include_once(ROOT_PATH.'classes/dao/database/model.class.php');
include_once(ROOT_PATH.'classes/dao/documentgalleryinfo.class.php');

class DocumentGalleries extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0,$database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
			
		} else $this->_db = $database;
		
		$this->table = DB_PREFIX."document_gallery";
		$this->store_id = $store_id;
	}
	function DocumentGalleries($store_id = 0,$database = '') {
		$this->__construct($store_id, $database);
	}

/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id', $condition = '1>0') {
		$result = $this->select('*',"(`store_id` = '".$this->store_id."' or `store_id`=0) AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new DocumentGalleryInfo(
									$result[0]['slug'],
									$result[0]['name'],
									$result[0]['date_created'],
									$result[0]['status'],
									$result[0]['position'],
									$result[0]['free'],
									$result[0]['properties'],
									$result[0]['parent_id'],
									$result[0]['user_id'],
									$result[0]['store_id'],
									$result[0]['id']
									);
			return $object;
		}
		return '';
	}

/*-----------------------------------------------------------------------*
* Function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "(`store_id` = '".$this->store_id."' or `store_id`=0) AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new DocumentGalleryInfo(
									$result['slug'],
									$result['name'],
									$result['date_created'],
									$result['status'],
									$result['position'],
									$result['free'],
									$result['properties'],
									$result['parent_id'],
									$result['user_id'],
									$result['store_id'],
									$result['id']
							);
			}
			return $objects;
			
		}
		return '';
	}
/*-----------------------------------------------------------------------*
* Function: addData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/
	function addData($object,$key = 'id') {
			 $this->add($object,'$key','NULL');
	}
/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/	
	function updateData($object, $value = '', $key = 'id') {
			 $this->update($object,"(`store_id` = '".$this->store_id."' or `store_id`=0)  AND `$key` = '$value'");
	}
	
	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

	# Clean trash
	function cleanTrash() {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	


	function generateCombo($value='', $condition = "1 = 1", $noroot = 0) {
			global $amessages;
			$combo = '';
			if(!$noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['all'].'</option>';
			else  $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['all'].'</option>';
			$results = $this->select('id,name',"`store_id` = '".$this->store_id."' AND parent_id = '0'  and ".$condition." order by position");
			if($results) {
				foreach($results as $key => $result) {
					$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">&nbsp;&nbsp;&nbsp;l--".$result['name']."</option>";	
					$s1results = $this->select('id,name',"`store_id` = '".$this->store_id."' AND parent_id = '".$result['id']."' and ".$condition." order by position");
					if($s1results) {
						foreach($s1results as $key1 => $result1) {
							$combo .= "<option value='".$result1['id']."'".($value==$result1['id']?" selected":"").">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;l--".$result1['name']."</option>";
						}
					}			
				}
			}
			return $combo;
	}
	
	
	# Return a AdsCategory name from provided ID
	function getNameFromId($id='0') {
		global $amessages;
		if(!$id) return $amessages['root'];
		$result = $this->select('name'," id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	
	function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
    function getParentIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('parent_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['parent_id'];
		return '';
	}	
	# Return ProductCategory from provided parent_id
	function getGalleryFree($pId=0) {
		$results = $this->select("id", "status =1 and id = $pId",array('position'=>'ASC'));
		if($results) {
			$categoryInfos = array();
			foreach($results as $key => $result) {
				$a= $result['id'];
				$categoryInfos[]=$result['id'];
				$results1 = $this->select("id", "status =1 and free = 1 and parent_id = $a",array('position'=>'ASC'));	
				foreach($results1 as $key => $result_1) {
						$b = $result_1['id'];
						$categoryInfos[]=$result_1['id'];
						$results2 = $this->select("id", "status =1 and free = 1 and parent_id = $b",array('position'=>'ASC'));					
						foreach($results2 as $key => $result_2) {
							$c = $result_2['id'];
							$categoryInfos[]=$result_2['id'];
							$results3 = $this->select("id", "status =1 and free = 1 and parent_id = $c",array('position'=>'ASC'));
							foreach($results3 as $key => $result_3) {
									$d=$result_3['id'];
									$categoryInfos[]=$result_3['id'];
							}
						}		
				}
			}
				return implode(",",$categoryInfos);
		}
		return 0;
	}
	# Return allIdGalleries
	function getAllIdGallery($condition= "1=1") {
		$results = $this->select("id", "status =1 and ".$condition,array('position'=>'ASC'));
		if($results) {
			$categoryInfos = array();
			foreach($results as $key => $result) {
				$a= $result['id'];
				$categoryInfos[]=$result['id'];
				$results1 = $this->select("id", "status =1 and parent_id = $a and ".$condition,array('position'=>'ASC'));	
				foreach($results1 as $key => $result_1) {
						$b = $result_1['id'];
						$categoryInfos[]=$result_1['id'];
						$results2 = $this->select("id", "status =1 and parent_id = $b and ".$condition,array('position'=>'ASC'));					
						foreach($results2 as $key => $result_2) {
							$c = $result_2['id'];
							$categoryInfos[]=$result_2['id'];
							$results3 = $this->select("id", "status =1 and parent_id = $c and ".$condition,array('position'=>'ASC'));
							foreach($results3 as $key => $result_3) {
									$d=$result_3['id'];
									$categoryInfos[]=$result_3['id'];
							}
						}		
				}
			}
				return implode(",",$categoryInfos);
		}
		return 0;
	}
}
?>