<?php
/*************************************************************************
Class language
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 28/05/2012
Coder: Mai Minh
**************************************************************************/
class LanguageInfo {
	public $id;			# language code (primary key)
	private $store_id;
	private $prefix;		# 2 character prefix, e.g vn, en, jp, cn,...		
	private $name;			# Name
	private $currency;		# Currency for this language
	private $primary;		# Wether this language is default or not
	private $position;		# position
	private $status;		# 0-Disabled, 1-Active, 2-Deleted
	# Constructor
	function __construct($prefix, $name, $currency, $primary=0, $position=0,$status=0, $store_id=0, $id = 0)
  	{
		$this->id = $id;
		$this->store_id=$store_id;
		$this->prefix = $prefix;
		$this->name = $name;
		$this->currency = $currency;
		$this->primary = $primary;
		$this->position = $position;
		$this->status = $status;
	}
	public function LanguageInfo($prefix, $name, $currency, $primary=0, $position=0,$status=0, $store_id=0, $id = 0)
	{
		$this->__construct($prefix, $name, $currency, $primary, $position,$status, $store_id, $id);
	}

	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}	
	
	public function getPrefix() {
		return $this->prefix;
	}	
	public function setPrefix($nValue) {
		$this->prefix=$nValue;
	}
	public function getName() {
		return $this->name;
	}	
	public function setName($nValue) {
		$this->name=$nValue;
	}
	
	public function getCurrency() {
		return $this->currency;
	}
	public function setCurrency($nValue) {
		$this->currency=$nValue;
	}
	public function getCurrencyName() {
		include_once(ROOT_PATH.'classes/dao/currencies.class.php');
		$currencies = new Currencies($this->store_id);
		return $currencies->getNameFromId($this->currency);
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
	public function getPrimary() {
		return $this->primary;
	}
	public function setPrimary($nValue) {
		$this->primary = $nValue;
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