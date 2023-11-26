<?php
include('server.php');
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    try {
        $check = $conn->prepare('SELECT * FROM tbl_account WHERE username = :username');
        $check->bindParam(':username', $username);
        $check->execute();
        $row = $check->fetch(PDO::FETCH_ASSOC);

        if ($username != $row['username'] or $password != $row['password']) {
            $_SESSION['error'] = "กรุณาลองใหม่อีกครั้ง";
            header("location: login.php");
        } else if ($username != $row['username'] and $password != $row['password']) {
            $_SESSION['error'] = "กรุณาลองใหม่";
            header("location: login.php");
        } else {
            $_SESSION['error'] = "กรุณาลองใหม่";
            header("location: login.php");
        }

        if ($check->rowCount() > 0) {
            if ($username == $row['username']) {
                if ($password == $row['password']) {
                    if ($row['status'] == "user") {
                        $_SESSION['user_login'] = $row['id'];
                        header("location: index.php");
                    }
                    if ($row['status'] == "owner") {
                        $_SESSION['owner_login'] = $row['id'];
                        header("location: index_owner.php");
                    }
                    if ($row['status'] == "delivery") {
                        $_SESSION['delivery_login'] = $row['id'];
                        header("location: index_delivery.php");
                    }
                    if ($row['status'] == "admin") {
                        $_SESSION['admin_login'] = $row['id'];
                        header("location: index_admin.php");
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}