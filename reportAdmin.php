<?php
include('server.php');
session_start();
include('nav_admin.php');

if (!isset($_SESSION['admin_login']) and empty($_SESSION['admin_login'])) {
    header('location:login.php');
}

$tbl_report = $conn->prepare("SELECT * FROM tbl_report");
$tbl_report->execute();
$tbl_report_check = $tbl_report->fetchAll(PDO::FETCH_ASSOC);

?>



<body>
    <div class="container-sm">
        <div class="row"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card" style="margin-top: 80px;">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ไอดี</th>
                                    <th scope="col">ชื่อผู้ร้องเรียน</th>
                                    <th scope="col">ชื่อผู้ถูกร้องเรียน</th>
                                    <th scope="col">รายงาน</th>
                                    <th scope="col">เวลา</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tbl_report_check as $check) { ?>
                                <tr>
                                    <th scope="row"><?php echo $check['id'] ?></th>
                                    <td><?php echo $check['fullname'] ?></td>
                                    <td><?php echo $check['defendant'] ?></td>
                                    <td><?php echo $check['report'] ?></td>
                                    <td><?php echo $check['date'] ?></td>
                                    <td>
                                        <a href="report_db.php?report_id=<?php echo $check['id'] ?>"
                                            class="btn btn-danger">ลบ</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row"></div>

    </div>


</body>

</html>