<?php
/*************************************************************************
Class QuestionInfo
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class GroupsInfo {
	public $id;			# Primary key
	private $name;			# Slug
	
	private $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished

	# Constructor
	public function __construct($name, $status, $id = 0)
	{
		$this->id = $id;
		$this->name = $name;
		$this->status = $status;
	}
	public function GroupsInfo($name, $status, $id = 0)
	{
		$this->__construct($name, $status, $id);
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
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
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['groups'][$this->status];
	}
	
}	
?>