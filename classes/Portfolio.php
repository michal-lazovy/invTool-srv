<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/ws/dao/FundDao.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/dao/FundValueDao.php';

class Portfolio {

	public function getPortfolioValue() {
		$fundDao = new FundDao();
		$fundValueDao = new FundValueDao();
		
		$PortfolioFunds = $fundDao->getFunds(true);
		
		$portfolioValue = 0.0;
		foreach($PortfolioFunds as $fund) {
			$latestFundValue = $fundValueDao->getLatestFundValue($fund->getId());
			
			$portfolioValue += $fund->getPortfolio() * $latestFundValue->getValue();
		}
		
		return $portfolioValue;
	}
	
}