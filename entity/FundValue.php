<?php

class FundValue {
	public $valueDate;
	public $value;
	
	public function __construct($valueDate, $value) {
		$this->valueDate = $valueDate;
		$this->value = $value;
	}
	
	public function getValueDate(){
		return $this->valueDate;
	}

	public function setValueDate($valueDate){
		$this->valueDate = $valueDate;
	}

	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}
}