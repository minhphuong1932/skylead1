<?php
/*************************************************************************
Class Staticinfo
----------------------------------------------------------------
Bido.vn Project
Company: Derasoft Co., Ltd                                  
Last updated: 15/09/2011
Coder: Tran Thi My Xuyen                                   
**************************************************************************/
class Staticinfo {
	public $id;			# Primary key
	private $store_id;		# Estore Id 
	private $slug;			# Slug
	private $block;			# Slug
	private $title;			# Title
	private $keywords;		# Keywords
	private $sapo;			# Sapo
	private $details;		# Details
	private $date_created;	# Date created
	private $status;		# Status
	private $position;		#Position
	private $properties;	# Properties
	public function __construct ($slug='',$block = '', $title='', $keywords,$sapo='',$details, $date_created, $status='',$position,  $properties = '', $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->slug = $slug;
		$this->block = $block;
		$this->title = stripslashes($title);
		$this->keywords = stripslashes($keywords);
		$this->sapo = stripslashes($sapo);
		$this->details = stripslashes($details);
		$this->date_created = $date_created;
		$this->status = $status;
		$this->position = $position;
		$this->properties = unserialize($properties);
	}
	public function Staticinfo ($slug='',$block = '', $title='', $keywords,$sapo='',$details, $date_created, $status='',$position,  $properties = '', $store_id = 0, $id = 0)
	{
		$this->__construct($slug,$block, $title, $keywords,$sapo,$details, $date_created, $status,$position,  $properties , $store_id , $id );
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
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
	public function getTitle($lang = 'vn') {
		if($lang == 'vn')	return $this->title;
		else return $this->properties['custom_'.$lang.'_title'];
	}
	public function setTitle($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->title=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_title']=stripslashes($nValue);
	}
	public function getKeywords($lang = 'vn') {
		if($lang == 'vn')	return $this->keywords;
		else return $this->properties['custom_'.$lang.'_keyword'];
	}
	public function setKeywords($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->$keywords = stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_keyword']=stripslashes($nValue);
	}
	public function getSapo($lang = 'vn') {
		if($lang == 'vn')	return $this->sapo;
		else return $this->properties['custom_'.$lang.'_sapo'];
	}
	public function setSapo($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->sapo=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_sapo']=stripslashes($nValue);
	}
	public function getDetails($lang = 'vn') {
		if($lang == 'vn')	return $this->details;
		else return $this->properties['custom_'.$lang.'_detail'];
	}
	public function setDetails($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->detail=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_detail']=stripslashes($nValue);
	}
	public function getDateCreated() {
		return $this->date_created;
	}
	public function setDateCreated( $nVlaue) {
		$this->$date_created=$nValue;
	}
	public function getStatus() {
		return $this->status;
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
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
	public function getUrl($lang='vn') {
		$url = '';
		if(URL_TYPE == 1) {	# Query string
			$url = '/'.SCRIPT.'?act=static&id='.$this->id;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			if($lang == 'en')	$url = '/en/'.$this->slug.'.htm';
			else $url = '/'.$this->slug.'.htm';
			return $url;
		} else return '';	
	}
}	
?>