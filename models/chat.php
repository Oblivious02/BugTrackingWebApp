<?php
include "../controllers/DBController.php";
include "connectserver.php";
session_start();
// include "../views/chat.php";
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
        echo $_SESSION['Name'];
        echo "<br>";
        // $_SESSION['place'] = 1;
        // $place = 1;
        echo $res['message'];
        echo "<br>";
        // echo "<br>";
        echo "<hr>";
    } elseif ($res['senderID'] == $_REQUEST['rID']) {
        // $place = 2;
        echo "Staff";
        echo "<br>";
        echo $res['message'];
        echo "<br>";
        // echo "<br>";
        echo "<hr>";
    }
}


// function getAllMessage()
// {
// }

// class Chat extends User
// {
//     private $message;
//     private $idSender;
//     private $idRecipient;
//     private $idMsg;

//     public function getMessage()
//     {
//         return $this->message;
//     }

//     public function setMessage($msg)
//     {
//         $this->message = $msg;
//     }
//     public function setSenderID($sen)
//     {
//         $this->idSender = $sen;
//     }
//     public function setIdMsg($Msg)
//     {
//         $this->idMsg = $Msg;
//     }
//     public function getIdMsg()
//     {
//         return $this->idMsg;
//     }
//     public function getSenderID()
//     {
//         return $this->idSender;
//     }
//     public function getIdRecipient()
//     {
//         return $this->idRecipient;
//     }

//     public function setIdRecipient($recipient)
//     {
//         $this->idRecipient = $recipient;
//     }


//     public function addMsg()
//     {
//         $db = new DBController;
//         $senderID = $this->getSenderID();
//         $recipient_id = $this->getIdRecipient();
//         $message = $this->getMessage();

//         if ($db->openConnect()) {
//             $query = "INSERT INTO messages VALUES ('','$senderID','$recipient_id','$message')";
//             return $db->insert($query);
//         } else {
//             echo "error database connection";
//             return false;
//         }
//     }
// public function getAllMessage()
// {
//     $db = new DBController;
//     if ($db->openConnect()) {
//         $query = "SELECT * FROM messages";
//         return $db->select($query);
//     } else {
//         echo "error database connection";
//         return false;
//     }
// }
// }

?>