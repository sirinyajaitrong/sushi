<?php
header('Content-Type: text/html; charset=utf-8');
include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/customer.php";

// insert Type
$obj = new Customer();
 $action = $_REQUEST["action"];
 $data = array(
    "customer_id" => !empty($_REQUEST["customer_id"]) ?  $_REQUEST["customer_id"] : "",
    "title_id" => !empty($_REQUEST["title_id"]) ?  $_REQUEST["title_id"] : "",
    "name_store" => !empty($_REQUEST["name_store"]) ?  $_REQUEST["name_store"] : "",
    "customer_name" => !empty($_REQUEST["customer_name"]) ?  $_REQUEST["customer_name"] : "",
    "address" => !empty($_REQUEST["address"]) ?  $_REQUEST["address"] : "",
    "tel" => !empty($_REQUEST["tel"]) ?  $_REQUEST["tel"] : "",
    "telephone" => !empty($_REQUEST["telephone"]) ?  $_REQUEST["telephone"] : "",
    );

$r = false;
switch ($action) {
    case "add":
        $r = $obj->insert($data);
        break;
    case "edit":
        $r = $obj->update($data, " customer_id = {$data["customer_id"]} ");
        break;
    case "delete":
        $r = $obj->delete(" customer_id = {$data["customer_id"]} ");
        break;
    default:
        break;
}
echo $r;
if($r){
    redirect("index.php?viewName=customerList");
}else{
    echo $r;
}

