<?php
header('Content-Type: text/html; charset=utf-8');

include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/sell.php";
include "./model/products.php";

$obj = new Sell();
$obj_products = new Products();

 $action = $_REQUEST["action"];
 $data = array(
    "products_id" => !empty($_REQUEST["products_id"]) ?  $_REQUEST["products_id"] : "",
    "customer_id" => !empty($_REQUEST["customer_id"]) ?  $_REQUEST["customer_id"] : "",
    "sell_quantity" => !empty($_REQUEST["sell_quantity"]) ?  $_REQUEST["sell_quantity"] : "",
    "sell_id" => !empty($_REQUEST["sell_id"]) ?  $_REQUEST["sell_id"] : "",
    "sell_sumprice" => !empty($_REQUEST["sell_sumprice"]) ?  $_REQUEST["sell_sumprice"] : "",
    "pay" => !empty($_REQUEST["pay"]) ?  $_REQUEST["pay"] : ""
    );

$r = false;
switch ($action) {
    case "add":
        $r = $obj->insert($data);
        break;
    case "add_pay":
        $r = $obj->update_pay($data, " sell_id = {$data["sell_id"]} ");
    break;
    case "edit":
        // $r = $obj->update($data, " customer_id = {$data["customer_id"]} AND DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ");
        $r = $obj->update($data, " customer_id = {$data["customer_id"]} ");
        break;
    case "delete":
        $r = $obj->delete(" sell_id = {$data["sell_id"]} ");
        $r = $obj_products->update_return($data, " products_id = {$data['products_id']} ");
        break;
    default:
        break;
}
echo $r;
if($r){
    redirect("index.php?viewName=sellList&customer_id={$data['customer_id']}");
}else{
    echo $r;
}

