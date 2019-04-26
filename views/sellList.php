<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/products.php";
include "./model/customer.php";
include "./model/sell.php";

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
$rows_sell = $obj_sell->read(" s.customer_id = {$customer_id} ");
// $rows_sell = $obj_sell->read(" DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') AND s.customer_id = {$customer_id} AND s.delivery_status_id <> 1 ");
//var_dump($rows);
	// $strDate = "2008-08-14 13:42:44";
	// echo "ThaiCreate.Com Time now : ".DateThai($strDate);
?>
<div class="container">
    <h3><label class="label label-warning"  >จัดการขายสินค้า</label></h3>
    <br />
    
    <div class="row">	  
        <div class="col-md-2 f16 text-right">
        <label>เลือกลูกค้า: </label>
        </div> 
        <div class="col-md-2">
            <select id="customer_id" name="customer_id" class="form-control" onChange="mycustomer()">
                <?php
                if ($rows_customer != false) {
                    foreach ($rows_customer as $row_customer) {
                    ?>				
                    <option <?php if ($row_customer["customer_id"] == $customer_id) echo 'selected'; ?> value="<?= $row_customer["customer_id"] ?>" ><?= $row_customer["customer_name"] ?></option>
                <?php } } ?>
            </select> 
        </div>
        <?php if($_SESSION["status"] != "2"){ ?>
        <div class="col-md-1 f16">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">เลือกสินค้า</button>
        </div>
        <?php } ?>
        <div class="col-md-6">
        </div>
        <br />
    </div>
