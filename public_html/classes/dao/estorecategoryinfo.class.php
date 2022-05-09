<?php
/*************************************************************************
Class EstoreCategory
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 03/10/2011
Author: Mai Minh
**************************************************************************/
class EstoreCategoryInfo {
	public $id;			# Primary key
	private $parent_id;		# Parent category
	private $slug;			# Slug
	private $name;			# Category name
	private $position;		# Position
	private $properties;	# Properties
	private $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished

	# Constructor
	public function __construct($slug, $name, $position, $properties, $status, $parent_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->parent_id = $parent_id;
		$this->slug = $slug;
		$this->name = stripslashes($name);
		$this->position = $position;
		$this->properties = unserialize($properties);
		$this->status = $status;
	}
	public function EstoreCategoryInfo($slug, $name, $position, $properties, $status, $parent_id = 0, $id = 0)
	{
		$this->__construct($slug, $name, $position, $properties, $status, $parent_id, $id);
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
	public function getSlug() {
		return $this->slug;
	}	
	public function setSlug($nValue) {
		$this->slug=$nValue;
	}
	public function getName() {
		return $this->name;		
	}
	public function setName($nValue) {
		$this->name=stripslashes($nValue);
	}
	public function getPosition() {
		return $this->position;
	}	
	public function setPosition($nValue) {
		$this->position=$nValue;
	}
	public function getNumEstores() {
		include_once(ROOT_PATH."classes/dao/estores.class.php");
		$Estores = new Estores($this->store_id);
		$rowsPages = $Estores->getNumItems('id', "`cat_id` = '".$this->id."'");
		return $rowsPages['rows'];
	}
	public function getNumActiveEstores() {
		include_once(ROOT_PATH."classes/dao/estores.class.php");
		$Estores = new Estores($this->store_id);
		$rowsPages = $Estores->getNumItems('id', "`cat_id` = '".$this->id."' AND `status` ='1'");
		return $rowsPages['rows'];
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
	public function getUrl($page = 1, $keywords = '', $sort_key = 'position', $sort_direction = 'asc') {
		$url = '';
		if(URL_TYPE == 1 || $page > 1) {	# Query string
			$url = '/'.SCRIPT.'?act=category&id='.$this->id.'&pg='.$page.'&kw='.$keywords.'&sk='.$sort_key.'&sd='.$sort_direction;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			$url = '/ac'.$this->id.'/'.$this->slug.'.html';
			return $url;
		} else return '';	
	}
	public function getChildren($page = 1, $condition = "`status` = '1'", $sort = array('position' => 'asc'), $items_per_page = 100) {
		include_once(ROOT_PATH."classes/dao/Estorecategories.class.php");
		$estoreCategories = new EstoreCategories();
		$estoreCategoryItems = $estoreCategories->getObjects($page,"`parent_id` = '".$this->id."' AND $condition",$sort,items_per_page);
		return $EstoreCategoryItems;
	}
}	
?>