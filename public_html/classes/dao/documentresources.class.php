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
include_once(ROOT_PATH.'classes/dao/model.class.php');
include_once(ROOT_PATH.'classes/dao/documentresourceinfo.class.php');

class DocumentResources extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."document_resource";	
		$this->store_id = $store_id;
	}
	function DocumentResources($store_id = 0, $database = '') {
		$this->__construct($store_id, $database);
	}


/*-----------------------------------------------------------------------*
* Function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*', "`store_id` = '".$this->store_id."' AND `$key` = '$value' AND ($condition)");
		if($result) {
			$ads = new DocumentResourceInfo( $result[0]['name'],
											$result[0]['code'],
											$result[0]['agency'],
											$result[0]['logo_url'],
											$result[0]['url'],
											$result[0]['status'],
											$result[0]['position'],
											$result[0]['viewed'],
											$result[0]['date_created'],
											$result[0]['date_ussed'],
											$result[0]['properties'],
											$result[0]['content'],
											$result[0]['content_brief'],
											$result[0]['content_compare'],
											$result[0]['gid'],
											$result[0]['user_id'],
											$result[0]['store_id'],
											$value
											);
			return $ads;
		}
		return '';
	}
	
	function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page - 1) * $items_per_page;
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND ($condition)", $sort, $start, $items_per_page);
		if($results) {
			$adsInfos = array();
			foreach($results as $key => $result) {
				$adsInfos[] = new DocumentResourceInfo (	$result['name'],
															$result['code'],
															$result['agency'],
															$result['logo_url'],
															$result['url'],
															$result['status'],
															$result['position'], 
															$result['viewed'],
															$result['date_created'],
															$result['date_ussed'],
															$result['properties'],
															$result['content'],
															$result['content_brief'],
															$result['content_compare'],
															$result['gid'],
															$result['user_id'],
															$result['store_id'],
															$result['id']
														);
			}
			return $adsInfos;		
		}
		return '';
	}
/*-----------------------------------------------------------------------*
* Function: getAdsFromGId
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	
	function getAdsFromGId($store_id, $gId) {
		$results = $this->select('*', "`store_id` = '$store_id' AND status = 1 and gid = $gId", array('position'=>'ASC'));
		if($results) {
			$adsInfos = array();
			foreach($results as $key => $result) {
				$adsInfos[] = new DocumentResourceInfo ( $result['name'],
														$result['code'],
														$result['agency'],
														$result['logo_url'],
														$result['url'],
														$result['status'],
														$result['position'], 
														$result['viewed'],
														$result['date_created'],
														$result['date_ussed'],
														$result['properties'],
														$result['content'],
														$result['content_brief'],
														$result['content_compare'],
														$result['gid'],
														$result['user_id'],
														$result['store_id'],
														$result['id']
													);
			}
			return $adsInfos;		
		}
		return '';
	}
	
# Check news resource 
	function getNewResources($store_id, $listGid = 0) {
		$results = $this->select('*', "`store_id` = '$store_id' AND `status` = 1 and `gid` in ($listGid)", array('date_created'=>'DESC'), 10);
		if($results) {
			$adsInfos = array();
			foreach($results as $key => $result) {
				$adsInfos[] = new DocumentResourceInfo ( $result['name'],
														$result['code'],
														$result['agency'],
														$result['logo_url'],
														$result['url'],
														$result['status'],
														$result['position'], 
														$result['viewed'],
														$result['date_created'],
														$result['date_ussed'],
														$result['properties'],
														$result['content'],
														$result['content_brief'],
														$result['content_compare'],
														$result['gid'],
														$result['user_id'],
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
	# Change ads category
	function changeCatId($id = 0, $gId = 0) {
		if(!$id) return 0;
		if($this->update(array('gid' => $gId), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change ads position
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

	# Clean trash
	function cleanTrash() {
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
	function checkDuplicate($value = '', $key = 'id', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
}
?>