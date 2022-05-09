<?php
/*************************************************************************
Class Article
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 16/04/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class ConsultantInfo {
	public $id;			# Primary key
	private $fullname;		# Estore id
	private $phone;		# Category id
	private $email;			# Slug
	private $province;			#Title
	private $store_id;		#Keyword
	private $date_created;			# Sapo
	private $type;		# Detail
	private $properties;		# Number of views
	private $status;	# Date created
  function __construct($fullname,$phone,$email,$province,$store_id = 0,$date_created,$type,$properties,$status,$id = 0) 
  {
		$this->id = $id;
		$this->fullname = $fullname;
		$this->phone = $phone;
		$this->email = $email;
		$this->province = $province;
		$this->store_id = $store_id;
		$this->date_created = $date_created;
		$this->type = $type;
		$this->properties = unserialize($properties);
		$this->status = $status;
	}
	# Constructor
	public function ConsultantInfo($fullname,$phone,$email,$province,$store_id = 0,$date_created,$type,$properties,$status, $id = 0)
	{
		$this-> __construct($fullname,$phone,$email,$province, $store_id,$date_created,$type,$properties,$status,$id);
	}
	public function getFullName() {
		return $this->fullname;
	}	
	public function setFullName($nValue) {
		$this->fullname=$nValue;
	}
	public function getPhone() {
		return $this->phone;
	}	
	public function setPhone($nValue) {
		$this->phone=$nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getEmail() {
		return $this->email;
	}	
	public function setEmail($nValue) {
		$this->email=$nValue;
	}
	public function getProvince() {
		return $this->province;
	}	
	public function setProvince($nValue) {
		$this->province=$nValue;
	}
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}
	public function getType() {
		return $this->type;
	}	
	public function setType($nValue) {
		$this->type=$nValue;
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
	public function getStoreId() {
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
}	
?>