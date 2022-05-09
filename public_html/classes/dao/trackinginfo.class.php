<?php
/*************************************************************************
Class Tracking Info
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Author: Mai Minh
Email: info@derasoft.com                                    
Last updated: 11/08/2011
**************************************************************************/
class TrackingInfo {
	public $id;
	private $store_id;
	private $username;
	private $action;
	private $date_created;
	private $ip;

	public function __construct($store_id, $username, $action, $date_created, $ip, $id = 0 )
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->username = trim($username);
		$this->action = $action;
		$this->date_created = $date_created;
		$this->ip = $ip;	
	}
	public function TrackingInfo($store_id, $username, $action, $date_created, $ip, $id = 0 )
	{
		$this->__construct($store_id, $username, $action, $date_created, $ip, $id);
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($nValue) {
		$this->id = $nValue;
	}
	public function getStoreId()
	{
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id = $nValue;
	}
	public function getUsername()
	{
		return $this->username;
	}
	public function setUsername($nValue) {
		$this->username = $nValue;
	}
	public function getAction()
	{
		return $this->action;
	}
	public function setAction($nValue) {
		$this->action = $nValue;
	}
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue) 
	{
		$this->date_created = $nValue;
	}
	public function getIp()
	{
		return $this->ip;
	}
	public function setIp($nValue) 
	{
		$this->ip = $nValue;
	}
}
?>