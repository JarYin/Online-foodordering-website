<?php include('server.php');
include('nav_owner.php');
include('session_name.php');


$sql = $conn->prepare("SELECT * FROM tbl_category");
$sql->execute();
$check_category = $sql->fetch(PDO::FETCH_ASSOC);
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
            <div class="card my-5">
                <div class="card-body">
                    <?php if (isset($_SESSION['error_postMenu'])) { ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error_postMenu'];
                                                        unset($_SESSION['error_postMenu']); ?></div>
                    <?php } ?>
                    <form action="post_menu_db.php" method="post" enctype="multipart/form-data">
                        <label for="">ชื่ออาหาร</label>
                        <input type="text" name="foodName" class="form-control">
                        <label for="">อธิบายรายละเอียดของอาหาร</label>
                        <input type="text" name="Discription" class="form-control">
                        <label for="">ราคา</label>
                        <input type="number" name="price" class="form-control">
                        <label for="">รูปภาพ</label>
                        <input type="file" name="image" id="imgInput" class="form-control">
                        <img id="Imgpreview" width="100%" alt="">
                        <label for="">หมวดหมู่</label>
                        <select name="catagory" id="catagory" class="form-control">
                            <option value="1">อาหารไทย</option>
                            <option value="2">อาหารอิตาลี่</option>
                            <option value="3">ขนม</option>
                        </select>
                        <label for="">สถานะ</label>
                        <select name="active" id="active" class="form-control">
                            <option value="Open">เปิดร้าน</option>
                            <option value="Close">ปิดร้าน</option>
                        </select>
                        <label for="">สร้างส่วนลด</label>
                        <input type="number" name="discount" id="" class="form-control" placeholder="ใส่เป็นตัวเลข">
                        <div class="d-flex my-2">
                            <button type="submit" name="post" class="btn btn-primary mx-1">ยืนยัน</button>
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