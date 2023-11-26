<?php
include('nav_admin.php');
include('server.php');
include('box_post.php');


if (!isset($_SESSION['admin_login']) and empty($_SESSION['admin_login'])) {
    $_SESSION['error'] = "ไม่มีผู้ดูแลนี้ในระบบ";
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catagory</title>
    <link rel="stylesheet" href="Design/catagory.css">
</head>

<body>

    <?php include('catagory.php'); ?>

</body>

</html>