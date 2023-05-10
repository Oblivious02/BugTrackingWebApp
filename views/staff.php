<?php
include "../models/functions/functions.php";
$pageTitle = 'Staff';
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {

    if ($_SESSION['userType'] != 0) {
        header("location: login.php");
    }
    require_once '../models/user.php';
    require_once '../controllers/MainController.php';
    require_once '../models/staff.php';
    $i = 1;
    $solvedSuccess = 0;
    $staff = new Staff;
    $pageTitle = 'Staff';
    $bugs = $staff->getMyBugs($_SESSION['userID']);
    if (isset($_POST['raiseBug'])) {
        if (!empty($_POST['bugID'])) {
            $_SESSION['idOfBug'] = $_POST['bugID'];
            header('location: assignBugAnotherStaff.php');
        }
    }
    if (isset($_POST['solved'])) {
        if (!empty($_POST['bugID'])) {
            $staff->updateSolve($_POST['bugID'], $_SESSION['userID']);

            $solvedSuccess = 1;
            header('refresh: 1');
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
                            <a class="nav-link active" aria-current="page" href="admin.php">Raise to another</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chat.php">Messages</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </a>
                            <ul class="dropdown-menu">

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
                <h1>Bug Table</h1>
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="stuff-operator">
                                    </div>
                                </div>


                                <?php
                                if (count($bugs) == 0) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        There are no bugs.
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <?php
                                    if ($solvedSuccess == 1) {
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            Solved Successfully
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">My Id</th>
                                                <th scope="col">Customer Id</th>
                                                <th scope="col">Bug Title</th>
                                                <th scope="col">Bug Details</th>
                                                <th scope="col">Raise To Another</th>
                                                <th scope="col">Solve the bug</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            <?php
                                            foreach ($bugs as $bug) {
                                            ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php echo $i++; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $bug["staffAssignedID"] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $bug["customerReportedID"] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $bug["bug title"] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $bug["bug details"] ?>
                                                    </td>
                                                    <td>
                                                        <form action="staff.php" method="POST">
                                                            <input type="hidden" name="bugID" value="<?php echo $bug["bugID"] ?>">
                                                            <button class="btn btn-outline-primary" name="raiseBug">
                                                                List Staff/Raise
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="staff.php" method="POST">
                                                            <input type="hidden" name="bugID" value="<?php echo $bug["bugID"] ?>">
                                                            <button class="btn btn-outline-success" name="solved">
                                                                Solve
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($bug["solved"] == 1) {
                                                            echo "Solved";
                                                        } else {
                                                            echo "Pending a solution";
                                                        }
                                                        ?>
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


                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>
    </div>
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