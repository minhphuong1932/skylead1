<?php
/*************************************************************************
Class Search
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Mai Minh
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/searchinfo.class.php");

class Search extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."search";
		$this->store_id = $store_id;
	}
	public function Search($store_id = 0, $database = '') {
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
			$object = new SearchInfo
						(	$result[0]['slug'],
							$result[0]['title'],
							$result[0]['keyword'],
							$result[0]['sapo'],
							$result[0]['detail'],	
							$result[0]['status'],
							$result[0]['search_id'],
							$result[0]['type'],
                            $result[0]['url'],
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
				$objects[] = new SearchInfo
								(	$result['slug'],
									$result['title'],
									$result['keyword'],
									$result['sapo'],
									$result['detail'],									
									$result['status'],
									$result['search_id'],
									$result['type'],
                                    $result['url'],
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

	# Update record
	public function updateData($fields,$vtype='', $value = '', $key = 'search_id') {
		$result = $this->update($fields,"`store_id` = '".$this->store_id."' AND `$key` = '$value' AND `type` = '$vtype'");
		if($result)
			return $result;
		return 0;
	}

	# Change status
	public function changeStatus($vtype='', $id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `type`='$vtype' AND `search_id` = '$id' ")) return 1;
		return 0;
	}
	
		
	# Return a Search Id from provided ID
	public function getIdFromSlug($slug='') {
		if(!$slug) return 0;
		$result = $this->select('id',"`store_id` = '".$this->store_id."' AND slug = '$slug'");
		if($result) return $result[0]['id'];
		return 0;
	}

	# Return a Search Name from provided slug
	public function getNameFromSlug($slug='') {
		if(!$slug) return '';
		$result = $this->select('title',"`store_id` = '".$this->store_id."' AND slug = '$slug'");
		if($result) return $result[0]['title'];
		return '';
	}

	# Return a Search slug from provided ID
	public function getSlugFromId($id='') {
		if(!$id) return '';
		$result = $this->select('slug',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['slug'];
		return '';
	}

	# Return a Search name from provided ID
	public function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('title',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['title'];
		return '';
	}
# Clean trash
	public function cleanTrash($vtype='') {

		$result = $this->delete("`store_id` = '".$this->store_id."' AND `type`='$vtype' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
/*-----------------------------------------------------------------------*
* public function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	public function checkDuplicate($value = '', $key = 'title', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}

//	# Return a Search name from provided ID
//	public function getCatIdFromId($id='') {
//		if(!$id) return '';
//		$result = $this->select('cat_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
//		if($result) return $result[0]['cat_id'];
//		return '';
//	}

}
?>