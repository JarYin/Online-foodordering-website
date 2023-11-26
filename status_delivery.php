<?php include('server.php');
include('nav_delivery.php');
session_start();
// ใช้ get ระบุสินค้า มาแสดงที่นี่
$delivery_id = $_SESSION['delivery_login'];
$row_delivery = $conn->prepare("SELECT * FROM tbl_status WHERE delivery_id = $delivery_id");
$row_delivery->execute();
$delivery_check = $row_delivery->fetchAll(PDO::FETCH_ASSOC);


?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STATUS</title>
</head>

<body>
    <div class="conatainer-sm">
        <div class="row"></div>
        <div class="row">
            <div class="col">
                <div class="card my-5">
                    <div class="card-body">

                        <?php if ($row_delivery->rowCount() > 0) { ?>

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

                                <?php foreach ($delivery_check as $row) { ?>
                                <?php if ($row['status'] != 'ส่งสินค้าเรียบร้อย') { ?>
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
                                                        $options =  array('รับออเดอร์', 'กำลังทำอาหาร', 'กำลังไปส่ง', 'ส่งสินค้าเรียบร้อย');

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

                                        <td><button type="submit" name="finished" class="btn btn-primary"
                                                value="<?php echo $row['id']; ?>">ยืนยัน</button>
                                        </td>


                                    </form>
                                <tr>
                                    <?php } ?>
                                    <?php } ?>




                                    <!-- ทำให้เมื่อกดยืนยันแสดงแค่สินค้าที่ต้องการไปส่ง -->
                                    <!-- บัคอาจเป็นเพราะ if else ถูกทั้งคู่  -->




                            </tbody>

                        </table>
                        <?php } ?>
                    </div>
                </div>
                <div class="row"></div>

            </div>
</body>

</html>