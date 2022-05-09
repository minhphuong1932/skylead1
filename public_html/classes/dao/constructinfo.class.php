<?php
/*************************************************************************
Class product unit
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Last updated: 01/08/2012
**************************************************************************/
class ConstructInfo {
	var $id;			# currency code (primary key)
	var $store_id;		
	var $user_id;
	var $slug;			# slug name construct
	var $name;			# Name method
	var $primary;		# Wether this currency is default or not
	var $position;		# Position
	var $status;		# 0-Disabled, 1-Active, 2-Deleted
	# Constructor
	function __construct($slug, $name, $primary=0, $position=0,$status=0, $user_id=0, $store_id=0, $id = 0)
	{
		$this->id = $id;
		$this->store_id=$store_id;
		$this->user_id=$user_id;
		$this->slug = $slug;
		$this->name = $name;
		$this->primary = $primary;
		$this->position = $position;
		$this->status = $status;
	}
	function ConstructInfo($slug, $name, $primary=0, $position=0,$status=0, $user_id=0, $store_id=0, $id = 0)
	{
		$this->__construct($slug, $name, $primary, $position,$status, $user_id, $store_id, $id);
	}

	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}	
	function getUserId() {
		return $this->user_id;
	}	
	function setUserId($nValue) {
		$this->user_id=$nValue;
	}	
	function getSlug() {
		return $this->slug;
	}	
	function setSlug($nValue) {
		$this->slug=$nValue;
	}
	function getName() {
		return $this->name;
	}	
	function setName($nValue) {
		$this->name=$nValue;
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
	function getPrimary() {
		return $this->primary;
	}
	function setPrimary($nValue) {
		$this->primary = $nValue;
	}
	function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
}	
?>