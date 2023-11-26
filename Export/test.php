<?php

include('../server.php');
session_start();
$id_bill = 22;
$id_owner = $_SESSION['owner_login'];

$tbl_account = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id_owner");
$tbl_account->execute();
$check_tbl_account = $tbl_account->fetch(PDO::FETCH_ASSOC);

// อ้างอิงจาก id ลำดับสินค้า เพื่อ ดึงชื่อ ลูกค้ามา
$CheckName_tbl_status = $conn->prepare("SELECT * FROM tbl_status WHERE id = $id_bill");
$CheckName_tbl_status->execute();
$CheckNameCustomer = $CheckName_tbl_status->fetch(PDO::FETCH_ASSOC);

$customer_name = $CheckNameCustomer['customer_name'];

// เอาชื่อลูกค้ามาเป็นตัวกำหนดขอบเขต
$ImportData_tbl_status = $conn->prepare("SELECT * FROM tbl_status WHERE customer_name = '$customer_name' and status = 'รับออเดอร์'");
$ImportData_tbl_status->execute();
$checkData_tbl_status = $ImportData_tbl_status->fetchAll(PDO::FETCH_ASSOC);

foreach ($checkData_tbl_status as $checkData_tbl_status) {
    echo $checkData_tbl_status['food'];
}

foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE customer_name = '$customer_name' and status = 'รับออเดอร์'") as $row) {;
    echo $row['SUM(total)'] . " บาท";
}

echo $checkData_tbl_status['food'];