<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

require_once $_SERVER["DOCUMENT_ROOT"].'/ws/dao/FundValueDao.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/entity/Fund.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/lib/excel_reader2.php';

class Downloader {

	public function downloadFundValues($fund) {
		$content = file_get_contents($fund->getLink());
		
		$data = new Spreadsheet_Excel_Reader($content);
		
		$fundValueDao = new FundValueDao();
		
		$latestFundValue = $fundValueDao->getLatestFundValue($fund->getId());
		$latestTime = $latestFundValue == null ? 0 : strtotime($latestFundValue->getValueDate());
		
		for($i = 2, $count = $data->sheets[0]['numRows']; $i <= $count; $i++) {
			$recordTime = strtotime($data->val($i, 1));
			
			if( $recordTime <= $latestTime) {
				break;
			}			
			
			$fundValueDao->insertFundValue($fund->getId(), date('Y-m-d', $recordTime), $data->val($i, 3));
			
		}
	}
}