<?php
/*************************************************************************
Class QuestionInfo
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class ConstrucInfo {
	public $id;			# Primary key
	private $order_id;			# Slug
	private $properties;	# Properties
	private $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	private $user_id;	
	private $payment_status;
	private $bill;	
	private $import;	
	private $export;	
	

	# Constructor
	function __construct($order_id,$user_id,$status,$payment_status, $properties,$bill,$import,$export, $id = 0)
	{
		$this->id = $id;
		$this->order_id = $order_id;
		$this->user_id = $user_id;
		$this->status = $status;
		$this->payment_status = $payment_status;
		$this->properties = unserialize($properties);
		$this->bill = $bill;
		$this->import = $import;
		$this->export = $export;
	}
	public function ConstrucInfo($order_id,$user_id,$status,$payment_status, $properties,$bill,$import,$export, $id = 0)
	{
		$this->__construct($order_id,$user_id,$status,$payment_status, $properties,$bill,$import,$export, $id);
	}
	public function getImport() {
		return $this->import;
	}	
	public function setImport($nValue) {
		$this->import=$nValue;
	}
	public function getExport() {
		return $this->export;
	}	
	public function setExport($nValue) {
		$this->export=$nValue;
	}
	public function getBill() {
		return $this->bill;
	}	
	public function setBill($nValue) {
		$this->bill=$nValue;
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getOrderId() {
		return $this->order_id;
	}
	public function setOrderId($nValue) {
		$this->order_id=$nValue;
	}
	public function getUserId() {
		return $this->user_id;
		
	}
	public function setUserId($nValue) {
		$this->user_id=$nValue;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
	public function getPaymentStatus() {
		return $this->payment_status;
	}
	public function setPaymentStatus($nValue) {
		$this->payment_status = $nValue;
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_construc'][$this->status];
	}
	public function getStatusPaymentTextBackend() {
		global $amessages;
		return $amessages['status_construc_done'][$this->payment_status];
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
}	
?>