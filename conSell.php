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
    "customer_id" => !empty($_REQUEST["customer_id"]) ?  $_REQUEST["customer_id"] : $_REQUEST["customer_id_s"],
    "sell_quantity" => !empty($_REQUEST["sell_quantity"]) ?  $_REQUEST["sell_quantity"] : "",
    "sell_id" => !empty($_REQUEST["sell_id"]) ?  $_REQUEST["sell_id"] : $_REQUEST["sell_id_s"],
    "sell_sumprice" => !empty($_REQUEST["sell_sumprice"]) ?  $_REQUEST["sell_sumprice"] : "",
    "pay" => !empty($_REQUEST["pay"]) ?  $_REQUEST["pay"] : "",
    "slip" => ""
    );

//upload slip
    $currentDir = getcwd();
    $uploadDirectory = "/upload_img/";
    $errors = []; // Store all foreseen and unforseen errors here
    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions'
    $size =9200000000; // 9200MB
    //-----------------------------------------------------------------------------------
    $fileName = $_FILES['slip']['name'];
    $fileSize = $_FILES['slip']['size'];
    $fileTmpName  = $_FILES['slip']['tmp_name'];
    $fileType = $_FILES['slip']['type'];

    $data["slip"] =  $fileName;

    echo "xxx ".$data["slip"]." yyy";
    //$fileExtension = strtolower(end(explode('.',$fileName)));
    $tmp = explode('.', $fileName);
    $fileExtension = end($tmp);
    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
    //if (isset($_POST['submit'])) {
    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > $size) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
//-----------------------------------------------------------------------------------
echo $action;
$r = false;
switch ($action) {
    case "add":
        $r = $obj->insert($data);
        break;
    case "add_pay":
        $r = $obj->update_pay($data, " sell_id = {$data["sell_id"]} ");
    break;
    case "add_slip":
        $r = $obj->update_slip($data, " sell_id = {$data["sell_id"]} ");
    break;
    case "edit":
        // $r = $obj->update($data, " customer_id = {$data["customer_id"]} AND DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ");
        $r = $obj->update($data, " customer_id = {$data["customer_id"]} ");
        break;
    case "delete":
        $r = $obj->delete(" sell_id = {$data["sell_id"]} ");
        $r = $obj_products->update_return($data, " products_id = {$data['products_id']} ");
        break;
    case "delete_r":
        $r = $obj->delete(" sell_id = {$data["sell_id"]} ");
        $r = $obj_products->update_return($data, " products_id = {$data['products_id']} ");
        break;
    default:
        break;     
}
echo $r;
if($r){
    if($ection == "delete_r"){
            redirect("index.php?viewName=sellReport&customer_id={$data['customer_id']}");
        }else{
            redirect("index.php?viewName=sellList&customer_id={$data['customer_id']}");
    }
        }else{
    echo $r;
}

