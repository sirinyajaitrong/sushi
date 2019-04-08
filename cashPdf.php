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
include "./model/sell.php";
include "./model/customer.php";

$obj_sell = new Sell();
$obj_customer = new customer();

$customer_id = !empty($_REQUEST["customer_id"]) ?  $_REQUEST["customer_id"] : "001";
$rows_sell = $obj_sell->read(" DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') AND s.customer_id = {$customer_id} AND s.delivery_status_id <> 1 ");

$rows_customer =  $obj_customer->read(" customer_id = {$customer_id} ");
$row_customer = $rows_customer[0];

$sum_price = 0;

$content = "";
if ($rows_sell != false) {
    $i = 1;
    foreach ($rows_sell as $row) {
        $sum_price += $row['price'] * $row['sell_quantity'];
        $content .= '<tr style="border:1px solid #000;">
            <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
            <td style="border-right:1px solid #000;padding:3px;"  >'.$row['products_name'].'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['sell_quantity']).' แพ็ค</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['price'],2).'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['price'] * $row['sell_quantity'],2).'</td>
        </tr>';
        $i++;
    }
}

$mpdf = new \Mpdf\Mpdf();

$head = '
<style>
body{
    font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
}
</style>

<table style="width:100%">
  <tr>
    <td style="text-align:center"><img src="images/brand.png" style="text-align:left" /></td>
  </tr>
</table>


<h5 style="text-align:center" >
<span>ร้านเดือนวัตถุดิบ</span>
<br />
<span>201/147 ม.2 ต.บึง อ.ศรีราชา จ.ชลบุรี 20230</span>
<br />
<span>หมายเลขโทรศัพท์ : 096-987-1435</span>
<br />
<span>เลขประจำตัวผู้เสียภาษี : 3410600756379</span>
</h5>

<h2 style="text-align:center">ใบเสร็จรับเงิน</h2>

<h5 style="text-align:center" >
<span>เงินสด</span>
<br />
<span>วันที่  &nbsp;'.DateThai(date("Y-m-d")).'</span>
<span style="text-align:center"><h5 style="text-align:center">เลขที่ใบสั่งซื้อสินค้า SE'.date('Ymd').'-'.$customer_id.'</h5></span>
</h5>





<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
<tr style="border:1px solid #000;padding:4px;">
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
    <td  width="45%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp;รายการ</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">จำนวน</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">ราคา/หน่วย</td>
    <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">จำนวนเงิน</td>
</tr>

</thead>
<tbody>';


$end = "</tbody>


</table>
<h5 style='text-align:right' >
    <span style='text-align:right'>รวมเงิน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($sum_price,2)." บาท</span><br />
    <span style='text-align:right'>ภาษี 7% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($sum_price*0.07,2)." บาท</span><br />
    <span style='text-align:right'>รวมราคาทั้งสิ้น &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($sum_price*1.07,2)." บาท</span><br />
    <span style='text-align:right'>(".convert(number_format($sum_price*1.07,2)).")</span>
</h5>


<br />
<h5 style='text-align:center' >
<span style='text-align:center'>พนักงาน</span><br />
</h5>
<h5 style='text-align:center' >
<span style='text-align:center'>(__________________________) </span><br />
</h5>

<br />
<h5 style='text-align:center' >
<span style='text-align:center'>ผู้รับสินค้า</span><br />
</h5>
<h5 style='text-align:center' >
<span style='text-align:center'>(__________________________) </span><br />
</h5>

";


// $html = '<img src="images/brand.png" />';
// $mpdf->WriteHTML($html);


$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();
