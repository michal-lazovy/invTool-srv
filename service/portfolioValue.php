<?php


require_once '../dao/FundValueDao.php';
$fundValueDao = new FundValueDao();
header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');

echo json_encode($fundValueDao->getPortfolioValuesByDate());