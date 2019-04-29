<link href="css/site.css" rel="stylesheet" type="text/css"/>
        
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="css/print.min.css" rel="stylesheet" type="text/css"/>
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/datepicker.css">
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<!--<link ef="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>-->
<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/print.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/jquery-input-mask-phone-number.js"></script>

<?php
header('Content-Type: text/html; charset=utf-8');
//เรียกใช้ไฟล์ autoload.php ที่อยู่ใน Folder vendor
require_once __DIR__ . '../../vendor/autoload.php';

include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/products.php";
include "./model/customer.php";
include "./model/sell.php";

$dateF  = "";
$dateT = "";
$total = 0.00;
$cost_of_good_sold = 0;
$net_income = 0;
$content = "";

if ($_REQUEST["dateFrom"] != "" && $_REQUEST["dateTo"] != ""){
	$dateF = $_REQUEST["dateFrom"];
	$dateT =  $_REQUEST["dateTo"];
}

$obj_sell = new Sell();

$rows_sell = $obj_sell->read(" DATE_FORMAT(date,'%Y-%m-%d') >= '".$dateF."' AND DATE_FORMAT( date,'%Y-%m-%d') <= '".$dateT."' ");

if ($rows_sell != false) {
    $i = 1;
    foreach ($rows_sell as $row) {
        $total += $row['sell_total'];
        $cost_of_good_sold += $row['cost'] * $row['sell_quantity'];
        $content .= '<tr style="border:1px solid #000;">
            <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
            <td style="border-right:1px solid #000;padding:3px;">'.$row['products_name'].'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:center;">'.$row['customer_name'].'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:center;">'.DateThaiTime($row["date"]).'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['sell_quantity']).' แพ็ค</td>
            
            <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['sell_total'],2).'</td>
            

          </tr>';
        $i++;
    }
    $content .= '
    <tr>
        <td style="border: 0px solid black;" colspan="5" ></td>
        <td style="border:1px solid #000;padding:3px;text-align:right;"  >'.number_format($total,2).'</td>
    </tr>';
}

// <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
//             <td style="border-right:1px solid #000;padding:3px;">'.$row['products_name'].'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:center;">'.$row['customer_name'].'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:center;">'.DateThaiTime($row["date"]).'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['sell_quantity']).'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['price'],2).'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['cost'],2).'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['price'] * $row['sell_quantity'],2).'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row['cost'] * $row['sell_quantity'],2).'</td>
//             <td style="border-right:1px solid #000;padding:3px;text-align:right;">'.number_format($row["sell_quantity"]*($row["price"]-$row["cost"]),2).'</td>

$mpdf = new \Mpdf\Mpdf();

$head = '
<style>
body{
    font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
}
</style>

<table style="width:100%">
  <tr>
    <td style="text-align:left"><img src="images/brand.png" style="text-align:left" /></td>
    <td style="text-align:right"><h5 style="text-align:center">เลขที่ RE'.date('Ymd').'-'.$_SESSION["users_id"].'</h5></td>
  </tr>
</table>


<h2 style="text-align:center">รายงานสรุปยอดขายสินค้า</h2>

<h6 style="text-align:center">ประจำวันที่ '.DateThai($dateF).' - '.DateThai($dateT).' </h6>


<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:10pt;margin-top:8px;">
<tr style="border:1px solid #000;padding:4px;">
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
    <td  width="45%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp;ชื่อสินค้า</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ชื่อลูกค้า</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="30%">วันที่ขาย</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวนขาย</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ยอดขาย</td>
    

</tr>

</thead>
<tbody>';

// <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ที่</td>
//     <td  width="45%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp;ชื่อสินค้า</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ชื่อลูกค้า</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="30%">วันที่ขาย</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวนขาย</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ราคาขาย</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ราคาทุน</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ยอดขาย</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ทุนขาย</td>
//     <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">กำไรขาย</td>

$end = "</tbody>


</table>
<h5 style='text-align:right' >
    <span style='text-align:right'>ยอดขายสุทธิ &nbsp;&nbsp;".number_format($total,2)." บาท</span>&nbsp;&nbsp;
    <span style='text-align:right'>(".convert(number_format($total,2)).")</span>
</h5>


";

// <span style='text-align:right'>ทุนขายสุทธิ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($cost_of_good_sold,2)." บาท</span><br />
// <span style='text-align:right'>กำไรสุทธิ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($total - $cost_of_good_sold,2)." บาท</span><br />
// <span style='text-align:right'>(".convert(number_format($total - $cost_of_good_sold,2)).")</span>

// $html = '<img src="images/brand.png" />';
// $mpdf->WriteHTML($html);


$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();
