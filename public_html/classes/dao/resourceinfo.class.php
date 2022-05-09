<?php
/*************************************************************************
Class Resource Info
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                
Last updated: 01/09/2011                                  
**************************************************************************/
class ResourceInfo {
	public $id;			# Primary key
	private $store_id;		# Estore Id 
	private $type;			# Resource type		1-Image, 2-Flash, 3-File, 4-Video, 5-Youtube
	private $block;			# Slug
	private $title;			# Vietnamese name
	private $keywords;		# Vietnamese keywords
	private $sapo;			# Vietnamese sapo
	private $details;		# Vietnamese details
	private $status;		# Status
	private $position;		#Position
	private $properties;	# Properties
	public function __construct ($store_id = 0, $slug='',$block = '', $title='', $keywords,$sapo='',$details, $status='',$position,  $properties = '',$Id = 0)
	{
		$this->Id = $Id;
		$this->store_id = $store_id;
		$this->slug = $slug;
		$this->block = $block;
		$this->title = stripslashes($title);
		$this->keywords = stripslashes($keywords);
		$this->sapo = stripslashes($sapo);
		$this->details = stripslashes($details);
		$this->status = $status;
		$this->position = $position;
		$this->properties = $properties;
	}
	public function Staticinfo ($store_id = 0, $slug='',$block = '', $title='', $keywords,$sapo='',$details, $status='',$position,  $properties = '',$Id = 0)
	{
		$this->__construct($store_id , $slug,$block, $title, $keywords,$sapo,$details, $status,$position,  $properties,$Id);
	}
	public function getId() {
		return $this->Id;
	}	
	public function setId($nValue) {
		$this->$Id=$nValue;
	}
	public function getStoreId() {
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	public function getSlug() {
		return $this->slug;
	}	
	public function setSlug($nValue) {
		$this->$slug=stripslashes($nValue);
	}
	public function getBlock() {
		return $this->block;
	}	
	public function setBlock($nValue) {
		$this->$block=$nValue;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($nValue) {
		$this->$title=stripslashes($nValue);
	}
	public function getKeywords($nValue) {
		return $this->keywords;
	}
	public function setKeywords( $nValue) {
		$this->$keywords=stripslashes($nValue);
	}
	public function getSapo() {
		return $this->sapo;
	}
	public function setSapo($nValue) {
		$this->$sapo=stripslashes($nValue);
	}
	public function getDetails() {
		return $this->details;
	}
	public function setDetails( $nVlaue) {
		$this->$details=stripslashes($nValue);
	}
	public function getStatus() {
		return $this->status;
	}
	public function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}	
	public function setStatus($nValue) {
		$this->$status = $nValue;
	}
	public function isEnabled() {
		return ($this->status == 1?1:0);
	}
	public function isDeleted() {
		return ($this->status == 2?1:0);
	}
	public function isDisabled() {
		return ($this->status == 0?1:0);
	}
	public function getPosition() {
		return $this->position;
	}
	public function setPosition($nValue) {
		$this->position = $nValue;
	}
	
	public function isImage() {
		$img = $this->avatar;
		if($this->avatar) $img = $this->avatar;
		if(preg_match("/jpg|JPEG|png|bmp|gif/",$img)) return 1;
		return 0;
	}
	public function isFlash() {
		$img = $this->avatar;
		if($this->avatar) $img = $this->avatar;
		if(preg_match("/.swf/",$img)) return 1;
		return 0;
	}
}	
?>