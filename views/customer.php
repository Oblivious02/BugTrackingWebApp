<?php
$pageTitle = 'Bug Tracking';
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {

    if ($_SESSION['userType'] != 2) {
        header("location: login.php");
    }
    include "../views/includes/navbar.php";
}
?>

<?php include "../views/includes/footer.php"; ?>