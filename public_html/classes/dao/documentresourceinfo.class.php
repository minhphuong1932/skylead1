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
class DocumentResourceInfo {
	var $id;			# Ad code (primary key)
	var $store_id;				
	var $user_id;
	var $gid;			# Group of the ad
	var $name; 			# name 
	var $code;			# code
	var $agency;			# place
	var $logo_url;		# Ad logo URL
	var $url;			# Ad URL
	var $status;		# 0-Disabled, 1-Active, 2-Deleted
	var $position;		# Display order
	var $viewed;		# Number of views
	var $date_created;	# Date created
	var $date_ussed;	#Date ussed
	var $properties;	# Properties
	var $content;
	var $content_brief;
	var $content_compare; 
	# Constructor
	function __construct($name, $code, $agency, $logo_url, $url, $status=0, $position=0, $viewed=0,$date_created='',$date_ussed, $properties='',$content='', $content_brief, $content_compare, $gid = 0,$user_id = 0, $store_id=0,$id = 0)
	{
		$this->id = $id;
		$this->store_id=$store_id;
		$this->user_id=$user_id;
		$this->gid = $gid;
		$this->name = $name;
		$this->code = $code;
		$this->agency = $agency;
		$this->logo_url = $logo_url;
		$this->url = $url;
		$this->status = $status;
		$this->position = $position;
		$this->viewed = $viewed;
		$this->date_created = $date_created;
		$this->date_ussed = $date_ussed;
		$this->properties = unserialize($properties);
		$this->content=stripslashes($content);
		$this->content_brief=stripslashes($content_brief);
		$this->content_compare=stripslashes($content_compare);
	}
	function DocumentResourceInfo($name, $code, $agency, $logo_url, $url, $status=0, $position=0, $viewed=0,$date_created='',$date_ussed, $properties='',$content='', $content_brief, $content_compare, $gid = 0,$user_id = 0, $store_id=0,$id = 0)
	{
		$this->__construct($name, $code, $agency, $logo_url, $url, $status, $position, $viewed,$date_created,$date_ussed, $properties,$content, $content_brief, $content_compare, $gid ,$user_id, $store_id,$id);
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
	function getContent() {
		return $this->content;		
	}
	function setContent($nValue) {
		$this->content=stripslashes($nValue);
	}
	function getContentBrief() {
		return $this->content_brief;		
	}
	function setContentBrief($nValue) {
		$this->content_brief=stripslashes($nValue);
	}
	function getContentCompare() {
		return $this->content_compare;		
	}
	function setContentCompare($nValue) {
		$this->content_compare=stripslashes($nValue);
	}
	function getGId() {
		return $this->gid;		
	}
	function setGId($nValue) {
		$this->gid=$nValue;
	}
	function getName() {
		return $this->name;		
	}
	function setName($nValue) {
		$this->name=$nValue;
	}
	function getCatName() {
		include_once(ROOT_PATH."classes/dao/documentgalleries.class.php");
		$documentGalleries = new DocumentGalleries($this->store_id);
		return $documentGalleries->getNameFromId($this->gid);
	}
	function getUrlCat() {
		include_once(ROOT_PATH."classes/dao/documentgalleries.class.php");
		$documentGalleries = new DocumentGalleries($this->store_id);
		$documentGalleryItem = $documentGalleries->getObject($this->gid, 'id');
		if($documentGalleryItem) return $documentGalleryItem->getUrl();
	}
	function getCode() {
		return $this->code;		
	}
	function setCode($nValue) {
		$this->code=$nValue;
	}
	function getAgency() {
		return $this->agency;		
	}
	function setAgency($nValue) {
		$this->agency=$nValue;
	}
	function getLogoUrl() {
		if($this->logo_url) return $this->logo_url;
	}
	function setLogoUrl($nValue) {
		$this->logo_url=$nValue;
	}
	function getViewed() {
		return $this->viewed;
	}	
	function setViewed($nValue) {
		$this->viewed=$nValue;
	}
	function getDateCreated()
	{
		return $this->date_created;
	}
	function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}

	function getDateUssed()
	{
		return $this->date_ussed;
	}
	function setDateUssed($nValue)
	{
		$this->date_ussed=$nValue;
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
	function getLinkDetail() {
		$url = '';
		if(URL_TYPE == 1 || $page > 1) {	# Query string
			$url = '/'.SCRIPT.'?act=article&id='.$this->id;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			//$url = '/'.$this->getCatSlug().'/'.$this->slug.'-'.$this->id.'.htm';
			$url = '/'.SCRIPT.'?op=document&act=document&mod=detail&id='.$this->id;
			return $url;
		} else return '';		
	}
    function getUrl() {
		return $this->url;		
	}
	function setUrl($nValue) {
		$this->url=$nValue;
	}
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
	function getPosition() {
		return $this->position;
	}
	function setPosition($nValue) {
		$this->position = $nValue;
	}
	function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
    function FormatDate($date = '', $lang = 'VN', $return = 'd/m/Y H:i:s', $returnDay = 1, $returnTxt = 0) {
	# returnDay = 1 => "Thứ hai, 18/12/2012
	# returnTxt = 1 => "Hôm qua, Thứ hai 18/12/2012
	
	if(!$date) $date = mktime();
	$week[0]['VN'] = 'Chủ nhật';
	$week[1]['VN'] = 'Thứ hai';
	$week[2]['VN'] = 'Thứ ba';
	$week[3]['VN'] = 'Thứ tư';
	$week[4]['VN'] = 'Thứ năm';
	$week[5]['VN'] = 'Thứ sáu';
	$week[6]['VN'] = 'Thứ bảy';
	$today['VN'] = 'Hôm nay';
	$tomorrow['VN'] = 'Ngày mai - ';
	$yesterday['VN'] = 'Hôm qua - ';
	$wd = date("w",$date);
	$txtDay = ($returnDay?$week[$wd][$lang].", ":"").date($return,$date);
	if($wd == date("w")) $txtDay = $today[$lang];
	if($wd == date("w",mktime()+86400)) $txtDay = $tomorrow[$lang].$week[$wd][$lang].", ".date($return,$date);
	if($wd == date("w",mktime()-86400)) $txtDay = $yesterday[$lang].$week[$wd][$lang].", ".date($return,$date);
	if($returnTxt) return $txtDay;
	
	if($lang == 'VN') return ($returnDay?$week[$wd][$lang].", ":"").date($return,$date);
	return date("l, ".$return,$date);
    }
    function getDateCreatedFormat()
	{
	   $dateCreated=$this->getDateCreated();
        $dateCreated=strtotime($dateCreated);
        $dateCreated=$this->FormatDate($dateCreated);
        return  $dateCreated;      
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
}	
?>