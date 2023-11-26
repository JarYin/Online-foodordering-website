<?php
session_start();
include('nav_owner.php');
include('server.php');
include('box_post.php');

$id_owner = $_SESSION['owner_login'];

$sql = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id_owner");
$sql->execute();
$check = $sql->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['owner_login']) and empty($_SESSION['owner_login']) or $check['approve'] != 1) {
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
<style>
.card {
    display: grid;
    grid-template-columns: 431.33px 1fr;
}
</style>

<body>
    <?php include('catagory.php'); ?>
</body>

</html>