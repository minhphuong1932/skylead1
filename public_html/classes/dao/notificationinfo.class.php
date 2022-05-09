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
class NotificationInfo {
	public $id;			# Ad code (primary key)
	private $store_id;				
	private $details;			# Group of the ad
	private $status;		# Ad logo URL
	private $created;			# Ad URL
	private $updated;		# 0-Disabled, 1-Active, 2-Deleted
	private $properties;		# Display order
	private $from_id;		# Number of views
	private $to_id;	# Date created
	private $link;

	function __construct($link,$to_id='', $from_id='', $properties='',$updated='',$created='',$status=0,$details='', $store_id=0,$id = 0)
	{
		$this->id = $id;
		$this->store_id=$store_id;
		$this->details = $details;
		$this->status = $status;
		$this->created = $created;
		$this->updated = $updated;
		$this->from_id = $from_id;
		$this->to_id = $to_id;
		$this->link = $link;
		$this->properties = unserialize($properties);
	}
	# Constructor
	public function NotificationInfo($link,$to_id='', $from_id='', $properties='',$updated='',$created='',$status=0,$details='', $store_id=0,$id = 0)
	{
		$this->__construct($link,$to_id, $from_id, $properties,$updated,$created,$status,$details,$store_id,$id);
	}
	public function getLink() {
		return $this->link;
	}	
	public function setLink($nValue) {
		$this->link=$nValue;
	}
	public function getDetails() {
		return $this->details;
	}	
	public function setDetails($nValue) {
		$this->details=$nValue;
	}
	public function getCreated() {
		return $this->created;
	}	
	public function setCreated($nValue) {
		$this->created=$nValue;
	}
	public function getUpdated() {
		return $this->updated;		
	}
	public function setUpdated($nValue) {
		$this->updated=$nValue;
	}
	public function getFromId() {
		return $this->from_id;		
	}
	public function setFromId($nValue) {
		$this->from_id=$nValue;
	}
	
	public function getToId() {
		return $this->to_id;
	}	
	public function setToId($nValue) {
		$this->to_id=$nValue;
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
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}

	
}	
?>