<?php
/*************************************************************************
Class currency
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 28/05/2012
Coder: Mai Minh
**************************************************************************/
class CurrencyInfo {
	public $id;			# currency code (primary key)
	private $store_id;		
	private $name;			# Name method
	private $display;		# Currency title
	private $rate;			# Exchange rate to the primary currency
	private $decimal;		# Decimal of currency
	private $primary;		# Wether this currency is default or not
	private $position;		# Position
	private $status;		# 0-Disabled, 1-Active, 2-Deleted
	# Constructor
	public function __construct($name, $display, $rate, $decimal=0, $primary=0, $position=0,$status=0, $store_id=0, $id = 0)
	{
		$this->id = $id;
		$this->store_id=$store_id;
		$this->name = $name;
		$this->display = $display;
		$this->rate = $rate;
		$this->decimal = $decimal;
		$this->primary = $primary;
		$this->position = $position;
		$this->status = $status;
	}
	public function CurrencyInfo($name, $display, $rate, $decimal=0, $primary=0, $position=0,$status=0, $store_id=0, $id = 0)
	{
		$this->__construct($name, $display, $rate, $decimal, $primary, $position,$status, $store_id, $id);
	}

	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}	
	
	public function getName() {
		return $this->name;
	}	
	public function setName($nValue) {
		$this->name=$nValue;
	}
	
	public function getDisplay() {
		return $this->display;
	}	
	public function setDisplay($nValue) {
		$this->display=$nValue;
	}
	public function getRate() {
		return $this->rate;
	}
	public function setRate($nValue) {
		$this->rate=$nValue;
	}
	public function getDecimal() {
		return $this->decimal;
	}
	public function setDecimal($nValue) {
		$this->decimal=$nValue;
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