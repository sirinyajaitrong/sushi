<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/products.php";
include "./model/store.php";
include "./model/stock.php";

$obj = new Products();
$obj_store = new Store();
$obj_stock = new Stock();

$search = " 1=1 ";
if(!empty($_REQUEST["search"])){
    $txt =  str_replace("pro", "", $_REQUEST["search"]);
   // $search = str_repeat("pro0", "0", $search);
    $search = " products_id LIKE '%".$txt."%' 
    OR products_name LIKE '%".$txt."%' ";
}
$rows = $obj->read($search);
$rows_store = $obj_store->read($search);
$rows_stock = $obj_stock->read();

//var_dump($rows);
	// $strDate = "2008-08-14 13:42:44";
	// echo "ThaiCreate.Com Time now : ".DateThai($strDate);
?>
<div class="container">
    <h3><label class="label label-warning"  >จัดการสินค้า</label></h3>
    <br />
        <!-- <div class="row">
                <div class="form-group col-md-3">
                    <input class="f17 form-control col-md-3" type="text" id="search" name="search" value="" placeholder="ค้นหาสินค้า" />
                </div>
                <div class="form-group col-md-3 ">
                <button type="button" onclick="ActSearch()" class="btn btn-info f16">
                ค้นหา 
                </button>
                </div>
               
        </div> -->
    <div class="table-responsive f16" >
        <table class="table table-bordered table-hover f16" id="myTable1">
            <thead>
                <tr class="success">
                    <th class="text-center">ที่</th>     
                    <th class="text-center">รหัสสินค้า</th>      
                    <th class="text-center">ชื่อสินค้า</th>             
                    <th class="text-center">สี</th>
                    <th class="text-center">ประเภท</th>
                    <th class="text-center">รูปภาพ</th>
                    <th class="text-center">ราคา</th>
                    <th class="text-center">ต้นทุน</th>
                    <th class="text-center" >วันที่ผลิต</th>
                    <th class="text-center" style="width: 150px;">วันหมดอายุ</th>
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
                        if($row["stock"] < 6){
                        ?>
                            <tr style="background-color:red;">
                        <?php }else{ ?>
                            <tr>
                        <?php } ?>
                            <td class="text-center" style="width: 5px;"><?= $count++; ?></td>
                            <td class="text-center" style="width: 90px;"><?= $row["products_id"] ?></td>
                            <td class="text-center" style="width: 140px;"><?= $row["products_name"] ?></td>
                            <td class="text-center" style="width: 5px;"><?= $row["color_name"] ?></td>
                            <td class="text-center"><?= $row["products_type_name"] ?></td>
                            <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row['pic'] ?>')" src="./upload_img/<?= $row["pic"] ?>" width="40px;" height="40px" alt=""></td>
                            <td class="text-center"><?= $row["price"] ?> บาท</td>
                            <td class="text-center"><?= $row["cost"] ?> บาท</td>
                            <td class="text-center" style="width: 150px;"><?= DateThai($row["mfd"]) ?></td>
                            <td class="text-center" style="width: 150px;"><?= DateThai($row["exd"]) ?></td>
                            <td class="text-center" style="width: 90px;"><?= $row["stock"] ?> แพ็ค</td>
                            <?php if($_SESSION["status"] != "2"){ ?>
                            <td class="text-center">
                                <a href="index.php?viewName=editProducts&products_id=<?= $row["products_id"] ?>" class=" btn btn-sm btn-success f16">
                                    แก้ไข
                                </a>
                                <!-- <a href="#" data-href="conProducts.php?action=delete&products_id=<?= $row["products_id"] ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
                                                                                            ลบ
                                </a> -->
                                <!-- <button onclick="AddStock('<?= $row["products_name"] ?>', '<?= $row["products_id"] ?>')" class="btn btn-sm btn-info f16">
                                    +stock
                                </button> -->
                            </td>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                }
                ?>
               
            </tbody>
        </table>
        <!-- <div class="col-md-12 pull-right">
          <?php if($_SESSION["status"] != "2"){ ?>
          <a href="index.php?viewName=addProducts" class="btn  btn-sm btn-primary pull-right f16">เพิ่มสินค้า</a>
          <?php } ?>
       </div> -->
    </div>
