<?php
/*************************************************************************
Class License
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 01/11/2013
Coder: Pham Quoc Dai
**************************************************************************/
class LicenseInfo {
	var $id;			# Primary key	
	var $version;		# version
	var $domain;		# domain
	var $subdomain;		# subdomain
	var $id_user;		# id user
	var $customer_name;	# Email
	var $customer_email;# Tel
	var $customer_phone;# Phone
	var $status;		# status
	var $properties;		# properties
	# Constructor
	function __construct($properties,$status,$version, $domain, $subdomain, $customer_name, $customer_email, $customer_phone,$id_user=0, $id = 0)
	{
		$this->id = $id;
		$this->status = $status;
		$this->version = $version;
		$this->id_user = $id_user;
		$this->domain = $domain;
		$this->subdomain = $subdomain;		
		$this->customer_name = $customer_name;
		$this->customer_email = $customer_email;
		$this->customer_phone = $customer_phone;
		$this->properties = unserialize($properties);
	}
	function LicenseInfo($properties,$status,$version, $domain, $subdomain, $customer_name, $customer_email, $customer_phone,$id_user=0, $id = 0)
	{
		$this->__construct($properties,$status,$version, $domain, $subdomain, $customer_name, $customer_email, $customer_phone,$id_user, $id);
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getVersion() {
		return $this->version;
	}
	function setVersion($nValue) {
		$this->version=$nValue;
	}
	function getIdUser() {
		return $this->id_user;
	}
	function setIdUser($nValue) {
		$this->id_user=$nValue;
	}
	function getDomain() {
		return $this->domain;
	}
	function setDomain($nValue) {
		$this->domain=$nValue;
	}
	
	function getSubdomain() {
		return $this->subdomain;		
	}
	function setSubdomain($nValue) {
		$this->subdomain=$nValue;
	}
	function getCustomerName() {
		return $this->customer_name;		
	}
	function setCustomerName($nValue) {
		$this->customer_name=$nValue;
	}
	function getCustomerEmail() {
		return $this->customer_email;		
	}
	function setCustomerEmail($nValue) {
		$this->customer_email=$nValue;
	}
	function getCustomerPhone() {
		return $this->customer_phone;		
	}
	function setCustomerPhone($nValue) {
		$this->customer_phone=$nValue;
	}	
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}	
	function getStatusTextBackend() {
		global $amessages;		
		return $this->status!=5?$amessages['status_license'][$this->status]:$amessages['status_license'][$this->status]."  <a title='".$this->getProperty('confuse')."'>detail</a>";
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
}	
?>