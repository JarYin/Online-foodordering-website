<?php include('server.php');

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
    <title>Document</title>
</head>

<body>
    <div class="container-sm">
        <div class="row"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col-11">
                <?php if (isset($_SESSION['success_food'])) { ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success_food'];
                                                        unset($_SESSION['success_food']);  ?></div>
                <?php } else if (isset($_SESSION['error_food'])) { ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_food'];
                                                    unset($_SESSION['error_food']);  ?></div>
                <?php } ?>
                <div class="card" style="margin-top: 80px;">
                    <div class="card-body">
                        <!-- รอการยืนยันจากทางร้าน  -->
                        <?php if (isset($_SESSION['user_login'])) {

                            $id = $_SESSION['user_login'];

                            $cart = $conn->prepare("SELECT * FROM tbl_status WHERE account_id = $id");
                            $cart->execute();
                            $check_cart = $cart->fetchAll(PDO::FETCH_ASSOC);

                            $orders = $conn->prepare("SELECT * FROM tbl_status WHERE account_id = $id");
                            $orders->execute();
                            $ordersCheck = $orders->fetch(PDO::FETCH_ASSOC);
                            if ($ordersCheck['status'] == "รอการยืนยันจากทางร้าน") { ?>
                                <div class="alert alert-warning">รอการยืนยันจากทางร้าน</div>
                            <?php } else { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ไอดี</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">ราคา</th>
                                            <th scope="col">จำนวน</th>
                                            <th scope="col">สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($check_cart as $check) { ?>
                                            <?php if ($check['status'] != 'ส่งสินค้าเรียบร้อย') { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $check['id']; ?></th>
                                                    <td><?php echo $check['food']; ?></td>
                                                    <td><?php echo $check['price']; ?></td>
                                                    <td><label for=""><?php echo $check['quantity']; ?></label></td>
                                                    <td><label for=""><?php echo $check['status']; ?></label></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">สรุป</th>
                                            <!-- ทำการบวกเลข โดย ใช้ sum() -->
                                            <?php  ?>
                                            <?php foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE account_id = $id and status != 'ส่งสินค้าเรียบร้อย' ") as $row) {;
                                            ?>
                                                <td colspan="6" align="center">
                                                    <!-- ทำให้คำนวณได้ -->
                                                    <?php echo $row['SUM(total)'] . " บาท"; ?>
                                                </td>
                                            <?php } ?>

                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } ?>


                            <!-- ส่วนของ เจ้าของร้าน -->

                            <?php } else if (isset($_SESSION['owner_login'])) {

                            $id_owner = $_SESSION['owner_login'];
                            $owner_check = $conn->prepare("SELECT * FROM tbl_status WHERE owner_id = $id_owner");
                            $owner_check->execute();
                            $row_owner = $owner_check->fetchAll(PDO::FETCH_ASSOC);


                            if ($owner_check->rowCount() > 0) { ?>

                                <table class="table">

                                    <thead>
                                        <tr>
                                            <th scope="col">ไอดี</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">ราคา</th>
                                            <th scope="col">จำนวน</th>
                                            <th scope="col">รวม</th>
                                            <td scope="col">สถานะ</td>
                                            <th scope="col">ชื่อลูกค้า</th>
                                            <th scope="col">อีเมลลูกค้า</th>
                                            <th scope="col">เบอร์ติดต่อ</th>
                                            <th scope="col">ที่อยู่ลูกค้า</th>
                                            <th scope="col" colspan="2">คำขอ</th>
                                            <th scope="col">ออกใบเสร็จ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($row_owner as $row) { ?>
                                            <tr>
                                                <?php if ($row['dontshow'] != 1) { ?>
                                                    <form action="status_db.php" method="get">
                                                        <th scope="row" name="id"><?php echo $row['id']; ?></th>
                                                        <td><?php echo $row['food']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td><label for=""><?php echo $row['quantity']; ?></label></td>
                                                        <td><label for=""><?php echo $row['total']; ?></label></td>
                                                        <td>


                                                            <?php
                                                            $selected = $row['status'];
                                                            echo "<select class='form-control' name='selected'>";
                                                            $options =  array('รอการยืนยันจากทางร้าน', 'รับออเดอร์', 'กำลังทำอาหาร', 'กำลังไปส่ง');

                                                            foreach ($options as $options) {
                                                                if ($selected == $options) {
                                                                    echo "<option selected='selected' value='$options'>$options</option>";
                                                                } else if ($selected == "ส่งสินค้าเรียบร้อย") {
                                                                    echo "<option selected='selected'>$selected</option>";
                                                                } else {
                                                                    echo "<option value='$options'>$options</option>";
                                                                }
                                                            }

                                                            echo "</select>";
                                                            ?>




                                                        </td>
                                                        <td><label for=""><?php echo $row['customer_name']; ?></label></td>
                                                        <td><?php echo $row['customer_email']; ?></td>
                                                        <td colspan="1"><?php echo $row['customer_contact']; ?></td>
                                                        <td><?php echo $row['customer_address']; ?></td>
                                                        <?php if ($row['status'] != "รับออเดอร์") { ?>
                                                            <div class="d-flex">
                                                                <td><button type="submit" name="update" class="btn btn-primary" value="<?php echo $row['id']; ?>">ยืนยัน</button>
                                                                </td>
                                                                <td><button type="submit" name="delete" class="btn btn-danger" value="<?php echo $row['id']; ?>">ลบ</button>
                                                                </td>
                                                                <td></td>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="d-flex">
                                                                <td><button type="submit" name="update" class="btn btn-primary" value="<?php echo $row['id']; ?>">ยืนยัน</button>
                                                                </td>

                                                                <td><button type="submit" name="delete" class="btn btn-danger" value="<?php echo $row['id']; ?>">ลบ</button>
                                                                </td>
                                                                <form action="" method="get">
                                                                    <td><a href="Export/pdf.php?bill=<?php echo $row['id']; ?>" class="btn btn-success">ออกใบเสร็จ</a></td>
                                                                </form>
                                                            </div>
                                                        <?php } ?>
                                                    </form>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">สรุป</th>
                                            <!-- ทำการบวกเลข โดย ใช้ sum() -->

                                            <?php foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE owner_id = $id_owner and status != 'ส่งสินค้าเรียบร้อย'") as $row) {;
                                            ?>
                                                <td colspan="12" align="center">
                                                    <!-- ทำให้คำนวณได้ -->
                                                    <?php echo $row['SUM(total)'] . " บาท";
                                                    ?>
                                                </td>
                                            <?php } ?>



                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { ?>
                                <div class="alert alert-danger">ไม่มีการสั่งซื้อ</div>
                            <?php } ?>



                            <!-- ส่วนของ delivery -->

                            <?php } else if (isset($_SESSION['delivery_login'])) {
                            $id_delivery = $_SESSION['delivery_login'];
                            $reserve = 0;
                            $delivery_check = $conn->prepare("SELECT * FROM tbl_status WHERE status = 'รับออเดอร์' and reserve = $reserve");
                            $delivery_check->execute();
                            $row_delivery = $delivery_check->fetchAll(PDO::FETCH_ASSOC);

                            if ($delivery_check->rowCount() > 0) { ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ไอดี</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th scope="col">ราคา</th>
                                            <th scope="col">จำนวน</th>
                                            <th scope="col">รวม</th>
                                            <th scope="col">สถานะ</th>
                                            <th scope="col">ชื่อลูกค้า</th>
                                            <th scope="col">อีเมลลูกค้า</th>
                                            <th scope="col">เบอร์ติดต่อ</th>
                                            <th scope="col">ที่อยู่ลูกค้า</th>
                                            <th scope="col">คำขอ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($row_delivery as $row) { ?>
                                            <tr>
                                                <!-- แสดงสินค้าที่ยังไม่มีการยืนยัน -->

                                                <form action="status_db.php" method="get">
                                                    <th scope="row" name="id"><?php echo $row['id']; ?></th>
                                                    <td><?php echo $row['food']; ?></td>
                                                    <td><?php echo $row['price']; ?></td>
                                                    <td><label for=""><?php echo $row['quantity']; ?></label></td>
                                                    <td><label for=""><?php echo $row['total']; ?></label></td>
                                                    <td>
                                                        <?php
                                                        $selected = $row['status'];
                                                        echo "<select class='form-control' name='selected'>";
                                                        $options =  array('รับออเดอร์', 'กำลังทำอาหาร', 'กำลังไปส่ง');

                                                        foreach ($options as $options) {
                                                            if ($selected == $options) {
                                                                echo "<option selected='selected' value='$options'>$options</option>";
                                                            } else {
                                                                echo "<option value='$options'>$options</option>";
                                                            }
                                                        }

                                                        echo "</select>";
                                                        ?>
                                                    </td>
                                                    <td><label for=""><?php echo $row['customer_name']; ?></label></td>
                                                    <td><?php echo $row['customer_email']; ?></td>
                                                    <td colspan="1"><?php echo $row['customer_contact']; ?></td>
                                                    <td><?php echo $row['customer_address']; ?></td>

                                                    <td><button type="submit" name="accept" class="btn btn-primary" value="<?php echo $row['id']; ?>">ยืนยัน</button>
                                                    </td>

                                                </form>
                                            <tr>
                                            <?php } ?>

                                    </tbody>


                                </table>

                                <a href="status_delivery.php" class="btn btn-warning">สินค้าที่ต้องส่ง</a>






                        <?php
                            }
                        } ?>

                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row"></div>

    </div>


</body>

</html>