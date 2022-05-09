<?php
/*************************************************************************
Class EstoreCategories
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 03/10/2011
Coder: Mai Minh
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/estorecategoryinfo.class.php");

class EstoreCategories extends Model {
	private $table;
	private $_db;
	
	public function __construct($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."estore_categories";
	}
	public function EstoreCategories($database = '') {
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
			$object = new EstoreCategoryInfo
						(	$result[0]['slug'],
							$result[0]['name'],
							$result[0]['position'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['parent_id'],
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
				$objects[] = new EstoreCategoryInfo
								(	$result['slug'],
									$result['name'],
									$result['position'],
									$result['properties'],
									$result['status'],
									$result['parent_id'],
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

	# Change parent category
	public function changePId($id = 0, $pId = 0) {
		if(!$id) return 0;
		if($this->update(array('parent_id' => $pId), "`id` = '$id'")) return 1;
		return 0;
	}
	
	# Change position category
	public function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`id` = '$id'")) return 1;
		return 0;
	}

	# Clean trash
	public function cleanTrash() {
		$results = $this->select('id',"`status` = ".S_DELETED);
		if($results) {
			include_once(ROOT_PATH."classes/dao/estores.class.php");
			$estores = new Estores();
			# Loop all DELETED categories
			foreach($results as $key => $result) {
				# Change status of all Estores in each category to DELETED too
				$estores->update(array('status' => S_DELETED),"`cat_id` = '".$result['id']."'");
			}	
		}
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
		
	public function getParentObject($parent_id) {
		return $this->getObject($parent_id,'parent_id');
	}

	# Return a EstoreCategory Id from provided ID
	public function getIdFromSlug($slug='') {
		if(!$slug) return 0;
		$result = $this->select('id',"`slug` = '$slug'");
		if($result) return $result[0]['id'];
		return 0;
	}

	# Return a EstoreCategory Name from provided slug
	public function getNameFromSlug($slug='') {
		if(!$slug) return '';
		$result = $this->select('name',"`slug` = '$slug'");
		if($result) return $result[0]['name'];
		return '';
	}

	# Return a EstoreCategory slug from provided ID
	public function getSlugFromId($id='') {
		if(!$id) return '';
		$result = $this->select('slug',"`id` = '$id'");
		if($result) return $result[0]['slug'];
		return '';
	}
	public function getParentIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('parent_id',"`id` = '$id'");
		if($result) return $result[0]['parent_id'];
		return '';
	}

	# Return a EstoreCategory name from provided ID
	public function getNameFromId($id='0') {
		global $amessages;
		if(!$id) return $amessages['root'];
		$result = $this->select('name',"`id` = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}

/*-----------------------------------------------------------------------*
* public function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	public function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	
	public function generateCombo($value='', $noroot = 0) {
		global $amessages;
		$combo = '';
		if(!$noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['root'].'</option>';
		$results = $this->select('id,name',"`parent_id` = '0'");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">&nbsp;&nbsp;&nbsp;l--".$result['name']."</option>";	
				$s1results = $this->select('id,name',"`parent_id` = '".$result['id']."'");
				if($s1results) {
					foreach($s1results as $key1 => $result1) {
						$combo .= "<option value='".$result1['id']."'".($value==$result1['id']?" selected":"").">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;l--".$result1['name']."</option>";
					}
				}			
			}
		}
		return $combo;
	}
}
?>