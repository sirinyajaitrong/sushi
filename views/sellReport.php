<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/products.php";
include "./model/customer.php";
include "./model/sell.php";

$dateF  = "";
$dateT = "";
$total = 0.00;
if ($_REQUEST["dateFrom"] != "" && $_REQUEST["dateTo"] != ""){
	$dateF = $_REQUEST["dateFrom"];
	$dateT =  $_REQUEST["dateTo"];
}

$obj = new Products();
$obj_customer = new Customer();
$obj_sell = new Sell();

$search = " 1=1 ";
// if(!empty($_REQUEST["search"])){
//     $txt =  str_replace("pro", "", $_REQUEST["search"]);
//    // $search = str_repeat("pro0", "0", $search);
//     $search = " products_id LIKE '%".$txt."%' 
//     OR products_name LIKE '%".$txt."%' ";
// }
$customer_id = !empty($_REQUEST["customer_id"]) ?  $_REQUEST["customer_id"] : "";
$rows = $obj->read();
$rows_customer = $obj_customer->read();
if($customer_id == ""){
    $customer_id = $rows_customer[0]['customer_id'];
}
$rows_sell = $obj_sell->read(" DATE_FORMAT(date,'%Y-%m-%d') >= '".$dateF."' AND DATE_FORMAT( date,'%Y-%m-%d') <= '".$dateT."' ");
//var_dump($rows);
	// $strDate = "2008-08-14 13:42:44";
	// echo "ThaiCreate.Com Time now : ".DateThai($strDate);
?>
<style>
    .color-box{
        display: inline-block;
        height: 25px;
        width: 90px;
    }
</style>
<script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {		
		$('#dateFrom').datepicker({
			format: "yyyy-mm-dd"
		});  
		$('#dateTo').datepicker({
			format: "yyyy-mm-dd"
		});  
	});
</script>

<div class="container">
    <h3><label class="label label-warning"  >รายงานการขายสินค้า</label></h3>
    <br />
    
    <div class="row">	  
        <div class="col-md-1">
        <label>เลือกวันที่: </label>
        </div>
        <div class="col-md-2">
            <div class="hero-unit">
            <label>วันที่เริ่มต้น </label>
                <input style="text-align:center;"  type="text" placeholder=""  id="dateFrom"  name="dateFrom"class="form-control" readonly="readonly"  value="<?= $dateF ?>" required="">
            </div>
        </div>
 
        <div class="col-md-2">
            <div class="hero-unit">
            <label>วันที่สิ้นสุด </label>
                <input  style="text-align:center;" type="text" placeholder=""  id="dateTo" name="dateTo" class="form-control" readonly="readonly" value="<?= $dateT ?>" required="">
            </div>
        </div>

        <div class="col-md-1">
        <button type="button" class="btn btn-primary" onclick="search()">ค้นหา</button>
        </div>
        <div class="col-md-6">
        </div>
        <br />
    </div>
</div>


