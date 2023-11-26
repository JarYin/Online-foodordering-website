<?php
include('server.php');
session_start();
if (isset($_SESSION['user_login'])) {
    include('nav_user.php');
    $id_account = $_SESSION['user_login'];
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
    include('box_post.php');
    $id_account = $_SESSION['owner_login'];
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    include('box_post.php');
    $id_account = $_SESSION['admin_login'];
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');
    $id_account = $_SESSION['delivery_login'];
} else {
    header("location: login.php");
}


if (isset($_GET['food_id'])) {
    $id = $_GET['food_id'];
    $sql = $conn->prepare("SELECT * FROM tbl_foods WHERE id = $id");
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageFood</title>
</head>

<body>
    <div class="container-md">
        <div class="row"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col-12 my-5">
                <div class="card my-5">
                    <div class=" card-body">
                        <?php if (isset($_SESSION['owner_login']) and $_SESSION['owner_login'] == $row['owner_id']) { ?>
                        <div class="d-flex">
                            <a href="edit_post.php?food_id=<?php echo $id ?>" class="btn btn-warning mx-1">แก้ไข</a>
                            <a href="post_menu_db.php?delete_id=<?php echo $id ?>" class="btn btn-danger">ลบ</a>
                        </div>
                        <?php } else if (isset($_SESSION['admin_login'])) { ?>
                        <a href="post_menu.php" class="btn btn-warning mx-1">แก้ไข</a>
                        <?php } ?>
                        <div class="card-title">
                            <center>
                                <h2><?php echo $row['title']; ?></h2>
                                <?php if (isset($row['shopname'])) { ?>
                                <h3><?php echo $row['shopname']; ?></h3>
                                <?php } ?>
                            </center>
                        </div>
                        <div class="card-image"><img
                                src="<?php echo $imageURL = 'foodmenu_uploads/' . $row['image_name']; ?>" alt=""
                                style="width:100%;">
                        </div>
                        <div class="discription">
                            <?php echo $row['discription']; ?>
                        </div>


                        <div class="d-flex">
                            <a href="accept_shopping.php?GetCart=<?php echo $row['id']; ?>"><button
                                    class="btn btn-primary">เพิ่มลงตะกร้าสินค้า</button></a>
                            <a href="rating.php?getrating=<?php echo $row['id'] ?>"
                                class="btn btn-warning mx-2">ให้คะแนน</a>
                        </div>

                        <div class="card-rating"><?php
                                                        $rating = $conn->prepare("SELECT rating FROM tbl_rating WHERE food_id = $id");
                                                        $rating->execute();
                                                        $fetch = $rating->fetch(PDO::FETCH_ASSOC);
                                                        if ($rating->rowCount() > 0) {
                                                            foreach ($conn->query("SELECT SUM(rating) FROM tbl_rating WHERE food_id = $id") as $row) {;
                                                                echo "คะแนนรีวิว : " . round($row['SUM(rating)'] / $rating->rowCount(), 2);
                                                            }
                                                        } else {
                                                            echo "";
                                                        } ?>
                        </div>

                    </div>
                </div>

                <!-- รีวิวอาหาร -->
                <div class="card">
                    <?php $profile = $conn->prepare("SELECT * FROM tbl_account WHERE id = $id_account");
                        $profile->execute();
                        $Profilefetch = $profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                    <tr>
                        <div class="card-title">
                            <!-- โปรไฟล์ -->
                            <div class="d-flex" style="align-items: center;">
                                <div class="profile px-2 py-2" align="left" style="border-radius:100px; "><a
                                        href="profile_config.php"><img
                                            src="<?php echo $imageURL = 'uploads/' . $Profilefetch['image_name']; ?>"
                                            alt="Avatar" class="avatar" style="border-radius:200px; height:50px;">
                                    </a>

                                </div>
                                <h4><?php echo $Profilefetch['fullname']; ?></h4>
                            </div>
                            <hr>
                        </div>

                        <!-- คอมเม้น -->
                        <div class="comment">
                            <center>
                                <form action="comment_db.php" method="post">
                                    <input type="hidden" name="id_food" value="<?php echo $id; ?>">

                                    <textarea name="comment" id="" cols="30" rows="10" class="form-control"
                                        placeholder="SAY SOMETHING...."></textarea>

                                    <button type="submit" name="post" value="<?php echo $id_account; ?>"
                                        class="btn btn-primary">โพสต์</button>
                                    <button type="reset" class="btn btn-warning">รีเซ็ต</button>

                                </form>
                            </center>

                        </div>

                    </tr>
                </div>

                <!-- กล่องความคิดเห็นคนอื่น -->
                <?php $tbl_comment = $conn->prepare("SELECT * FROM tbl_comment WHERE  food_id = $id");
                    $tbl_comment->execute();
                    $tbl_comment_check = $tbl_comment->fetchAll(PDO::FETCH_ASSOC);

                    ?>

                <?php foreach ($tbl_comment_check as $check) { ?>
                <div class="card my-2">
                    <div class="card-title">
                        <!-- โปรไฟล์ -->
                        <div class="d-flex" style="align-items: center;">
                            <div class="profile px-2 py-2" align="left" style="border-radius:100px; "><a
                                    href="profile_config.php"><img
                                        src="<?php echo $imageURL = 'uploads/' . $check['profile']; ?>" alt="Avatar"
                                        class="avatar" style="border-radius:200px; height:50px;">
                                </a>

                            </div>
                            <h4><?php echo $check['fullname']; ?></h4>
                            <h5 style="color:green" class="mx-5">คะแนนรีวิว <?php echo $check['rating'] ?></h5>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <h5><?php echo $check['comment'] ?></h5>
                    </div>
                </div>
                <?php } ?>

            </div>


        </div>


        <div class="col"></div>
    </div>
    <div class="row"></div>
    </div>
</body>

</html>
<?php  } ?>