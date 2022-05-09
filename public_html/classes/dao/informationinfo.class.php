<?php
/*************************************************************************
Class Staticinfo
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Name: Tran Thi Kim Que                                  
Last updated: 15/10/2009                                  
**************************************************************************/
class InformationInfo {
	var $id;
	var $store_id;
	var $status;
	var $date_created;
	var $properties;
	var $name;
	var $phone;
	var $email;
	


	function __construct($store_id, $status,$date_created,$properties, $name, $phone,$email,$id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->status = $status;
		$this->date_created = $date_created;
		$this->properties = unserialize($properties);
		$this->name = $name;
		$this->phone = $phone;
		$this->email = $email;
	}
	public function InformationInfo($store_id, $status,$date_created,$properties, $name, $phone,$email,$id = 0)
	{
	$this->__construct($store_id, $status,$date_created,$properties, $name, $phone,$email,$id);
	}

	function getId() {
		return $this->id;
	}
	function setId($nValue) {
		$this->id=$nValue;
	}

    function getName() {
		return $this->name;
	}
	function setName($nValue) {
		$this->name=$nValue;
	}

    function getEmail() {
		return $this->email;
	}
	function setEmail($nValue) {
		$this->email=$nValue;
	}

    function getPhone() {
		return $this->phone;
	}
	function setPhone($nValue) {
		$this->phone=$nValue;
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
	function getDateCreated() {
		return $this->date_created;
	}	
	function setDateCreated($nValue) {
		$this->date_created=$nValue;
	}
	function getStoreId() {
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	function getStatus() {
		return $this->status;
	}	
	function setStatus($nValue) {
		$this->status=$nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}

}	

?>