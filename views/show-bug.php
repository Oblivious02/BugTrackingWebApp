<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {

    if ($_SESSION['userType'] != 1) {
        header("location: login.php");
    }
}
$pageTitle = 'Bugs';
require_once "../views/includes/navbar.php";
require_once '../models/user.php';
require_once '../controllers/MainController.php';
require_once '../models/bug.php';
$bug = new Bug;
$bugs = $bug->getAllBugs();
$deleted = false;
if (isset($_POST['raise'])) {
    if (!empty($_POST['bugID'])) {
        $_SESSION['idOfBug'] = $_POST['bugID'];
        header('location: assign-bug.php');
    }
}
?>
<div class="container">
    <main id="main" class="main show-admin">

        <div class="pagetitle">
            <h1>Bugs Tables</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card bug-body">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="stuff-operator">
                                </div>
                            </div>
                            <?php

                            if (count($bugs) == 0) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    There are no bugs
                                </div>
                            <?php
                            } else {
                            ?>
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Staff Assigned ID</th>
                                            <th scope="col">Customer Reported ID</th>
                                            <th scope="col">Bug Title</th>
                                            <th scope="col">Bug details</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        <?php
                                        foreach ($bugs as $bug) {
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $bug["bugID"] ?>
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
                                                    <form action="show-bug.php" method="POST">
                                                        <input type="hidden" name="bugID" value="<?php echo $bug["bugID"] ?>">
                                                        <button class="btn btn-outline-primary" name="raise">
                                                            Assign Bug
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
<script src="../views/js/bootstrap.bundle.min.js"></script>
<script src="../views/js/main.js"></script>

<?php require_once "../views/includes/footer.php" ?>