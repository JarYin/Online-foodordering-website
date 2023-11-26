<?php
include('server.php');

$stmt = $conn->prepare("SELECT * FROM tbl_category");
$stmt->execute();
$stmtCheck = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catagory</title>
    <link rel="stylesheet" href="Design/catagory.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    .container-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
</style>

<body>
    <div class="container-fulid">
        <div class="row"></div>
        <div class="row">

            <div class="container-grid my-5">
                <?php if ($stmt->rowCount() > 0) {
                    foreach ($stmtCheck as $Check) {

                ?>
                        <div class="card my-5 mx-5" style="width: fit-content ;">
                            <div class="card-body">
                                <center>
                                    <a href="webfood.php?id_category=<?php echo $Check['id']; ?>"><img src="<?php echo $imageURL = 'CatagoryUploads/' . $Check['image_name']; ?>" alt="" style="width: 100%; height:250px;"></a>

                                    <h5 class="card-title"><?php echo $Check['title']; ?></h5>


                                </center>

                            </div>
                        </div>




                <?php }
                } ?>
            </div>



            <div class="row"></div>
        </div>
</body>

</html>