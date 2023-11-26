<?php
require('../server.php');
require('pdf/fpdf.php');
session_start();

if (isset($_GET['bill'])) {
    $id_bill = $_GET['bill'];
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
    $ImportData_tbl_status = $conn->prepare("SELECT * FROM tbl_status WHERE  customer_name = '$customer_name' and status = 'รับออเดอร์'");
    $ImportData_tbl_status->execute();
    $checkData_tbl_status = $ImportData_tbl_status->fetchAll(PDO::FETCH_ASSOC);

    $fpdf = new FPDF();

    //สร้างหน้าเอกสาร
    $fpdf->AddPage();
    $fpdf->AddFont('sarabun', '', 'THSarabunNew.php');
    $fpdf->AddFont('sarabun', 'B', 'THSarabunNew Bold.php');
    $fpdf->SetY(20);
    $fpdf->SetFont('sarabun', 'B', 30);

    // ข้อมูลเจ้าของร้าน
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', 'ใบเสร็จรับเงิน'), 0, 1, 'C');

    $fpdf->SetY(40);

    $fpdf->SetFont('sarabun', '', 24);
    // ชื่อร้าน
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', 'ชื่อร้าน : ' . $check_tbl_account['shopname']), 0, 1, 'C');
    // ที่อยู่ร้าน
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', $check_tbl_account['address']), 0, 1, 'C');
    // เบอร์โทรร้าน
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', 'เบอร์โทรศัพท์ : ' . $check_tbl_account['contact']), 0, 1, 'C');

    $fpdf->SetY(80);

    // ข้อมูลลูกค้า
    $fpdf->SetFont('sarabun', 'B', 30);
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', 'รายการอาหาร'), 0, 1, 'C');

    // ชื่อ + เวลาสั่ง
    $fpdf->SetFont('sarabun', '', 24);
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', $CheckNameCustomer['customer_name']), 0, 0, 'L');
    // เวลาสั่ง
    $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', $CheckNameCustomer['order_date']), 0, 1, 'R');

    // รายการอาหาร + ราคา
    foreach ($checkData_tbl_status as $checkData_tbl_status) {
        $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', $checkData_tbl_status['food']), 0, 0, 'L');
        // รวม
        $fpdf->Cell(0, 10, iconv('utf-8', 'cp874', $checkData_tbl_status['price'] . ' บาท'), 0, 1, 'R');
    }

    // รวมราคา
    $fpdf->SetFont('sarabun', 'B', 30);
    foreach ($conn->query("SELECT SUM(total) FROM tbl_status WHERE customer_name = '$customer_name' and status = 'รับออเดอร์'") as $row) {;
        $fpdf->Cell(0, 40, iconv('utf-8', 'cp874', 'รวมทั้งหมด ' . $row['SUM(total)'] . ' บาทถ้วน'), 0, 1, 'C');
    }

    // ออกใบเสร็จกี่โมง
    $fpdf->SetFont('sarabun', '', 24);
    date_default_timezone_set('asia/bangkok');

    $fpdf->Cell(0, 20, iconv('utf-8', 'cp874', 'เวลาออกใบเสร็จ  ' . $date = date('d-m-Y h:i:s')), 0, 1, 'C');



    // พิมพ์ข้อความลงเอกสาร



    $fpdf->Output();
}