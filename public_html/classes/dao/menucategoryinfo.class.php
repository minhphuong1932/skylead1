<?php
/*************************************************************************
Class MenuGroupInfo
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd 
Update: 22/09/2011
Coder: Tran Thi My Xuyen
Checked by: Mai Minh (29/09/2011)
**************************************************************************/
class MenuCategoryInfo {
	public $mcId;			# Primary key
	private $name;			# Vietnamese name
	private $status;		# Status
	private $store_id;	
	private $properties;
	
	public function __construct($name, $status, $properties, $store_id, $mcId = 0)
	{
		$this->mcId = $mcId;	
		$this->store_id = $store_id;
		$this->name = stripslashes(htmlspecialchars($name));
		$this->status = $status;
		$this->properties = unserialize($properties);
	}
	public function MenuCategoryInfo($name, $status, $properties, $store_id, $mcId = 0)
	{
		$this->__construct($name, $status, $properties, $store_id, $mcId);
	}
	public function getId() {
		return $this->mcId;
	}	
	public function setId($nValue) {
		$this->mcId=$nValue;
	}
	
	public function getProperty($key)
	{
		if(isset($this->properties['0'][$id][$key])) return ''.$this->properties['0'][$id][$key];
		return '';
	}
	public function getProperties()
	{
		return $this->properties;
	}
	
	public function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
	
	public function getStoreId() {
		return $this->store_id;
	}	
	
	public function StoreId($nValue) {
		$this->store_id=$nValue;
	}
	
	public function getActiveMenus() {
		include_once(ROOT_PATH."classes/dao/menus.class.php");
		$menus = new Menus($this->store_id);
		$rowsPages = $menus->getNumItems('id', "`mgid` = '".$this->id."' AND `status` = '1'");
		return $rowsPages['rows'];
	}	

	public function getNumMenus() {
		include_once(ROOT_PATH."classes/dao/menus.class.php");
		$menus = new Menus($this->store_id);
		$rowsPages = $menus->getNumItems('id', "`mgid` = '".$this->id."'");
		return $rowsPages['rows'];
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
	
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
}
?>