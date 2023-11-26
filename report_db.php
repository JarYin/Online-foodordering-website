<?php
include('server.php');

if (isset($_POST['reportsubmit'])) {
    $fullname = $_POST['fullname'];
    $defendant = $_POST['defendant'];
    $report = $_POST['report'];

    $tbl_report = $conn->prepare("INSERT INTO tbl_report(fullname,defendant,report) VALUES(:fullname,:defendant,:report)");
    $tbl_report->bindParam(':fullname', $fullname);
    $tbl_report->bindParam(':defendant', $defendant);
    $tbl_report->bindParam(':report', $report);
    $tbl_report->execute();

    if ($tbl_report) {
        header("location: report.php");
    }
}

// ลบรายงาน
if (isset($_GET['report_id'])) {
    $id_delete = $_GET['report_id'];
    $delete_tbl_report = $conn->prepare("DELETE FROM tbl_report WHERE id = $id_delete");
    $delete_tbl_report->execute();

    if ($delete_tbl_report) {
        header("location: reportAdmin.php");
    }
}