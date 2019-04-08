
<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
include "../lib/std.php";
include "../lib/dbConnector.php";
include "../model/customer.php";

$action = $_REQUEST["action"];
$condition = empty($_REQUEST["condition"]);

$obj = new Customer();
$resultArray = array();

switch ($action) {
    case "read":
		$rows = $obj->read($_REQUEST['cust_user'], $_REQUEST['cust_password']);	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
								$arrCol["status"] = "1";
								$arrCol["cust_id"] = $row["cust_id"];
								$arrCol["cust_name"] = $row["cust_name"];
								$arrCol["address_id"] = $row["address_id"];
								$arrCol["cust_birthday"] = $row["cust_birthday"];
								$arrCol["cust_gender"] = $row["cust_gender"];
								$arrCol["cust_tel"] = $row["cust_tel"];
								$arrCol["cust_email"] = $row["cust_email"];
								$arrCol["cust_user"] = $row["cust_user"];
								$arrCol["cust_password"] = $row["cust_password"];
								$arrCol["add_dt"] = $row["add_dt"];
                                
				array_push($resultArray,$arrCol);
			}
			}else{
					$arrCol = array();
						$arrCol["status"] = "0";                               
						array_push($resultArray,$arrCol);
			}
			echo json_encode($resultArray);
		break;
		//read_title
    case "read_title":
		$rows = $obj->read_title();	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
								$arrCol["status"] = "1";
								$arrCol["title_id"] = $row["title_id"];
								$arrCol["title_name"] = $row["title_name"];                     
				array_push($resultArray,$arrCol);
			}
			}else{
					$arrCol = array();
						$arrCol["status"] = "0";                               
						array_push($resultArray,$arrCol);
			}
			echo json_encode($resultArray);
		break;
		case "register":
			$rows = $obj->read($_REQUEST['cust_user'], $_REQUEST['cust_password']);	
			if ($rows == false) {
							$data = array(
								"title_id" => $_REQUEST["title_id"],
								"cust_name" => $_REQUEST["cust_name"],
								"cust_birthday" => $_REQUEST["cust_birthday"],
								"cust_gender" => $_REQUEST["cust_gender"],
								"cust_tel" => $_REQUEST["cust_tel"],
								"cust_email" => $_REQUEST["cust_email"],
								"cust_user" => $_REQUEST["cust_user"],
								"cust_password" => $_REQUEST["cust_password"],
							);
							$resual = $obj->insert($data);
							
							

							$arrCol["status"] = "1";
							$arrCol["msg"] = ""; 
							array_push($resultArray,$arrCol);
				}
				else{
							$arrCol = array();
							$arrCol["status"] = "0";
							$arrCol["msg"] = "ชื่อผู้ใช้งานนี้มีผู้ใช้งานแล้ว!";                               
							array_push($resultArray,$arrCol);
				}
				echo json_encode($resultArray);
			break;
    default:
	   echo "Action is not found.";
	   break;
}

?>