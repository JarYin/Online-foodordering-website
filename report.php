<?php
include('server.php');
session_start();
if (isset($_SESSION['user_login'])) {
    include('nav_user.php');
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
    include('box_post.php');
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    include('box_post.php');
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');
} else {
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report</title>
</head>

<body>
    <div class="container-md">
        <div class="row"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col my-5">
                <div class="card my-5">
                    <div class="card-title">
                        <center>
                            <h2>รายงาน</h2>
                            <hr>
                        </center>
                    </div>
                    <div class="card-body" style="box-shadow: 2px 2px grey;">
                        <form action="report_db.php" method="post">
                            <label for="">ชื่อ-นามสกุล</label>
                            <input type="text" name="fullname" id="" class="form-control">
                            <label for="">ร้องเรียนใคร</label>
                            <input type="text" name="defendant" id="" placeholder="เช่น ร้านอาหาร หรือ บุคคลใดคนหนึ่ง" class="form-control">
                            <label for="">อธิบายรายละเอียด</label>
                            <textarea name="report" id="" cols="30" rows="10" class="form-control"></textarea>
                            <div class="d-flex my-2">
                                <button type="submit" name="reportsubmit" class="btn btn-primary mx-2">ยืนยัน</button>
                                <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row"></div>
    </div>
</body>

</html>