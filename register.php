<?php include('server.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body style="background-image: url('img/FoodBackground.jpg'); background-size:cover; background-repeat: no-repeat;">
    <div class="row"></div>
    <div class="row">
        <div class="col"></div>
        <div class="col my-5">
            <div class="card my-5">
                <div class="card-body">
                    <!-- SESSION ERROR -->
                    <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                    </div>
                    <?php } ?>

                    <!-- SESSION SUCCESSFULLY -->
                    <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                    </div>
                    <?php } ?>


                    <form action="register_db.php" method="post" enctype="multipart/form-data">
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
                        <label for="img">รูปภาพ</label>
                        <input type="file" name="img" id="imgInput" class="form-control">
                        <img id="Imgpreview" alt="" width="100%">
                        <label for="">หมวดหมู่</label>
                        <select name="catagory" id="catagory" class="form-control">
                            <option value="owner">เจ้าของร้าน</option>
                            <option value="user">ลูกค้า</option>
                            <option value="delivery">พนักงานส่งอาหาร</option>
                        </select>
                        <div class="d-flex my-2">
                            <button type="submit" name="signup" class="btn btn-success mx-1">ยืนยัน</button>
                            <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                            <a href="login.php" class="btn btn-primary"
                                style="margin-left:auto;">กลับไปยังหน้าล็อคอิน</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <div class="row"></div>
</body>

<style>
.card {
    box-shadow: 2px 2px grey;
}
</style>

<script>
let imgInput = document.getElementById('imgInput');
let Imgpreview = document.getElementById('Imgpreview');

// ถ้า imgInput มีการเปลี่ยนแปลง 
imgInput.onchange = evt => {
    // ให้ imgInput เข้าถึงไฟล์
    const [file] = imgInput.files;
    // ถ้ามี ไฟล์
    if (file) {
        // ให้ id = previewImg สร้าง object จากไฟล์ขึ้นมา
        Imgpreview.src = URL.createObjectURL(file);
    }
}
</script>



</html>