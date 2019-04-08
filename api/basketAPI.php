<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
include "../lib/std.php";
include "../lib/dbConnector.php";
include "../model/basket.php";

$action = $_REQUEST["action"];
$condition = $_REQUEST["condition"];
//$condition = str_replace("''", "'", $condition);
$obj = new Basket();
$resultArray = array();

switch ($action) {
    case "read_sum":
		$rows = $obj->read_sum($condition);	
		if ($rows != false) {
			foreach ($rows as $row) {
                $arrCol = array();
                
				$arrCol["sumQty"] = $row["sumQty"];
                $arrCol["sumPrice"] = $row["sumPrice"];
                if(empty($row["sumQty"])){
                    $arrCol["sumQty"] = 0;
                    $arrCol["sumPrice"] = 0;
                }
                
				array_push($resultArray,$arrCol);
			}
		}
		echo json_encode($resultArray);
		break;
    default:
	   echo "Action is not found.";
	   break;
}

?>