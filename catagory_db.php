<?php
include('server.php');


if (isset($_POST['postCatagory'])) {
    $catagoryName = $_POST['catagoryName'];
    $active = $_POST['active'];
    $targetdir = 'CatagoryUploads/';

    if (!empty($_FILES['image']['name'])) {
        // สร้างชื่อ
        $fileName = basename($_FILES['image']['name']);
        // ที่อยู่ไฟล์ + ชื่อ
        $targetFilePath = $targetdir . $fileName;
        // ดึงสกุลไฟล์มา
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        // อนุญาติให้เข้าถึงสกุลไฟล์ตามนี้
        $allowsType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        // ดึงสกุลไฟล์มาและเปรียบเทียบกับประเภทที่ให้อนุญาติ
        if (in_array($fileType, $allowsType)) {
            // $_FILES["file"]["tmp_name"] - คือ ชื่อไฟล์ชั่วคราวที่คัดลอกไว้ในเซิร์ฟเวอร์
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $sql = $conn->prepare("INSERT INTO tbl_category(title,image_name, active) 
                VALUES(:title,:img,:active)");
                $sql->bindParam(':title', $catagoryName);
                $sql->bindParam(':img', $fileName);
                $sql->bindParam(':active', $active);
                $sql->execute();



                if ($sql) {
                    header("location:index_admin.php");
                    $_SESSION['success'] = "อัปโหลดข้อมูลเสร็จสิ้น";
                } else {
                    header("location:index_admin.php");
                    $_SESSION['error'] = "อัปโหลดข้อมูลล้มเหลว";
                }
            }
        }
    }
}