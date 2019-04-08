<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/user.php";
$obj = new User();
$search = " 1=1 ";
if(!empty($_REQUEST["search"])){
    $search = " codeusers LIKE '%".$_REQUEST["search"]."%' 
    OR firstname LIKE '%".$_REQUEST["search"]."%' 
    OR lastname LIKE '%".$_REQUEST["search"]."%'";
}

//echo $search;

$rows = $obj->read($search);
//var_dump($rows);
?>
<div class="container">
    <h3><label class="label label-warning"  >จัดการผู้ใช้งาน</label></h3>
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
        <table class="table table-bordered table-hover f16 ">
            <thead>
                <tr class="success">
                    <th class="text-center">ที่</th>     
                    <th class="text-center">รหัสผู้ใช้งาน</th>      
                    <th class="text-center">คำนำหน้า</th>             
                    <th class="text-center">ชื่อ</th>
                    <th class="text-center">นามสกุล</th>
                    <th class="text-center">หมายเลขโทรศัพท์เคลื่อนที่</th>
                    <th class="text-center">อีเมล</th>
                    <th class="text-center">รูปภาพ</th>
                    <th class="text-center">สถานะ</th>
                    <?php if($_SESSION["status"] == "1"){ ?>
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
                            <td class="text-center"><?= $count++; ?></td>
                            <td class="text-center"><?= $row["codeusers"] ?></td>
                            <td class="text-center"><?= $row["title_name"] ?></td>
                            <td class="text-center"><?= $row["firstname"] ?></td>
                            <td class="text-center"><?= $row["lastname"] ?></td>
                            <td class="text-center phone"><?= $row["telephone"] ?></td>
                            <td class="text-center"><?= $row["email"] ?></td>
                            <td class="text-center"> <img style="border-radius: 50%;" onclick="showPic('./upload_img/<?= $row['pic'] ?>')" src="./upload_img/<?= $row["pic"] ?>" width="40px;" height="40px" alt=""></td>
                            <td class="text-center"><?= $row["users_status_name"] ?></td>
                            <?php if($_SESSION["status"] == "1"){ ?>
                            <td>
                                <a href="index.php?viewName=editUser&users_id=<?= $row["users_id"] ?>" class="btn btn-sm btn-success f16">
                                    แก้ไข
                                </a>
                                <a href="#" data-href="conUser.php?action=delete&users_id=<?= $row["users_id"] ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm btn-danger f16">
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
            <?php if($_SESSION["status"] == "1"){ ?>
                <a href="index.php?viewName=addUser" class="btn  btn-sm btn-primary pull-right f16">เพิ่มผู้ใช้งาน</a>
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
                คุณต้องการลบผู้ใช้งานนี้ไหม?
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

    function ActSearch(){
        var search = $("#search").val();
        window.location.replace("index.php?viewName=userList&search="+search);
    }

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.2').addClass('ac');
    })
</script>