<?php
/*************************************************************************
Class Information
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                   
Last updated: 18/09/2011
**************************************************************************/	
include_once(ROOT_PATH.'classes/database/model.class.php');
include_once(ROOT_PATH.'classes/dao/informationinfo.class.php');

class Information extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0,$database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
			
		} else $this->_db = $database;
		
		$this->table = DB_PREFIX."information";
		$this->store_id = $store_id;
	}
	public function Information($store_id = 0,$database = '') {
		$this->__construct($store_id,$database);
	}

/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	public function getObject($value = '0', $key = 'id', $condition = '1>0') {
		$result = $this->select('*',"(`store_id` = '".$this->store_id."' or `store_id`=0) AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new InformationInfo(
									$result[0]['store_id'],
									$result[0]['status'],
									$result[0]['date_created'],
									$result[0]['properties'],
									$result[0]['name'],
									$result[0]['phone'],
									$result[0]['email'],
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
	public function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "(`store_id` = '".$this->store_id."' or `store_id`=0) AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new InformationInfo(
                                $result['store_id'],
                                $result['status'],
                                $result['date_created'],
                                $result['properties'],
                                $result['name'],
                                $result['phone'],
                                $result['email'],
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
	
	public function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result) return $result;
		return 0;
	}
/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*-----------------------------------------------------------------------*/	
	public function updateData($object, $value = '', $key = 'id') {
			 $this->update($object,"(`store_id` = '".$this->store_id."' or `store_id`=0)  AND `$key` = '$value'");
	}
	
	# Change status
	public function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}

	# Clean trash
	public function cleanTrash() {
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	

	public function generateCombo($value='',$noroot = 0) {
		global $amessages;
		$combo = '';
		if(!$noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['root'].'</option>';
		$results = $this->select('id,name',"1>0");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">&nbsp;&nbsp;&nbsp;l--".$result['name']."</option>";	
				$s1results = $this->select('id,name',"1>0");
					
			}
		}
		return $combo;
	}
	
	# Return a AdsCategory name from provided ID
	public function getNameFromId($id='0') {
		global $amessages;
		if(!$id) return $amessages['root'];
		$result = $this->select('name'," id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	
	public function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}

	public function getIdFromPassWordAndName($password='',$username='') {
		$result = $this->select('id'," `password` = '$password' AND `username` = '$username'");
		if($result) return $result[0]['id'];
		return '';
	}
	public function getIdFormCustomerId($idcustomer='') {
		$result = $this->select('id'," `customer_id` = '$idcustomer' ");
		if($result) return $result[0]['id'];
		return '';
	}

	public function convertUserName($str='')
	{
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		return $str;
	}
	// function getSumFriend($id='') {
	// 	if(!$id) return '';
    //     $result = $this->select('COUNT('.$id.')', "`store_id` = '".$this->store_id."' AND `id` = '".$id."' AND `status` = '1' ");
    //     if($result){
    //     	return $result[0][0];
    //     }
    //     return 0;
    // }
}
?>