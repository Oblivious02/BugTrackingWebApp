<?php
$pageTitle = 'Staff';
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {

    if ($_SESSION['userType'] != 0) {
        header("location: login.php");
    }
    include "../views/includes/navbar.php";
    print_r($_SESSION['userID']);
    print_r($_SESSION['Name']);
    print_r($_SESSION['userType']);
}
/* ------------------------------------ } ----------------------------------- */

?>

<?php include "../views/includes/footer.php"; ?>