<?php
/*************************************************************************
Class ReportTypeInfo
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com
Author: Dai Pham
Last updated: 24/10/2013
************************************************************************** */

class ReportTypeInfo{
	var $id;
	var $store_id;
	var $name;
	var $startat;
	var $endat;
	var $status;
	var $properties;
	function __construct($store_id,$name, $startat,$endat,$status='1',$properties='',$id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;		
		$this->name = $name;						
		$this->startat = $startat;		
		$this->endat = $endat;
		$this->status = $status;
		$this->properties = unserialize($properties);
	}
	function ReportTypeInfo($store_id,$name, $startat,$endat,$status='1',$properties='',$id = 0)
	{
		$this->__construct($store_id,$name, $startat,$endat,$status,$properties,$id);
	}
	function getId()
	{
		return $this->id;
	}
	function setId($nValue) {
		$this->id = $nValue;
	}
	function getStoreid()
	{
		return $this->store_id;
	}
	function setStoreid($nValue) {
		$this->store_id = $nValue;
	}
	function getName()
	{
		return $this->name;
	}
	function setName($nValue) {
		$this->name = $nValue;
	}
	function getStartat()
	{
	  return $this->startat;
	}
	function getStart()
	{
	  $start = explode('|',$this->startat);
	  if($this->getProperty('type_condition') =='1'){
	  	return $start[1].' '.$start[0];
	  }else{
		if($start[0]!='lastday'){
			  	return $start[1].' ngày '.$start[0];
			  }else{
				  return $start[1].' ngày cuối tháng';
			  }
	  }
	}
	function getEnd()
	{
		$end=explode('|',$this->endat);
		if($this->getProperty('type_condition') =='1'){
			if($this->getProperty('type_condition1') =='1'){
	  			return $end[1].' '.$end[0].' next week';
			}else{
				return $end[1].' '.$end[0];
			}
	  	}else{
		  if($this->getProperty('type_condition1') =='1'){
		  	return $end[1].' ngày '.$end[0].' tháng sau';
		  }else{
			  if($end[0]!='lastday'){
			  	return $end[1].' ngày '.$end[0];
			  }else{
				  return $end[1].' cuối tháng';
			  }
		  }
		}
	}
	function setStartat($nValue) {
		$this->startat = $nValue;
	}
	function getStatus()
	{
		return $this->status;
	}
	function setStatus($nValue) 
	{
		$this->status = $nValue;
	}
	
	function getEndat()
	{
		return $this->endat;
	}
	function setEndat($nValue) 
	{
		$this->endat = $nValue;
	}
	
	function getProperties()
	{
		return $this->properties;
	}
	function setProperties($nValue)
	{
		$this->properties=$nValue;
	}
	function getProperty($key)
	{
		if(isset($this->properties[$key])) return $this->properties[$key];
		return '';
	}
	function setProperty($key,$nValue)
	{
		$this->properties[$key]=$nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_user'][$this->status];
	}	
	
}
?>