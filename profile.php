<?php
include('server.php');
session_start();

if (isset($_SESSION['user_login'])) {
    include('nav_user.php');
    $id = $_SESSION['user_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
    include('box_post.php');
    $id = $_SESSION['owner_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');
    $id = $_SESSION['delivery_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    $id = $_SESSION['admin_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


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
            <div class="col"></div>
            <div class="col" style="margin-top: 20px;">
                <div class="card my-5">
                    <div class="card-body">
                        <?php if (isset($_SESSION['success_profile'])) { ?>
                            <div class="alert alert-success"><?php echo $_SESSION['success_profile'];
                                                                unset($_SESSION['success_profile']); ?></div>
                        <?php } ?>
                        <div class="profile" style="border-radius:100px;" align="center"><a href="profile_config.php"><img src="<?php echo $imageURL = 'uploads/' . $row['image_name']; ?>" alt="Avatar" class="avatar"></a>
                        </div>
                        <!-- img/avatar.jpg -->
                        <center>
                            <div class="name">
                                <h4><?php echo $row['fullname']; ?></h4>
                            </div>
                        </center>
                        <hr>

                        <?php
                        if (isset($_SESSION['user_login'])) {
                            $user_id = $_SESSION['user_login'];
                            $history = $conn->prepare("SELECT * FROM tbl_status WHERE account_id = $user_id and status = 'ส่งสินค้าเรียบร้อย'");
                            $history->execute();
                            $historyCheck = $history->fetchAll(PDO::FETCH_ASSOC); ?>
                            <h1>ประวัติการซื้อสินค้า</h1>
                        <?php } else if (isset($_SESSION['owner_login'])) {
                            $owner_id = $_SESSION['owner_login'];
                            $history = $conn->prepare("SELECT * FROM tbl_status WHERE owner_id = $owner_id and status = 'ส่งสินค้าเรียบร้อย'");
                            $history->execute();
                            $historyCheck = $history->fetchAll(PDO::FETCH_ASSOC); ?>
                            <h1>ประวัติการขายสินค้า</h1>
                            <a href="sales_summary.php" class="btn btn-success">บันทึกรายรับ</a>
                        <?php } else if (isset($_SESSION['delivery_login'])) {
                            $delivery_id = $_SESSION['delivery_login'];
                            $history = $conn->prepare("SELECT * FROM tbl_status WHERE delivery_id = $delivery_id and status = 'ส่งสินค้าเรียบร้อย'");
                            $history->execute();
                            $historyCheck = $history->fetchAll(PDO::FETCH_ASSOC); ?>
                            <h1>ประวัติการส่งสินค้า</h1>
                        <?php } else if (isset($_SESSION['admin_login'])) {
                            $admin_id = $_SESSION['admin_login'];
                            $history = $conn->prepare("SELECT * FROM tbl_status WHERE admin_id = $admin_id and status = 'ส่งสินค้าเรียบร้อย'");
                            $history->execute();
                            $historyCheck = $history->fetchAll(PDO::FETCH_ASSOC);
                        }


                        ?>
                        <table class="table">
                            <thead>

                                <tr>
                                    <th scope="col">ไอดี</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">ราคา</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">รวม</th>
                                    <th scope="col">สถานะ</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($historyCheck as $check) { ?>
                                    <tr>

                                        <th scope="row"><?php echo $check['id']; ?></th>
                                        <td><?php echo $check['food'] ?></td>
                                        <td><?php echo $check['price'] ?></td>
                                        <td><?php echo $check['quantity'] ?></td>
                                        <td><?php echo $check['total'] ?></td>
                                        <td><?php echo $check['status'] ?></td>

                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row"></div>
    </div>




    <style>
        .avatar {
            vertical-align: middle;
            height: 150px;
            border-radius: 50%;
            transition: .2s ease-in-out;
        }

        .avatar:hover {
            opacity: 0.8;
        }
    </style>

</body>

</html>