<?php
/*************************************************************************
Class Validate data input
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 07/11/2010
Coder: Mai Minh
**************************************************************************/
class Validate{
	var $messages;
	function __construct() {
		global $amessages;
		$this->messages = $amessages;
	}
	function Validate() {
		$this->__construct();
	}

	function validUsername($value) {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!$value || strlen($value) < 4 || !preg_match("/^([a-z0-9_]+)$/",$value)) {
			$return['error'] = 1;
			$return['message'] = $this->messages['invalid_username'];
		}
		return $return;	# no error
	}
	function validPassword1($value, $id = '') {
        $return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
        if(!$value || strlen($value) < 6 || !preg_match("/[0-9]/",$value) || !preg_match("/[a-z]/", $value) ) {
            $return['error'] = 1;
            $return['message'] = ($id?$id.' - ':'')."Mật khẩu phải bao gồm chữ và số";
            // || !preg_match("#\W+#", $value)
        }
        return $return; # no error
    }
	function validStoreUsername($sCode, $value) {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!$value || strlen($sCode.'_'.$value) < 6 || !preg_match("/^([a-z0-9_]+)$/",$sCode.'_'.$value)) {
			$return['error'] = 1;
			$return['message'] = $this->messages['invalid_username'];
		}
		return $return;	# no error
	}

	function validPassword($value, $name = '') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!$value || strlen($value) < 6 || !preg_match("#[0-9]+#",$value) || !preg_match("#[a-z]+#", $value) || !preg_match("#\W+#", $value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_password'];
		}
		return $return; # no error
	}
	function validTestPass($password,$confirm,$name='') {
		if($password != $confirm) return $name."  ".$this->messages['invalidCPass'];
		return '';	
	}	
	function validString($value,$name = '') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!$value) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_string'];
		}
		return $return;	
	}
    function validStringU($value,$name = '') {
		$return = array('value' => ($value), 'error' => 0,'message' =>'');
		if(!$value) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_string'];
		}
		return $return;	
	}
    function validNumGT($value1,$name1 = '',$value2,$name2 = '') {
		$return = array('value' => ($value1), 'error' => 0,'message' =>'');
		if($value1 === ''|| !is_numeric($value1)) {
			$return['error'] = 1;
			$return['message'] = ($name1?$name1.' - ':'').$this->messages['invalid_number'];
		} else if($value1 > $value2 || !is_numeric($value1)) {
			$return['error'] = 1;
			$return['message'] = ($name1?$name1.' ':'').$this->messages['not_greater_than'].' '.($name2?$name2:'');
		}
		return $return;	
	}

	function validEmail($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$lengthPattern = "/^[^@]{1,64}@[^@]{1,255}$/";
		$syntaxPattern = "/^((([\w\+\-]+)(\.[\w\+\-]+)*)|(\"[^(\\|\")]{0,62}\"))@(([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,})|\[?([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})(\.([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})){3}\]?)$/";
		if(!$value || preg_match($lengthPattern, $value) <= 0 || preg_match($syntaxPattern, $value) <= 0) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_email'];
		}
		return $return;
	}
	function validPhone($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!preg_match("/^[0-9]*$/", $value) //valid chars check
				|| strlen($value)!=10){ //overall length check){
					$return['error'] = 1;
					$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_phone'];
				} //length of each label\
				return $return;
	}
	function pasteString($value,$name = '') {
		return array('value' => stripslashes($value), 'error' => 0,'message' =>'');
	}
	
	/* Old function
	function validDomain($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$regexp = '/^([a-z0-9][a-z0-9\-]+[a-z0-9]\.)+[a-z]{2,4}$/i';
		if ($value && false == preg_match($regexp, $value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'')."Domain invalid";
		}
		return $return;
	}*/
	
	function validDomain($domain_name)
	{
		return (preg_match("/^(\*\.)?([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name,$matches) //valid chars check
				&& preg_match("/^.{1,253}$/", $domain_name) //overall length check
				&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
	}

	function validNumber($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if($value == '' || !is_numeric($value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_number'];
		}
		return $return;
	}
	
	function validIdEmployee($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if($value == '' || !is_numeric($value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_id_employee'];
		}
		return $return;
	}
	function validPlusNumber($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if($value == '' || !is_numeric($value) || $value<0) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_number'];
		}
		return $return;
	}

	function validPrice($value,$name='',$allow_zero = 0) {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$value = str_replace(',','',$value);
		if($value == '' || !is_numeric($value) || (($allow_zero>0 && $value < 0) || ($allow_zero==0 && $value <= 0))) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_number'];
		}
		return $return;
	}

	function validMarketPrice($value,$price,$name='',$allow_zero = 0) {
		if(!$value) $value = 0;
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$value = str_replace(',','',$value);
		$price = str_replace(',','',$price);
		if($value == '' || !is_numeric($value) || (($allow_zero>0 && $value < 0) || ($allow_zero==0 && $value <= 0) || $value<=$price)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_number'];
			if($value<=$price) $return['message'] = ($name?$name.' - ':'').$this->messages['invalid_market_price'];
		}
		return $return;
	}
	
	function validInteger($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if($value == '' || !is_numeric($value) || !is_int((int)$value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_integer'];
		}
		return $return;
	}
	
	function validPlusInteger($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if($value == '' || !is_numeric($value) || !is_int((int)$value) || (int)$value <=0) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_integer'];
		}
		return $return;
	}

	function validUrl($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$domain = "(http(s?):\/\/|ftp:\/\/)*([[:alpha:]][-[:alnum:]]*[[:alnum:]])(\.[[:alpha:]][-[:alnum:]]*[[:alpha:]])+";
		$dir = "(/[[:alpha:]][-[:alnum:]]*[[:alnum:]])*";
		$trailingslash  = "(\/?)";
		$page = "(/[[:alpha:]][-[:alnum:]]*\.[[:alpha:]]{3,5})?";
		$getstring = "(\?([[:alnum:]][-_%[:alnum:]]*=[-_%[:alnum:]]+)(&([[:alnum:]][-_%[:alnum:]]*=[-_%[:alnum:]]+))*)?";
		$pattern = "^".$domain.$dir.$trailingslash.$page.$getstring."$";
		$check = eregi($pattern, $value);
		if(!$check) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_url'];
		}
		return $return;		
	}

	function validDateTime($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$valid = 0;
		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $value, $matches)) { 
			if (checkdate($matches[2], $matches[3], $matches[1])) $valid = 1;
		}
		if(!$valid) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_datetime'];
		}
		return $return;
	}
	
	function validSubdomain($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!$value || !preg_match("/^([a-z0-9_]+)$/",$value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_subdomain'];
		}
		return $return;
	}

	function validOnlyText($value,$name='') {
		include_once(ROOT_PATH."classes/data/textfilter.class.php");
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		$textFilter = new TextFilter();
		$text = $textFilter->urlize($value,false,' ');
		if(!$text || !preg_match('/^[a-z .\-]+$/i',$text)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_text'];
		}
		return $return;
	}
	
	function validSlug($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!$value || !preg_match("/^([a-z0-9_-]+)$/",$value)) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_slug'];
		}
		return $return;
	}
	
	function validCode($value,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(!isset($_SESSION['rand_code']) || $value != strtolower($_SESSION['rand_code'])) {
			$return['error'] = 1;
			$return['message'] = ($name?$name.' - ':'').$this->messages['notValidCodeSecurity'];
		}
		return $return;
	}
	function validTime($value,$key,$name='') {
		$return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		if(date("Y-m-d",strtotime($value))>date()) $return = array('value' => stripslashes($value), 'error' => 0,'message' =>'');
		else{
			if(date("Y-m-d",strtotime($value))==date()) {
				if ((strtotime($value) - time()) < strtotime($key)) { // current time is greater than 05/15/2010 4:00PM } 
					$return['error'] = 1;
					$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_datetime'];
					echo 'kem';
				}
			}else{
				$return['error'] = 1;
				$return['message'] = ($name?$name.' - ':'').$this->messages['invalid_datetime'];
				echo 'co';
			}
		}
		return $return;
	}
}
?>