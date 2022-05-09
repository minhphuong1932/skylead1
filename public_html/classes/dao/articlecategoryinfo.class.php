<?php
/*************************************************************************
Class ArticleCategory
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 09/09/2010
Author: Tran Thi My Xuyen
Checked by: Mai Minh (22/09/2011)
**************************************************************************/
class ArticleCategoryInfo {
	public $id;			# Primary key
	private $parent_id;		# Parent category
	private $store_id;		# Estore id
	private $slug;			# Slug
	private $name;			# Category name
	private $keyword;		#Keyword
	private $sapo;			# Sapo
	private $position;		# Position
	private $viewed;		# Number of views
	private $properties;	# Properties
	private $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	private $slug_en;	
        # New constructor
	function __construct($slug_en,$slug, $name, $keyword, $sapo, $position, $viewed, $properties, $status, $store_id = 0, $parent_id = 0, $id = 0) 
        {
		$this->id = $id;
		$this->parent_id = $parent_id;
		$this->store_id = $store_id;
		$this->slug = $slug;
		$this->slug_en = $slug_en;
		$this->name = stripslashes($name);
		$this->keyword = stripslashes($keyword);
		$this->sapo = stripslashes($sapo);
		$this->position = $position;
		$this->viewed = $viewed;
		$this->properties = unserialize($properties);
		$this->status = $status;
	}

	# Old constructor
    public function ArticleCategoryInfo($slug_en,$slug, $name, $keyword, $sapo, $position, $viewed, $properties, $status, $store_id = 0, $parent_id = 0, $id = 0)
    {
        $this->__construct($slug_en,$slug, $name, $keyword, $sapo, $position, $viewed, $properties, $status, $store_id, $parent_id, $id);
    }

	public function getSlugEN() {
		return $this->slug_en;
	}	
	public function setSlugEN($nValue) {
		$this->slug_en=$nValue;
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getParentId() {
		return $this->parent_id;
	}
	public function setParentId($nValue) {
		$this->parent_id=$nValue;
	}
	public function getStoreId() {
		return $this->store_id;
	}
	public function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	public function getSlug($lang='vn') {
		if($lang == 'vn'){
			return $this->slug;
		}elseif(isset($this->properties['custom_'.$lang.'_slug'])){
			return $this->properties['custom_'.$lang.'_slug'];
		}
	}	
	public function setSlug($nValue,$lang='vn') {
		if($lang=='vn') $this->slug=stripslashes($nValue);
		else $this->slug_en=stripslashes($nValue);
	}
	public function getName($lang='vn') {
		if($lang=='vn')	return $this->name;
		elseif(isset($this->properties['custom_'.$lang.'_name'])) return $this->properties['custom_'.$lang.'_name'];
	}
	public function setName($nValue,$lang='vn') {
		if($lang=='vn') $this->name=stripslashes($nValue);
		else $this->properties['custom_'.$lang.'_name']=stripslashes($nValue);
	}
	public function getKeyword($lang='vn') {
		if($lang=='vn')	return $this->keyword;
		elseif(isset($this->properties['custom_'.$lang.'_keyword'])) return $this->properties['custom_'.$lang.'_keyword'];
	}
	public function setKeyword($nValue) {
		
		if($lang=='vn')$this->keyword=stripslashes($nValue);
		else  $this->properties['custom_'.$lang.'_keyword']=stripslashes($nValue);
	}
	public function getSapo($lang='vn') {
		if($lang=='vn')	return $this->sapo;
		elseif(isset($this->properties['custom_'.$lang.'_sapo'])) return $this->properties['custom_'.$lang.'_sapo'];
	}
	public function setSapo($nValue,$lang='vn') {
		if($lang=='vn')$this->sapo=stripslashes($nValue);		
		else  $this->properties['custom_'.$lang.'_sapo']=stripslashes($nValue);
	}
	public function getPosition() {
		return $this->position;
	}	
	public function setPosition($nValue) {
		$this->position=$nValue;
	}
	public function getNumArticles() {
		include_once(ROOT_PATH."classes/dao/articles.class.php");
		$articles = new Articles($this->store_id);
		$rowsPages = $articles->getNumItems('id', "`cat_id` = '".$this->id."'");
		return $rowsPages['rows'];
	}
	public function getNumActiveArticles() {
		include_once(ROOT_PATH."classes/dao/articles.class.php");
		$articles = new Articles($this->store_id);
		$rowsPages = $articles->getNumItems('id', "`cat_id` = '".$this->id."' AND `status` ='1'");
		return $rowsPages['rows'];
	}
	public function getViewed() {
		return $this->viewed;
	}	
	public function setViewed($nValue) {
		$this->viewed=$nValue;
	}
	public function getProperty($key)
	{
		if(isset($this->properties[$key])) return ''.$this->properties[$key];
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
		return $amessages['status'][$this->status];
	}
	public function getUrl($lang='vn',$page = 1, $keywords = '', $sort_key = 'position', $sort_direction = 'asc') {
		$url = '';
		if(URL_TYPE == 1 || $page > 1) {	# Query string
			$url = '/'.SCRIPT.'?act=category&id='.$this->id.'&pg='.$page.'&kw='.$keywords.'&sk='.$sort_key.'&sd='.$sort_direction.'&lang='.$lang;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			$url = "/".$this->slug.'-'.$this->id.($page>1?'-p'.$page:'').'.html';
			return $url;
		} else return '';	
	}
	public function getUrlNoId($lang='vn',$page = 1, $keywords = '', $sort_key = 'position', $sort_direction = 'asc') {
		$url = '';
		if(URL_TYPE == 1 || $page > 1) {	# Query string
			$url = '/'.SCRIPT.'?act=category&id='.$this->id.'&pg='.$page.'&kw='.$keywords.'&sk='.$sort_key.'&sd='.$sort_direction.'&lang='.$lang;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			$url = "/".$this->slug.($page>1?'-p'.$page:'').'.html';
			return $url;
		} else return '';	
	}
	public function getChildren($page = 1, $condition = "`status` = '1'", $sort = array('position' => 'asc'), $items_per_page = 100) {
		include_once(ROOT_PATH."classes/dao/articlecategories.class.php");
		$articleCategories = new ArticleCategories($this->store_id);
		$articleCategoryItems = $articleCategories->getObjects($page,"`parent_id` = '".$this->id."' AND $condition",$sort,items_per_page);
		return $articleCategoryItems;
	}
}	
?>