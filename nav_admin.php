<?php
include('server.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    max-width: 2000px;
    width: 100%;
    margin: 0 auto;
    position: fixed;
    z-index: 1;
    background-color: whitesmoke;
}

.nav-grid {
    display: grid;
    grid-template-columns: 255px 1fr;
}

.logo {
    color: green;
}

header {
    width: 100%;
    height: fit-content;
    background-color: whitesmoke;

}

ul.menu {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
}


.menu li {
    text-decoration: none;
    list-style-type: none;
}

.menu li a {
    text-decoration: none;
    text-transform: uppercase;
    color: black;
    transition: ease-in-out;
}

.menu li a:hover {
    color: aqua;
}
</style>

<body>
    <div class="container">

        <div class="nav-grid">
            <div class="logo">
                <a href="index_admin.php" style="color:red; text-decoration: none;">
                    <h1>Admin</h1>
                </a>
            </div>
            <ul class="menu my-3">
                <li><a href="profile.php">Profile</a></li>
                <li><a href="reportAdmin.php">report</a></li>
                <li><a href="admin_status.php">Status</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
        </div>
    </div>
</body>

</html>