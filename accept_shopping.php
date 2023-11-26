<?php
session_start();
include('server.php');
if (isset($_SESSION['user_login'])) {
    include('nav_user.php');
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    include('box_post.php');
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');
} else {
    header("location: login.php");
}

if (isset($_GET['GetCart'])) {
    $id = $_GET['GetCart'];
    $_SESSION['id_getcart'] = $id;
    $food = $conn->prepare("SELECT * FROM tbl_foods WHERE id = $id");
    $food->execute();
    $food_check = $food->fetch(PDO::FETCH_ASSOC);
    if (isset($food_check['discount'])) {
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้ายืนยันสั่งซื้อสินค้า</title>
</head>

<body>
    <div class="row"></div>
    <div class="row">
        <div class="col"></div>
        <div class="col my-5">
            <div class="card my-5">
                <div class="card-title"></div>
                <div class="card-body">
                    <form action="shopping_cart_db.php" method="post">
                        <label for="">ชื่ออาหาร</label> <br>
                        <label for="" class="form-control"><?php echo $food_check['title']; ?></label>
                        <label for="">อธิบายรายละเอียดของอาหาร</label> <br>
                        <textarea for="" col=5 rows=" 5"
                            class="form-control"><?php echo $food_check['discription']; ?></textarea>
                        <label for="">ราคา</label> <br>
                        <label for="" class="form-control">
                            <!-- การหาเปอร์เซ็น -->
                            <?php
                                if ($food_check['discount'] > 0) {
                                    $percent = ($food_check['price'] / 100) * $food_check['discount'];
                                    echo $food_check['price'] - $percent;
                                } else {
                                    echo $food_check['price'];
                                }

                                ?>
                        </label>
                        <label for="">รูปภาพ</label>
                        <img src="<?php echo $imageURL = 'foodmenu_uploads/' . $food_check['image_name'];  ?>"
                            width="100%" alt="">
                        <img id="Imgpreview" width="100%" alt="">
                        <label for="">จำนวน</label>
                        <input type="number" name="quantity" class="form-control">
                        <div class="d-flex my-2">
                            <button type="submit" name="Submit" class="btn btn-primary mx-1">ยืนยัน</button>
                            <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <div class="row"></div>

</body>

</html>
<?php } else {
    header("location:thaifood.php");
} ?>