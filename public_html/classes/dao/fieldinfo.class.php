<?php
/*************************************************************************
Class Custom Field info
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 18/05/2012
Coder: Mai Minh
**************************************************************************/
class FieldInfo {
	public $Id;			# Method code (primary key)
	private $store_id;		
	private $module;		# Module name
	private $name;			# Name method
	private $title;			# Title of custom field
	private $class;			# CSS class name
	private $type;			# 1-textbox, 2-textarea, 3-list, 4-combo, 5-radio, 6-checkbox
	private $value;			# List value
	private $status;		# 0-Disabled, 1-Active, 2-Deleted
	private $position;		# Display order
	# Constructor
	public function __construct($module, $name, $title, $class, $type, $value='',$status=0, $position=0, $store_id=0, $Id = 0)
	{
		$this->Id = $Id;
		$this->store_id=$store_id;
		$this->module = $module;
		$this->name = $name;
		$this->title = $title;
		$this->class = $class;
		$this->type = $type;
		$this->value = $value;
		$this->status = $status;
		$this->position = $position;
	}
	public function FieldInfo($module, $name, $title, $class, $type, $value='',$status=0, $position=0, $store_id=0, $Id = 0)
	{
		$this->__construct($module, $name, $title, $class, $type, $value,$status, $position, $store_id, $Id);
	}

	public function getId() {
		return $this->Id;
	}	
	public function setId($nValue) {
		$this->Id=$nValue;
	}	
	
	public function getModule() {
		return $this->module;
	}	
	public function setModule($nValue) {
		$this->module=$nValue;
	}
	public function getName() {
		return $this->name;
	}	
	public function setName($nValue) {
		$this->name=$nValue;
	}
	public function getTitle() {
		return $this->title;
	}	
	public function setTitle($nValue) {
		$this->title=$nValue;
	}
	public function getClass() {
		return $this->class;
	}	
	public function setClass($nValue) {
		$this->class=$nValue;
	}
	
	public function getType() {
		return $this->type;		
	}
	public function setType($nValue) {
		$this->type=$nValue;
	}
	public function getValue() {
		return unserialize($this->value);
	}
	// public function getBackEndValue() {
	// 	$valueList = unserialize($this->value);
	// 	$new_array = array_map(create_public function('$key, $value', 'return $key.":".$value."\n";'), array_keys($valueList), array_values($valueList));
	// 	return implode($new_array);
	// }
	public function setValue($nValue) {
		$this->value=$nValue;
	}

	public function getStatus() {
		return $this->status;
	}
	public function setStatus($nValue) {
		$this->status = $nValue;
	}
	public function getPosition() {
		return $this->position;
	}
	public function setPosition($nValue) {
		$this->position = $nValue;
	}
	public function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	public function getTypeTextBackend() {
		global $amessages;
		return $amessages['field_type'][$this->type];
	}
	public function displayHTML($value) {
		switch($this->type) {
			case "1":	# Textbox
				return "<p><label for=\"".$this->name."\">".$this->title.":</label>
<input type=\"text\" value=\"$value\" name=\"".$this->name."\" id=\"".$this->name."\"".($this->class?" class=\"".$this->class."\"":"")." /></p>";
				break;
			case "2":	# Textarea
				return "<p><label for=\"".$this->name."\">".$this->title.":</label>
<textarea rows=\"10\" cols=\"20\" name=\"".$this->name."\" id=\"".$this->name."\"".($this->class?" class=\"".$this->class."\"":"").">$value</textarea></p>";
				break;
			case "3":	# WYSIWYG
				return "<p><label for=\"".$this->name."\">".$this->title.":</label></p>
<textarea rows=\"10\" cols=\"20\" name=\"".$this->name."\" id=\"".$this->name."\"".($this->class?" class=\"".$this->class."\"":"").">$value</textarea>
<script type=\"text/javascript\">private editor = CKEDITOR.replace('".$this->name."');</script>";
				break;
			case "4":	# Listbox
				$return = "<p><label for=\"".$this->name."\">".$this->title.":</label>
<select name=\"".$this->name."[]\" id=\"".$this->name."[]\"".($this->class?" class=\"".$this->class."\"":"")." size=\"8\" multiple=\"multiple\">";
				foreach($this->getValue() as $ckey => $cvalue) {
					$return .= "<option value='$ckey'".(in_array($ckey,$value)?" selected":"").">$cvalue</option>";
				}
				$return .= "</select></p>";
				return $return;
				break;
			case "5":	# Combobox		
				$return = "<p><label for=\"".$this->name."\">".$this->title.":</label>
<select name=\"".$this->name."\" id=\"".$this->name."\"".($this->class?" class=\"".$this->class."\"":"").">";
				foreach($this->getValue() as $ckey => $cvalue) {
					$return .= "<option value='$ckey'".($value==$ckey?" selected":"").">$cvalue</option>";
				}
				$return .= "</select></p>";
				return $return;
				break;
			case "6":	# Radio
					$return = "<p><label for=\"".$this->name."\">".$this->title.":</label>";
					foreach($this->getValue() as $ckey => $cvalue) {
						$return .= "<input type=\"radio\" name=\"".$this->name."\" id=\"".$this->name."\" class=\"box\" value=\"$ckey\"".($value==$ckey?" checked":"")." /><label for=\"".$this->name."\" class=\"lbl\">$cvalue</label>";
					}
					$return .= "</p>";
					return $return;
					break;
			case "7":	# Checkbox
					$return = "<p><label for=\"".$this->name."\">".$this->title.":</label>";
					foreach($this->getValue() as $ckey => $cvalue) {
						$return .= "<input type=\"checkbox\" name=\"".$this->name."[]\" id=\"".$this->name."\" class=\"box\" value=\"$ckey\"".(in_array($ckey,$value)?" checked":"")." /><label for=\"".$this->name."\" class=\"lbl\">$cvalue</label>";
					}
					$return .= "</p>";
					return $return;
					break;
			case "8":	# Textbox with popup to select resources
				$return ="<p id=\"p-".$this->name."\" $class><label id=\"l-".$this->name."\" for=\"".$this->name."\">".($this->star==1?"* ":"").$this->title.":</label>
				<input type=\"text\" value=\"$value\" name=\"".$this->name."\" id=\"".$this->name."\" class=\"selectPhoto\" /></p>";
				return $return;
			break;

		}
				
	}
}	
?>