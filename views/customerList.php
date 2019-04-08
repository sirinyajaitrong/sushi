<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/customer.php";
$obj = new Customer();
$search = " 1=1 ";
//echo str_replace("world","Peter","Hello world!");

if(!empty($_REQUEST["search"])){
    $txt =  str_replace("cus", "", $_REQUEST["search"]);
   // $search = str_repeat("cus0", "0", $search);
    $search = " customer_id LIKE '%".$txt."%' 
    OR customer_name LIKE '%".$txt."%' ";
}
$rows = $obj->read($search);
//var_dump($rows);
?>
<div class="container">
    <h3><label class="label label-warning"  >จัดการลูกค้า</label></h3>
    <br />
    <div class="row">
                <div class="form-group col-md-3">
                    <input class="f17 form-control col-md-3" type="text" id="search" name="search" value="" placeholder="ค้นหาผู้ใช้งาน" />
                </div>
                <div class="form-group col-md-3 ">
                <button type="button" onclick="ActSearch()" class="btn btn-info f16">
                ค้นหา 
                </button>
                </div>
               
    </div>
    <div class="table-responsive" >
        <table class="table table-bordered table-hover f16 " >
            <thead>
                <tr class="success">
                    <th class="text-center">ที่</th>     
                    <th class="text-center">รหัสลูกค้า</th>      
                    <th class="text-center" style="width: 100px;">คำนำหน้า</th>   
                    <th class="text-center" >ชื่อลูกค้า</th>          
                    <th class="text-center">ชื่อร้านค้า</th>
                    <th class="text-center" style="width: 300px;">ที่อยู่</th>
                    <th class="text-center" style="width: 150px;">หมายเลขโทรศัพท์</th>
                    <th class="text-center" >หมายเลขโทรศัพท์เคลื่อนที่</th>
                    <?php if($_SESSION["status"] != "2"){ ?>
                    <th class="text-center" style="width: 100px;">จัดการ</th>
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
                            <td class="text-center"><?= $count++; ?></td>
                            <td class="text-center">cus<?= $row["customer_id"] ?></td>
                            <td class="text-center"><?= $row["title_name"] ?></td>
                            <td class="text-center"><?= $row["customer_name"] ?></td>
                            <td class="text-center"><?= $row["name_store"] ?></td>
                            <td class="text-left" style="width: 260px;"><?= $row["address"] ?></td>
                            <td class="text-center"><?= $row["tel"] ?></td>
                            <td class="text-center"><?= $row["telephone"] ?></td>
                            <?php if($_SESSION["status"] != "2"){ ?>
                            <td>
                                <a href="index.php?viewName=editCustomer&customer_id=<?= $row["customer_id"] ?>" class="btn btn-sm btn-success f16">
                                    แก้ไข
                                </a>
                                <a href="#" data-href="conCustomer.php?action=delete&customer_id=<?= $row["customer_id"] ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
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
        <div class="col-md-12 pull-right">
          <?php if($_SESSION["status"] != "2"){ ?>
          <a href="index.php?viewName=addCustomer" class="btn  btn-sm btn-primary pull-right f16">เพิ่มลูกค้า</a>
          <?php } ?>
       </div>
    </div>
</div>

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
                คุณต้องการลบลูกค้านี้ไหม?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                <a class="btn btn-danger btn-ok" onclick="confirmDel()" >ลบ</a>
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
        window.location.replace("index.php?viewName=customerList&search="+search);
    }

</script>
<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.3').addClass('ac');
    })
</script>