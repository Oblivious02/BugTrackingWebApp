<?php

session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {
    $i = 1;
    if ($_SESSION['userType'] != 0) {
        header("location: login.php");
    }
    include "../models/functions/functions.php";
    require_once '../models/user.php';
    require_once '../controllers/MainController.php';
    require_once '../models/admin.php';
    require_once '../models/staff.php';
    $staff = new Staff;
    $admin = new Admin;
    $user = new User;
    $pageTitle = 'RaiseBug';
    $staffs = $admin->getAllStaff();
    $deleted = false;
    if (isset($_POST['raiseTheBug'])) {
        if (!empty($_POST['staffID']) && !empty($_POST['staffUsername']) && !empty($_POST['staffPassword']) && !empty($_POST['staffName'])) {
            $user->setUserID($_POST['staffID']);
            $user->setUsername($_POST['staffUsername']);
            $user->setPassword($_POST['staffPassword']);
            $user->setName($_POST['staffName']);
            if ($staff->raiseToAnotherStaff($user)) {
                $staffs = $admin->getAllStaff();
            } else {
                echo "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php getTitle(); ?>
    </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../views/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../views/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/css/all.min.css">
    <link rel="stylesheet" href="../views/css/util.css">
    <link rel="stylesheet" href="../views/css/main.css">
    <link rel="stylesheet" href="../views/css/style.css">
    <link rel="stylesheet" href="../views/css/bootstrap.min.css">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar bg-body-secondary sticky-top na" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">BugTracking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menubar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin.php">Edit members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chat.php">Messages</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="show-bug.php">Show Bugs</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <main id="main" class="main show-admin">

            <div class="pagetitle">
                <h1>Staff Tables</h1>
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php

                                if (count($staffs) == 0) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        There is no any staff
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Name</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($staffs as $staff) {
                                            ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $i++; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $staff["username"] ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $staff["name"] ?>
                                                    </td>
                                                    <td>
                                                        <form action="assign-bug.php" method="POST">
                                                            <input type="hidden" name="staffID" value="<?php echo $staff["staffID"] ?>">
                                                            <input type="hidden" name="staffUsername" value="<?php echo $staff["username"] ?>">
                                                            <input type="hidden" name="staffPassword" value="<?php echo $staff["password"] ?>">
                                                            <input type="hidden" name="staffName" value="<?php echo $staff["name"] ?>">
                                                            <button class="btn btn-outline-success" name="raiseTheBug">
                                                                <i class="fa-solid fa-check"></i> Raise
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                }

                                ?>
                                <?php
                                if ($deleted == true) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        the staff has been deleted
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="../views/admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../views/admin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../views/admin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="../views/admin/assets/vendor/quill/quill.min.js"></script>
    <script src="../views/admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../views/admin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../views/admin/assets/vendor/php-email-form/validate.js"></script>
    <script src="../views/js/bootstrap.bundle.min.js"></script>
    <script src="../views/js/main.js"></script>
    <script src="../views/admin/assets/js/main.js"></script>

</body>

</html>