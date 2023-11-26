<?php
include('server.php');
session_start();
if (isset($_SESSION['user_login'])) {
    include('nav_user.php');
    $id = $_SESSION['user_login'];
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
    include('box_post.php');
    $id = $_SESSION['owner_login'];
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    include('box_post.php');
    $id = $_SESSION['admin_login'];
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');
    $id = $_SESSION['delivery_login'];
} else {
    header("location: login.php");
}

$tbl_account = $conn->prepare("SELECT fullname FROM tbl_account WHERE id = $id");
$tbl_account->execute();
$check_tbl_account = $tbl_account->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rating</title>
</head>

<body>
    <div class="container-md">
        <div class="row"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col my-5">
                <div class="card my-5">
                    <div class="card-title py-2">
                        <center>
                            <h3 style="color:green; box-shadow: 2px 2px #888888;">ให้คะแนนสินค้า</h3>
                        </center>
                    </div>
                    <div class="card-body">
                        <form action="rating_db.php" method="post">
                            <input type="hidden" name="account_id" value="<?php echo $id ?>">
                            <input type="hidden" name="fullname" value="<?php echo $check_tbl_account['fullname'] ?>">
                            <input type="hidden" name="food_id" value="<?php echo $_GET['getrating'] ?>">
                            <label for="">ให้คะแนน</label>
                            <input type="number" name="rating" id="" class="form-control">
                            <div class="d-flex my-1">
                                <button type="submit" class="btn btn-primary" name="give">ยืนยัน</button>
                                <button type="reset" class="btn btn-warning">รีเซ็ต</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row"></div>
    </div>
</body>

</html>