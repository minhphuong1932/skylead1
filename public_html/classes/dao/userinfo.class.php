<?php
/*************************************************************************
Class User Info
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Author: Mai Minh
Email: info@derasoft.com                                    
Last updated: 29/09/2009
**************************************************************************/
class UserInfo {
	public  $id;
	private $store_id;
	private $customer_id;
	private $id_gioithieu;
	private $id_target;
	private $username;
	private $password;
	private $fullname;
	private $email;
	private $address;
	private $tel;
	private $cell;
	private $id_NV;
	private $date_joining;
	private $date_leaving;
	private $date_birth;
	private $gender;
	private $height;
	private $weight;
	private $address_tt;
	private $tinhthanh_tt;
	private $quanhuyen_tt;
	private $address_lh;
	private $tinhthanh_lh;
	private $quanhuyen_lh;
	private $CMND;
	private $date_cap;
	private $noi_cap;
	private $contact_person;
	private $contact_relationship;
	private $contact_phone;
	private $type_marry;
	private $name_vochong;
	private $trinhdoVH;
	private $tdvhkhac;
	private $cuu_quannhan;
	private $kinhnghiem;
	private $baohiem;
	private $luong_BH;
	private $luongcd_BH;
	private $BHYT;
	private $BHXH;
	private $BHTN;
	private $thue_TNCN;
	private $luong_TNCN;
	private $nguoidongthue;
	private $luongcd_TNCN;
	private $STK;
	private $name_tk;
	private $name_ngh;
	private $chinhanh;
	private $ngoaingu;
	private $type; # 1-Store staff, 2-Store admin, 3-Store boss, 7-Site staff, 8-Site admin, 9-Site boss
	private $date_created;
	private $last_login;
	private $status;
	private $real_employee;
	private $properties;
	private $dantoc;
	private $tongiao;
	private $doanvien;
	private $dangvien;
	private $thigiac;

