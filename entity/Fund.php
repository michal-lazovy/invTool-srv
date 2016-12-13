<?php

class Fund {
	public $id;
	public $name;
	public $link;
	public $portfolio;	
	public $FundValues = array();
	
	public function __construct($id, $name, $link, $portfolio) {
		$this->id = $id;
		$this->name = $name;
		$this->link = $link;
		$this->portfolio = $portfolio;
	}
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getLink(){
		return $this->link;
	}

	public function setLink($link){
		$this->link = $link;
	}

	public function getPortfolio(){
		return $this->portfolio;
	}

	public function setPortfolio($portfolio){
		$this->portfolio = $portfolio;
	}

	public function getFundValues(){
		return $this->FundValues;
	}

	public function setFundValues($FundValues){
		$this->FundValues = $FundValues;
	}
}