</div>
<div class="container">    
        <div id="loginbox" style="margin-top:10px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info f16" >
                    <div class="panel-heading">
                        <div class="panel-title f18 " style="text-align: center; font-weight: bold; color: #101010;" >ประวัติการขายสินค้า</div>                     
                    </div>     
                    <br />
                    <div class="table-responsive center" style="width: 1200px;margin-left:20px; color: #101010;">
                    <table class="table table-bordered table-hover f16 center" id="myTable">
                        <thead>
                            <tr class="success">
                                <th class="text-center" style="width: 5px;">ที่</th>     
                                <!-- <th class="text-center">รหัสสินค้า</th>        -->
                                <th class="text-center">ชื่อสินค้า</th> 
                                <!-- <th class="text-center" style="width: 100px;">ชื่อลูกค้า</th>             -->
                                <!-- <th class="text-center">สี</th>
                                <th class="text-center">ประเภท</th> -->
                                <!-- <th class="text-center">รูปภาพ</th> -->
                                <!-- <th class="text-center">ราคา</th>
                                <th class="text-center">ต้นทุน</th> -->
                                <th class="text-center" ">จำนวนขาย</th>
                                <th class="text-center">วันที่ขายสินค้า</th>
                                <th class="text-center">ราคารวม</th>
                            <?php if($customer_id != "001") { ?>
                                <th class="text-center">จำนวนเงิน</th>
                                <!-- <th class="text-center" >ค้างชำระ</th> -->
                            <?php } ?>
                                
                            <?php if($customer_id != "001") { ?>
                                <th class="text-center">วันที่ชำระเงิน</th>
                                <th class="text-center">การจัดส่ง</th> 
                            <?php } ?>                     
                            <?php if(($customer_id != "001" && $_SESSION["status"] != "2")||($customer_id != "001" && $_SESSION["status"] == "2")) { ?>
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
                                        <!-- <td class="text-center" style="width: 120px;"><?= $row_sell["products_id"] ?></td> -->
                                        <td class="text-center" style="width: 100px;"><?= $row_sell["products_name"] ?></td>
                                        <!-- <td class="text-center" style="width: 120px;"><?= $row_sell["customer_name"] ?></td> -->
                                        <!-- <td class="text-center" style="width: 5px;"><?= $row_sell["color_name"] ?></td>
                                        <td class="text-center"><?= $row_sell["products_type_name"] ?></td> -->
                                        <!-- <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row_sell['pic'] ?>')" src="./upload_img/<?= $row_sell["pic"] ?>" width="40px;" height="40px" alt=""></td> -->
                                        <!-- <td class="text-center"><?= $row["price"] ?> บาท</td>
                                        <td class="text-center"><?= $row["price"] ?> บาท</td> -->
                                        <td class="text-right" style="width: 100px;"><?= number_format($row_sell["sell_quantity"]) ?> แพ็ค</td>
                                        <td class="text-center" style="width: 175px;"><?= DateThaiTime($row_sell["date"]) ?></td>
                                        <td class="text-right" style="width: 95px;"><?= number_format($row_sell["sell_sumprice"],2) ?> </td>
                                    <?php if($customer_id != "001") { ?>   
                                        <td class="text-right" style="width: 95px;"><?= number_format($row_sell["pay"],2) ?> </td>
                                        <!-- <td class="text-right" style="width: 120px;"><?= number_format($row_sell["sell_sumprice"]-$row_sell["pay"],2) ?> </td> -->
                                    <?php } ?>      
                                        
                                    <?php if($customer_id != "001") { ?>
                                        <td class="text-center" style="width: 175;"><?php if(!empty($row_sell["date_pay"])){ echo DateThaiTime($row_sell["date_pay"]); } ?></td>
                                        <td class="text-center" style="width: 85px;"><?= $row_sell["delivery_status_name"] ?></td>
                                    <?php } ?>
                                    <?php if(($customer_id != "001" && $_SESSION["status"] != "2")||($customer_id != "001" && $_SESSION["status"] == "2")) { ?>
                                        <td class="text-center f16" style="width: 180px;">
                                            <?php if($customer_id != "001") { ?> 
                                                <button onclick="AddPay('<?= $row_sell["sell_id"] ?>', '<?= $row_sell["products_name"] ?>', '<?= $row_sell["sell_sumprice"]-$row_sell["pay"] ?>')" class="btn btn-info">
                                                    ชำระเงิน
                                                </button>
                                            <?php } ?>
                                            
                                            <?php if($_SESSION["status"] != "2" && $row_sell["delivery_status_id"] != "1" && $row_sell["pay"] == 0){ ?>
                                            <a href="#" data-href="conSell.php?action=delete&sell_id=<?= $row_sell["sell_id"] ?>&products_id=<?= $row_sell["products_id"] ?>&sell_quantity=<?= $row_sell["sell_quantity"] ?>&customer_id=<?= $customer_id ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
                                                                                            ลบ
                                            </a>  
                                            <?php } ?>
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
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-1">
                        <label></label>
                        </div>
                        <div class="col-md-3">
                           
                        </div>
                        <div class="col-md-2">
                        <?php if($_SESSION["status"] != "2"){ ?>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-warning" onclick="onPrint()"><i class="fa fa-print"></i> พิมพ์</button>
                        
                            <?php if($customer_id != "001"){ ?>
                            <button id="sended" name="sended" class="btn btn-success" onclick="onUpdate()"><i class="fa fa-paper-plane"></i> จัดส่งสินค้า</button>
                            <?php } ?>
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
                คุณต้องลบการขายสินค้านี้ไหม?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-danger btn-ok" >ลบ</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="msgStock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                แจ้งเตือน!
            </div>
            <div class="modal-body">
                จำนวนสินค้าไม่เพียงพอสำหรับการขาย!!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ตกลง</button>
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

<div id="productModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <th class="text-center">ราคา</th>
                        <th class="text-center">วันที่ผลิต</th>
                        <th class="text-center">วันหมดอายุ</th>
                        <th class="text-center">สต็อก</th>
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
                                <td class="text-center" style="width: 90px;"><?= $row["products_id"] ?></td>
                                <td class="text-center" style="width: 120px;"><?= $row["products_name"] ?></td>
                                <td class="text-center" style="width: 5px;"><?= $row["color_name"] ?></td>
                                <!-- <td class="text-center"><?= $row["products_type_name"] ?></td>
                                <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row['pic'] ?>')" src="./upload_img/<?= $row["pic"] ?>" width="40px;" height="40px" alt=""></td> -->
                                <!-- <td class="text-center"><?= $row["price"] ?> บาท</td> -->
                                <td class="text-center"><?= number_format($row["price"],2) ?> </td>
                                <td class="text-center" style="width: 150px;"><?= DateThai($row["mfd"]) ?></td>
                                <td class="text-center" style="width: 150px;"><?= DateThai($row["exd"]) ?></td>
                                <td class="text-center" style="width: 70px;"><?= $row["stock"] ?> แพ็ค</td>
                                <?php if($_SESSION["status"] != "2"){ ?>
                                <td class="text-center">
                                    <button onclick="Addsell('<?= $row["products_name"] ?>', '<?= $row["products_id"] ?>', '<?= $row["price"] ?>', '<?= $row["stock"] ?>')" class="btn btn-sm btn-info f16">
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
                <input type="hidden" id="price" name="price" />
                <input type="hidden" id="stock" name="stock" />
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

<!-- Modal -->
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stockModalLabel" style="text-align: center; font-weight: bold;"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">

        <div class="row">	
            <div class="col-md-1 f16"><input type="hidden" id="sell_id" name="sell_id" value="" /></div>
            <div class="col-md-4 f16">
                <label>ค้างชำระ</label>
                <input type="number" id="cm_pay" name="cm_pay"  class="form-control text-right" min="1" value="1" readonly  required="" />
            </div>
            <div class="col-md-5 f16">
                <label>ต้องการชำระ</label>
                <input type="number" id="c_pay" name="c_pay"  class="form-control text-right" min="1" value="1"  required="" />
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="ActionPayment()" >บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script>
    function AddPay(sell_id, products_name, cm_pay){
        $('#sell_id').val(sell_id);
        $('#c_pay').val(cm_pay);
        $('#cm_pay').val(cm_pay);
        $("#stockModalLabel").text(products_name);
		$('#stockModal').modal('show');
    }

    function ActionPayment(){
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        var sell_id = $('#sell_id').val();
        var pay = $('#c_pay').val();
        window.location.replace("conSell.php?action=add_pay&sell_id="+sell_id+"&pay="+pay+"&customer_id="+customer_id);

        // alert($('#products_id').val());
        // alert(store_id);stock_quantity
    }


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

    function Addsell(label, products_id, price, stock){
        $('#products_id').val(products_id);
        $("#sellModalLabel").text(label);
        $("#price").val(price);
        $("#stock").val(stock);
		$('#sellModal').modal('show');
    }

    function Actionsell(){
        var products_id = $('#products_id').val();
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        var sell_quantity = 0;
        var stock = 0;
        var price = 0;

        if($("#sell_quantity").val().trim() != ""){
            sell_quantity = parseInt($("#sell_quantity").val().trim(), 10);
        }
        if($("#stock").val().trim() != ""){
            stock = parseInt($("#stock").val().trim(), 10);
        }
        if($("#price").val().trim() != ""){
            price = parseInt($("#price").val().trim(), 10);
        }
        
        var sell_sumprice = sell_quantity * price;
        // alert(sell_sumprice);
        // alert(stock);

        if(sell_quantity > stock){
            $('#productModal').modal('hide');
            $('#sellModal').modal('hide');
            $("#msgStock").modal('show');
        }else{
            window.location.replace("conSell.php?action=add&products_id="+products_id+"&customer_id="+customer_id+"&sell_quantity="+sell_quantity+"&sell_sumprice="+sell_sumprice);
        }
    }

    function mycustomer(){
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        window.location.replace("?viewName=sellList&customer_id="+customer_id);
    }

    function onPrint(){
        var e = document.getElementById("customer_id");
        var customer_id = e.options[e.selectedIndex].value;
        var report = "cashPdf.php";
        if(customer_id != "001"){
            report = "sellPdf.php";
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
</script>
<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.6').addClass('ac');
    })
</script>