<?php
include('server.php');
include('nav_owner.php');
session_start();

$owner_id = $_SESSION['owner_login'];

$history = $conn->prepare("SELECT * FROM tbl_status WHERE owner_id = $owner_id and status = 'ส่งสินค้าเรียบร้อย'");
$history->execute();
$historyCheck = $history->fetchAll(PDO::FETCH_ASSOC);


// ปฎิทิน ปุ่ม search 
if (isset($_POST['search'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $search_sales_summary = $conn->prepare("SELECT * FROM tbl_status WHERE owner_id = $owner_id and order_date BETWEEN '$date1' and '$date2' and status = 'ส่งสินค้าเรียบร้อย'");
    $search_sales_summary->execute();

    $check_sales_summary = $search_sales_summary->fetchAll(PDO::FETCH_ASSOC);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกรายรับ</title>
</head>

<body>
    <div class="container-md">
        <div class="row"></div>
        <div class="row my-2">

            <div class="col my-5 ">
                <h1>บันทึกรายรับ</h1>
                <form action="" method="post"><button type="submit" class="btn btn-warning">reset</button></form>
                <hr>
                <!-- ปุ่ม search -->
                <form action="" method="post">
                    <div class="input-group">

                        <!-- ปฎิทิน -->
                        <input type="date" value="<?php echo date('y-m-d') ?>" class="form-control rounded" name="date1"
                            placeholder="Search" aria-label="Search" aria-describedby="search-addon" />

                        <h1>-</h1>

                        <!-- ปฎิทิน -->
                        <input type="date" class="form-control rounded" name="date2" placeholder="Search"
                            aria-label="Search" value="<?php echo date('y-m-d') ?>" aria-describedby="search-addon" />

                        <button type="submit" name="search" class="btn btn-outline-primary">search</button>

                    </div>
                </form>

                <table class="table">
                    <thead>

                        <tr>
                            <th scope="col">ไอดี</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">รวม</th>
                            <th scope="col">วัน เดือน ปี</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php if (!isset($_POST['search'])) { ?>
                        <?php foreach ($historyCheck as $check) { ?>
                        <tr>

                            <th scope="row"><?php echo $check['id']; ?></th>
                            <td><?php echo $check['food'] ?></td>
                            <td><?php echo $check['price'] ?></td>
                            <td><?php echo $check['quantity'] ?></td>
                            <td><?php echo $check['total'] ?></td>
                            <td><?php echo $check['order_date'] ?></td>
                        </tr>

                        <?php } ?>
                    <tfoot>
                        <th>สรุป</th>
                        <td><?php foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE owner_id = $owner_id and status = 'ส่งสินค้าเรียบร้อย'") as $row) { ?>
                        <td colspan="5" align="center">
                            <!-- ทำให้คำนวณได้ -->
                            <?php echo $row['SUM(total)'] . " บาท";
                            ?>
                        </td>
                        <?php } ?>
                        </td>
                    </tfoot>
                    <?php } else if (isset($_POST['search'])) { ?>
                    <?php foreach ($check_sales_summary as $check) { ?>
                    <tr>

                        <th scope="row"><?php echo $check['id']; ?></th>
                        <td><?php echo $check['food'] ?></td>
                        <td><?php echo $check['price'] ?></td>
                        <td><?php echo $check['quantity'] ?></td>
                        <td><?php echo $check['total'] ?></td>
                        <td><?php echo $check['order_date'] ?></td>
                    </tr>

                    <?php } ?>
                    <tfoot>
                        <th>สรุป</th>
                        <td><?php foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE owner_id = $owner_id and status = 'ส่งสินค้าเรียบร้อย'and  order_date BETWEEN '$date1' and '$date2'") as $row) { ?>
                        <td colspan="5" align="center">
                            <!-- ทำให้คำนวณได้ -->
                            <?php echo $row['SUM(total)'] . " บาท";
                            ?>
                        </td>
                        <?php } ?>
                        </td>
                    </tfoot>

                    <?php } else { ?>
                    <?php foreach ($historyCheck as $check) { ?>
                    <tr>

                        <th scope="row"><?php echo $check['id']; ?></th>
                        <td><?php echo $check['food'] ?></td>
                        <td><?php echo $check['price'] ?></td>
                        <td><?php echo $check['quantity'] ?></td>
                        <td><?php echo $check['total'] ?></td>
                        <td><?php echo $check['order_date'] ?></td>
                    </tr>

                    <?php } ?>
                    <tfoot>
                        <th>สรุป</th>
                        <td><?php foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE owner_id = $owner_id and status = 'ส่งสินค้าเรียบร้อย'") as $row) { ?>
                        <td colspan="5" align="center">
                            <!-- ทำให้คำนวณได้ -->
                            <?php echo $row['SUM(total)'] . " บาท";
                            ?>
                        </td>
                        <?php } ?>
                        </td>
                    </tfoot>
                    <?php } ?>


                    </tbody>

                </table>

            </div>
            <div class="row"></div>
        </div>
</body>

</html>