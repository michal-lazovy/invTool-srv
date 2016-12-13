<?php

require_once '../dao/FundDao.php';
require_once '../dao/FundValueDao.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/ws/classes/Downloader.php';

$x = new FundDao();
$Funds = $x->getFunds(true);

$fundValueDao = new FundValueDao();

$downloader = new Downloader();
foreach($Funds as $fund) {
    $downloader->downloadFundValues($fund);
    $fund->setFundValues(
        $fundValueDao->getFundValues($fund->getId())
    );
}

header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');

echo json_encode($Funds);