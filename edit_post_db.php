<?php
include('server.php');
session_start();


if (isset($_POST['post'])) {
    $food_id = $_POST['food_id'];
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
                    $sql = $conn->prepare("UPDATE tbl_foods SET owner_id = :owner_id ,title = :foodName , discription = :discription , price = :price , image_name = :img  , catagory_id  = :catagory , active = :active WHERE id = $food_id");
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
                    $sql = $conn->prepare("UPDATE tbl_foods SET owner_id = :owner_id ,title = :foodName , discription = :discription , price = :price ,  discount = :discount , image_name = :img  , catagory_id  = :catagory , active = :active WHERE id = $food_id");
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