	function __construct($store_id, $customer_id, $id_gioithieu, $id_target, $username, $password, $email, $fullname, $address, $tel, $cell, $id_NV, $date_joining, $date_leaving, $date_birth, $gender, $height, $weight, $address_tt, $tinhthanh_tt, $quanhuyen_tt, $address_lh, $tinhthanh_lh, $quanhuyen_lh, $CMND, $date_cap, $noi_cap, $contact_person, $contact_relationship, $contact_phone, $type_marry, $name_vochong, $trinhdoVH, $tdvhkhac, $cuu_quannhan, $kinhnghiem, $baohiem, $luong_BH, $luongcd_BH, $BHYT, $BHXH, $BHTN, $thue_TNCN, $luong_TNCN, $nguoidongthue, $luongcd_TNCN, $STK, $name_tk, $name_ngh, $chinhanh, $ngoaingu, $type, $date_created, $last_login, $status, $real_employee, $properties = '', $dantoc, $tongiao, $doanvien, $dangvien, $thigiac, $id = 0 )
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->customer_id = $customer_id;
		$this->id_gioithieu = $id_gioithieu;
		$this->id_target = $id_target;
		$this->username = trim($username);
		$this->password = $password;
		$this->email = stripslashes(htmlspecialchars($email));	
		$this->fullname = stripslashes(htmlspecialchars($fullname));
		$this->address= stripslashes(htmlspecialchars($address));
		$this->tel = stripslashes(htmlspecialchars($tel));
		$this->cell = stripslashes(htmlspecialchars($cell));
	    $this->id_NV = $id_NV;
	    $this->date_joining = $date_joining;
	    $this->date_leaving = $date_leaving;
	    $this->date_birth = $date_birth;
	    $this->gender = $gender;
	    $this->height = $height;
	    $this->weight = $weight;
	    $this->address_tt = $address_tt;
	    $this->tinhthanh_tt =$tinhthanh_tt;
	    $this->quanhuyen_tt =$quanhuyen_tt;
	    $this->address_lh = $address_lh;
	    $this->tinhthanh_lh =$tinhthanh_lh;
	    $this->quanhuyen_lh =$quanhuyen_lh;
	    $this->CMND = $CMND;
	    $this->date_cap = $date_cap;
		$this->noi_cap = $noi_cap;
		$this->contact_person = $contact_person;
		$this->contact_relationship = $contact_relationship;
		$this->contact_phone = $contact_phone;
		$this->type_marry = $type_marry;
		$this->name_vochong = $name_vochong;
		$this->trinhdoVH = $trinhdoVH;
		$this->tdvhkhac = $tdvhkhac;
		$this->cuu_quannhan = $cuu_quannhan;
		$this->kinhnghiem = $kinhnghiem;
		$this->baohiem = $baohiem;
		$this->luong_BH = $luong_BH;
		$this->luongcd_BH = $luongcd_BH;
		$this->BHYT = $BHYT;
		$this->BHXH = $BHXH;
		$this->BHTN = $BHTN;
		$this->thue_TNCN = $thue_TNCN;
		$this->luong_TNCN = $luong_TNCN;
		$this->nguoidongthue = $nguoidongthue;
		$this->luongcd_TNCN = $luongcd_TNCN;
		$this->STK = $STK;
		$this->name_tk = $name_tk;
		$this->name_ngh = $name_ngh;
		$this->chinhanh = $chinhanh;
		$this->ngoaingu = $ngoaingu;
		$this->type = $type;
		$this->date_created = $date_created;
		$this->last_login = $last_login;
		$this->status = $status;
		$this->real_employee = $real_employee;
		$this->properties = unserialize($properties);
		$this->dantoc = $dantoc;
		$this->tongiao = $tongiao;
		$this->doanvien = $doanvien;
		$this->dangvien = $dangvien;
		$this->thigiac = $thigiac;
	}

	public function UserInfo($store_id, $customer_id, $id_gioithieu, $id_target, $username, $password, $email, $fullname, $address, $tel, $cell, $id_NV, $date_joining, $date_leaving, $date_birth, $gender, $height, $weight, $address_tt, $tinhthanh_tt, $quanhuyen_tt, $address_lh, $tinhthanh_lh, $quanhuyen_lh, $CMND, $date_cap, $noi_cap, $contact_person, $contact_relationship, $contact_phone, $type_marry, $name_vochong, $trinhdoVH, $tdvhkhac, $cuu_quannhan, $kinhnghiem, $baohiem, $luong_BH, $luongcd_BH, $BHYT, $BHXH, $BHTN, $thue_TNCN, $luong_TNCN, $nguoidongthue, $luongcd_TNCN, $STK, $name_tk, $name_ngh, $chinhanh, $ngoaingu, $type, $date_created, $last_login, $status, $real_employee, $properties = '', $dantoc, $tongiao, $doanvien, $dangvien, $thigiac, $id = 0 )
	{
		$this->__construct($store_id, $customer_id, $id_gioithieu, $id_target, $username, $password, $email, $fullname, $address, $tel, $cell, $id_NV, $date_joining, $date_leaving, $date_birth, $gender, $height, $weight, $address_tt, $tinhthanh_tt, $quanhuyen_tt, $address_lh, $tinhthanh_lh, $quanhuyen_lh, $CMND, $date_cap, $noi_cap, $contact_person, $contact_relationship, $contact_phone, $type_marry, $name_vochong, $trinhdoVH, $tdvhkhac, $cuu_quannhan, $kinhnghiem, $baohiem, $luong_BH, $luongcd_BH, $BHYT, $BHXH, $BHTN, $thue_TNCN, $luong_TNCN, $nguoidongthue, $luongcd_TNCN, $STK, $name_tk, $name_ngh, $chinhanh, $ngoaingu, $type, $date_created, $last_login, $status, $real_employee, $properties, $dantoc, $tongiao, $doanvien, $dangvien, $thigiac, $id);
	}

	public function getIdGioithieu()
	{
		return $this->id_gioithieu;
	}
	public function setIdGioithieu($nValue) {
		$this->id_gioithieu = $nValue;
	}
	public function getIdTarget()
	{
		return $this->id_target;
	}
	public function setIdTarget($nValue) {
		$this->id_target = $nValue;
	}
	public function getSTK()
	{
		return $this->STK;
	}
	public function setSTK($nValue) {
		$this->STK = $nValue;
	}
	public function getNameTK()
	{
		return $this->name_tk;
	}
	public function setNameTK($nValue) {
		$this->name_tk = $nValue;
	}
	public function getNameNGH()
	{
		return $this->name_ngh;
	}
	public function setNameNGH($nValue) {
		$this->name_ngh = $nValue;
	}
	public function getChinhanh()
	{
		return $this->chinhanh;
	}
	public function setChinhanh($nValue) {
		$this->chinhanh = $nValue;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($nValue) {
		$this->id = $nValue;
	}
	public function getStoreid()
	{
		return $this->store_id;
	}
	public function setStoreid($nValue) {
		$this->store_id = $nValue;
	}
	public function getCustomerId()
	{
		return $this->customer_id;
	}
	public function setCustomerId($nValue) {
		$this->customer_id = $nValue;
	}
	public function getUserName()
	{
		return $this->username;
	}
	public function setUserName($nValue) {
		$this->username = $nValue;
	}
	public function getNguoidongthue()
	{
		return $this->nguoidongthue;
	}
	public function setNguoidongthue($nValue) {
		$this->nguoidongthue = $nValue;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($nValue) {
		$this->password = $nValue;
	}
	public function getType()
	{
		return $this->type;
	}
	public function setType($nValue) 
	{
		$this->type = $nValue;
	}
	public function getFullName()
	{
	  return $this->fullname;
	}
	public function setFullName($nValue) {
		$this->fullname = $Value;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($nValue)
	{
		$this->email = $nValue;
	}
	public function getAddress() 
	{
		return $this->address;
	}
	public function setAddress($nValue) {
		$this->address = $nValue;
	}
	public function getTel() 
	{
		return $this->tel;
	}
	public function setTel($nValue) 
	{
		$this->tel = $nValue;
	}
	public function getCell() 
	{
		return $this->cell;
	}
	public function setCell($nValue) 
	{
		$this->cell = $nValue;
	}
	public function getidNV() 
	{
		return $this->id_NV;
	}
	public function setidNV($nValue) 
	{
		$this->id_NV = $nValue;
	}
	public function getDateJoining()
	{
		return $this->date_joining;
	}
	public function setDateJoining($nValue) 
	{
		$this->date_joining = $nValue;
	}
	public function getDateLeaving()
	{
		return $this->date_leaving;
	}
	public function setDateLeaving($nValue) 
	{
		$this->date_leaving = $nValue;
	}
	public function getDateBirth()
	{
		return $this->date_birth;
	}
	public function setDateBirth($nValue) 
	{
		$this->date_birth = $nValue;
	}
	public function getGender()
	{
		return $this->gender;
	}
	public function setGender($nValue) 
	{
		$this->gender = $nValue;
	}
	public function getHeight()
	{
		return $this->height;
	}
	public function setHeight($nValue) 
	{
		$this->height = $nValue;
	}
	public function getWeight()
	{
		return $this->weight;
	}
	public function setWeight($nValue) 
	{
		$this->weight = $nValue;
	}
	public function getAddressTT()
	{
		return $this->address_tt;
	}
	public function setAddressTT($nValue) 
	{
		$this->address_tt = $nValue;
	}
	public function getTinhthanhTT()
	{
		return $this->tinhthanh_tt;
	}
	public function setTinhthanhTT($nValue) 
	{
		$this->tinhthanh_tt = $nValue;
	}
	public function getQuanhuyenTT()
	{
		return $this->quanhuyen_tt;
	}
	public function setQuanhuyenTT($nValue) 
	{
		$this->quanhuyen_tt = $nValue;
	}
	public function getAddressLH()
	{
		return $this->address_lh;
	}
	public function setAddressLH($nValue) 
	{
		$this->address_lh = $nValue;
	}
	public function getTinhthanhLH()
	{
		return $this->tinhthanh_lh;
	}
	public function setTinhthanhLH($nValue) 
	{
		$this->tinhthanh_lh = $nValue;
	}
	public function getQuanhuyenLH()
	{
		return $this->quanhuyen_lh;
	}
	public function setQuanhuyenLH($nValue) 
	{
		$this->quanhuyen_lh = $nValue;
	}
	public function getCMND()
	{
		return $this->CMND;
	}
	public function setCMND($nValue) 
	{
		$this->CMND = $nValue;
	}
	public function getDatecap()
	{
		return $this->date_cap;
	}
	public function setDatecap($nValue) 
	{
		$this->date_cap = $nValue;
	}
	public function getNoicap()
	{
		return $this->noi_cap;
	}
	public function setNoicap($nValue) 
	{
		$this->noi_cap = $nValue;
	}
	public function getContactPerson()
	{
		return $this->contact_person;
	}
	public function setContactPerson($nValue) 
	{
		$this->contact_person = $nValue;
	}
	public function getContactRelationship()
	{
		return $this->contact_relationship;
	}
	public function setContactRelationship($nValue) 
	{
		$this->contact_relationship = $nValue;
	}
	public function getContactPhone()
	{
		return $this->contact_phone;
	}
	public function setContactPhone($nValue) 
	{
		$this->contact_phone = $nValue;
	}
	public function getTypeMarry()
	{
		return $this->type_marry;
	}
	public function setTypeMarry($nValue) 
	{
		$this->type_marry = $nValue;
	}
	public function getNameVochong()
	{
		return $this->name_vochong;
	}
	public function setNameVochong($nValue) 
	{
		$this->name_vochong = $nValue;
	}
	public function getTrinhdoVH()
	{
		return $this->trinhdoVH;
	}
	public function setTrinhdoVH($nValue) 
	{
		$this->trinhdoVH = $nValue;
	}
	public function getTdvhkhac()
	{
		return $this->tdvhkhac;
	}
	public function setTdvhkhac($nValue) 
	{
		$this->tdvhkhac = $nValue;
	}
	public function getCuuQuanNhan()
	{
		return $this->cuu_quannhan;
	}
	public function setCuuQuanNhan($nValue) 
	{
		$this->cuu_quannhan = $nValue;
	}
	public function getKinhnghiem()
	{
		return $this->kinhnghiem;
	}
	public function setKinhnghiem($nValue) 
	{
		$this->kinhnghiem = $nValue;
	}
	public function getBaohiem()
	{
		return $this->baohiem;
	}
	public function setBaohiem($nValue) 
	{
		$this->baohiem = $nValue;
	}
	public function getLuongBH()
	{
		return $this->luong_BH;
	}
	public function setLuongBH($nValue) 
	{
		$this->luong_BH = $nValue;
	}
	public function getLuongcdBH()
	{
		return $this->luongcd_BH;
	}
	public function setLuongcdBH($nValue) 
	{
		$this->luongcd_BH = $nValue;
	}
	public function getBHYT()
	{
		return $this->BHYT;
	}
	public function setBHYT($nValue) 
	{
		$this->BHYT = $nValue;
	}
	public function getBHXH()
	{
		return $this->BHXH;
	}
	public function setBHXH($nValue) 
	{
		$this->BHXH = $nValue;
	}
	public function getBHTN()
	{
		return $this->BHTN;
	}
	public function setBHTN($nValue) 
	{
		$this->BHTN = $nValue;
	}
	public function getThueTNCN()
	{
		return $this->thue_TNCN;
	}
	public function setThueTNCN($nValue) 
	{
		$this->thue_TNCN = $nValue;
	}
	public function getLuongTNCN()
	{
		return $this->luong_TNCN;
	}
	public function setLuongTNCN($nValue) 
	{
		$this->luong_TNCN = $nValue;
	}
	public function getLuongcdTNCN()
	{
		return $this->luongcd_TNCN;
	}
	public function setLuongcdTNCN($nValue) 
	{
		$this->luongcd_TNCN = $nValue;
	}
	public function getNgoaingu()
	{
		return $this->ngoaingu;
	}
	public function setNgoaingu($nValue) 
	{
		$this->ngoaingu = $nValue;
	}
	public function getDantoc()
	{
		return $this->dantoc;
	}
	public function setDantoc($nValue) 
	{
		$this->dantoc = $nValue;
	}
	public function getTongiao()
	{
		return $this->tongiao;
	}
	public function setTongiao($nValue) 
	{
		$this->tongiao = $nValue;
	}
	public function getDoanvien()
	{
		return $this->doanvien;
	}
	public function setDoanvien($nValue) 
	{
		$this->doanvien = $nValue;
	}
	public function getDangvien()
	{
		return $this->dangvien;
	}
	public function setDangvien($nValue) 
	{
		$this->dangvien = $nValue;
	}
	public function getThigiac()
	{
		return $this->thigiac;
	}
	public function setThigiac($nValue) 
	{
		$this->thigiac = $nValue;
	}
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue) 
	{
		$this->date_created = $nValue;
	}
	public function getLastLogin()
	{
		return $this->last_login;
	}
	public function setLastLogin($nValue) 
	{
		$this->last_login = $nValue;
	}
	public function getStatus()
	{
		return( $this->status );
	}
	public function setStatus($nValue) 
	{
		$this->status = $nValue;
	}
	public function getRealEmployee()
	{
		return( $this->real_employee);
	}
	public function setRealEmployee($nValue) 
	{
		$this->real_employee = $nValue;
	}
	public function getProperties()
	{
		return $this->properties;
	}
	public function setProperties($nValue)
	{
		$this->properties=$nValue;
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
	public function getStatusText() {
		global $messages;
		return $messages['status_user'][$this->status];
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_user'][$this->status];
	}
	public function getTypeTextBackend() {
		global $amessages;
		return $amessages['type_user'][$this->type];
	}
	public function getTypeTextExcel() {
		global $amessages;
		return $amessages['type_user_excel'][$this->type];
	}
	public function getTypeTongiaoExcel() {
		global $amessages;
		return $amessages['ton_giao'][$this->tongiao];
	}
	public function getGioitinhTextBackend() {
		global $amessages;
		return $amessages['gender_user'][$this->gender];
	}
	public function getDoanvienTextBackend() {
		global $amessages;
		return $amessages['doan_vien'][$this->doanvien];
	}
	public function getTypeMarryTextBackend() {
		global $amessages;
		return $amessages['type_marry'][$this->type_marry];
	}
	public function getDangvienTextBackend() {
		global $amessages;
		return $amessages['dang_vien'][$this->dangvien];
	}
	
	public function getVanhoaTextBackend() {
		global $amessages;
		return $amessages['van_hoa'][$this->trinhdoVH];
	}
	
	public function getVanhoaKhacTextBackend() {
		global $amessages;
		return $amessages['tdvhkhac'][$this->tdvhkhac];
	}
	public function getBaohiemTextBackend() {
		global $amessages;
		return $amessages['baohiem'][$this->baohiem];
	}
	public function isDeleted() {
		return ($this->status == S_DELETED?1:0);
	}
	public function isEnabled() {
		return ($this->status == S_ENABLED?1:0);
	}
	public function isDisabled() {
		return ($this->status == S_DISABLED?1:0);
	}
	public function isSiteStaff() {
		return ($this->type == U_SITE_STAFF?1:0);
	}
	public function isSiteAdmin() {
		return ($this->type == U_SITE_ADMINISTRATOR?1:0);
	}
	public function isSiteFounder() {
		return ($this->type == U_SITE_FOUNDER?1:$this->type == 4?1:0);
	}
	public function isSiteSuperAdmin() {
		return ($this->type == U_SITE_SUPERADMIN?1:0);
	}
	public function isSiteLeader() {
		return ($this->type == U_SITE_LEADER?1:0);
	}
	public function isBidoStaff() {
		return ($this->type == U_BIDO_STAFF?1:0);
	}
	public function isBidoAdmin() {
		return ($this->type == U_BIDO_ADMIN?1:0);
	}
	public function isBidoFounder() {
		return ($this->type == U_BIDO_FOUNDER?1:0);
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
		if($this->isSiteAdmin()) return 1;
		if($allow_admin && $this->isSiteAdmin()) return 1;
		$permissions = $this->getPermissions();
		if(isset($permissions[$act][$mod]) && $permissions[$act][$mod] == 1) return 1;
		header("location: /admin.php?op=accessdenied");
		exit;
	}
}
?>