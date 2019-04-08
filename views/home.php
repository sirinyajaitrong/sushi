<?php
// header('Content-Type: text/html; charset=utf-8');
?>
<div class="container">
    <!-- <h3><label class="label label-warning pull-right" >หน้าหลัก</label></h3> -->
    <h3><label class="label label-warning"  ><?= $_SESSION["users_status_name"] ?></label></h3>
    <div class="col-md-12 text-center">
    <br />
        <img src="images/Home.jpg"  style="text-align:center;"; width="1024px" height="280px"></h3>
    <br />
    <br />
    </div>
    
</div>

<script>
    $(function(){
        $('.nav li').removeClass('ac');
        $('.1').addClass('ac');
    })
</script>