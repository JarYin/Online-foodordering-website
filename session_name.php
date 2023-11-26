<?php
// ดึงข้อมูลจากตารางมาแสดงหน้าต่างๆ
include('server.php');
session_start();


if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['owner_login'])) {
    include('box_post.php');
    $owner_id = $_SESSION['owner_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $owner_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['delivery_login'])) {
    include('box_post.php');
    $delivery_id = $_SESSION['delivery_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $delivery_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_SESSION['admin_login'])) {
    include('box_post.php');
    $admin_id = $_SESSION['admin_login'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account WHERE id = $admin_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}