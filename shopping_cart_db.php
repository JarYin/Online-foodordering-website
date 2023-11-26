<?php
include('server.php');
include('session_name.php');


if (isset($_POST['Submit'])) {
    //ระบอาหารที่เลือก
    $id = $_SESSION['id_getcart'];
    $quantity = $_POST['quantity'];


    $sql = $conn->prepare("SELECT * FROM tbl_foods WHERE id = $id");
    $sql->execute();
    $rowFood = $sql->fetch(PDO::FETCH_ASSOC);
    $statusDefault = "รอการยืนยันจากทางร้าน";
    //อ้างอิงถึงสมาชิกคนนั้นๆ หรือ ลูกค้า และ include จาก session name
    $id = $row['id'];
    $total = $rowFood['price'] * $quantity;
    $_SESSION['statusDefault'] = "รอการยืนยันจากทางร้าน";


    //นำข้อมูลนั้นเข้า
    $insert = $conn->prepare("INSERT INTO tbl_orders(owner_id,food,price,quantity,total,status,account_id,customer_name,customer_contact,customer_email,customer_address) 
    VALUES(:owner_id,:food,:price,:quantity,:total,:status,:account_id,:customer_name,:customer_contact,:customer_email,:customer_address)");
    $insert->bindParam(':owner_id', $rowFood['owner_id']);
    $insert->bindParam(':food', $rowFood['title']);
    $insert->bindParam(':price', $rowFood['price']);
    $insert->bindParam(':quantity', $quantity);
    $insert->bindParam(':total', $total);
    $insert->bindParam(':status', $statusDefault);
    $insert->bindParam(':account_id', $id);
    $insert->bindParam(':customer_name', $row['fullname']);
    $insert->bindParam(':customer_contact', $row['contact']);
    $insert->bindParam(':customer_email', $row['email']);
    $insert->bindParam(':customer_address', $row['address']);
    $insert->execute();

    if ($insert) {
        header("location:shopping_cart.php");
    } else {
        $_SESSION['error_food'] = "มีบางอย่างผิดพลาด";
        header("location:shopping_cart.php");
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = $conn->prepare("DELETE FROM tbl_orders WHERE $id = id");
    $delete->execute();

    if ($delete) {
        header("location: shopping_cart.php");
    } else {
        header("location: shopping_cart.php");
    }
}