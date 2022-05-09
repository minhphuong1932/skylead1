<?php
/*************************************************************************
Class Users
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com
Author: Mai Minh
Last updated: 06/19/2010
**************************************************************************/
/* Edit log:
- 30/09/2009 08:00 - Mai Minh: Initialize
*/

include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/userinfo.class.php");

class Users extends Model {
	public $table;
	public $_db;
	private $store_id;
	
	public function __construct($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."users";
		$this->store_id = $store_id;
	}	
	public function Users($store_id = 0, $database = '') {
		$this->__construct($store_id, $database);
	}	
/* Common methods
/*-----------------------------------------------------------------------*
* public function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	public function getObject($value = '0', $key = 'id') {
		if(!$key || !$value) return '';
		$result = $this->select('*',"`store_id` = '".$this->store_id."' AND `$key` = '$value'");
		if($result) {
			$object = new UserInfo
						(	$result[0]['store_id'],
							$result[0]['customer_id'],
							$result[0]['id_gioithieu'],
							$result[0]['id_target'],
						 	$result[0]['username'],
							$result[0]['password'],
							$result[0]['email'],
							$result[0]['fullname'],
							$result[0]['address'],
							$result[0]['tel'],
							$result[0]['cell'],
							$result[0]['id_NV'],
						 	$result[0]['date_joining'],
							$result[0]['date_leaving'],
							$result[0]['date_birth'],
							$result[0]['gender'],
							$result[0]['height'],
							$result[0]['weight'],
							$result[0]['address_tt'],
							$result[0]['tinhthanh_tt'],
							$result[0]['quanhuyen_tt'],
							$result[0]['address_lh'],
							$result[0]['tinhthanh_lh'],
							$result[0]['quanhuyen_lh'],
							$result[0]['CMND'],
							$result[0]['date_cap'],
							$result[0]['noi_cap'],
							$result[0]['contact_person'],
							$result[0]['contact_relationship'],
							$result[0]['contact_phone'],
							$result[0]['type_marry'],
							$result[0]['name_vochong'],
							$result[0]['trinhdoVH'],
							$result[0]['tdvhkhac'],
							$result[0]['cuu_quannhan'],
							$result[0]['kinhnghiem'],
							$result[0]['baohiem'],
							$result[0]['luong_BH'],
							$result[0]['luongcd_BH'],
							$result[0]['BHYT'],
							$result[0]['BHXH'],
							$result[0]['BHTN'],
							$result[0]['thue_TNCN'],
							$result[0]['luong_TNCN'],
							$result[0]['nguoidongthue'],
							$result[0]['luongcd_TNCN'],
							$result[0]['STK'],
							$result[0]['name_tk'],
							$result[0]['name_ngh'],
							$result[0]['chinhanh'],
							$result[0]['ngoaingu'],
							$result[0]['type'],
							$result[0]['date_created'],
							$result[0]['last_login'],
							$result[0]['status'],
							$result[0]['real_employee'],
							$result[0]['properties'],
							$result[0]['dantoc'],
							$result[0]['tongiao'],
							$result[0]['doanvien'],
							$result[0]['dangvien'],
							$result[0]['thigiac'],
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
	public function getObjects($page = 1, $condition = '`id` = 0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*',"`store_id` = '".$this->store_id."' AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new UserInfo
						(	$result['store_id'],
							$result['customer_id'],
							$result['id_gioithieu'],
							$result['id_target'],
						 	$result['username'],
							$result['password'],
							$result['email'],
							$result['fullname'],
							$result['address'],
							$result['tel'],
							$result['cell'],
							$result['id_NV'],
						 	$result['date_joining'],
							$result['date_leaving'],
							$result['date_birth'],
							$result['gender'],
							$result['height'],
							$result['weight'],
							$result['address_tt'],
							$result['tinhthanh_tt'],
							$result['quanhuyen_tt'],
							$result['address_lh'],
							$result['tinhthanh_lh'],
							$result['quanhuyen_lh'],
							$result['CMND'],
							$result['date_cap'],
							$result['noi_cap'],
							$result['contact_person'],
							$result['contact_relationship'],
							$result['contact_phone'],
							$result['type_marry'],
							$result['name_vochong'],
							$result['trinhdoVH'],
							$result['tdvhkhac'],
							$result['cuu_quannhan'],
							$result['kinhnghiem'],
							$result['baohiem'],
							$result['luong_BH'],
							$result['luongcd_BH'],
							$result['BHYT'],
							$result['BHXH'],
							$result['BHTN'],
							$result['thue_TNCN'],
							$result['luong_TNCN'],
							$result['nguoidongthue'],
							$result['luongcd_TNCN'],
							$result['STK'],
							$result['name_tk'],
							$result['name_ngh'],
							$result['chinhanh'],
							$result['ngoaingu'],
							$result['type'],
							$result['date_created'],
							$result['last_login'],
							$result['status'],
							$result['real_employee'],
							$result['properties'],
							$result['dantoc'],
							$result['tongiao'],
							$result['doanvien'],
							$result['dangvien'],
							$result['thigiac'],
							$result['id']
								);
			}
			return $objects;
		}
		return 0;
	}
/*-----------------------------------------------------------------------*
* public function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	public function checkDuplicate($value = '', $key = 'username', $condition = '') {
		$value = str_replace(" ",'',$value);
		$value = str_replace("\\",'',$value);
		$value = str_replace("\"",'',$value);
		$value = str_replace("'",'',$value);
		$result = $this->select("`$key`",($this->store_id?"`store_id` = '".$this->store_id."' AND ":'')."`$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}	
/*-----------------------------------------------------------------------*
* public function: addData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	public function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result)
			return $result;
		return 0;
	}	
/*-----------------------------------------------------------------------*
* public function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	public function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`store_id` = '".$this->store_id."' AND `$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}
	public function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	public function changeType($id = 0, $type = '') {
		if(!$id) return 0;
		if($this->update(array('type' => $type), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	public function cleanTrash() {
		$result = $this->delete('status = '.S_DELETED);
		if($result) return 1;
		return 0;
	}

/* Special methods	
/*-----------------------------------------------------------------------*
* public function: change password
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	
	public function changePassword($id = 0, $password = '') {
		if(!$id) return 0;
		if($this->update(array('`password`' => $password), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	
	public function getUserId($condition = '1=1') {
		$result = $this->select('`id`',"`store_id` = '".$this->store_id."' AND $condition");
		if($result) return $result[0]['id'];
		return 0;
	}
	
	public function getUserType($condition = '1=1') {
		$result = $this->select('`type`',"`store_id` = '".$this->store_id."' AND $condition");
		if($result) return $result[0]['type'];
		return 0;
	}
	public function getIdFromUserName($username='') {
		if(!$username) return '';
		$result = $this->select('id',"`store_id` = '".$this->store_id."' AND `username` = '$username'");
		if($result) return $result[0]['id'];
		return '';
	}
	public function getUsername($condition = '1=1') {
		$result = $this->select('`username`',"`store_id` = '".$this->store_id."' AND $condition");
		if($result) return $result[0]['username'];
		return '';
	}
	
	public function getFullNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('fullname',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['fullname'];
		return '';
	}
	public function getUserNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('username',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['username'];
		return '';
	}
	function getidNVFromId($id='') {
		if(!$id) return '';
		$result = $this->select('id_NV',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['id_NV'];
		return '';
	}
	function getTypeFromId($id='') {
		if(!$id) return '';
		$result = $this->select('type',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['type'];
		return '';
	}
	public function getTypeTextBackendFromId($id='') {
		global $amessages;
		if(!$id) return '';
		$result = $this->select('type',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result){
			$typeuser = $result[0]['type'];
			return $amessages['type_user'][$typeuser];
		}else{
			return '';
		}
	}
	function getDateBirthFromId($id='') {
		if(!$id) return '';
		$result = $this->select('date_birth',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['date_birth'];
		return '';
	}
	function getCMNDFromId($id='') {
		if(!$id) return '';
		$result = $this->select('CMND',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['CMND'];
		return '';
	}
	function getAddressTtFromId($id='') {
		if(!$id) return '';
		$result = $this->select('address_tt',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['address_tt'];
		return '';
	}

	function getSTKFromId($id='') {
		if(!$id) return '';
		$result = $this->select('STK',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['STK'];
		return '';
	}

	function getTelFromId($id='') {
		if(!$id) return '';
		$result = $this->select('tel',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['tel'];
		return '';
	}
	public function getPropertyFromId($key,$id='')
	{
		if(!$id) return '';
		$result = $this->select('properties',"`store_id` = '".$this->store_id."' AND id = '$id'");
		$result_key = unserialize($result[0][0])[$key] ;
		if($result) return $result_key;
		return '';
	}
	
	public function generateCombo($value='',$noroot = 0) {
		global $amessages;
		$combo = '';
		if(!$noroot) $combo = '<option value="0"'.($value=='0'?" selected":"").'>'.$amessages['root'].'</option>';
		$results = $this->select('id,fullname,type',"1>0 AND (type = 1)");
		
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">&nbsp;&nbsp;&nbsp;l--".$result['fullname']."(".$result['type'].")"."</option>";	
				$s1results = $this->select('id,fullname,type',"status = 1");
					
			}
		}
		return $combo;
	}
	public function authenticateUser($username,$password) {
		if(!$username || !$password) return 0;
		$username = str_replace(" ",'',$username);
		$username = str_replace("\\",'',$username);
		$username = str_replace("\"",'',$username);
		$username = str_replace("'",'',$username);	
		$password = md5($password);
		$result = $this->select('`id`,`status`',"`store_id` = '".$this->store_id."' AND `username` = '$username' AND `password` = '$password'");# AND `status` = 1");
		if($result) { # User o trang thai kich hoat, cho phep dang nhap
			if($result[0]['status'] == 1) {
				$last_login = array('last_login'=>date("Y-m-d H:i:s"));
				$this->update($last_login,"`id`='".$result[0]['id']."'");
				return $result[0]['id'];
			} else return '-1';
		}
		return 0;
	}
	
	public function authenticateUserAdmin($username,$password) {
		if(!$username || !$password) return 0;
		$username = str_replace(" ",'',$username);
		$username = str_replace("\\",'',$username);
		$username = str_replace("\"",'',$username);
		$username = str_replace("'",'',$username);
		$password = md5($password);
		$result = $this->select('`id`',"`store_id` = '".$this->store_id."' AND `username` = '$username' AND `password` = '$password' AND type >= '".U_MERCHANT."'");
		if($result) {
			$last_login = array('last_login'=>date("Y-m-d H:i:s"));
			$this->update($last_login,"`id`='".$result[0]['id']."'");
			return $result[0]['id'];
		}
		return 0;
	}
	
	public function authenticateUserAdminCP($username,$password) {
		if(!$username || !$password) return 0;
		$username = str_replace(" ",'',$username);
		$username = str_replace("\\",'',$username);
		$username = str_replace("\"",'',$username);
		$username = str_replace("'",'',$username);
		$password = md5($password);
		$result = $this->select('`id`',"`store_id` = '".$this->store_id."' AND `username` = '$username' AND `password` = '$password' AND type >= '".U_BIDO_SALE."'");
		if($result) {
			$last_login = array('last_login'=>date("Y-m-d H:i:s"));
			$this->update($last_login,"`id`='".$result[0]['id']."'");
			return $result[0]['id'];
		}
		return 0;
	}

	function generateHCNSCombo($value='') {
		global $amessages;
		$combo = '';
		$results = $this->select('id,username, fullname',"`store_id` = '".$this->store_id."' AND type='2' AND status='1'");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($value==$result['id']?" selected":"").">".$result['username']." - ".$result['fullname']."</option>";	
			}
		}
		return $combo;
	}
}
?>