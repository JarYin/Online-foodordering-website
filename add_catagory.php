<!-- ตารางนี้มีใว้เพื่อสร้างหมวดหมู่อาหารใว้สำหรบ แอดมิน เท่านั้น -->
<?php
include('server.php');
include('nav_admin.php');
include('session_name.php');

if (!isset($_SESSION['admin_login'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddCatagory</title>
</head>

<body>
    <div class="row"></div>
    <div class="row">
        <div class="col"></div>
        <div class="col my-3">
            <div class="card my-5">
                <div class="card-body">
                    <form action="catagory_db.php" method="post" enctype="multipart/form-data">
                        <label for="">ชื่อหมวดหมู่</label>
                        <input type="text" name="catagoryName" class="form-control">
                        <label for="">รูปภาพ</label>
                        <input type="file" name="image" id="imgInput" class="form-control">
                        <img id="Imgpreview" width="100%" alt="">
                        <label for="">สถานะ</label>
                        <select name="active" id="active" class="form-control">
                            <option value="Open">เปิดใช้งาน</option>
                            <option value="Close">ปิดใช้งาน</option>
                        </select>
                        <div class="d-flex my-2">
                            <button type="submit" name="postCatagory" class="btn btn-primary mx-1">ยืนยัน</button>
                            <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                        </div>
                </div>
            </div>

            </form>
        </div>
        <div class="col"></div>
    </div>
    <div class="row"></div>
</body>
<script>
let imgInput = document.getElementById('imgInput');
let Imgpreview = document.getElementById('Imgpreview');

imgInput.onchange = evt => {
    const [file] = imgInput.files;

    if (file) {
        Imgpreview.src = URL.createObjectURL(file);
    }

}
</script>

</html>