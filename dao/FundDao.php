<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/ws/classes/DB.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/entity/Fund.php';

class FundDao {
	
	function getFunds($inPortfolio = false) {
		$db = new DB();
		
		$Funds = array();
		
		$query = "SELECT * FROM t_fund";
		
		if($inPortfolio) {
			$query .= " WHERE portfolio > 0";
		}
		
		$result = $db->query($query);
		while ($row = mysqli_fetch_assoc($result)) {
			$Funds[] = new Fund($row['id'], $row['name'], $row['link'], $row['portfolio']);
		}
		
		return $Funds;
	}
	
	
	function getFund($fundId) {
		if(!is_numeric($fundId)) {
			return null;
		}
	
		$db = new DB();
		$result = $db->query("SELECT * FROM t_fund WHERE id=".$fundId);
		
		$dbFund = mysqli_fetch_assoc($result);
		return new Fund($dbFund['id'], $dbFund['name'], $dbFund['link'], $dbFund['portfolio']);
	}
    
    function savePortfolio($fundId, $portfolioValue) {
        $db = new DB();
        $query = "UPDATE t_fund SET portfolio=".$portfolioValue." WHERE id=".$fundId;
        
        echo($query);
        $result = $db->query($query);
    }
}