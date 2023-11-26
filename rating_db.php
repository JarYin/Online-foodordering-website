<?php
include('server.php');
session_start();


if (isset($_POST['give'])) {
    $account_id = $_POST['account_id'];
    $food_id = $_POST['food_id'];
    $fullname = $_POST['fullname'];
    $rating = $_POST['rating'];

    $tbl_rating = $conn->prepare("SELECT * FROM tbl_rating WHERE food_id = $food_id");
    $tbl_rating->execute();
    $check_tbl_rating = $tbl_rating->fetch(PDO::FETCH_ASSOC);

    if ($check_tbl_rating['account_id'] != $account_id) {
        $insertRating = $conn->prepare("INSERT INTO tbl_rating(account_id,food_id,fullname,rating) 
    VALUES(:account_id,:food_id,:fullname,:rating)");
        $insertRating->bindParam(':account_id', $account_id);
        $insertRating->bindParam(':food_id', $food_id);
        $insertRating->bindParam(':fullname', $fullname);
        $insertRating->bindParam(':rating', $rating);
        $insertRating->execute();
        if ($insertRating) {
            header("location: PageFood.php?food_id=" . $food_id);
        }
    } else {
        $update_tbl_rating = $conn->prepare("UPDATE tbl_rating SET rating = :rating WHERE account_id = $account_id and food_id = $food_id");
        $update_tbl_rating->bindParam(':rating', $rating);
        $update_tbl_rating->execute();

        $update_tbl_comment = $conn->prepare("UPDATE tbl_comment SET rating = :rating");
        $update_tbl_comment->bindParam(':rating', $rating);
        $update_tbl_comment->execute();

        if ($update_tbl_rating and $update_tbl_comment) {
            header("location: PageFood.php?food_id=" . $food_id);
        }
    }
}