<?php
/*************************************************************************
Class Boot
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 07/06/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
define('BOOTSTRAP', 'sCode');
define('DEFAULT_KEY', 'CodeFromDerasoftVN');
include_once(ROOT_PATH.'license/license.inc.php');

class Boot
{
    function __construct() {
    
    }
	function Boot() {
	        $this->__construct();
	}
	function checkBootstrapLoaded()
	{
		global $db;
		global $license_domain;
		
		$host = $_SERVER['HTTP_HOST'];
		$clean_host = preg_replace('/^www\./','',$host);
		if(!in_array($host,$license_domain)) header('location: http://derasoft.com/license.html');
		$result = $db->query("SELECT `subdomain` FROM ".DB_PREFIX."estores WHERE `domain`='".$host."' OR `domain`='".$clean_host."'");
		if($db->numRows($result)) {
			$row = $db->fetchRow($result);
			$db->freeResult($result);
			return $row[0];
		}
		return '';
	}
	function checkBootstrap()
	{
		global $db;
		global $license_domain;
		$sCode = '';
		$host = $_SERVER['HTTP_HOST'];
		$clean_host = preg_replace('/^www\./','',$host);
		if(!in_array($host,$license_domain)) header('location: http://derasoft.com/license.html');
		$result = $db->query("SELECT `id` FROM ".DB_PREFIX."estores WHERE `domain`='".$host."' OR `domain`='".$clean_host."'");
		if($db->numRows($result)) {
			$row = $db->fetchRow($result);
			$db->freeResult($result);
			return $row[0];
		}
		return '';
	}
	function encrypt($string, $key = DEFAULT_KEY) { 
		$result = ''; 
		for($i=0; $i<strlen($string); $i++) { 
			$char = substr($string, $i, 1); 
			$keychar = substr($key, ($i % strlen($key))-1, 1); 
			$char = chr(ord($char)+ord($keychar)); 
			$result.=$char; 
		}
		return base64_encode($result); 
	}
	function decrypt($string, $key = DEFAULT_KEY) { 
		$result = ''; 
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) { 
			$char = substr($string, $i, 1); 
			$keychar = substr($key, ($i % strlen($key))-1, 1); 
			$char = chr(ord($char)-ord($keychar)); 
			$result.=$char; 
		}	
		return $result; 
	}
}
?>
