<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/products.php";
include "./model/store.php";
include "./model/orders.php";

$obj = new Products();
$obj_store = new Store();
$obj_orders = new Orders();

$search = " 1=1 ";
if(!empty($_REQUEST["search"])){
    $txt =  str_replace("pro", "", $_REQUEST["search"]);
   // $search = str_repeat("pro0", "0", $search);
    $search = " products_id LIKE '%".$txt."%' 
    OR products_name LIKE '%".$txt."%' ";
}
$store_id = !empty($_REQUEST["store_id"]) ?  $_REQUEST["store_id"] : "";
$rows = $obj->read($search);
$rows_store = $obj_store->read($search);
if($store_id == ""){
    $store_id = $rows_store[0]['store_id'];
}
$rows_orders = $obj_orders->read(" o.store_id = {$store_id} ");
// $rows_orders = $obj_orders->read(" DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') AND o.store_id = {$store_id} ");
//var_dump($rows);
	// $strDate = "2008-08-14 13:42:44";
	// echo "ThaiCreate.Com Time now : ".DateThai($strDate);
?>
<div class="container">
    <h3><label class="label label-warning "  >จัดการสั่งซื้อสินค้า</label></h3>
  <p>
    
    <div class="row">	
    <?php if($_SESSION["status"] != "2"){ ?>  
        <div class="col-md-2 f16  text-right">
        <label>เลือกร้านค้า : </label>
        </div>
        <div class="col-md-2">
            <select id="store_id" name="store_id" class="form-control" onChange="myStore()">
                <?php
                if ($rows_store != false) {
                    foreach ($rows_store as $row_store) {
                    ?>				
                    <option <?php if ($row_store["store_id"] == $store_id) echo 'selected'; ?> value="<?= $row_store["store_id"] ?>" ><?= $row_store["store_name"] ?></option>
                <?php } } ?>
            </select> 
        </div>
        <div class="col-md-1">
        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">สั่งซื้อสินค้า</button> -->
        <button type="button" class="btn btn-success f15"  onclick="AddProduct()">สั่งซื้อสินค้า</button>
        </div>
        <div class="col-md-6">
        </div>
        <?php } ?>
        <br />
    </div>
