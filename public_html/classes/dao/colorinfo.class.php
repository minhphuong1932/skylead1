<?php
	class ColorInfo {
		public $id;				# Primary key
		private $store_id;		# Estore id
		private $name;		
		private $primary_color;		
		private $primary_color_opacity;
		private $date_created;
		private $user_created;
		private $status;
		private $properties;

		# Constructor
		function __construct($id = 0, $store_id = 0, $name, $primary_color, $primary_color_opacity, $date_created, $user_created, $status, $properties)	{
			$this->id = $id;
			$this->store_id = $store_id;
			$this->name = $name;
			$this->primary_color = $primary_color;
			$this->primary_color_opacity = $primary_color_opacity;
			$this->date_created = $date_created;
			$this->user_created = $user_created;
			$this->status = $status;
			$this->properties = $properties;
		}
		public function ColorInfo($id = 0, $store_id = 0, $name, $primary_color, $primary_color_opacity, $date_created, $user_created, $status, $properties)	{
			$this->__construct($id, $store_id, $name, $primary_color, $primary_color_opacity, $date_created, $user_created, $status, $properties);
		}

		public function getId() {
			return $this->id;
		}	
		public function setId($nValue) {
			$this->id=$nValue;
		}
		
		public function getName($lang='vn') {
			if($lang == 'vn')	return $this->name;
			elseif(isset($this->properties['custom_'.$lang.'_name'])) return $this->properties['custom_'.$lang.'_name'];	
		}
		public function setName($nValue,$lang='vn') {
			if($lang == 'vn')	$this->name=stripslashes($nValue);
			else	$this->properties['custom_'.$lang.'_name']=stripslashes($nValue);
		}
		
		public function getProperty($key) {
			if(isset($this->properties[$key])) return $this->properties[$key];
			return '';
		}
		public function setProperty($key,$nValue) {
			$this->properties[$key]=$nValue;
		}
		
		# Return primary color from id
		public function getPrimaryColorFromId($id='') {
			if($id == '') return '';
			
			include_once(ROOT_PATH."classes/dao/color.class.php");
			$color = new Color();
			$result = $color->getPrimaryColorFromId($id);
			
			if($result) return $result[0]['primary_color'];
			return '';
		}
		
		# Return primary color from id
		public function getPrimaryColorOpacityFromId($id='') {
			if($id == '') return '';
			
			include_once(ROOT_PATH."classes/dao/color.class.php");
			$color = new Color();
			$result = $color->getPrimaryColorOpacityFromId($id);
			
			if($result) return $result[0]['primary_color_opacity'];
			return '';
		}
		
	}
?>