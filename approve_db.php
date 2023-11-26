<?php
include('server.php');

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $update = $conn->prepare("UPDATE tbl_account SET approve = 1 WHERE id = $id");
    $update->execute();

    if ($update) {
        header("location: admin_status.php");
    }
}

// if (isset($_GET['cancel'])) {
//     $id = $_GET['cancel'];
//     $update = $conn->prepare("UPDATE tbl_account SET approve = 2 WHERE id = $id");
//     $update->execute();

//     if ($update) {
//         header("location: admin_status.php");
//     }
// }

if (isset($_GET['ban'])) {
    $id = $_GET['ban'];
    $update = $conn->prepare("UPDATE tbl_account SET approve = 2 WHERE id = $id");
    $update->execute();

    if ($update) {
        header("location: admin_status.php");
    }
}
