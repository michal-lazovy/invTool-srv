<?php

require_once '../dao/FundDao.php';

$x = new FundDao();
$Funds = $x->getFunds();
//var_dump($Funds);
$json = "";
//foreach($Funds as $f) {
//	$json .= json_encode($f);
//}
header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
echo json_encode($Funds);