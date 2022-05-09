<?php
/*************************************************************************
Class Customer
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
class DomainInfo {
	var $id;
    var $store_id;		# Estore id			# Primary key
    var $domain_name;
    var $summary;
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
    var $date_created;
    var $last_updated;
    var $last_updated_username;

	# Constructor
	function __construct($domain_name, $summary, $status, $date_created, $last_updated, $last_updated_username, $store_id = 0, $id = 0)
	{
		$this->id = $id;
        $this->store_id = $store_id;
        $this->domain_name=$domain_name;
        $this->summary=$summary;
        $this->status=$status;
        $this->date_created=$date_created;
        $this->last_updated=$last_updated;
        $this->last_updated_username=$last_updated_username;
	}
	function DomainInfo($domain_name, $summary, $status, $date_created, $last_updated, $last_updated_username, $store_id = 0, $id = 0)
	{
		$this->__construct($domain_name, $summary, $status, $date_created, $last_updated, $last_updated_username, $store_id, $id);
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
	function getDomainName() {
		return $this->domain_name;
	}
	function setDomainName($nValue) {
		$this->domain_name=$nValue;
	}
	function getSummary() {
		return $this->summary;
	}
	function setSummary($nValue) {
		$this->summary=$nValue;
	}
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
    function getDateCreated() {
		return $this->date_created;
	}
	function setDateCreated($nValue) {
		$this->date_created = $nValue;
	}
    function getLastUpdate() {
		return $this->last_updated;
	}
	function setLastUpdate($nValue) {
		$this->last_updated = $nValue;
	}
    function getLastUpdateUserName() {
		return $this->last_updated_username;
	}
	function setLastUpdateUserName($nValue) {
		$this->last_updated_username = $nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_domain'][$this->status];
	}

	
}	

?>