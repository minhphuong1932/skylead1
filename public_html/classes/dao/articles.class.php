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
include_once(ROOT_PATH."classes/dao/articleinfo.class.php");

class Articles extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."articles";
		$this->store_id = $store_id;
	}
	public function Articles($store_id = 0, $database = '') {
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
			$object = new ArticleInfo
						(	$result[0]['slug'],
							$result[0]['title'],
							$result[0]['keyword'],
							$result[0]['sapo'],
							$result[0]['detail'],
							$result[0]['viewed'],
							$result[0]['date_created'],
							$result[0]['date_update'],
							$result[0]['position'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['status_duyet'],
							$result[0]['home'],
							$result[0]['banner'],
							$result[0]['dateshow'],
							$result[0]['listcat'],
							$result[0]['price1'],
							$result[0]['price2'],
							$result[0]['cat_id'],
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
				$objects[] = new ArticleInfo
								(	
									$result['slug'],
									$result['title'],
									$result['keyword'],
									$result['sapo'],
									$result['detail'],
									$result['viewed'],
									$result['date_created'],
									$result['date_update'],
									$result['position'],
									$result['properties'],
									$result['status'],
									$result['status_duyet'],
									$result['home'],
									$result['banner'],
									$result['dateshow'],
									$result['listcat'],
									$result['price1'],
									$result['price2'],
									$result['cat_id'],
									$result['store_id'],
									$result['id']
								);
			}
			return $objects;
			
		}
		return 0;
	}
	//random theo cate
	public function Random($idCat='0',$id='0') {
		$results = $this->select('*',"`store_id` = '".$this->store_id."'AND`status`='1' AND `cat_id` = $idCat AND `id` <> $id ORDER BY RAND() LIMIT 3");
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ArticleInfo
								(		
								$result['slug'],
								$result['title'],
								$result['keyword'],
								$result['sapo'],
								$result['detail'],
								$result['viewed'],
								$result['date_created'],
								$result['date_update'],
								$result['position'],
								$result['properties'],
								$result['status'],
								$result['status_duyet'],
								$result['home'],
								$result['banner'],
								$result['dateshow'],
								$result['listcat'],
								$result['price1'],
								$result['price2'],
								$result['cat_id'],
								$result['store_id'],
								$result['id']
								);
			}
			return $objects;
			
		}
		return 0;
	}
	//random all
	public function RandomAll() {
		$results = $this->select('*',"`store_id` = '".$this->store_id."'AND`status`='1' ORDER BY RAND() LIMIT 3");
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ArticleInfo
								(		
								$result['slug'],
								$result['title'],
								$result['keyword'],
								$result['sapo'],
								$result['detail'],
								$result['viewed'],
								$result['date_created'],
								$result['date_update'],
								$result['position'],
								$result['properties'],
								$result['status'],
								$result['status_duyet'],
								$result['home'],
								$result['banner'],
								$result['dateshow'],
								$result['listcat'],
								$result['price1'],
								$result['price2'],
								$result['cat_id'],
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

	public function changeStatusDuyet($id = 0, $statusduyet = '') {
		if(!$id) return 0;
		if($this->update(array('status_duyet' => $statusduyet), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change home
	public function changeHome($id = 0, $home = '') {
		if(!$id) return 0;
		if($this->update(array('home' => $home), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

	# Change banner
	public function changeBanner($id = 0, $banner = '') {
		if(!$id) return 0;
		if($this->update(array('banner' => $banner), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change article category
	public function changeCatId($id = 0, $catId = 0) {
		if(!$id) return 0;
		if($this->update(array('cat_id' => $catId), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change article position
	public function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

	# Clean trash
	public function cleanTrash() {
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$properties = unserialize($result['properties']);
				$avalue = $properties['avatar'];
				if($properties['avatar']) {
					unlink(ROOT_PATH."upload/".$this->store_id."/articles/l_".$properties['avatar']);
					unlink(ROOT_PATH."upload/".$this->store_id."/articles/a_".$properties['avatar']);
				}
				foreach($properties['photos'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/articles/l_".$pvalue);
					unlink(ROOT_PATH."upload/".$this->store_id."/articles/a_".$pvalue);					
				}
				foreach($properties['videos'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/articles/".$pvalue);					
				}
				foreach($properties['files'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/articles/".$pvalue);					
				}
			}
		}	
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
		
	# Return a Article Id from provided ID
	public function getIdFromSlug($slug='') {
		if(!$slug) return 0;
		if($slug = "vn"){
			$result = $this->select('id',"`store_id` = '".$this->store_id."' AND slug = '$slug'");
			if($result) return $result[0]['id'];
		}else{
			$result = $this->select('id',"`store_id` = '".$this->store_id."' AND pro = '$slug'");
			if($result) return $result[0]['id'];
		}
	
		return 0;
	}
	

	# Return a Article Name from provided slug
	public function getNameFromSlug($slug='') {
		if(!$slug) return '';
		$result = $this->select('title',"`store_id` = '".$this->store_id."' AND slug = '$slug'");
		if($result) return $result[0]['title'];
		return '';
	}

	# Return a Article slug from provided ID
	public function getSlugFromId($id='') {
		if(!$id) return '';
		$result = $this->select('slug',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['slug'];
		return '';
	}

	# Return a Article name from provided ID
	public function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('title',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['title'];
		return '';
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

	# Return a Article name from provided ID
	public function getCatIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('cat_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['cat_id'];
		return '';
	}
	public function getCountSubFromId($id='') {
		if(!$id) return '';
		$result = $this->select('COUNT(id)',"`store_id` = '".$this->store_id."' AND `status` ='1' AND `cat_id` = '$id'");
		if($result) return $result[0][0];
		return '';
	}

	public function generateComboListExpert($value='') {
		global $amessages;
		$combo = '';
		$results = $this->select('id,title',"`store_id` = '".$this->store_id."' AND cat_id = '33'");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">".$result['title']."</option>";		
			}
		}
		return $combo;
	}

}
?>