</div>


<!-- <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title f20 " style="text-align: center; font-weight: bold; " >ประวัติการเพิ่มสต็อกสินค้า</div>                     
                    </div>     
                    <br />
                    <div class="table-responsive center" style="width: 1200px;margin-left:20px;">
                    <table class="table table-bordered table-hover f16 center" id="myTable">
                        <thead>
                            <tr class="success">
                                <th class="text-center">ที่</th>     
                                <th class="text-center">รหัสสินค้า</th>       
                                <th class="text-center">ชื่อสินค้า</th> 
                                <th class="text-center">ชื่อร้านค้า</th>            
                                <th class="text-center">รูปภาพ</th>
                                <th class="text-center">สต็อก</th>
                                <th class="text-center">วันที่สินค้าเข้า</th>
                                <?php if($_SESSION["status"] != "2"){ ?>
                                <th class="text-center">จัดการ</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($rows_stock != false) {
                                $count = 1;
                                foreach ($rows_stock as $row_stock) {
                                    ?>
                                    <tr>
                                        <td class="text-center" style="width: 5px;"><?= $count++; ?></td>
                                        <td class="text-center" style="width: 150px;"><?= $row_stock["products_id"] ?></td>
                                        <td class="text-center" style="width: 200px;"><?= $row_stock["products_name"] ?></td>
                                        <td class="text-center" style="width: 200px;"><?= $row_stock["store_name"] ?></td>
                                        <td class="text-center" > <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row_stock['pic'] ?>')" src="./upload_img/<?= $row_stock["pic"] ?>" width="40px;" height="40px" alt=""></td>
                                        <td class="text-center" style="width: 200px;"><?= $row_stock["stock_quantity"] ?> แพ็ค</td>
                                        <td class="text-center" style="width: 200px;"><?= DateThaiTime($row_stock["date"]) ?></td>
                                        <?php if($_SESSION["status"] != "2"){ ?>
                                        <td class="text-center" style="width: 100px;">
                                            <a href="#" data-href="conStock.php?action=delete&stock_id=<?= $row_stock["stock_id"] ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
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

            </div>               
         </div> 
</div> -->


<!-- <a href="#" data-href="delete.php?id=23" data-toggle="modal" data-target="#confirm-delete">Delete record #23</a>

<button class="btn btn-default" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">
    Delete record #54
</button> -->


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
            <div class="col-md-1 f16"><input type="hidden" id="products_id" name="products_id" value="" /></div>
            <div class="col-md-4 f16">
                <label>เพิ่มสต็อก</label>
                <input type="number" id="stock_quantity" name="stock_quantity"  class="form-control text-right" min="1" value="1"  required="" />
            </div>
            <div class="col-md-5 f16">
                <label>ร้านค้า</label>
                <select id="store_id" name="store_id" class="form-control">
                    <?php
                    if ($rows_store != false) {
                        foreach ($rows_store as $row_store) {
                        ?>				
                        <option value="<?= $row_store["store_id"] ?>" ><?= $row_store["store_name"] ?></option>
                    <?php } } ?>
                </select> 
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" onclick="ActionStock()" >บันทึก</button>
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

    function ActSearch(){
        var search = $("#search").val();
        window.location.replace("index.php?viewName=productsList&search="+search);
    }

    function AddStock(label, products_id){
        $('#products_id').val(products_id);
        $("#stockModalLabel").text(label);
		$('#stockModal').modal('show');
    }

    function ActionStock(){
        var products_id = $('#products_id').val();
        var e = document.getElementById("store_id");
        var store_id = e.options[e.selectedIndex].value;
        var stock_quantity = $('#stock_quantity').val();

        window.location.replace("conStock.php?action=add&products_id="+products_id+"&store_id="+store_id+"&stock_quantity="+stock_quantity);

        // alert($('#products_id').val());
        // alert(store_id);stock_quantity
    }
</script>
<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.5').addClass('ac');
    })
</script>