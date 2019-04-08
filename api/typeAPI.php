
<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
include "../lib/std.php";
include "../lib/dbConnector.php";
include "../model/type.php";

$action = $_REQUEST["action"];
$condition = $_REQUEST["condition"];

$obj = new Type();
$resultArray = array();

switch ($action) {
    case "read":
		$rows = $obj->read();	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
				$arrCol["id"] = $row["id"];
                $arrCol["type_name"] = $row["type_name"];
                                
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