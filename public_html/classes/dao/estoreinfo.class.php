<?php
/*************************************************************************
Class EStore Info
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/20/2010
**************************************************************************/
class EStoreInfo {
	public 	$id;
	private $owner_id;
	private $area_id;
	private $cat_id;
	public $subdomain;
	public $domain;
	private $name;
	private $keywords;
	private $description;
	private $company;
	private $address;
	private $tel;
	private $cell;
	private $email;
	private $date_created;
	private $date_expire;
	private $properties;
	private $status;
	

	function __construct($owner_id, $area_id, $cat_id, $subdomain, $domain, $name, $keywords, $description, $company, $address, $tel, $cell, $email, $date_created, $date_expire, $properties, $status, $id = '0') 
  {
		$this->id = $id;
		$this->owner_id = $owner_id;
		$this->area_id = $area_id;
		$this->cat_id = $cat_id;
		$this->subdomain = stripslashes(htmlspecialchars($subdomain));
		$this->domain = stripslashes(htmlspecialchars($domain));
		$this->name = stripslashes(htmlspecialchars($name));
		$this->keywords = stripslashes(htmlspecialchars($keywords));
		$this->description = stripslashes(htmlspecialchars($description));
		// $this->company = stripslashes(htmlspecialchars($company));
		$this->company = $company;
		$this->address = $address;
		$this->tel = stripslashes(htmlspecialchars($tel));
		$this->cell = stripslashes(htmlspecialchars($cell));
		$this->email = stripslashes(htmlspecialchars($email));
		$this->date_created = $date_created;
		$this->date_expire = $date_expire;
		$this->properties = unserialize($properties);
		$this->status = $status;
	}			
	public function EStoreInfo($owner_id, $area_id, $cat_id, $subdomain, $domain, $name, $keywords, $description, $company, $address, $tel, $cell, $email, $date_created, $date_expire, $properties, $status, $id = '0')
	{
		$this->__construct($owner_id, $area_id, $cat_id, $subdomain, $domain, $name, $keywords, $description, $company, $address, $tel, $cell, $email, $date_created, $date_expire, $properties, $status, $id);
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
	public function getOwnerUsername() {
		include_once(ROOT_PATH."classes/dao/users.class.php");
		$users = new Users($this->id);
		return $users->getUsername("`id` = '".$this->owner_id."'");	
	}
	public function getAreaId()
	{
		return $this->area_id;
	}
	public function setAreaId($nValue)
	{
		$this->area_id=$nValue;
	}
	public function getCatId()
	{
		return $this->cat_id;
	}
	public function setCatId($nValue)
	{
		$this->cat_id=$nValue;
	}
	public function getCatName() {
		include_once(ROOT_PATH."classes/dao/estorecategories.class.php");
		$estoreCategories = new EstoreCategories();
		return $estoreCategories->getNameFromId($this->cat_id);
	}
	public function getSubdomain()
	{
		return $this->subdomain;
	}
	public function setSubdomain($nValue)
	{
		$this->subdomain=$nValue;
	}
	public function getDomain()
	{
		return $this->domain;
	}
	public function setDomain($nValue)
	{
		$this->domain=$nValue;
	}
	public function getName($lang='vn')
	{
		if($lang=='vn')return $this->name;
		else return $this->properties['custom_'.$lang.'_name'];
	}
	public function setName($nValue,$lang='vn')
	{
		if($lang=='vn') $this->name=$nValue;
		else  $this->properties['custom_'.$lang.'_name'] = $nValue;
	}
	public function getKeywords($lang='vn')
	{
		if($lang=='vn')return $this->keywords;
		else return $this->properties['custom_'.$lang.'_keyword'];
	}
	public function setKeywords($nValue,$lang='vn')
	{
		if($lang=='vn') $this->keyword=$nValue;
		else  $this->properties['custom_'.$lang.'_keyword']=$nValue;
	}
	public function getDescription($lang='vn')
	{
		if($lang=='vn')return $this->description;
		else return $this->properties['custom_'.$lang.'_description'];
	}
	public function setDescription($nValue,$lang='vn')
	{
		if($lang=='vn') $this->description=$nValue;
		else  $this->properties['custom_'.$lang.'_description']=$nValue;
	}
	public function getCompany($lang='vn')
	{
		if($lang=='vn')return $this->company;
		else return $this->properties['custom_'.$lang.'_company'];
	}
	public function setCompany($nValue,$lang='vn')
	{
		if($lang=='vn') $this->company=$nValue;
		else  $this->properties['custom_'.$lang.'_company']=$nValue;
	}
	public function getAddress($lang='vn')
	{
		if($lang=='vn')return $this->address;
		else return $this->properties['custom_'.$lang.'_address'];
	}
	public function setAddress($nValue,$lang='vn')
	{
		if($lang=='vn') $this->address=$nValue;
		else  $this->properties['custom_'.$lang.'_address']=$nValue;
	}
	public function getTel()
	{
		return $this->tel;
	}
	public function setTel($nValue)
	{
		$this->tel=$nValue;
	}
	public function getCell()
	{
		return $this->cell;
	}
	public function setCell($nValue)
	{
		$this->cell=$nValue;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($nValue)
	{
		$this->email=$nValue;
	}
	public function getDateCreated()
	{
		return $this->date_created;
	}
	public function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}
	public function getDateExpire()
	{
		return $this->date_expire;
	}
	public function setDateExpire($nValue)
	{
		$this->date_expire=$nValue;
	}
	public function getProperty($key)
	{
		if(isset($this->properties[$key])) return $this->properties[$key];
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
	public function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	public function getAdsCategoryInfo($cId = 0) {
		$catItems = $this->getProperty('ads_category');
		if(isset($catItems[$cId]['rows'])) {
			return $catItems[$cId];
		} else {
			include_once(ROOT_PATH.'classes/dao/adscategories.class.php');
			$adsCategories = new AdsCategories();
			$adsCategoryInfo = $adsCategories->getObject($cId);
			if($adsCategoryInfo) {
				return $adsCategoryInfo->getProperties();
			}
		}
	}
	public function getCurrency() {
		include_once(ROOT_PATH.'classes/dao/currencies.class.php');
		$currencies = new Currencies($this->id);
		$currency = $currencies->getPrimaryCurrency();
		return $currency->getName();
	}
}
?>