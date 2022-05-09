<?php
/*************************************************************************
Class Template Info
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/20/2010
**************************************************************************/
class TemplateInfo {
	public $id;
	private $owner_id;
	private $name;
	private $folder;
	private $type;
	private $properties;
	private $status;
				
	public function __construct($owner_id, $name, $folder, $type, $properties, $status, $id = '0')
	{
		$this->id = $id;
		$this->owner_id = $owner_id;
		$this->name = stripslashes($name);
		$this->folder = stripslashes($folder);
		$this->type = $type;		
		$this->properties = unserialize($properties);
		$this->status = $status;
	}
	public function TemplateInfo($owner_id, $name, $folder, $type, $properties, $status, $id = '0')
	{
		$this->__construct($owner_id, $name, $folder, $type, $properties, $status, $id);
		
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($nValue)
	{
		$this->id=$nValue;
	}
	public function getOwnerId()
	{
		return $this->owner_id;
	}
	public function setOwnerId($nValue)
	{
		$this->owner_id=$nValue;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setName($nValue)
	{
		$this->name=stripslashes($nValue);
	}
	public function getFolder()
	{
		return $this->folder;
	}
	public function setFolder($nValue)
	{
		$this->folder=stripslashes($nValue);
	}
	public function getType()
	{
		return $this->type;
	}
	public function setType($nValue)
	{
		$this->type=stripslashes($nValue);
	}
	public function getProperty($key)
	{
		if(isset($this->properties[$key])) return ''.$this->properties[$key];
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
	public function getStatus()
	{
		return $this->status;
	}
	public function setStatus($nValue)
	{
		$this->status=$nValue;
	}
}
?>