<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title f20 " style="text-align: center; font-weight: bold; " >ประวัติการขายสินค้า</div>                     
                    </div>     
                    <br />
                    <div class="table-responsive center" style="width: 1000px;margin-left:130px;">
                    <table class="table table-bordered table-hover f16 center" id="myTable">
                        <thead>
                            <tr class="success">
                                <th class="text-center" style="width: 5px;">ที่</th>     
                                <th class="text-center">รหัสสินค้า</th>       
                                <th class="text-center">ชื่อสินค้า</th> 
                                <th class="text-center">ชื่อลูกค้า</th>  
                                <th class="text-center">วันที่ขายสินค้า</th>          
                                <!-- <th class="text-center">สี</th>
                                <th class="text-center">ประเภท</th> -->
                                <!-- <th class="text-center">รูปภาพ</th> -->
                                <!-- <th class="text-center">ราคา</th>
                                <th class="text-center">ต้นทุน</th> -->
                                <th class="text-center"  style="width: 100px;">จำนวนที่ขาย</th>
                                <th class="text-center">ยอดขาย</th>
                                <?php if($_SESSION["status"] != "2"){ ?>
                                <th class="text-center">จัดการ</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($rows_sell != false) {
                                $count = 1;
                                foreach ($rows_sell as $row_sell) {
                                    ?>
                                    <tr>
                                        <td class="text-center" style="width: 5px;"><?= $count++; ?></td>
                                        <td class="text-center" style="width: 90px;">pro<?= $row_sell["products_id"] ?></td>
                                        <td class="text-center" style="width: 120px;"><?= $row_sell["products_name"] ?></td>
                                        <td class="text-center" style="width: 200px;"><?= $row_sell["customer_name"] ?></td>
                                        <td class="text-center" style="width: 140px;"><?= DateThai($row_sell["date"]) ?></td>
                                        <!-- <td class="text-center" style="width: 5px;"><?= $row_sell["color_name"] ?></td>
                                        <td class="text-center"><?= $row_sell["products_type_name"] ?></td> -->
                                        <!-- <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row_sell['pic'] ?>')" src="./upload_img/<?= $row_sell["pic"] ?>" width="40px;" height="40px" alt=""></td> -->
                                        <!-- <td class="text-center"><?= $row["price"] ?> บาท</td>
                                        <td class="text-center"><?= $row["price"] ?> บาท</td> -->
                                        <td class="text-right" style="width: 100px;"><?= number_format($row_sell["sell_quantity"]) ?> แพ็ค</td>
                                        <td class="text-right" style="width: 100px;"><?= number_format($row_sell["sell_quantity"]*$row_sell["price"],2) ?> บาท</td>
                                        
                                        <?php if($_SESSION["status"] != "2"){ ?>
                                        <td class="text-center" style="width: 100px;">
                                            <a href="#" data-href="conSell.php?action=delete&sell_id=<?= $row_sell["sell_id"] ?>&customer_id=<?= $customer_id ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
                                                                                            ลบ
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        
                        </tbody>
                    </table> 
                </div>
                    <div class="row">	
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-1">
                        <label></label>
                        </div>
                        <div class="col-md-3">
                           
                        </div>
                        <div class="col-md-3">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-warning" onclick="onPrint()"><i class="fa fa-print"></i> พิมพ์</button>
                            <?php if($customer_id != "001"){ ?>
                            <button id="sended" name="sended" class="btn btn-success" onclick="onUpdate()"><i class="fa fa-paper-plane"></i> จัดส่งสินค้าแล้ว</button>
                            <?php } ?>
                        </div>
                        </div>
                        <br /><br /><br />
                    </div>
            </div>            
         </div>    
    </div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                แจ้งเตือน!
            </div>
            <div class="modal-body">
                คุณต้องการลบสินค้านี้ไหม?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-danger btn-ok" >ลบ</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4> -->
      </div>
      <div class="modal-body">
            <img id="pic" name="pic"  src="" width="100%;" height="100%" alt="">
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      </div> -->
    </div>

  </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="table-responsive center" style="width: 800px;margin-left:50px;margin-top:20px;">
            <table class="table table-bordered table-hover f16" id="myTable1">
                <thead>
                    <tr class="success">
                        <!-- <th class="text-center">ที่</th>      -->
                        <th class="text-center">รหัสสินค้า</th>      
                        <th class="text-center">ชื่อสินค้า</th>             
                        <th class="text-center">สี</th>
                        <!-- <th class="text-center">ประเภท</th> -->
                        <!-- <th class="text-center">รูปภาพ</th> -->
                        <!-- <th class="text-center">ราคา</th> -->
                        <th class="text-center">ต้นทุน</th>
                        <th class="text-center">วันที่ผลิต</th>
                        <th class="text-center">วันหมดอายุ</th>
                        <!-- <th class="text-center">สต็อก</th> -->
                        <?php if($_SESSION["status"] != "2"){ ?>
                        <th class="text-center">จัดการ</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($rows != false) {
                        $count = 1;
                        foreach ($rows as $row) {
                            ?>
                            <tr>
                                <!-- <td class="text-center" style="width: 5px;"><?= $count++; ?></td> -->
                                <td class="text-center" style="width: 90px;">pro<?= $row["products_id"] ?></td>
                                <td class="text-center" style="width: 120px;"><?= $row["products_name"] ?></td>
                                <td class="text-center" style="width: 5px;"><?= $row["color_name"] ?></td>
                                <!-- <td class="text-center"><?= $row["products_type_name"] ?></td>
                                <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row['pic'] ?>')" src="./upload_img/<?= $row["pic"] ?>" width="40px;" height="40px" alt=""></td> -->
                                <!-- <td class="text-center"><?= $row["price"] ?> บาท</td> -->
                                <td class="text-center"><?= number_format($row["cost"],2) ?> บาท</td>
                                <td class="text-center" style="width: 140px;"><?= DateThai($row["mfd"]) ?></td>
                                <td class="text-center" style="width: 140px;"><?= DateThai($row["exd"]) ?></td>
                                <!-- <td class="text-center" style="width: 100px;"><?= $row["stock"] ?> แพ็ค</td> -->
                                <?php if($_SESSION["status"] != "2"){ ?>
                                <td class="text-center">
                                    <button onclick="Addsell('<?= $row["products_name"] ?>', '<?= $row["products_id"] ?>')" class="btn btn-sm btn-info f16">
                                        +ขาย
                                    </button>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                
                </tbody>
            </table>
        </div>     

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-labelledby="sellModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sellModalLabel" style="text-align: center; font-weight: bold;"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">

        <div class="row">	
            <div class="col-md-4 f16"><input type="hidden" id="products_id" name="products_id" value="" /></div>
            <div class="col-md-4 f16">
                <label>จำนวน</label>
                <input type="number" id="sell_quantity" name="sell_quantity" class="form-control text-right" min="1" value="1"  required="" />
            </div>
            <!-- <div class="col-md-5 f16">
                <label>ร้านค้า</label>
                <select id="customer_id" name="customer_id" class="form-control">
                    <?php
                    if ($rows_customer != false) {
                        foreach ($rows_customer as $row_customer) {
                        ?>				
                        <option value="<?= $row_customer["customer_id"] ?>" ><?= $row_customer["customer_name"] ?></option>
                    <?php } } ?>
                </select> 
            </div> -->
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="Actionsell()" >บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script>
    function showPic(pic){
        //alert(pic);
        document.getElementById("pic").src = pic;
        $('#myModal').modal('show');
    }

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    // function ActSearch(){
    //     var search = $("#search").val();
    //     window.location.replace("index.php?viewName=productsList&search="+search);
    // }

    function Addsell(label, products_id){
        $('#products_id').val(products_id);
        $("#sellModalLabel").text(label);
		$('#sellModal').modal('show');
    }

    function Actionsell(){
        var products_id = $('#products_id').val();
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        var sell_quantity = $('#sell_quantity').val();

        window.location.replace("conSell.php?action=add&products_id="+products_id+"&customer_id="+customer_id+"&sell_quantity="+sell_quantity);

        // alert($('#products_id').val());
        // alert(customer_id);sell_quantity
    }

    function mycustomer(){
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        window.location.replace("?viewName=sellList&customer_id="+customer_id);
    }

    function onPrint(){
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        var report = "reportPdf.php";
        if(customer_id != "001"){
            report = "reportPdf.php";
        }
        //window.location.replace("sellPdf.php?customer_id="+customer_id, '_blank');
        window.open(
            report+'?customer_id='+customer_id,
            '_blank' // <- This is what makes it open in a new window.
        );
    }

    function onUpdate(){
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;

        window.location.replace("conSell.php?action=edit&customer_id="+customer_id);

        // alert($('#products_id').val());
        // alert(customer_id);sell_quantity
    }

    function search(){
        var dateFrom = $("#dateFrom").val();
        var dateTo = $("#dateTo").val();
        window.location.replace("?viewName=reportPdf&dateFrom="+dateFrom+"&dateTo="+dateTo);
    }
</script>
<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.7').addClass('ac');
    })
</script>