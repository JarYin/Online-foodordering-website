<?php
include('server.php');
session_start();

if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $img = $_FILES['img'];
    $status = $_POST['catagory'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $approve = 0;

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    $filePath = 'uploads/' . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {

                $sql = $conn->prepare("INSERT INTO tbl_account(fullname, email, username, password, address, contact,image_name , status , approve) VALUES(:fullname, :email, :username, :password, :address, :contact, :img , :status , :approve)");
                $sql->bindParam(":fullname", $fullname);
                $sql->bindParam(":email", $email);
                $sql->bindParam(":username", $username);
                $sql->bindParam(":password", $password);
                $sql->bindParam(':address', $address);
                $sql->bindParam(':contact', $contact);
                $sql->bindParam(":img", $fileNew);
                $sql->bindParam(':status', $status);
                $sql->bindParam(':approve', $approve);
                $sql->execute();


                if ($sql) {
                    $_SESSION['success'] = "Data has been inserted successfully";
                    header("location: login.php");
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("location: login.php");
                }
            }
        }
    }
}
