<?php
session_start();

include('server.php');
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
    header("location:login.php");
}


if (isset($_GET['id_category'])) {
    $id_category = $_GET['id_category'];
    $food = $conn->prepare("SELECT * FROM tbl_foods WHERE catagory_id = $id_category");
    $food->execute();
    $food_check = $food->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อาหารไทย</title>
</head>

<style>

</style>

<body>
    <!-- อ้างอิงแต่ล่ะหมวดหมู่ด้วยการเก็บ id catagory ด้วย session -->
    <div class="container-md">
        <div class="row"></div>
        <div class="row my-5">
            <div class="col"></div>
            <div class="col my-5">
                <div class="container-grid">
                    <?php if ($food->rowCount() > 0) {
                        foreach ($food_check as $foodCheck) {
                    ?>
                            <div class="card" style="width: 250px ;">
                                <div class="card-body">
                                    <center>

                                        <a href="PageFood.php?food_id=<?php echo $foodCheck['id']; ?>"><img src="<?php echo $imageURL = 'foodmenu_uploads/' . $foodCheck['image_name']; ?>" id="catagory1" alt="" style="width:100%; height:156px;">
                                        </a>

                                        <h5 class="card-title"><?php echo $foodCheck['title']; ?></h5>
                                        <a href="accept_shopping.php?GetCart=<?php echo $foodCheck['id']; ?>"><button class="btn btn-primary">เพิ่มลงตะกร้าสินค้า</button></a>


                                    </center>

                                </div>
                            </div>



                        <?php }
                    } else { ?>
                        <div class="alert alert-danger">ไม่พบสินค้า</div>
                    <?php } ?>



                </div>

            </div>
            <div class="col">
            </div>
        </div>
        <div class="row" style="position: relative;">
            <form action="search_db.php" method="post" style="position: fixed; top: 18cm; width:80% ">
                <div class=" d-flex ">
                    <input type=" text" name="search" class="form-control mx-2" placeholder="กรอกคำค้นหา">
                    <input type="submit" class="form-control" value="ค้นหา">
                </div>
            </form>


        </div>
    </div>


</body>

</html>

<style>
    .container-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
</style>