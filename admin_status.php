<?php
include('server.php');
session_start();
include('nav_admin.php');


$sql = $conn->prepare("SELECT * FROM tbl_account WHERE status = 'owner' or status = 'delivery'");
$sql->execute();
$check = $sql->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="container-sm">
        <div class="row"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <!-- การอนุมัติ ร้านอาหาร หรือ คนส่งอาหาร -->

                <div class="card" style="margin-top: 80px;">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>ตารางอนุมัติ</h1>
                            <hr>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ไอดี</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">ชื่อร้าน</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">อนุมัติ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($check as $check) { ?>
                                <?php if ($check['approve'] != 1) { ?>
                                <form action="approve_db.php" method="get">
                                    <tr>
                                        <th scope="row"><?php echo $check['id']; ?></th>
                                        <td><?php echo $check['fullname'] ?></td>
                                        <td><?php echo $check['shopname'] ?></td>
                                        <td>
                                            <?php
                                                    if ($check['status'] == 'owner') {
                                                        echo 'เจ้าของร้าน';
                                                    } else {
                                                        echo 'คนส่งอาหาร';
                                                    }

                                                    ?>

                                        </td>
                                        <td>
                                            <button type="submit" name="approve" value="<?php echo $check['id'] ?>"
                                                class="btn btn-success mx-1">อนุมัติ</button>
                                            <!-- <button type="submit" class="btn btn-danger" name="cancel"
                                                value="<?php echo $check['id'] ?>">ยกเลิก</button> -->
                                        </td>
                                    </tr>
                                </form>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>



                    </div>
                </div>
                <!-- ส่วนของ การยกเลิกสมาชิกทุกคน -->
                <?php
                $account = $conn->prepare("SELECT * FROM tbl_account");
                $account->execute();
                $check_account = $account->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="card" style="margin-top: 80px;">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>ตารางแบน</h1>
                            <hr>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ไอดี</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col">ชื่อร้าน</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">แบน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($check_account as $account) { ?>
                                <?php if ($account['approve'] == 1) { ?>
                                <form action="approve_db.php" method="get">
                                    <tr>
                                        <th scope="row"><?php echo $account['id']; ?></th>
                                        <td><?php echo $account['fullname'] ?></td>
                                        <td><?php echo $account['shopname'] ?></td>
                                        <td>
                                            <?php
                                                    if ($account['status'] == 'owner') {
                                                        echo 'เจ้าของร้าน';
                                                    } else if ($account['status'] == 'delivery') {
                                                        echo 'คนส่งอาหาร';
                                                    } else if ($account['status'] == 'user') {
                                                        echo 'ผู้ใช้';
                                                    } else {
                                                        echo 'admin';
                                                    }

                                                    ?>

                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger" name="ban"
                                                value="<?php echo $account['id'] ?>">แบน</button>
                                        </td>
                                    </tr>
                                </form>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row"></div>

    </div>


</html>