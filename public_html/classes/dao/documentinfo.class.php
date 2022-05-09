<?php
/*************************************************************************
Class Customer
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
class DocumentInfo {
	public $id;			
	private $store_id;		
	private $name;		
	private $customer_id;			
	private $document_type_id;
	private $financial_year;
	private $month_processed;
	private $keywords;	
	private $properties;		
	private $status;		
	private $date_created;		
	private $last_updated;		
	private $date_processed;			
	private $user_processed;
	private $user_processed_temporary;	
	private $processed_from;
	private $processed_to;	
	private $date_approved;			
	private $user_approved;	


	# Constructor
	function __construct($name, $customer_id, $document_type_id, $financial_year,$month_processed, $keywords, $properties,$status,$date_created, $last_updated, $date_processed, $user_processed,$user_processed_temporary,$processed_from,$processed_to, $date_approved, $user_approved, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->name = $name;
		$this->customer_id = $customer_id;
		$this->document_type_id = $document_type_id;
		$this->financial_year = $financial_year;
		$this->month_processed = $month_processed;
		$this->keywords = $keywords;
		$this->properties = unserialize($properties);
		$this->status = $status;
		$this->date_created = $date_created;
		$this->last_updated = $last_updated;
		$this->date_processed = $date_processed;
		$this->user_processed = $user_processed;
		$this->user_processed_temporary = $user_processed_temporary;
		$this->processed_from = $processed_from;
		$this->processed_to = $processed_to;
		$this->date_approved = $date_approved;
		$this->user_approved = $user_approved;
	}
	public function DocumentInfo($name, $customer_id, $document_type_id, $financial_year,$month_processed, $keywords, $properties,$status,$date_created, $last_updated, $date_processed, $user_processed,$user_processed_temporary,$processed_from,$processed_to, $date_approved, $user_approved, $store_id = 0, $id = 0)
	{
		$this->__construct($name, $customer_id, $document_type_id, $financial_year,$month_processed, $keywords, $properties,$status,$date_created, $last_updated, $date_processed, $user_processed,$user_processed_temporary,$processed_from,$processed_to, $date_approved, $user_approved, $store_id , $id);
	}
	public function getUserProcessedTemporary() {
		return $this->user_processed_temporary;
	}	
	public function setUserProcessedTemporary($nValue) {
		$this->user_processed_temporary=$nValue;
	}
	
	public function getProcessedTo() {
		return $this->processed_to;
	}	
	public function setProcessedTo($nValue) {
		$this->processed_to=$nValue;
	}

	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getMonthProcessed() {
		return $this->month_processed;
	}	
	public function setMonthProcessed($nValue) {
		$this->month_processed=$nValue;
	}
	public function getStoreId() {
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($nValue) {
		$this->name=$nValue;
	}
	public function getCustomerId() {
		return $this->customer_id;
	}
	public function setCustomerId($nValue) {
		$this->customer_id=$nValue;
	}
	public function getDocumentTypeId() {
		return $this->document_type_id;		
	}
	public function setDocumentTypeId($nValue) {
		$this->document_type_id=$nValue;
	}
	public function getFinancialYear() {
		return $this->financial_year;		
	}
	public function setFinancialYear($nValue) {
		$this->financial_year=$nValue;
	}
	public function getKeywords() {
		return $this->keywords;		
	}
	public function setKeywords($nValue) {
		$this->keywords=$nValue;
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
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['document_status'][$this->status];
	}
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}
	public function getProcessedFrom() {
		return $this->processed_from;
	}	
	public function setProcessedFrom($nValue) {
		$this->processed_from=$nValue;
	}
	public function getLastUpdated()
	{
		return $this->last_updated;
	}
	public function setLastUpdated($nValue)
	{
		$this->last_updated=$nValue;
	}
	public function getDateProcessed()
	{
		return $this->date_processed;
	}
	public function setDateProcessed($nValue)
	{
		$this->date_processed=$nValue;
	}
	public function getUserProcessed()
	{
		return $this->user_processed;
	}
	public function setUserProcessed($nValue)
	{
		$this->user_processed=$nValue;
	}
	public function getUserApproved()
	{
		return $this->user_approved;
	}
	public function setUserApproved($nValue)
	{
		$this->user_approved=$nValue;
	}
	public function getDateApproved()
	{
		return $this->date_approved;
	}
	public function setDateApproved($nValue)
	{
		$this->date_approved=$nValue;
	}
	
}	
?>