
<?php
/*************************************************************************
Class AdsCategoryInfo
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                   
Last updated: 05/08/2012
**************************************************************************/	

class  DocumentGalleryInfo {
	var $id;			# Primary key
	var $store_id;		
	var $user_id;
	var $parent_id;
	var $slug;
	var $name;			# Vietnamese name
	var $date_created;
	var $status;		# Status
	var $position;
	var $free;
	var $properties;
	
	function __construct($slug, $name='', $date_created, $status='', $position, $free, $properties='',$parent_id = 0, $user_id = 0, $store_id=0, $id=0) {
		$this->id = $id;
		$this->store_id=$store_id;
		$this->user_id=$user_id;
		$this->parent_id=$parent_id;
		$this->slug = stripslashes(htmlspecialchars($slug));
		$this->name = stripslashes(htmlspecialchars($name));
		$this->date_created = $date_created;
		$this->status = $status;
		$this->position = $position;
		$this->free = $free;
		$this->properties = unserialize($properties);
	}
	function DocumentGalleryInfo($slug, $name='', $date_created, $status='', $position, $free, $properties='',$parent_id = 0, $user_id = 0, $store_id=0, $id=0) {
		$this->__construct($slug, $name, $date_created, $status, $position, $free, $properties,$parent_id , $user_id , $store_id, $id);
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
	
	function getParentId() {
		return $this->parent_id;
	}	
	
	function setParentId($nValue) {
		$this->parent_id=$nValue;
	}
	
	function getActiveAds() {
		include_once(ROOT_PATH."classes/dao/ads.class.php");
		$ads = new Ads($this->store_id);
		$rowsPages = $ads->getNumItems('id', "`gid` = '".$this->id."' AND `status` = '1'");
		return $rowsPages['rows'];
	}	
	
	function getNumResources() {
		include_once(ROOT_PATH."classes/dao/documentresources.class.php");
		$documentResources = new DocumentResources($this->store_id);
		$rowsPages = $documentResources->getNumItems('id', "`gid` = '".$this->id."'");
		return $rowsPages['rows'];
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
	
	function getStatus() {
		return $this->status;
	}
	
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
	
	function getPosition() {
		return $this->position;		
	}
	function setPosition($nValue) {
		$this->position=stripslashes($nValue);
	}
	
	function getFree() {
		return $this->free;		
	}
	function setFree($nValue) {
		$this->free=stripslashes($nValue);
	}
	function getFreeTextBackend() {
		global $amessages;
		return $amessages['free'][$this->free];
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
			# $url = '/'.$this->slug.'.htm';
            # edit $url by Quoc Minh
            $url = '/'.SCRIPT.'?op=document&act=text&mod=read&pId='.$this->id;
			return $url;
		} else return '';	
	}
	function getChildren($arryId, $page = 1, $condition = "`status` = '1'", $sort = array('position' => 'asc'), $items_per_page = 100) {
		include_once(ROOT_PATH."classes/dao/documentgalleries.class.php");
		$documentGalleries = new DocumentGalleries($this->store_id);
		if($arryId) $condition .= " and (`id` in (".$arryId.") or `free` = 0)";  
		$galleryCategoryItems = $documentGalleries->getObjects($page,"`parent_id` = '".$this->id."' AND $condition",$sort,items_per_page);
		return $galleryCategoryItems;
	}
	function getSubGallery($free=1, $page = 1, $condition = "`status` = '1'", $sort = array('position' => 'asc'), $items_per_page = 100) {
		include_once(ROOT_PATH."classes/dao/documentgalleries.class.php");
		$documentGalleries = new DocumentGalleries($this->store_id);
		$galleryCategoryItems = $documentGalleries->getObjects($page,"`parent_id` = '".$this->id."' AND `free` = '".$free."' AND $condition",$sort,items_per_page);
		return $galleryCategoryItems;
	}
    function getLastNews($number){
        include_once(ROOT_PATH.'classes/dao/documentresources.class.php');
        $documentResources = new DocumentResources($this->store_id);
		$documentItems = $documentResources->getObjects(1,"`gid` = '".$this->id."' AND `status` = '1'", array('position' => 'ASC'),$number);
        return $documentItems;
    }
}
?>