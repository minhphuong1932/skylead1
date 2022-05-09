
<?php
/*************************************************************************
Class AdsCategoryInfo
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Name: Mai Minh                                   
Last updated: 18/09/2011
**************************************************************************/	

class  AdsCategoryInfo {
	public $id;			# Primary key
	private $store_id;		
	private $name;		# Vietnamese name
	private $status;		# Status
	private $properties;
	private $pid;
	
	function __construct($pid,$store_id=0, $name='', $status='',$properties='', $acId=0) {
		$this->id = $acId;
		$this->store_id=$store_id;
		$this->name = stripslashes(htmlspecialchars($name));
		$this->status = $status;
		$this->pid = $pid;
		$this->properties = unserialize($properties);
	}
	public function AdsCategoryInfo($pid,$store_id=0, $name='', $status='',$properties='', $acId=0) {
		$this->__construct($pid,$store_id, $name, $status,$properties, $acId);
	}
	
	public function getPId() {
		return $this->pid;
	}	
	
	public function setPId($nValue) {
		$this->pid=$nValue;
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
	
	public function getActiveAds() {
		include_once(ROOT_PATH."classes/dao/ads.class.php");
		$ads = new Ads($this->store_id);
		$rowsPages = $ads->getNumItems('id', "`gid` = '".$this->id."' AND `status` = '1'");
		return $rowsPages['rows'];
	}	
	
	public function getNumAds() {
		include_once(ROOT_PATH."classes/dao/ads.class.php");
		$ads = new Ads($this->store_id);
		$rowsPages = $ads->getNumItems('id', "`gid` = '".$this->id."'");
		return $rowsPages['rows'];
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

	public function getName() {
		return $this->name;		
	}
	public function setName($nValue) {
		$this->name=stripslashes($nValue);
	}
	
	public function getStatus() {
		return $this->status;
	}
	

	public function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
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
}
?>