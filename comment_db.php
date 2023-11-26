<?php
include('server.php');
session_start();

if (isset($_POST['post'])) {
    $id_account = $_POST['post'];

    $tbl_rating = $conn->prepare("SELECT * FROM tbl_rating WHERE account_id = $id_account");
    $tbl_rating->execute();
    $tbl_rating_check = $tbl_rating->fetch(PDO::FETCH_ASSOC);

    $tbl_account = $conn->prepare("SELECT fullname,image_name FROM tbl_account WHERE id = $id_account");
    $tbl_account->execute();
    $tbl_account_check = $tbl_account->fetch(PDO::FETCH_ASSOC);

    $food_id = $_POST['id_food'];
    $fullname = $tbl_account_check['fullname'];
    $profile = $tbl_account_check['image_name'];
    $comment = $_POST['comment'];



    if ($tbl_rating_check['rating'] != "") {
        $tbl_comment = $conn->prepare("SELECT rating  FROM tbl_rating  WHERE account_id = $id_account and food_id = $food_id");
        $tbl_comment->execute();
        $check_tbl_comment = $tbl_comment->fetch(PDO::FETCH_ASSOC);

        $tbl_comment = $conn->prepare("INSERT INTO tbl_comment(account_id,food_id,fullname,profile,comment,rating) 
        VALUES(:id_account,:id_food,:fullname,:profile,:comment,:rating)");
        $tbl_comment->bindParam(':id_account', $id_account);
        $tbl_comment->bindParam(':id_food', $food_id);
        $tbl_comment->bindParam(':fullname', $fullname);
        $tbl_comment->bindParam(':profile', $profile);
        $tbl_comment->bindParam(':comment', $comment);
        $tbl_comment->bindParam(':rating', $check_tbl_comment['rating']);
        $tbl_comment->execute();
    } else {
        $_SESSION['error_comment'] = "ให้คะแนนก่อน!!!!";
        header("location: PageFood.php");
    }

    if ($tbl_comment) {
        header("location: PageFood.php?food_id=" . $food_id);
    }
}