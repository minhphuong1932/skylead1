<?php
/*************************************************************************
Class Method delivery
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Last updated: 8/5/2012
Coder: Tran Thi My Xuyen
**************************************************************************/
class ShippingMethodInfo {
	public $Id;			# Method code (primary key)
	private $store_id;		
	private $name;			# Name method
	private $price;			# Price method
	private $status;		# 0-Disabled, 1-Active, 2-Deleted
	private $position;		# Display order
	private $properties;	# Properties
	# Constructor
	public function __construct($name, $price, $status=0, $position=0, $properties='',$store_id=0, $Id = 0)
	{
		$this->Id = $Id;
		$this->store_id=$store_id;
		$this->name = $name;
		$this->price = $price;
		$this->status = $status;
		$this->position = $position;
		$this->properties = unserialize($properties);
	}
	public function ShippingMethodInfo($name, $price, $status=0, $position=0, $properties='',$store_id=0, $Id = 0)
	{
		$this->__construct($name, $price, $status, $position, $properties,$store_id, $Id);
	}
	public function getId() {
		return $this->Id;
	}	
	public function setId($nValue) {
		$this->Id=$nValue;
	}	
	
	public function getName() {
		return $this->name;
	}	
	public function setName($nValue) {
		$this->name=$nValue;
	}
	
	public function getPrice() {
		return $this->price;		
	}
	public function setPrice($nValue) {
		$this->price=$nValue;
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
	public function getPosition() {
		return $this->position;
	}
	public function setPosition($nValue) {
		$this->position = $nValue;
	}
	public function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
}	
?>