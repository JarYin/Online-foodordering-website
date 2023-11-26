<?php include('server.php');
session_start();
if (isset($_SESSION['owner_login'])) {
    $id = $_SESSION['owner_login'];
    $stmt = $conn->prepare("SELECT status FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['admin_login'])) {
    $id = $_SESSION['admin_login'];
    $stmt = $conn->prepare("SELECT status FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['delivery_login'])) {
    $id = $_SESSION['delivery_login'];
    $stmt = $conn->prepare("SELECT status FROM tbl_account WHERE id = $id");
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);
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
<style>
* {
    position: relative;
}

.buttonPost {

    position: fixed;
    top: 17cm;
    left: 38cm;
    z-index: 1;
}

.buttonPost img {
    width: 100px;

}
</style>

<body>
    <footer>
        <?php if ($check['status'] == "owner") { ?>
        <div class="buttonPost">
            <a href="post_menu.php"><img src="img/plus.png" alt=""></a>
        </div>

        <?php } else if ($check['status'] == "admin") { ?>
        <div class="buttonPost">
            <a href="add_catagory.php"><img src="img/plus.png" alt=""></a>
        </div>
        <?php } ?>
    </footer>
</body>

</html>