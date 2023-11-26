<?php
include('server.php');
session_start();


//ส่งข้อมูลสินค้าจากลูกค้าไปยังเจ้าของร้าน โดยอ้างอิงจาก owner_id จากตาราง tbl_orders
// if (isset($_POST['SendToOwner'])) {
//     $sql = $conn->prepare("SELECT * FROM tbl_orders WHERE  ");
// }


if (isset($_GET['account_id'])) {
    $id_account = $_GET['account_id'];
    $sql = $conn->prepare("SELECT * FROM tbl_orders WHERE account_id = $id_account");
    $sql->execute();
    $check = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($check as $check) {
        $insert = $conn->prepare("INSERT INTO tbl_status(owner_id,food,price,quantity,total,order_date,status,account_id,
    customer_name,customer_contact,customer_email,customer_address) VALUES(:owner_id,:food,:price,:quantity,:total,:order_date,
    :status,:account_id,:customer_name,:customer_contact,:customer_email,:customer_address)");
        $insert->bindParam(':owner_id', $check['owner_id']);
        $insert->bindParam(':food', $check['food']);
        $insert->bindParam(':price', $check['price']);
        $insert->bindParam(':quantity', $check['quantity']);
        $insert->bindParam(':total', $check['total']);
        $insert->bindParam(':order_date', $check['order_date']);
        $insert->bindParam(':status', $check['status']);
        $insert->bindParam(':account_id', $check['account_id']);
        $insert->bindParam(':customer_name', $check['customer_name']);
        $insert->bindParam(':customer_contact', $check['customer_contact']);
        $insert->bindParam(':customer_email', $check['customer_email']);
        $insert->bindParam(':customer_address', $check['customer_address']);
        $insert->execute();
    }

    // delete
    $id_account = $_GET['account_id'];
    $delete = $conn->prepare("DELETE FROM tbl_orders WHERE account_id = $id_account");
    $delete->execute();

    if ($insert) {
        header("location: status.php");
    } else {
        header("location:shopping_cart.php");
    }
}


// เจ้าของร้าน
if (isset($_GET['update'])) {
    // ต้องใช้ GET ระบุ
    $idStatus = $_GET['update'];
    $catagory = $_GET['selected'];
    $sql = $conn->prepare("SELECT * FROM tbl_status WHERE id = $idStatus ");
    $sql->execute();
    $statusCheck = $sql->fetch(PDO::FETCH_ASSOC);

    if ($catagory == "รอการยืนยันจากทางร้าน") {
        echo $catagory == 1;
    } else if ($catagory == "รับออเดอร์") {
        echo $catagory == 2;
    } else if ($catagory == "กำลังทำอาหาร") {
        echo $catagory == 3;
    } else if ($catagory == "กำลังไปส่ง") {
        echo $catagory == 4;
    }

    $id = $statusCheck['id'];
    $update = $conn->prepare("UPDATE tbl_status SET status=:catagory ,reserve=0 WHERE id = $id");
    $update->bindParam(':catagory', $catagory);
    $update->execute();

    //  ต้องระบุ WHERE ก่อน

    if ($update) {
        header("location:status.php");
    } else {
        header("location:status.php");
    }
}

if (isset($_GET['delete'])) {
    $idDelete = $_GET['delete'];
    $dontshow = 1;

    $deleteID = $conn->prepare("UPDATE tbl_status SET dontshow = $dontshow WHERE id = $idDelete");
    $deleteID->execute();


    if ($deleteID) {
        header("location:status.php");
    } else {
        header("location:status.php");
    }
}





// delivery 
if (isset($_GET['accept'])) {
    $id = $_GET['accept'];
    $id_delivery = $_SESSION['delivery_login'];
    $deliveryAccept = $id_delivery;
    $reserve = 1;

    $sql = $conn->prepare("SELECT * FROM tbl_status WHERE id=$id");
    $sql->execute();
    $check = $sql->fetch(PDO::FETCH_ASSOC);

    $update = $conn->prepare("UPDATE tbl_status SET delivery_id = :delivery_id , reserve = :reserve WHERE id = $id");
    $update->bindParam(':delivery_id', $deliveryAccept);
    $update->bindParam(':reserve', $reserve);
    $update->execute();

    // ทำให้ขึ้นแค่สินค้าที่ผู้ส่งอาหารได้เลือก และ ลองใช้ ้where เป็น id


    // ลิ้งไปหน้า status_delivery
    if ($update) {
        header("location:status_delivery.php");
    } else {
        header("location:status.php");
    }
}

if (isset($_GET['finished'])) {
    $id = $_GET['finished'];
    $id_delivery = $_SESSION['delivery_login'];
    $catagory = $_GET['selected'];

    $sql = $conn->prepare("SELECT * FROM tbl_status WHERE id=$id");
    $sql->execute();
    $check = $sql->fetch(PDO::FETCH_ASSOC);

    $update = $conn->prepare("UPDATE tbl_status SET status = :catagory WHERE id = $id");
    $update->bindParam(':catagory', $catagory);
    $update->execute();

    if ($update) {
        header("location: status_delivery.php");
    } else {
        header("location: status_delivery.php");
    }
}