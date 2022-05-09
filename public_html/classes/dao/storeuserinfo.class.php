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
class StoreUserInfo {
	public $id;
	private $store_id;
	private $area_id;
	private $username;
	private $password;
	private $type;
	private $fullname;
	private $email;
	private $address;
	private $tel;
	private $cell;
	private $date_created;
	private $status;
	private $properties;

	public function __construct($store_id,$area_id, $username, $password, $type, $fullname, $email, $address, $tel, $cell,  $date_created, $last_login, $status, $properties = '', $id = 0 )
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->area_id = $area_id;
		$this->username = trim($username);
		$this->password = $password;
		$this->type = $type;
		$this->fullname = $fullname;
		$this->email = $email;	
		$this->address= $address;
		$this->tel = $tel;
		$this->cell = $cell;		
		$this->date_created = $date_created;
		$this->last_login = $last_login;
		$this->status = $status;
		$this->properties = $properties;	
	}
	public function StoreUserInfo($store_id,$area_id, $username, $password, $type, $fullname, $email, $address, $tel, $cell,  $date_created, $last_login, $status, $properties = '', $id = 0 )
	{
		$this->__construct($store_id,$area_id, $username, $password, $type, $fullname, $email, $address, $tel, $cell,  $date_created, $last_login, $status, $properties, $id);
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
	public function getAreaid()
	{
		return $this->area_id;
	}
	public function setAreaid($nValue) {
		$this->area_id = $nValue;
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
		return isset($this->properties[$key])?$this->properties[$key]:'';
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
	public function isDeleted() {
		return ($this->status == S_DELETED?1:0);
	}
	public function isEnabled() {
		return ($this->status == S_ENABLED?1:0);
	}
	public function isDisabled() {
		return ($this->status == S_DISABLED?1:0);
	}
}
?>