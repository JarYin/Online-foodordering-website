<?php
session_start();
if (isset($_SESSION['user_login'])) {
    include('nav_user.php');

    $id = $_SESSION['user_login'];

    $cart = $conn->prepare("SELECT * FROM tbl_orders WHERE account_id = $id");
    $cart->execute();
    $check_cart = $cart->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
    include('box_post.php');

    $id = $_SESSION['owner_login'];

    $cart = $conn->prepare("SELECT * FROM tbl_orders WHERE account_id = $id");
    $cart->execute();
    $check_cart = $cart->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');

    $id = $_SESSION['delivery_login'];

    $cart = $conn->prepare("SELECT * FROM tbl_orders WHERE account_id = $id");
    $cart->execute();
    $check_cart = $cart->fetchAll(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    include('box_post.php');

    $id = $_SESSION['admin_login'];

    $cart = $conn->prepare("SELECT * FROM tbl_orders WHERE account_id = $id");
    $cart->execute();
    $check_cart = $cart->fetchAll(PDO::FETCH_ASSOC);
}



// ตัวแปรในอนาคต จำนวน ค่าปกติจะเป็น 1 จนกว่า user จะแก้ไขมัน
$quantity = 1;
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
                <div class="card" style="margin-top:80px;">
                    <div class="card-body">
                        <?php if ($cart->rowCount() > 0) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ไอดี</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">ราคา</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ดึงข้อมูลจาก tbl_orders -->

                                <?php foreach ($check_cart as $check) { ?>
                                <tr>
                                    <form action="status_db.php" method="post"></form>
                                    <th scope="row"><?php echo $check['id']; ?></th>
                                    <td><?php echo $check['food']; ?></td>
                                    <td><?php echo $check['price']; ?></td>
                                    <td><label for=""><?php echo $check['quantity']; ?></label></td>
                                    <td><a href="shopping_cart_db.php?delete=<?php echo $check['id']; ?>"
                                            class="btn btn-danger">ลบ</a></td>
                                </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row">สรุป</th>
                                    <!-- ทำการบวกเลข โดย ใช้ sum() -->
                                    <?php foreach ($conn->query("SELECT SUM(total) FROM tbl_orders WHERE account_id = $id") as $row) {;
                                        ?>
                                    <td colspan="3" align="center">
                                        <!-- ทำให้คำนวณได้ -->
                                        <?php echo $row['SUM(total)'];
                                                ?>
                                    </td>
                                    <?php } ?>


                                    <!-- จะส่งไปให้เจ้าของร้านและเจ้าของร้านกดยืนยันถึงจะแสดงสินค้าหน้า status -->
                                    <td><a href="status_db.php?account_id=<?php
                                                                                echo $check['account_id'];
                                                                                ?>"><button
                                                class="btn btn-primary">ยืนยัน</button></a>
                                    </td>


                                </tr>
                            </tfoot>
                        </table>
                        <?php } else { ?>
                        <div class=" alert alert-danger">ไม่พบสินค้า
                        </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row"></div>

    </div>


</body>

</html>