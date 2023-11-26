<?php include('server.php');
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body style="background-image:url('img/Login.jpg'); background-size:cover;">
    <div class="container-sm">
        <div class="row"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card" style="margin-top:50%;">
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error'];
                                unset($_SESSION['error']); ?>
                        </div>
                        <?php } ?>
                        <h1 align="center" style="color: green;">FOOD</h1>
                        <form action="login_db.php" method="post">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password">
                            <div class="d-flex my-2">
                                <button type="submit" class="btn btn-primary mx-1" name="login">เข้าสู่ระบบ</button>
                                <a href="register.php" class="btn btn-warning">สมัครสมาชิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row"></div>

    </div>
</body>

<style>
.card {
    box-shadow: 2px 2px grey;
}
</style>

</html>