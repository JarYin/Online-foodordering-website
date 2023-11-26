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

<body style="background-image: url('img/FoodBackground.jpg'); background-size:cover; background-repeat: no-repeat;">
    <div class="row"></div>
    <div class="row">
        <div class="col"></div>
        <div class="col my-5">
            <?php if (isset($_SESSION['user_login'])) { ?>
            <div class="card my-5">
                <div class="card-body">
                    <?php if (isset($_SESSION['error_profile_config'])) { ?>
                    <div class="alert alert-danger"><?php $_SESSION['error_profile_config'];
                                                            unset($_SESSION['error_profile_config']); ?></div>
                    <?php } ?>
                    <form action="profile_config_db.php" method="post" enctype="multipart/form-data">
                        <label for="">ชื่อ-นามสกุล</label>
                        <input type="text" name="fullname" class="form-control">
                        <label for="">อีเมล</label>
                        <input type="email" name="email" id="" class="form-control">
                        <label for="">ชื่อผู้ใช้</label>
                        <input type="text" name="username" class="form-control">
                        <label for="">รหัสผ่าน</label>
                        <input type="text" name="password" class="form-control">
                        <label for="">ที่อยู่</label>
                        <input type="text" name="address" class="form-control">
                        <label for="">เบอร์ติดต่อ</label>
                        <input type="text" name="contact" class="form-control">
                        <label for="">รูปภาพ</label>
                        <input type="file" name="image" id="imgInput" class="form-control">
                        <img id="previewImg" width="100%" alt="">
                        <label for="">สถานะ</label>
                        <select name="active" id="active" class="form-control">
                            <option value="user">ลูกค้า</option>
                            <option value="owner">เจ้าของร้าน</option>
                            <option value="delivery">พนักงานส่งสินค้า</option>
                        </select>
                        <div class="d-flex my-2">
                            <button type="submit" name="update" class="btn btn-primary mx-1">ยืนยัน</button>
                            <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                        </div>

                    </form>
                </div>
            </div>
            <?php } else if (isset($_SESSION['owner_login'])) { ?>
            <div class="card my-5">
                <div class="card-body">
                    <?php if (isset($_SESSION['error_profile_config'])) { ?>
                    <div class="alert alert-danger"><?php $_SESSION['error_profile_config'];
                                                            unset($_SESSION['error_profile_config']); ?></div>
                    <?php } ?>
                    <form action="profile_config_db.php" method="post" enctype="multipart/form-data">
                        <label for="">ชื่อ-นามสกุล</label>
                        <input type="text" name="fullname" class="form-control">
                        <label for="">อีเมล</label>
                        <input type="email" name="email" id="" class="form-control">
                        <label for="">ชื่อผู้ใช้</label>
                        <input type="text" name="username" class="form-control">
                        <label for="">รหัสผ่าน</label>
                        <input type="text" name="password" class="form-control">
                        <label for="">ที่อยู่</label>
                        <input type="text" name="address" class="form-control">
                        <label for="">เบอร์ติดต่อ</label>
                        <input type="text" name="contact" class="form-control">
                        <label for="">รูปภาพ</label>
                        <input type="file" name="image" id="imgInput" class="form-control">
                        <img id="previewImg" width="100%" alt="">
                        <label for="">สถานะ</label>
                        <select name="active" id="active" class="form-control">
                            <option value="user">ลูกค้า</option>
                            <option value="owner">เจ้าของร้าน</option>
                            <option value="delivery">พนักงานส่งสินค้า</option>
                        </select>
                        <label for="">ชื่อร้าน</label>
                        <input type="text" name="shopname" class="form-control">

                        <div class="d-flex my-2">
                            <button type="submit" name="update" class="btn btn-primary mx-1">ยืนยัน</button>
                            <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                        </div>

                    </form>
                </div>
            </div>
            <?php } else { ?>
            <div class="card my-5">
                <div class="card-body">
                    <?php if (isset($_SESSION['error_profile_config'])) { ?>
                    <div class="alert alert-danger"><?php $_SESSION['error_profile_config'];
                                                            unset($_SESSION['error_profile_config']); ?></div>
                    <?php } ?>
                    <form action="profile_config_db.php" method="post" enctype="multipart/form-data">
                        <label for="">ชื่อ-นามสกุล</label>
                        <input type="text" name="fullname" class="form-control">
                        <label for="">อีเมล</label>
                        <input type="email" name="email" id="" class="form-control">
                        <label for="">ชื่อผู้ใช้</label>
                        <input type="text" name="username" class="form-control">
                        <label for="">รหัสผ่าน</label>
                        <input type="text" name="password" class="form-control">
                        <label for="">ที่อยู่</label>
                        <input type="text" name="address" class="form-control">
                        <label for="">เบอร์ติดต่อ</label>
                        <input type="text" name="contact" class="form-control">
                        <label for="">รูปภาพ</label>
                        <input type="file" name="image" id="imgInput" class="form-control">
                        <img id="previewImg" width="100%" alt="">
                        <label for="">สถานะ</label>
                        <select name="active" id="active" class="form-control">
                            <option value="user">ลูกค้า</option>
                            <option value="owner">เจ้าของร้าน</option>
                            <option value="delivery">พนักงานส่งสินค้า</option>
                        </select>
                        <div class="d-flex my-2">
                            <button type="submit" name="update" class="btn btn-primary mx-1">ยืนยัน</button>
                            <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                        </div>

                    </form>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="col"></div>
    </div>
    <div class="row"></div>
</body>


<script>
let imgInput = document.getElementById('imgInput');
let previewImg = document.getElementById('previewImg');

imgInput.onchange = evt => {
    const [file] = imgInput.files;
    if (file) {
        previewImg.src = URL.createObjectURL(file)
    }
}
</script>

</html>