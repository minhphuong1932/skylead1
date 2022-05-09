<?php
/*************************************************************************
Class DisctrictInfo
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
Eit by Quang Tri
**************************************************************************/
class DisctrictInfo {
	var $id;			# Primary key
	var $name;			# Category name
	var $shipprice;			# Category name
	var $provinceid;	# provinceid
	# Constructor
	function __construct($name, $shipprice, $provinceid, $id = 0)
	{
		$this->id = $id;
		$this->name = stripslashes($name);
		$this->shipprice = $shipprice;
		$this->provinceid = $provinceid;
	}
	function DisctrictInfo($name, $shipprice, $provinceid, $id = 0)
	{
		$this->__construct($name, $shipprice, $provinceid, $id);
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getName() {
		return $this->name;		
	}
	function setName($nValue) {
		$this->name=stripslashes($nValue);
	}
	function getProvinceid() {
		return $this->provinceid;		
	}
	function setProvinceid($nValue) {
		$this->provinceid=stripslashes($nValue);
	}

	function getShipprice() {
		return $this->shipprice;		
	}
	function setShipprice($nValue) {
		$this->shipprice=stripslashes($nValue);
	}
}	
?>

