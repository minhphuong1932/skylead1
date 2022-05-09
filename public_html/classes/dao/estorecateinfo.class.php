<?php
/*************************************************************************
Class Order Item
----------------------------------------------------------------
Bido.vn Project
Name: Tran Thi My Xuyen
Last Update: 19/04/2012
**************************************************************************/
class EstoreCateInfo {
	public $id;		# Item ID
	private $sid;		# Restaurant ID
	private $cat_id;		# time start

	# Constructor
	public function __construct($sid, $cat_id, $id = 0)
	{
		$this->id = $id;
		$this->sid = $sid;
		$this->cat_id = $cat_id;
	}
	public function EstoreCateInfo($sid, $cat_id, $id = 0)
	{
		$this->__construct($sid, $cat_id, $id);
	}
	public function getId() {
		return $this->id;
	}	
	public function setId($nValue) {
		$this->id=$nValue;
	}
	public function getSId() {
		return $this->sid;
	}	
	public function setSId($nValue) {
		$this->sid=$nValue;
	}
	public function getCatId() {
		return $this->cat_id;
	}	
	public function setCatId($nValue) {
		$this->cat_id=$nValue;
	}
	public function getCatName() {
		include_once(ROOT_PATH."classes/dao/estorecategories.class.php");
		$estoreCategories = new EstoreCategories($this->sid);
		return $estoreCategories->getNameFromId($this->cat_id);
	}
	
}	
?>