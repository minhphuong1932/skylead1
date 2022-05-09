<?php
/*
Class Translator
Coder: Mai Minh
Last updated: 01/06/2012
*/
class Translator
{
	var $messages;
	
	#New constructor
	function __construct($messages) {
		$this->messages = $messages;
	}
	
	#Old constructor
	function Translator($message) {
		$this->__construct($message);
	}

	function msg($key='') {
		if(isset($this->messages[$key])) return $this->messages[$key];
		return '{'.$key.'}';
	}	
}
?>
