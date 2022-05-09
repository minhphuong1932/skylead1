<?php
/*************************************************************************

**************************************************************************/	

class Reportrepairinfo {
	var $id;				# Primary key
	var $store_id;			# Estore id	
	var $product_id;		#Product Id
	var $repair_id;			# customer_id	
	var $customer_id;
	var $area_id;
	
	var $model; 			# Brand
	var $series;			# series	
	var $cause;				#cause
	var $work;				#work
	var $state_completed; 	# Brand
	var $replacement;		# series
	var $node;				# name
	var $created;
	var $properties;		# Properties
	var $status;

	# Constructor
	function __construct($model,$series,$cause,$work,$state_completed,$replacement,$node,$created,$properties,$status,$customer_id,$area_id=0,$repair_id=0, $product_id=0, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;		
		$this->product_id = $product_id;				
		$this->repair_id = $repair_id;
		$this->area_id = $area_id;
		$this->customer_id = $customer_id;
		$this->repair_id = $repair_id;
		$this->model = $model;
		$this->series = $series;			
		$this->cause = stripslashes($cause);			
		$this->work = stripslashes($work);	
		$this->state_completed = stripslashes($state_completed);	
		$this->replacement = $replacement;
		$this->node = stripslashes($node);
		$this->created=$created;
		$this->status = $status;
		$this->properties = unserialize($properties);		
	}
	function Reportrepairinfo($model,$series,$cause,$work,$state_completed,$replacement,$node,$created,$properties,$status,$customer_id,$area_id=0,$repair_id=0, $product_id=0, $store_id = 0, $id = 0)
	{
		$this->__construct($model,$series,$cause,$work,$state_completed,$replacement,$node,$created,$properties,$status,$customer_id,$area_id,$repair_id, $product_id, $store_id, $id);
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	////////////
	function getStoreId() {
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	////////////
	function getRepair_id() {
		return $this->repair_id;
	}
	function setRepair_id($nValue) {
		$this->repair_id=$nValue;
	}
	////////////
	function getProductId() {
		return $this->product_id;
	}
	function setProductId($nValue) {
		$this->product_id=$nValue;
	}
	function getCustomerId() {
		return $this->customer_id;
	}
	function setCustomerId($nValue) {
		$this->customer_id=$nValue;
	}
	///////////
	function getAreaId() {
		return $this->area_id;
	}
	function setAreaId($nValue) {
		$this->area_id=$nValue;
	}
	function getModel() {
		return $this->model;
	}
	function setModel($nValue) {
		$this->model=$nValue;
	}
	function getSeries() {
		return $this->series;
	}
	function setSeries($nValue) {
		$this->series=$nValue;
	}
	///////////
	function getCause() {
		return $this->cause;
	}
	function setCause($nValue) {
		$this->cause=$nValue;
	}
	////////////////
	function getWork() {
		return $this->work;
	}
	function setWork($nValue) {
		$this->work=$nValue;
	}
	/////////////////
	function getState_completed() {
		return $this->state_completed;
	}
	function setState_completed($nValue) {
		$this->state_completed=$nValue;
	}
	/////////////////////
	function getReplacement() {
		return $this->replacement;
	}
	function setReplacement($nValue) {
		$this->replacement=$nValue;
	}
	//////////////////////
	function getNode() {
		return $this->node;		
	}
	function setNode($nValue) {
		$this->node=stripslashes($nValue);
	}
	////////////////////
	function getCreated() {
		return $this->created;		
	}
	function setCreated($nValue) {
		$this->created=($nValue);
	}
	////////////////////
	function getProperty($key)
	{
		if(isset($this->properties[$key])) return $this->properties[$key];
		return '';
	}
	function setProperty($key,$nValue)
	{
		$this->properties[$key]=$nValue;
	}	
	//////////////////////
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_request'][$this->status];
	}
	function getStatus() {
		return $this->status;	
	}
	function getProperties()
	{
		return $this->properties;
	}
	function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
/*	function getModel() {
	include_once(ROOT_PATH."classes/dao/tradeservices.class.php");
	$TradeServices = new TradeServices($this->store_id);
	return $TradeServices->getModelFromId($this->repair_id);
	
	}
	#getSerie	
	function getSeries() {
	include_once(ROOT_PATH."classes/dao/tradeservices.class.php");
	$TradeServices = new TradeServices($this->store_id);
	return $TradeServices->getSerieFromId($this->repair_id);	
	}*/
	#get ngay hoan thanh
	function getCompleteDate() {
	include_once(ROOT_PATH."classes/dao/tradeservices.class.php");
	$TradeServices = new TradeServices($this->store_id);
	return $TradeServices->getDate_acceptFromId($this->repair_id);	
	}
	#getName getProperty service
	function getPropertyservice() {
	include_once(ROOT_PATH."classes/dao/tradeservices.class.php");
	$tradeServices = new TradeServices($this->store_id);
	return $tradeServices->getPropertyFromId($this->repair_id);	
	}
	#getName	
	function getName() {
	include_once(ROOT_PATH."classes/dao/tradeservices.class.php");
	$TradeServices = new TradeServices($this->store_id);
	return $TradeServices->getDescriptionFromId($this->repair_id);	
	}
	#getName customer
	function getNameCustomer() {
	include_once(ROOT_PATH.'classes/dao/customerwarrantys.class.php');
	$customerwarrantys = new customerwarrantys($this->store_id);
	return $customerwarrantys->getFullNameFromId($this->customer_id);	
	}
	
	#get ID appraials
	function getAppraisalsID() {
	include_once(ROOT_PATH.'classes/dao/tradeappraisals.class.php');
	$appraisal = new Appraisal($this->store_id);
	return $appraisal->getrIdFromRpairId($this->repair_id);	
	}
	
	/*#get ngay thuc hien
	function getNameCustomer() {
	include_once(ROOT_PATH.'classes/dao/customerwarrantys.class.php');
	$customerwarrantys = new customerwarrantys($this->store_id);
	return $customerwarrantys->getFullNameFromId($this->repair_id);	
	}*/

}	
?>