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
include "./model/orders.php";
include "./model/store.php";

$obj_orders = new Orders();
$obj_store = new Store();

$store_id = !empty($_REQUEST["store_id"]) ?  $_REQUEST["store_id"] : "0";
$rows_orders = $obj_orders->read(" DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') AND o.store_id = {$store_id} ");

$rows_store =  $obj_store->read(" store_id = {$store_id} ");
$row_store = $rows_store[0];

$sum_price = 0;

$content = "";
if ($rows_orders != false) {
    $i = 1;
    foreach ($rows_orders as $row) {
        $sum_price += $row['cost'] * $row['stock_quantity'];
        $content .= '<tr style="border:1px solid #000;">
            <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$i.'</td>
            <td style="border-right:1px solid #000;padding:3px;"  >'.$row['products_name'].'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['stock_quantity']).' แพ็ค</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['cost'],2).'</td>
            <td style="border-right:1px solid #000;padding:3px;text-align:right;"  >'.number_format($row['cost'] * $row['stock_quantity'],2).'</td>
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
    <td style="text-align:left"><img src="images/brand.png" style="text-align:left" /></td>
    <td style="text-align:right"><h5 style="text-align:right">เลขที่ใบสั่งซื้อสินค้า PO'.date('Ymd').'-'.$store_id.'</h5></td> 
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
<h2 style="text-align:center">ใบสั่งซื้อสินค้า</h2>

<h5 style="text-align:left" >
<span>ชื่อผู้ขาย : '.$row_store['store_name'].'</span>
<br />
<span>ที่อยู่ : '.$row_store['address'].'</span>
<br />
<span>หมายเลขโทรศัพท์ : '.$row_store['tel'].' &nbsp;&nbsp;&nbsp;&nbsp;หมายเลขโทรศัพท์เคลื่อนที่ : '.$row_store['telephone'].'</span>
<br />
<span>เลขประจำตัวผู้เสียภาษี : '.$row_store['tax'].'</span>
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



<h5 style='text-align:center' >
<span style='text-align:center'>พนักงาน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  เจ้าของร้าน</span><br />
</h5>

<h5 style='text-align:center' >
<span style='text-align:center'>__________________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  __________________________</span><br />
</h5>

<br /> 
<h5 style='text-align:center' >
<span style='text-align:center'>ตราประทับร้าน</span><br />
</h5>
<br /> 
<h5 style='text-align:center' >
<span style='text-align:center'>_____________________________</span><br />
</h5>
";


// $html = '<img src="images/brand.png" />';
// $mpdf->WriteHTML($html);


$mpdf->WriteHTML($head);

$mpdf->WriteHTML($content);

$mpdf->WriteHTML($end);

$mpdf->Output();
