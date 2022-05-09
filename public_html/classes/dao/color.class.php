<?php
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/colorinfo.class.php");

	class Color extends Model {
		public $table;
		public $_db;
		private $store_id;
		
		public function __construct($store_id = 1, $database = '') {
			if(!$database) {
				global $db;
				$this->_db = $db;
			} else $this->_db = $database;
			$this->table = DB_PREFIX."color";
			$this->store_id = $store_id;
		}
		public function Color($store_id = 1, $database = '') {
			$this->__construct($store_id, $database);
		}
		
		/* Common methods
		/*-----------------------------------------------------------------------*
		* public function: getObject
		* Parameter: key
		* Return: Info object
		*-----------------------------------------------------------------------*/
		public function getObject($value = '0', $key = 'id', $condition = '1>0') {
			if(!$key || !$value) return '';
			$result = $this->select('*', "`store_id` = '".$this->store_id."' AND `$key` = '$value' AND ($condition)");
			if($result) {
				$object = new ColorInfo
							(	$result[0]['id'],
								$result[0]['store_id'],
								$result[0]['name'],
								$result[0]['primary_color'],
								$result[0]['primary_color_opacity'],
								$result[0]['date_created'],
								$result[0]['user_created'],
								$result[0]['status'],
								$result[0]['properties']
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
		public function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
			if(!$page) $page = 1;
			$start = ($page -1) * $items_per_page;
			$results = $this->select('*', "`store_id` = '".$this->store_id."' AND $condition", $sort, $start, $items_per_page);
			if($results) {
				$objects = array();
				foreach($results as $key => $result) {
					$objects[] = new ColorInfo
									(	$result['id'],
										$result['store_id'],
										$result['name'],
										$result['primary_color'],
										$result['primary_color_opacity'],
										$result['date_created'],
										$result['user_created'],
										$result['status'],
										$result['properties']
									);
				}
				return $objects;
			}
			return 0;
		}
		
		# Return primary color from id
		public function getPrimaryColorFromId($id='') {
			if(!$id) return '';
			$result = $this->select('primary_color',"`store_id` = '".$this->store_id."' AND `id` = '$id'");
			
			if($result) return $result;
			return '';
		}
		
		# Return primary color opacity from id
		public function getPrimaryColorOpacityFromId($id='') {
			if(!$id) return '';
			$result = $this->select('primary_color_opacity',"`store_id` = '".$this->store_id."' AND `id` = '$id'");
			if($result) return $result;
			return '';
		}
	}
?>