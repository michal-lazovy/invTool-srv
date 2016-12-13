<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/ws/classes/DB.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/entity/FundValue.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/dao/FundDao.php';

class FundValueDao {
	
	public function getLatestFundValue($fundId) {
		if(!is_numeric($fundId)) {
			return null;
		}
		$db = new DB();
		$result = $db->query("SELECT * FROM t_fund_value WHERE id_fund=".$fundId." ORDER BY value_date DESC LIMIT 1");
		
		$dbFundValue = mysqli_fetch_assoc($result);		
		$fundValue = new FundValue($dbFundValue['value_date'], $dbFundValue['fund_value']);
		
		return $fundValue;
	}
	
	public function getFundValues($fundId) {
		if(!is_numeric($fundId)) {
			return null;
		}
		$db = new DB();
		
		$result = $db->query("SELECT * FROM t_fund_value WHERE id_fund=".$fundId." ORDER BY value_date DESC");
		
		$FundValues = array();
		while($row = mysqli_fetch_assoc($result)) {
			$FundValues[] = new FundValue($row['value_date'], $row['fund_value']);
		}
		return $FundValues;
	}
	
	public function insertFundValue($fundId, $fundValueDate, $fundValue) {
		$db = new DB();
		
		$query = "INSERT INTO t_fund_value (id_fund, value_date, fund_value) VALUES (";
		$query .= "".$db->escape($fundId).", "."'".$db->escape($fundValueDate)."', ".$db->escape($fundValue).")";
		
		return $db->query($query);
	}
    
    public function getPortfolioValuesByDate() {
        $db = new DB();
        
        $result = $db->query("SELECT `value_date`,sum(fund_value) FROM `t_fund_value` group by `value_date` order by `value_date` desc");
        $PortfolioValues = array(array('Date', 'Value'));
        while($row = mysqli_fetch_assoc($result)) {
            $PortfolioValues[] = array($row['value_date'], floatval($row['sum(fund_value)']));
        }
        return $PortfolioValues;
    }
}