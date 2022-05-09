<?php
/*************************************************************************
Class Search
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 16/04/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class SearchInfo {
	public $id;			# Primary key
	private $store_id;		# Estore id
	private $slug;			# Slug
	private $title;			#Title
	private $keyword;		#Keyword
	private $sapo;			# Sapo
	private $detail;		# Detail
	private $status;		# Status
	private $search_id;			# Id product,article,static
    private $type;           #Type
    private $url;

	# Constructor
	
	public function __construct($slug, $title, $keyword, $sapo, $detail, $status,$search_id,$type,$url, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->slug = stripslashes($slug);
		$this->title = stripslashes($title);
		$this->keyword = stripslashes($keyword);
		$this->sapo = stripslashes($sapo);
		$this->detail = stripslashes($detail);
		$this->status = $status;
		$this->search_id = $search_id;
        $this->type = $type;
        $this->url = $url;
	}
	public function SearchInfo($slug, $title, $keyword, $sapo, $detail, $status,$search_id,$type,$url, $store_id = 0, $id = 0)
	{
		$this->__construct($slug, $title, $keyword, $sapo, $detail, $status,$search_id,$type,$url, $store_id, $id);
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
		$this->slug=stripslashes($nValue);
	}
	public function getTitle($lang = 'vn') {
		if($lang == 'vn')	return $this->title;
		else return $this->properties['custom_'.$lang.'_title'];
	}
	public function setTitle($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->title=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_title']=stripslashes($nValue);
	}
	public function getKeyword($lang = 'vn') {
		if($lang == 'vn')	return $this->keyword;
		else return $this->properties['custom_'.$lang.'_keyword'];		
	}
	public function setKeyword($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->keyword=stripslashes($nValue);
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
		if($lang == 'vn')	return $this->detail;
		elseif($lang == 'en')	return $this->properties['custom_'.$lang.'_details'];
		else return $this->properties['custom_'.$lang.'_detail'];
	}
	public function setDetails($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->detail=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_details']=stripslashes($nValue);
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
    public function getUrl() {
		return $this->url;
	}
	public function setUrl($nValue) {
		$this->url = $nValue;
	}
	public function getSearchId() {
		return $this->search_id;
	}
	public function setSearchId($nValue) {
		$this->search_id = $nValue;
	}
    public function getType() {
		return $this->type;
	}
	public function setType($nValue) {
		$this->type = $nValue;
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
}	
?>