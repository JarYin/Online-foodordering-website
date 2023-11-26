<?php
include('server.php');
session_start();


if (isset($_POST['post'])) {
    $foodName = $_POST['foodName'];
    $discription = $_POST['Discription'];
    $price = $_POST['price'];
    $catagory = $_POST['catagory'];
    $active = $_POST['active'];
    $owner_id = $_SESSION['owner_login'];
    $discount = $_POST['discount'];

    $targetDir = 'foodmenu_uploads/';
    if (!empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'JPG');

        if (in_array($fileType, $allowTypes)) {

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                if ($discount == "") {
                    $sql = $conn->prepare("INSERT INTO tbl_foods(owner_id,title, discription, price, image_name , catagory_id, active) 
                    VALUES(:owner_id,:foodName, :discription, :price, :img, :catagory , :active)");
                    $sql->bindParam(':owner_id', $owner_id);
                    $sql->bindParam(":foodName", $foodName);
                    $sql->bindParam(":discription", $discription);
                    $sql->bindParam(":price", $price);
                    $sql->bindParam(":img", $fileName);
                    $sql->bindParam(":catagory", $catagory);
                    $sql->bindParam(':active', $active);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: index_owner.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: post_menu.php");
                    }
                } else {
                    $sql = $conn->prepare("INSERT INTO tbl_foods(owner_id,title, discription, price, discount ,image_name , catagory_id, active) 
                    VALUES(:owner_id,:foodName, :discription, :price, :discount, :img, :catagory , :active)");
                    $sql->bindParam(':owner_id', $owner_id);
                    $sql->bindParam(":foodName", $foodName);
                    $sql->bindParam(":discription", $discription);
                    $sql->bindParam(":price", $price);
                    $sql->bindParam(":discount", $discount);
                    $sql->bindParam(":img", $fileName);
                    $sql->bindParam(":catagory", $catagory);
                    $sql->bindParam(':active', $active);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: index_owner.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: post_menu.php");
                    }
                }
            }
        }
    }
}

// ลบอาหาร
if (isset($_GET['delete_id'])) {
    $id_delete = $_GET['delete_id'];
    $tbl_food = $conn->prepare("DELETE FROM tbl_foods WHERE id = $id_delete");
    $tbl_food->execute();
    if ($tbl_food) {
        if (isset($_SESSION['owner_login'])) {
            header("location: index_owner.php");
        } else {
            header("location: index_admin.php");
        }
    }
}
