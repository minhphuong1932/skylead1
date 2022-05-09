<?php
/*************************************************************************
Class Templates
----------------------------------------------------------------
Bido.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/19/2010
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/templateinfo.class.php");

class Templates extends Model{
	public $table;
	public $_db;

	public function __construct($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."templates";	
	}	
	public function Templates($database = '') {
		$this->__construct($database);
	}	
/* Common methods
/*-----------------------------------------------------------------------*
* public function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	public $id;
	private $owner_id;
	private $name;
	private $folder;
	private $type;
	private $properties;
	private $status;
	public function getObject($value = '0', $key = 'id') {
		if(!$key || !$value) return '';
		$result = $this->select('*',"`$key` = '$value'");
		if($result) {
			$object = new TemplateInfo
						(	$result[0]['owner_id'],
							$result[0]['name'],
							$result[0]['folder'],
							$result[0]['type'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['id']
						);
			return $object;
		}
		return 0;
	}
/*-----------------------------------------------------------------------*
* public function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	public function getObjects($page = 1, $condition = '`id` = 0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', $condition, $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new TemplateInfo
								(	$result['owner_id'],
									$result['name'],
									$result['folder'],
									$result['type'],
									$result['properties'],
									$result['status'],
									$result['id']
								);
			}
			return $objects;
		}
		return 0;
	}
	
	public function getTemplateFolderFromId($id = '0') {
		$result = $this->select('folder',"id = '$id' AND status='1'");
		if($result) return $result[0]['folder'];
		return '';
	}
	
	public function generateCombo($objects = array(''), $current = '') {
		$return = '';
		foreach($objects as $object) {
			$return .= '<option value="'.$object->getId().'"'.($current == $object->getId()?' selected="selected"':'').'>'.$object->getName().'</option>';
		}
		return $return;
	}
}
?>