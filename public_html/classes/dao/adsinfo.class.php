<?php
/*************************************************************************
Class Ad
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Last updated: 21/09/2011
Coder: Tran Thi My Xuyen
Checked by: Mai Minh (26/09/2011)
**************************************************************************/
class AdsInfo {
	public $aId;			# Ad code (primary key)
	private $store_id;				
	private $gid;			# Group of the ad
	private $logo_url;		# Ad logo URL
	private $url;			# Ad URL
	private $status;		# 0-Disabled, 1-Active, 2-Deleted
	private $position;		# Display order
	private $viewed;		# Number of views
	private $date_created;	# Date created
	private $properties;	# Properties
	private $content;
	private $tid;
	
	# Constructor
	function __construct($tid,$logo_url, $url, $status=0, $position=0, $viewed=0,$date_created='',$properties='',$content='',$gid = 0, $store_id=0,$aId = 0)
	{
		$this->aId = $aId;
		$this->store_id=$store_id;
		$this->gid = $gid;
		$this->logo_url = $logo_url;
		$this->url = $url;
		$this->status = $status;
		$this->position = $position;
		$this->viewed = $viewed;
		$this->date_created = $date_created;
		$this->properties = unserialize($properties);
		$this->content=$content;
		$this->tid=$tid;
	}
	public function AdsInfo($tid,$logo_url, $url, $status=0, $position=0, $viewed=0,$date_created='',$properties='',$content='',$gid = 0, $store_id=0,$aId = 0)
	{
		$this->__construct($tid,$logo_url, $url, $status, $position, $viewed, $date_created, $properties, $content, $gid, $store_id, $aId);
	}

	public function getId() {
		return $this->aId;
	}	
	public function setId($nValue) {
		$this->aId=$nValue;
	}	
	public function getTId() {
		return $this->tid;
	}	
	public function setTId($nValue) {
		$this->tid=$nValue;
	}	
	public function getContent($lang = 'vn') {
		if($lang == 'vn')	return $this->content;
		elseif($lang == 'en')	return $this->properties['detail_en'];
		else return $this->content;	
	}
	public function getCaption($lang = 'vn') {
		if($lang == 'vn')	return $this->properties['caption'];
		elseif($lang == 'en')	return $this->properties['caption_en'];
		else return $this->properties['caption'];	
	}
	public function setContent($nValue) {
		$this->content=stripslashes($nValue);
	}
	public function getGId() {
		return $this->gid;		
	}
	public function setGId($nValue) {
		$this->gid=$nValue;
	}
	public function getCatName() {
		include_once(ROOT_PATH."classes/dao/adscategories.class.php");
		$adsCategories = new AdsCategories($this->store_id);
		return $adsCategories->getNameFromId($this->gid);
	}
	public function getLogoUrl() {
		if($this->logo_url) return $this->logo_url;
	}
	public function setLogoUrl($nValue) {
		$this->logo_url=$nValue;
	}
	public function getViewed() {
		return $this->viewed;
	}	
	public function setViewed($nValue) {
		$this->viewed=$nValue;
	}
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
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
	public function getUrl() {
		return $this->url;		
	}
	public function setUrl($nValue) {
		$this->url=$nValue;
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