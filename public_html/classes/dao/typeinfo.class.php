<?php
/*************************************************************************
Class Product
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 06/24/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class TypeInfo {
	var $id;			# Primary key
	var $store_id;		# Estore id
	var $user_id;		# User id
	var $slug;			# Slug
	var $name;			# Product name
	var $position;
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	var $properties;	# Properties
	# Constructor
	function __construct($slug, $name, $position, $status, $properties, $user_id = 0, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->user_id = $user_id;
		$this->slug = stripslashes(htmlspecialchars($slug));
		$this->name = stripslashes(htmlspecialchars($name));
		$this->position = $position;
		$this->status = $status;
		$this->properties = unserialize($properties);
	}
	function TypeInfo($slug, $name, $position, $status, $properties, $user_id = 0, $store_id = 0, $id = 0)
	{
		$this->__construct($slug, $name, $position, $status, $properties, $user_id , $store_id , $id);
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
	function getSlug() {
		return $this->slug;		
	}
	function setSlug($nValue) {
		$this->slug=stripslashes($nValue);
	}
	function getName() {
		return $this->name;		
	}
	function setName($nValue) {
		$this->name=stripslashes($nValue);
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
	function getPosition() {
		return $this->position;
	}
	function setPosition($nValue) {
		$this->position = $nValue;
	}
	function getProperties()
	{
		return $this->properties;
	}
	function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
	
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_product'][$this->status];
	}
}	
?>