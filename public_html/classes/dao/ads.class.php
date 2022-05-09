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
include_once(ROOT_PATH.'classes/dao/adsinfo.class.php');

class Ads extends Model {
	public $table;
	public $_db;
	public $store_id;
	
	public function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."ads";	
		$this->store_id = $store_id;
	}
	public function Ads($store_id = 0, $database = '') {
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
			$ads = new AdsInfo( $result[0]['tid'],
								$result[0]['logo_url'],
								$result[0]['url'],
								$result[0]['status'],
								$result[0]['position'],
								$result[0]['viewed'],
								$result[0]['date_created'],
								$result[0]['properties'],
								$result[0]['content'],
								$result[0]['gid'],
								$result[0]['store_id'],
								$value
								);
			return $ads;
		}
		return '';
	}
	
	public function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page - 1) * $items_per_page;
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND ($condition)", $sort, $start, $items_per_page);
		if($results) {
			$adsInfos = array();
			foreach($results as $key => $result) {
				$adsInfos[] = new AdsInfo (	$result['tid'],
											$result['logo_url'],
											$result['url'],
											$result['status'],
											$result['position'], 
											$result['viewed'],
											$result['date_created'],
											$result['properties'],
											$result['content'],
											$result['gid'],
											$result['store_id'],
											$result['id']
										);
			}
			return $adsInfos;		
		}
		return '';
	}
		//random theo gid
		public function Random($gid='0') {
			$results = $this->select('*',"`store_id` = '".$this->store_id."'AND`status`='1' AND `gid` = $gid  ORDER BY RAND() LIMIT 4");
			if($results) {
				$objects = array();
				foreach($results as $key => $result) {
					$objects[] = new AdsInfo
									(		
										$result['tid'],
										$result['logo_url'],
										$result['url'],
										$result['status'],
										$result['position'], 
										$result['viewed'],
										$result['date_created'],
										$result['properties'],
										$result['content'],
										$result['gid'],
										$result['store_id'],
										$result['id']
									);
				}
				return $objects;
				
			}
			return 0;
		}
/*-----------------------------------------------------------------------*
* Function: getAdsFromGId
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	
	public function getAdsFromGId($store_id, $gId) {
		$results = $this->select('*', "`store_id` = '$store_id' AND status = 1 and gid = $gId", array('position'=>'ASC'));
		if($results) {
			$adsInfos = array();
			foreach($results as $key => $result) {
				$adsInfos[] = new AdsInfo ( $result['logo_url'],
											$result['url'],
											$result['status'],
											$result['position'], 
											$result['viewed'],
											$result['date_created'],
											$result['properties'],
											$result['content'],
											$result['gid'],
											$result['store_id'],
											$result['id']
										);
			}
			return $adsInfos;		
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
	public function changeCatId($id = 0, $gId = 0) {
		if(!$id) return 0;
		if($this->update(array('gid' => $gId), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change ads position
	public function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

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
		
/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	public function checkDuplicate($value = '', $key = 'id', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
}
?>