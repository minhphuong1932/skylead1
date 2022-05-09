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
class OnlineUser {
	public $id;
	private $store_id;
	private $sid;
	private $uid;
	private $username;
	private $utype;
	private $ip;
	private $last_updated;
	private $last_page;

	public function __construct($store_id, $sid, $uid, $username, $utype, $ip, $last_updated, $last_page, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->sid = $sid;
		$this->uid = $uid;
		$this->username = $username;
		$this->utype = $utype;
		$this->ip = $ip;
		$this->last_updated = $last_updated;
		$this->last_page = $last_page;
	}
	public function OnlineUser($store_id, $sid, $uid, $username, $utype, $ip, $last_updated, $last_page, $id = 0)
	{
		$this->__construct($store_id, $sid, $uid, $username, $utype, $ip, $last_updated, $last_page, $id);
	}
	public function getStoreid()
	{
		return $this->store_id;
	}
	public function getUId()
	{
		return $this->uid;
	}
	public function getUsername()
	{
		return $this->username;
	}
	public function getUType()
	{
		return $this->utype;
	}
	public function getSId()
	{
		return $this->sid;
	}
	public function getId()
	{
		return $this->id;
	}
	public function getIp() 
	{
		return $this->ip;
	}
	public function getLastUpdated() 
	{
		return $this->last_updated;
	}
	public function getLastPage() 
	{
		return $this->last_page;
	}
}
?>