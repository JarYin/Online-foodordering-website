<?php
include('server.php');
session_start();
if (isset($_SESSION['user_login'])) {
    include('nav_user.php');
} else if (isset($_SESSION['owner_login'])) {
    include('nav_owner.php');
    include('box_post.php');
} else if (isset($_SESSION['admin_login'])) {
    include('nav_admin.php');
    include('box_post.php');
} else if (isset($_SESSION['delivery_login'])) {
    include('nav_delivery.php');
} else {
    header("location:login.php");
}
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = $conn->prepare(" SELECT * FROM tbl_foods WHERE ( title LIKE '%" . $search . "%' ) ");
    $sql->execute();
    $searchTxt = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($searchTxt as $searchTxt) { ?>
<div class="container-md">
    <div class="row"></div>
    <div class="row my-5">
        <div class="col"></div>
        <div class="col my-5">
            <div class="container-grid">

                <div class="card" style="width: 250px ;">
                    <div class="card-body">
                        <center>

                            <a href="PageFood.php?food_id=<?php echo $searchTxt['id']; ?>"><img
                                    src="<?php echo $imageURL = 'foodmenu_uploads/' . $searchTxt['image_name']; ?>"
                                    id="catagory1" alt="" style="width:100%; height:156px;">
                            </a>

                            <h5 class="card-title"><?php echo $searchTxt['title']; ?></h5>
                            <a href="accept_shopping.php?GetCart=<?php echo $searchTxt['id']; ?>"><button
                                    class="btn btn-primary">เพิ่มลงตะกร้าสินค้า</button></a>


                        </center>

                    </div>
                </div>







            </div>

        </div>
        <div class="col">
        </div>
    </div>


    <?php     }
}
    ?>

    <style>
    .container-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    </style>