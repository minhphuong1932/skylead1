<?php
/*************************************************************************
Class Staff
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
class StaffInfo {
	var $id;			# Primary key
	var $store_id;		# Estore id
	var $user_id;		# User id
	var $type;			# Type user
	var $fullname;		# Fullname
	var $address;		# Address
	var $email;			# Email
	var $tel;			# Tel
	var $created;		# Date created
	var $updated;		# Date updated
	var $position;		# Date Last login
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	var $properties;	# Properties(about, cel)
	# Constructor
	function __construct($type, $fullname, $address, $email, $tel, $created, $updated, $position, $status, $properties,$user_id=0, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->user_id = $user_id;
		$this->type = $type;
		$this->fullname = $fullname;
		$this->address = $address;
		$this->email = $email;
		$this->tel = $tel;
		$this->created = $created;
		$this->updated = $updated;
		$this->position = $position;
		$this->status = $status;
		$this->properties = unserialize($properties);
	}
	function StaffInfo($type, $fullname, $address, $email, $tel, $created, $updated, $position, $status, $properties,$user_id=0, $store_id = 0, $id = 0)
	{
		$this->__construct($type, $fullname, $address, $email, $tel, $created, $updated, $position, $status, $properties,$user_id, $store_id, $id);
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getStoreId() {
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	function getUserId() {
		return $this->user_id;
	}
	function setUserId($nValue) {
		$this->user_id=$nValue;
	}
	function getType() {
		return $this->type;
	}
	function setType($nValue) {
		$this->type=$nValue;
	}
	
	function getFullName() {
		return $this->fullname;		
	}
	function setFullName($nValue) {
		$this->fullname=$nValue;
	}
	function getAddress() {
		return $this->address;		
	}
	function setAddress($nValue) {
		$this->address=$nValue;
	}
	function getEmail() {
		return $this->email;		
	}
	function setEmail($nValue) {
		$this->email=$nValue;
	}
	function getTel() {
		return $this->tel;		
	}
	function setTel($nValue) {
		$this->tel=$nValue;
	}
	
	function getDateCreated()
	{
		return $this->created;
	}
	function setDateCreated($nValue)
	{
		$this->created=$nValue;
	}
	function getUpdated()
	{
		return $this->updated;
	}
	function setUpdated($nValue)
	{
		$this->updated=$nValue;
	}
	function getProperty($key)
	{
		if(isset($this->properties[$key])) return $this->properties[$key];
		return '';
	}
	function setProperty($key,$nValue)
	{
		$this->properties[$key]=$nValue;
	}
	
	function getProperties()
	{
		return $this->properties;
	}
	function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
	function getPosition() {
		return $this->position;
	}
	function setPosition($nValue) {
		$this->position = $nValue;
	}
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
}	
?>