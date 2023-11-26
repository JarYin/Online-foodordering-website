<?php

session_start();

include("server.php");

if (isset($_POST['update']) and isset($_SESSION['user_login']) or isset($_SESSION['owner_login']) or isset($_SESSION['delivery_login']) or isset($_SESSION['admin_login'])) {
    if (isset($_SESSION['user_login'])) {
        $id = $_SESSION['user_login'];
    } else if (isset($_SESSION['owner_login'])) {
        $id = $_SESSION['owner_login'];
    } else if (isset($_SESSION['delivery_login'])) {
        $id = $_SESSION['delivery_login'];
    } else if (isset($_SESSION['admin_login'])) {
        $id = $_SESSION['admin_login'];
    } else {
        header("location: login.php");
    }

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $img = $_FILES['image'];
    // $img_temp = $_FILES['image']['tmp_name'];
    $active = $_POST['active'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $approve = 0;

    // $sql = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id");
    // $sql->execute();
    // $row = $sql->fetch(PDO::FETCH_ASSOC);
    try {

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/' . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {

                    $stmt = $conn->prepare("UPDATE tbl_account SET fullname=:fullname ,email=:email,username=:username,password=:password, 
                    image_name=:img,status=:active,contact=:contact,address=:address,approve=:approve WHERE id=$id");
                    $stmt->bindParam(':fullname', $fullname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':img', $fileNew);
                    $stmt->bindParam(':active', $active);
                    $stmt->bindParam(':contact', $contact);
                    $stmt->bindParam(':address', $address);
                    $stmt->bindParam(':approve', $approve);
                    $stmt->execute();


                    if ($stmt) {
                        $_SESSION['success_profile'] = "ระบบได้ทำการอัปเดตฐานข้อมูลเป็นที่เรียบร้อย";
                        header("location:profile.php");
                    } else {
                        $_SESSION['error_profile_config'];
                        header("location: profile_config.php");
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['update']) and isset($_SESSION['owner_login'])) {
    $id = $_SESSION['owner_login'];
    $shopname = $_POST['shopname'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $img = $_FILES['image'];
    // $img_temp = $_FILES['image']['tmp_name'];
    $active = $_POST['active'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // $sql = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id");
    // $sql->execute();
    // $row = $sql->fetch(PDO::FETCH_ASSOC);
    try {

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/' . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {


                    $stmt = $conn->prepare("UPDATE tbl_account SET shopname=:shopname ,fullname=:fullname ,email=:email,username=:username,password=:password, 
                    image_name=:img,status=:active,contact=:contact,address=:address WHERE id=$id");
                    $stmt->bindParam(':shopname', $shopname);
                    $stmt->bindParam(':fullname', $fullname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':img', $fileNew);
                    $stmt->bindParam(':active', $active);
                    $stmt->bindParam(':contact', $contact);
                    $stmt->bindParam(':address', $address);
                    $stmt->execute();

                    $tbl_food_update = $conn->prepare("UPDATE tbl_food SET shopname = :shopname");
                    $tbl_food_update->bindParam(':shopname', $shopname);
                    $tbl_food_update->execute();

                    echo 123;
                    if ($stmt and $tbl_food_update) {
                        $_SESSION['success_profile'] = "ระบบได้ทำการอัปเดตฐานข้อมูลเป็นที่เรียบร้อย";
                        header("location:profile.php");
                    } else {
                        $_SESSION['error_profile_config'];
                        header("location: profile_config.php");
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}