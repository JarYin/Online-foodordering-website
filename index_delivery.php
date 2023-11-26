<?php
include('server.php');
session_start();
include('nav_delivery.php');

$id_delivery = $_SESSION['delivery_login'];

$sql = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id_delivery");
$sql->execute();
$check = $sql->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['delivery_login']) and empty($_SESSION['delivery_login']) or $check['approve'] != 1) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeliveryPage</title>
</head>

<body>
    <?php include('catagory.php'); ?>
</body>

</html>