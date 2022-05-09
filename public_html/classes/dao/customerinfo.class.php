<?php
/*************************************************************************
Class Customer
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
class CustomerInfo {
	public $id;			# Primary key
	private $store_id;		# Estore id
	private $area_id;		# Area id
	private $type;			# Type user
	private $username;
	private $password;
	private $fullname;		# Fullname
	private $position;		
	private $company_name;	
	private $company_sapo;		
	private $tax_code;		
	private $address;		# Address
	private $tel;			# Tel
	private $fax;	
	private $email;			# Email
	private $group_id;	
	private $details;	
	private $properties;		# Properties(about, cel)
	private $status;# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	private $date_created;	# Date created
	private $date_updated;
	private $last_login;
	private $bank;
	private $bank_number;
	private $expire;
	private $charge_staff;
	private $credit;
	private $city;
	private $county;
	private $qlykv;
	private $asm;
	

	# Constructor

	function __construct($type, $username, $password, $fullname, $position, $company_name,$company_sapo,$tax_code,$address, $tel, $fax, $email, $group_id, $details, $properties, $status, $date_created,$date_updated, $last_login,$bank,$bank_number,$expire,$charge_staff,$credit,$city,$county,$qlykv,$asm, $area_id=0, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->charge_staff = $charge_staff;
		$this->credit = $credit;
		$this->store_id = $store_id;
		$this->area_id = $area_id;
		$this->type = $type;
		$this->username = trim($username);
		$this->password = $password;
		$this->fullname = $fullname;
		$this->position = $position;
		$this->company_name = $company_name;
		$this->company_sapo = $company_sapo;
		$this->tax_code = $tax_code;
		$this->address = $address;
		$this->tel = $tel;
		$this->fax = $fax;
		$this->email = $email;
		$this->group_id = $group_id;
		$this->details = $details;
		$this->properties = unserialize($properties);
		$this->status = $status;
		$this->date_created = $date_created;
		$this->date_updated = $date_updated;
		$this->last_login = $last_login;
		$this->bank = $bank;
		$this->bank_number = $bank_number;
		$this->expire = $expire;
		$this->city = $city;
		$this->county = $county;
		$this->qlykv = $qlykv;
		$this->asm = $asm;
	}
	public function CustomerInfo($type, $username, $password, $fullname, $position, $company_name,$company_sapo,$tax_code,$address, $tel, $fax, $email, $group_id, $details, $properties, $status, $date_created,$date_updated, $last_login,$bank,$bank_number,$expire,$charge_staff,$credit,$city,$county,$qlykv,$asm, $area_id=0, $store_id = 0, $id = 0)
	{
		$this->__construct($type, $username, $password, $fullname, $position, $company_name,$company_sapo,$tax_code,$address, $tel, $fax, $email, $group_id, $details, $properties, $status, $date_created,$date_updated, $last_login,$bank,$bank_number,$expire,$charge_staff,$credit,$city,$county,$qlykv,$asm, $area_id, $store_id , $id );
	}

	public function getCredit() {
		if($this->credit <0){
			$fixcre = $this->credit * (-1);
			return "(". number_format($fixcre, 0, ".", ".") .")";

		}else{
			return number_format($this->credit, 0, ".", ".");
		}
		
	}	
	public function getAsm() {
		return $this->asm;
	}	
	public function setAsm($nValue) {
		$this->asm=$nValue;
	}
	public function getCredit1() {
		return $this->credit;
	}	
	public function setCredit($nValue) {
		$this->credit=$nValue;
	}
	public function getQlykv() {
		return $this->qlykv;
	}	
	public function setQlykv($nValue) {
		$this->qlykv=$nValue;
	}
	public function getCity() {
		return $this->city;
	}	
	public function setCity($nValue) {
		$this->city=$nValue;
	}
	public function getCounty() {
		return $this->county;
	}	
	public function setCounty($nValue) {
		$this->county=$nValue;
	}
	public function getCompanySapo() {
		return $this->company_sapo;
	}	
	public function setCompanySapo($nValue) {
		$this->company_sapo=$nValue;
	}
	public function getChargeStaff() {
		return $this->charge_staff;
	}	
	public function setChargeStaff($nValue) {
		$this->charge_staff=$nValue;
	}
	public function getExpire() {
		return $this->expire;
	}	
	public function setExpire($nValue) {
		$this->expire=$nValue;
	}
	public function getBank() {
		return $this->bank;
	}	
	public function setBank($nValue) {
		$this->bank=$nValue;
	}
	public function getBankNumber() {
		return $this->bank_number;
	}	
	public function setBankNumber($nValue) {
		$this->bank_number=$nValue;
	}

	public function getTaxCode() {
		return $this->tax_code;
	}	
	public function setTaxCode($nValue) {
		$this->tax_code=$nValue;
	}
	public function getDetails() {
		return $this->details;
	}	
	public function setDetails($nValue) {
		$this->details=$nValue;
	}
	public function getFax() {
		return $this->fax;
	}	
	public function setFax($nValue) {
		$this->fax=$nValue;
	}
	public function getGroupId() {
		return $this->group_id;
	}	
	public function setGroupId($nValue) {
		$this->group_id=$nValue;
	} 
	public function getUserName()
	{
		return $this->username;
	}
	public function setUserName($nValue) {
		$this->username = $nValue;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($nValue) {
		$this->password = $nValue;
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getStoreId() {
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	public function getAreaId() {
		return $this->area_id;
	}
	public function setAreaId($nValue) {
		$this->area_id=$nValue;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($nValue) {
		$this->type=$nValue;
	}
	public function getPosition() {
		return $this->position;		
	}
	public function setPosition($nValue) {
		$this->position=$nValue;
	}
	public function getCompanyName() {
		return $this->company_name;		
	}
	public function setCompanyName($nValue) {
		$this->company_name=$nValue;
	}
	public function getFullName() {
		return $this->fullname;		
	}
	public function setFullName($nValue) {
		$this->fullname=$nValue;
	}
	public function getAddress() {
		return $this->address;		
	}
	public function setAddress($nValue) {
		$this->address=$nValue;
	}
	public function getEmail() {
		return $this->email;		
	}
	public function setEmail($nValue) {
		$this->email=$nValue;
	}
	public function getTel() {
		return $this->tel;		
	}
	public function setTel($nValue) {
		$this->tel=$nValue;
	}
	
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}
	
	public function getProperty($key)
	{
		if(isset($this->properties[$key])) return $this->properties[$key];
		return '';
	}
	public function setProperty($key,$nValue)
	{
		$this->properties[$key]=$nValue;
	}
	
	public function getProperties()
	{
		return $this->properties;
	}
	public function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	public function getPermissions() {
		return $this->getProperty('permissions');
	}
	public function getPermission($act='',$mod='') {
		if($act == '' || $mod == '') return 0;
		$permissions = $this->getPermissions();
		if(isset($permissions[$act][$mod])) return $permissions[$act][$mod];
		return 0;
	}
	public function checkPermission($act='',$mod='',$allow_admin = 1) {
		if($this->isSiteFounder()) return 1;
		if($allow_admin && $this->isSiteAdmin()) return 1;
		$permissions = $this->getPermissions();
		if(isset($permissions[$act][$mod]) && $permissions[$act][$mod] == 1) return 1;
		header("location: /admin.php?op=accessdenied");
		exit;
	}
	function getAllCustomerFromUserid($aId) {
		$results = $this->select("id", "`details` = '$aId'");
		if($results) {
			$categoryInfos = array();
			foreach($results as $key => $result) {
				$a= $result['id'];
				$categoryInfos[]=$result['id'];
			$results1 = $this->select("id", " `details` = '$a'");	
			foreach($results1 as $key => $result_1) {
					$b = $result_1['id'];
					$categoryInfos[]=$result_1['id'];
					$results2 = $this->select("id", " `details` = '$b'");					
			foreach($results2 as $key => $result_2) {
				$c = $result_2['id'];
				$categoryInfos[]=$result_2['id'];
					$results3 = $this->select("id", " `details` = '$c'");
			foreach($results3 as $key => $result_3) {
					$d=$result_3['id'];
					$categoryInfos[]=$result_3['id'];
				
			}
			}		
			}
			}
			if($aId){
			return implode(",",$categoryInfos).",$aId";
			}else{
				return implode(",",$categoryInfos);
			}
			
		}
		return($aId);
	}
	
}	
?>