</div>
<div class="container">    
        <div id="loginbox" style="margin-top:10px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info f16">
                    <div class="panel-heading ">
                        <div class="panel-title f18 " style="text-align: center; font-weight: bold; color: #101010; " >ประวัติการสั่งซื้อสินค้า</div>                     
                    </div>     
                    <br />
                    <div class="table-responsive center " style="width: 1200px;margin-left:20px; color: #101010;">
                    <table class="table table-bordered table-hover f16 center" id="myTable">
                        <thead>
                            <tr class="success">
                                <th class="text-center">ที่</th>     
                                <th class="text-center" style="width: 20px;">รหัสสินค้า</th>       
                                <th class="text-center" style="width: 40px;">ชื่อสินค้า</th> 
                                <th class="text-center" >ชื่อร้านค้า</th>            
                                <!-- <th class="text-center">สี</th>
                                <th class="text-center">ประเภท</th> -->
                                <!-- <th class="text-center">รูปภาพ</th> -->
                                <!-- <th class="text-center">ราคา</th>
                                <th class="text-center">ต้นทุน</th> -->
                                <th class="text-center" style="width: 150px;">จำนวนสั่งซื้อสินค้า</th>
                                <th class="text-center" style="width: 150px;">ราคารวม</th>
                                <th class="text-center" style="width: 150px;">ราคารวมทั้งสิ้น</th>
                                <th class="text-center" >วันที่สั่งซื้อสินค้า</th>
                                <?php if($_SESSION["status"] != "2"){ ?>
                                <th class="text-center" style="width: 40px;">จัดการ</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($rows_orders != false) {
                                $count = 1;
                                foreach ($rows_orders as $row_orders) {
                                    ?>
                                    <tr>
                                        <td class="text-center" style="width: 5px;"><?= $count++; ?></td>
                                        <td class="text-center" style="width: 120px;"><?= $row_orders["products_id"] ?></td>
                                        <td class="text-center" style="width: 200px;"><?= $row_orders["products_name"] ?></td>
                                        <td class="text-center" style="width: 200px;"><?= $row_orders["store_name"] ?></td>
                                        <!-- <td class="text-center" style="width: 5px;"><?= $row_orders["color_name"] ?></td>
                                        <td class="text-center"><?= $row_orders["products_type_name"] ?></td> -->
                                        <!-- <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row_orders['pic'] ?>')" src="./upload_img/<?= $row_orders["pic"] ?>" width="40px;" height="40px" alt=""></td> -->
                                        <!-- <td class="text-center"><?= $row["price"] ?> บาท</td>
                                        <td class="text-center"><?= $row["cost"] ?> บาท</td> -->
                                        <td class="text-right" style="width: 200px;"><?= number_format($row_orders["stock_quantity"]) ?> แพ็ค</td>
                                        <td class="text-right" style="width: 100px;"><?= number_format($row_orders["orders_sumprice"],2) ?> </td>
                                        <td class="text-right" style="width: 150px;"><?= number_format($row_orders["orders_total"],2) ?> </td>
                                        <td class="text-center" style="width: 180px;"><?= DateThaiTime($row_orders["date"]) ?></td>
                                        <?php if($_SESSION["status"] != "2"){ ?>
                                        <td class="text-center" style="width: 100px;">
                                            <a href="#" data-href="conOrders.php?action=delete&orders_id=<?= $row_orders["orders_id"] ?>&products_id=<?= $row_orders["products_id"] ?>&store_id=<?= $store_id ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
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
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-1">
                        <label></label>
                        </div> 
                        <div class="col-md-3">
                           
                        </div>
                        <div class="col-md-1">
                           
                           </div>
                        <?php if($_SESSION["status"] != "2"){ ?>
                        <div class="col-md-1">
                        <button class="btn btn-warning" onclick="onPrint()"><i class="fa fa-print"></i> พิมพ์</button>
                        </div>
                        <?php } ?>
                        <br /><br />
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
                คุณต้องการลบรายการสั่งซื้อสินค้านี้ไหม?
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
                                <td class="text-center" style="width: 90px;"><?= $row["products_id"] ?></td>
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
                                    <button onclick="Addorders('<?= $row["products_name"] ?>', '<?= $row["products_id"] ?>')" class="btn btn-sm btn-info f16">
                                        +สั่งซื้อ
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
<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="ordersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ordersModalLabel" style="text-align: center; font-weight: bold;"></h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">

        <div class="row">	
            <div class="col-md-4 f16"><input type="hidden" id="products_id" name="products_id" value="" /></div>
            <div class="col-md-4 f16">
                <label>จำนวน</label>
                <input type="number" id="stock_quantity" name="stock_quantity" class="form-control text-right" min="1" value="1"  required="" />
            </div>
            <!-- <div class="col-md-5 f16">
                <label>ร้านค้า</label>
                <select id="store_id" name="store_id" class="form-control">
                    <?php
                    if ($rows_store != false) {
                        foreach ($rows_store as $row_store) {
                        ?>				
                        <option value="<?= $row_store["store_id"] ?>" ><?= $row_store["store_name"] ?></option>
                    <?php } } ?>
                </select> 
            </div> -->
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="Actionorders()" >บันทึก</button>
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

    function Addorders(label, products_id){
        $('#products_id').val(products_id);
        $("#ordersModalLabel").text(label);
		$('#ordersModal').modal('show');
    }

    function Actionorders(){
        var products_id = $('#products_id').val();
        var e = document.getElementById("store_id");
        var store_id = e.options[e.selectedIndex].value;
        var stock_quantity = $('#stock_quantity').val();

        window.location.replace("conOrders.php?action=add&products_id="+products_id+"&store_id="+store_id+"&stock_quantity="+stock_quantity);

        // alert($('#products_id').val());
        // alert(store_id);stock_quantity
    }

    function myStore(){
        var e = document.getElementById("store_id");
        var store_id = e.options[e.selectedIndex].value;
        window.location.replace("?viewName=ordersList&store_id="+store_id);
    }

    function onPrint(){
        var e = document.getElementById("store_id");
        var store_id = e.options[e.selectedIndex].value;
        //window.location.replace("ordersPdf.php?store_id="+store_id, '_blank');
        window.open(
            'ordersPdf.php?store_id='+store_id,
            '_blank' // <- This is what makes it open in a new window.
        );
    }

    function AddProduct(){
        var e = document.getElementById("store_id");
        var store_id = e.options[e.selectedIndex].value;

        window.location.replace("?viewName=addProducts&store_id="+store_id);
    }

</script>
<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.4').addClass('ac');
    })
</script>