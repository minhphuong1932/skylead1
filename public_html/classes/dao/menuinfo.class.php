<?php
/*************************************************************************
Class MenuInfo
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Name: Nguyen Anh Ngoc                        
Last updated: 07/10/2009
Checked by: Mai Minh (29/09/2011)
**************************************************************************/
class MenuInfo {
	public $id;			# Primary key
	private $parent_id;		# Parent menu
	private $store_id;
	private $cId;			# Menu category ID
	private $name;			# Vietnamese name
	private $url;			# Vietnamese url
	private $status;		# Status
	private $position;		# Order position
	private $properties;
	
	public function __construct ($name, $url,$status, $position,$properties='',$mcId,$store_id, $parent_id = 0, $mId = 0)
	{
		$this->id = $mId;
		$this->parent_id = $parent_id;
		$this->store_id = $store_id;
		$this->cId= $mcId;
		$this->name = $name;
		$this->url = stripslashes(htmlspecialchars($url));
		$this->status = $status;
		$this->position = $position;
		$this->properties = unserialize($properties);
	}
	public function MenuInfo ($name, $url,$status, $position,$properties='',$mcId,$store_id, $parent_id = 0, $mId = 0)
	{
		$this->__construct($name, $url,$status, $position,$properties,$mcId,$store_id, $parent_id , $mId);
	}

	public function getId() {
		return $this->id;
	}	
	public function setId($nValue){
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
	public function getName($lang = 'vn') {
		if($lang == 'vn')	return $this->name;
		else return $this->properties['custom_'.$lang.'_name'];
	}
	public function setName($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->name=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_name']=stripslashes($nValue);
	}
	public function getCId() {
		return $this->cId;
	}
	public function setCId($nValue) {
		$this->cId = $nValue;
	}
	public function getUrl($lang = 'vn') {
		if($lang == 'vn')	return $this->url;
		else	return $this->properties['custom_'.$lang.'_url'];
	}
	public function setUrl($lang = 'vn', $nVlaue) {
		if($lang == 'vn')	$this->url=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_url']=stripslashes($nValue);
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
	public function getPosition() {
		return $this->position;
	}
	public function setPosition($nValue) {
		$this->position = $nValue;
	}
	
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	public function getCatName() {
		include_once(ROOT_PATH."classes/dao/menucategories.class.php");
		$menuCategories = new MenuCategories($this->store_id);
		return $menuCategories->getNameFromId($this->parent_id);
	}
	public function getChildren($page = 1, $condition = "`status` = '1'", $sort = array('position' => 'asc'), $items_per_page = 100) {
		include_once(ROOT_PATH."classes/dao/menus.class.php");
		$menus = new Menus($this->store_id);
		$Items = $menus->getObjects($page,"`parent_id` = '".$this->id."' AND $condition",$sort,$items_per_page);
		return $Items;
	}
}	
?>