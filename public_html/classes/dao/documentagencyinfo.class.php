
<?php
/*************************************************************************
Class AdsCategoryInfo
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                   
Last updated: 05/08/2012
**************************************************************************/	
class  DocumentAgencyInfo {
	var $id;			# Primary key
	var $store_id;		# Store Id
	var $user_id;		# User Id
	var $slug;			# Slug
	var $name;			#  name
	var $created;		# Date Created
	var $updated;		# Date Update 
	var $status;		# Status
	var $position;		# Position 
	var $properties;	# 
	function __construct($slug, $name='', $created, $updated, $status='', $position, $properties='', $user_id = 0, $store_id=0, $id=0) {
		$this->id = $id;
		$this->store_id=$store_id;
		$this->user_id=$user_id;
		$this->slug = stripslashes(htmlspecialchars($slug));
		$this->name = stripslashes(htmlspecialchars($name));
		$this->created = $created;
		$this->updated = $updated;
		$this->status = $status;
		$this->position = $position;
		$this->properties = unserialize($properties);
	}
	function DocumentAgencyInfo($slug, $name='', $created, $updated, $status='', $position, $properties='', $user_id = 0, $store_id=0, $id=0) {
		$this->__construct($slug, $name, $created, $updated, $status, $position, $properties, $user_id , $store_id, $id);
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
	function getUserId() {
		return $this->user_id;
	}	
	function setUserId($nValue) {
		$this->user_id=$nValue;
	}
	function getProperty($id,$key)
	{
		if(isset($this->properties[$id][$key])) return $this->properties[$id][$key];
		return '';
	}
	function getProperties()
	{
		return $this->properties;
	}
	
	function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
	function getSlug() {
		return $this->slug;		
	}
	function setSlug($nValue) {
		$this->slug=stripslashes($nValue);
	}
	function getName() {
		return $this->name;		
	}
	function setName($nValue) {
		$this->name=stripslashes($nValue);
	}
	function getDateCreated() {
		return $this->date_created;		
	}
	function setDateCreated($nValue) {
		$this->date_created=stripslashes($nValue);
	}
	function getUpdated() {
		return $this->updated;		
	}
	function setUpdated($nValue) {
		$this->updated=stripslashes($nValue);
	}
	function getStatus() {
		return $this->status;
	}
	
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	
	function getPosition() {
		return $this->position;		
	}
	function setPosition($nValue) {
		$this->position=stripslashes($nValue);
	}
	function isEnabled() {
		return ($this->status == 1?1:0);
	}
	
	function isDeleted() {
		return ($this->status == 2?1:0);
	}
	
	function isDisabled() {
		return ($this->status == 0?1:0);
	}
	function getUrl($page = 1, $keywords = '', $sort_key = 'position', $sort_direction = 'asc') {
		$url = '';
		if(URL_TYPE == 1 || $page > 1) {	# Query string
			$url = '/'.DOCUMENT_SCRIPT.'?op=estore&act=text&slug='.$this->slug.'&pg='.$page.'&kw='.$keywords.'&sk='.$sort_key.'&sd='.$sort_direction;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			$url = '/'.$this->slug.'.htm';
			return $url;
		} else return '';	
	}
	
}
?>