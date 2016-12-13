<?php

require_once '../dao/FundDao.php';

header('Access-Control-Allow-Origin: *');
$entityBody = file_get_contents('php://input');

$Funds = json_decode($entityBody);

$fundDao = new FundDao();
foreach($Funds as $fund) {
    $fundDao->savePortfolio($fund->id, $fund->portfolio);
}