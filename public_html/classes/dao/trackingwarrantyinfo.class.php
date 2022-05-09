<?php
/*************************************************************************
Class Product
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd
Last updated: 06/24/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class TrackingWarrantyInfo {
	var $id;			# Primary key
	var $store_id;		# Estore id
	var $user_id;		# User id
	var $customer_id;	# Customer id
	var $product_id;	# Product id
	var $type;			# Type
	var $name;			# Product name
	var $typeId;			# brand
	var $date_created;	# Date created
	var $updated;		# Date update
	var $number_contract;# number_contract
	var $time_contract;	# Description
	var $date_start;		# Detail
	var $date_end;		# number
	var $note;
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	var $properties;	# Properties
	
	# Constructor
	function __construct($type, $name, $typeId, $date_created, $updated, $number_contract, $time_contract, $date_start, $date_end, $note, $status, $properties, $product_id = 0, $customer_id = 0, $user_id = 0, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->user_id = $user_id;
		$this->customer_id = $customer_id;
		$this->product_id = $product_id;
		$this->type = $type;
		$this->name = stripslashes(htmlspecialchars($name));
		$this->typeId = stripslashes(htmlspecialchars($typeId));
		
		$this->date_created = $date_created;
		$this->updated = $updated;
		$this->number_contract = $number_contract;
		$this->time_contract = $time_contract;
		$this->date_start = $date_start;
		
		$this->date_end = $date_end;
		$this->note = $note;
		$this->properties = unserialize($properties);
		$this->status = $status;
		
	}
	function TrackingWarrantyInfo($type, $name, $typeId, $date_created, $updated, $number_contract, $time_contract, $date_start, $date_end, $note, $status, $properties, $product_id = 0, $customer_id = 0, $user_id = 0, $store_id = 0, $id = 0)
	{
		$this->__construct($type, $name, $typeId, $date_created, $updated, $number_contract, $time_contract, $date_start, $date_end, $note, $status, $properties, $product_id, $customer_id , $user_id , $store_id , $id);
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
	function getProductId() {
		return $this->product_id;
	}
	function setProductId($nValue) {
		$this->product_id=$nValue;
	}
	function getType() {
		return $this->type;
	}
	function setType($nValue) {
		$this->type=$nValue;
	}
	function getUserId() {
		return $this->user_id;
	}
	function setUserId($nValue) {
		$this->user_id=$nValue;
	}
	function getCustomerId() {
		return $this->customer_id;
	}
	function setCustomerId($nValue) {
		$this->customer_id=$nValue;
	}
	function getTypeId() {
		return $this->typeId;
	}
	function setTypeId($nValue) {
		$this->typeId=$nValue;
	}
	
	function getInfoProduct() {
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products($this->store_id);
		$productItem = $products->getObject($this->product_id);
		if($productItem){
			$info = array('name' => $productItem->getName(),
						  'model' => $productItem->getSKU(),
						  'brand' => $productItem->getBrand(),
						  'series'=> $productItem->getSeries(),
						  'description' => $productItem->getDescription());	
			return $info;
		}
		return '';
	}
	function getName() {
		return $this->name;		
	}
	function setName($nValue) {
		$this->name=stripslashes($nValue);
	}
	
	function getDateCreated()
	{
		return $this->date_created;
	}
	function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}
	function getUpdated()
	{
		return $this->updated;
	}
	function setUpdated($nValue)
	{
		$this->updated=$nValue;
	}
	function getNumberContract() {
		return $this->number_contract;		
	}
	function setNumberContract($nValue) {
		$this->number_contract=stripslashes($nValue);
	}
	function gettTimeContract() {
		return $this->time_contract;		
	}
	function settTimeContract($nValue) {
		$this->time_contract=stripslashes($nValue);
	}
	function getDateStart() {
		return $this->date_start;		
	}
	function setDateStart($nValue) {
		$this->date_start=stripslashes($nValue);
	}
	function getDateEnd() {
		return $this->date_end;
	}
	function setDateEnd($nValue) {
		$this->date_end=$nValue;
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
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
	function getNote() {
		return $this->note;
	}
	function setNote($nValue) {
		$this->note = $nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_product'][$this->status];
	}
	# Return 1 if File is not null
	function getNullFile($n) {
		for($i=1;$i<=$n;$i++){
		$key = "file".$i;
		if($this->$key!='')
			return 1;
		}
		return '';
	}
	function getInfoHistory(){
		 $id = $this->typeId;
		if($this->type == 1){
			include_once(ROOT_PATH."classes/dao/tradeservices.class.php");
			$tradeServices = new TradeServices($this->store_id);
			$repairInfo = $tradeServices->getObject($id,'id');
			if($repairInfo) return $repairInfo;
			
		}elseif($this->type == 2){
			include_once(ROOT_PATH."classes/dao/transactionmainternances.class.php");
			$mainternances = new Mainternances($this->store_id);
			$mainternanceInfo = $tradeServices->getObject($id,'id');
			if($mainternanceInfo) return $mainternanceInfo;
		}
		//return '';
	}
}	
?>