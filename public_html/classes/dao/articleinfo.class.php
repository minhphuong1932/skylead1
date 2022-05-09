<?php
/*************************************************************************
Class Article
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 16/04/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class ArticleInfo {
	public $id;			# Primary key
	private $store_id;		# Estore id
	private $cat_id;		# Category id
	private $slug;			# Slug
	private $title;			#Title
	private $keyword;		#Keyword
	private $sapo;			# Sapo
	private $detail;		# Detail
	private $viewed;		# Number of views
	private $date_created;	# Date created
	private $date_update;	# Date created
	private $position;
	private $properties;	# Properties
	private $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	private $status_duyet;
	private $home;			# Display in home page
	private $banner;
	private $dateshow;
	private $listcat;
	private $price1;
	private $price2;
  
  function __construct($slug, $title, $keyword, $sapo, $detail,$viewed, $date_created, $date_update, $position, $properties, $status, $status_duyet, $home, $banner,$dateshow,$listcat,$price1,$price2, $cat_id = 0, $store_id = 0, $id = 0) 
  {
		$this->id = $id;
		$this->store_id = $store_id;
		$this->cat_id = $cat_id;
		$this->slug = stripslashes($slug);
		$this->title = stripslashes($title);
		$this->keyword = stripslashes($keyword);
		$this->sapo = stripslashes($sapo);
		$this->detail = stripslashes($detail);
		$this->viewed = $viewed;
		$this->date_created = $date_created;
		$this->date_update = $date_update;
		$this->position = $position;
		$this->properties = unserialize($properties);
		$this->status = $status;
		$this->status_duyet = $status_duyet;
		$this->home = $home;
		$this->banner = $banner;
		$this->dateshow = $dateshow;
		$this->listcat = $listcat;
		$this->price1 = $price1;
		$this->price2 = $price2;
	}
	# Constructor
	public function ArticleInfo($slug, $title, $keyword, $sapo, $detail,$viewed, $date_created, $date_update, $position, $properties, $status, $status_duyet, $home, $banner,$dateshow,$listcat,$price1,$price2, $cat_id = 0, $store_id = 0, $id = 0)
	{
		$this->__construct($slug, $title, $keyword, $sapo, $detail,$viewed, $date_created, $date_update, $position, $properties, $status, $status_duyet, $home, $banner,$dateshow,$listcat,$price1,$price2, $cat_id , $store_id , $id);
	}
	public function getPrice1() {
		return $this->price1;
	}	
	public function setPrice1($nValue) {
		$this->price1=$nValue;
	}
	public function getPrice2() {
		return $this->price2;
	}	
	public function setPrice2($nValue) {
		$this->price2=$nValue;
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getDateShow() {
		return $this->dateshow;
	}	
	public function setDateShow($nValue) {
		$this->dateshow=$nValue;
	}
	public function getListCat() {
		return $this->listcat;
	}	
	public function setListCat($nValue) {
		$this->listcat=$nValue;
	}
	public function getBanner() {
		return $this->banner;
	}	
	public function setBanner($nValue) {
		$this->banner=$nValue;
	}
	public function getStoreId() {
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	public function getCatId() {
		return $this->cat_id;
	}
	public function setCatId($nValue) {
		$this->cat_id=$nValue;
	}
	public function getCatSlug($lang = 'vn') {
		include_once(ROOT_PATH."classes/dao/articlecategories.class.php");
		$articleCategories = new ArticleCategories($this->store_id);
		return $articleCategories->getSlugFromId($this->cat_id);
		// if($lang == 'vn'){
		// 	return $articleCategories->getSlugFromId($this->cat_id);
		// }else{
		// 	$slug = $articleCategories->getSlugENFromId($this->cat_id);
		// 	if(isset($slug)){
		// 		return $slug;
		// 	}else{
		// 		return $articleCategories->getSlugFromId($this->cat_id);
		// 	}
			
		// }
	}
	public function getCatSlugEN() {
		include_once(ROOT_PATH."classes/dao/articlecategories.class.php");
		$articleCategories = new ArticleCategories($this->store_id);
		$slug = $articleCategories->getSlugENFromId($this->cat_id);
		if(isset($slug)){
			return $slug;
		}else{
			return $articleCategories->getSlugFromId($this->cat_id);
		}
		
	}
	public function getCatName() {
		include_once(ROOT_PATH."classes/dao/articlecategories.class.php");
		$articleCategories = new ArticleCategories($this->store_id);
		return $articleCategories->getNameFromId($this->cat_id);
	}
	public function getSlug($lang ='vn') {
		if($lang == 'vn'){
			return $this->slug;
		}elseif(isset($this->properties['custom_'.$lang.'_slug'])){
			return $this->properties['custom_'.$lang.'_slug'];
		}
	}
	public function getSlugEN() {
		if(isset($this->properties['custom_en_slug'])){
			return $this->properties['custom_en_slug'];
		}else return $this->slug;
	}

	public function setSlug($nValue) {
		$this->slug=stripslashes($nValue);
	}
	public function getTitle($lang = 'vn') {
		if($lang == 'vn'){
			return $this->title;
		}else{
			if(!empty($this->properties['custom_'.$lang.'_title'])){
				return $this->properties['custom_'.$lang.'_title'];
			}
		}
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
		if($lang == 'vn'){
			return $this->sapo;
		}else{
			if(!empty($this->properties['custom_tomtattienganh'])){
				return $this->properties['custom_tomtattienganh'];
			}
		}
	}
	public function setSapo($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->sapo=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_sapo']=stripslashes($nValue);
	}
	public function getDetails($lang = 'vn') {
		if($lang == 'vn')	return $this->detail;
		elseif($lang == 'en')	return $this->properties['en_detail'];
		else return $this->properties['en_detail'];
	}
	public function getDetailMore($lang = 'vn') {
		if($lang == 'vn')	return $this->properties['detailmore'];
		elseif($lang == 'en')	return $this->properties['detailmore_en'];
		else return $this->properties['detailmore'];
	}
	public function setDetails($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->detail=stripslashes($nValue);
		else	$this->properties['detail_en']=stripslashes($nValue);
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
	public function getDateUpdate()
	{
		return $this->date_update;
	}
	public function setDateUpdate($nValue)
	{
		$this->date_update=$nValue;
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
	public function getPosition() {
		return $this->position;
	}
	public function setPosition($nValue) {
		$this->position = $nValue;
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
	public function getStatusDuyet() {
		return $this->status_duyet;
	}
	public function setStatusDuyet($nValue) {
		$this->status_duyet = $nValue;
	}
	public function getHome() {
		return $this->home;
	}
	public function setHome($nValue) {
		$this->home = $nValue;
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	public function getUrl() {
		$url = '';
		if(URL_TYPE == 1) {	# Query string
			$url = "/$lang/".SCRIPT.'?act=article&id='.$this->id;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			$url = "/".$this->getCatSlug().'/'.$this->slug.'.html';
			return $url;
		} else return '';	
	}
	public function getArticleUrl($lang ='vn'){
		$url = $this->getSlug();
		return $url;
	}
	public function getBlogUrl(){
		$url =  $this->getCatSlug().'/'.$this->slug;
		return $url;
	}
	public function getReUrl(){
		$url =  $this->getCatSlug().'/'.$this->slug;
		return $url;
	}
}	
?>