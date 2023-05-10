<?php
include "../controllers/DBController.php";
include "connectserver.php";
session_start();
if (!empty($_REQUEST['sID']) && !empty($_REQUEST['m']) && !empty($_REQUEST['rID'])) {
    $sID = $_REQUEST['sID'];
    $msg = $_REQUEST['m'];
    $rID = $_REQUEST['rID'];
    $db = new DBController;
    if ($db->openConnect()) {
        $query = "INSERT INTO messages VALUES ('','$sID','$rID','$msg')";
        mysqli_query($conn, $query);
    } else {
        echo "error database connection";
        return false;
    }
}

$query = "SELECT * FROM messages";
$s = mysqli_query($conn, $query);
while ($res = mysqli_fetch_assoc($s)) {
    if ($res['senderID'] == $_REQUEST['sID'] && $res['recipientID'] == $_REQUEST['rID']) {
        echo "Me";
        echo '<br>';
        echo $res['message'];
        echo '<br style= "margin-top:10px;">';
        echo "<hr>";
    } elseif ($res['senderID'] == $_REQUEST['rID']) {
        echo "Another";
        echo "<br>";
        echo $res['message'];
        echo '<br style= "margin-top:10px;">';
        echo "<hr>";
    }
}
