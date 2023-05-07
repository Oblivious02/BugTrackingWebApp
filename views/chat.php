<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {

    // if ($_SESSION['userType'] != 1) {
    //     header("location: login.php");
    // }
    $pageTitle = 'Chat';
    require_once "../views/includes/navbar.php";
    require_once '../models/user.php';
    // require_once '../models/chat.php';   
    require_once '../controllers/MainController.php';
    require_once '../models/admin.php';
    // $place = 0;

    $user = new User;
    // $chat = new Chat;
    $admin = new Admin;
    // $messages = getAllMessage();
    if ($_SESSION['userType'] == 1) {
        $staffs = $admin->getAllStaff();
    } elseif ($_SESSION['userType'] == 0) {
        $staffs = $admin->getStaffChat();
    } else {
        $staffs = $admin->getCustomerChat();
    }
}

// if (isset($_POST['msgContent'])) {
//     if (!empty($_POST['msgContent'])) {
//         $user = new User;
//         // $chat->setMessage($_POST['msgContent']);
//         $chat->setSenderID($_SESSION['userID']);
//         $chat->setIdRecipient($_GET['buttonPeople']);
//         // if ($chat->addMsg()) {
//         //     header("refresh:0.1");
//         // }
//     }
// }
?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<body onload="sendMsg()">


    <div class="container-fluid">
        <div class="row clearfix chat-position">
            <div class="col-lg-12 overflow-hidden">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend btn btn-success">
                                <span class="input-group-text btn-send"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <?php
                            foreach ($staffs as $staff) {
                                ?>
                                <a href="chat.php?buttonPeople=<?php echo $staff["staffID"] ?>">
                                    <div class="<?php $staff['staffID'] ?>">
                                        <li class="clearfix" name="ahmed" id="s<?php echo $staff["staffID"] ?>">
                                            <img src="images/avatar2.png" alt="avatar">
                                            <div class="about">
                                                <div class="name text-start">
                                                    <?php
                                                    echo $staff["name"];
                                                    ?>
                                                </div>
                                                <div class="status text-start"> <i class="fa fa-circle online"></i>
                                                    online
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </a>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                    if (!empty($_GET['buttonPeople'])) {
                        ?>
                        <div>
                            <div class="chat" id="chat">
                                <div class="chat-header clearfix">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                                <!-- ----------- https://bootdey.com/img/Content/avatar/avatar2.png ----------- -->
                                                <img src="images/avatar2.png" alt="avatar">
                                            </a>
                                            <div class="chat-about">
                                                <h6 class="m-b-0">
                                                    <?php
                                                    $name = $admin->chatName($_GET['buttonPeople']);
                                                    echo $name[0]['name'];
                                                    ?>
                                                </h6>
                                                <small>Last seen: 2 hours ago</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 hidden-sm text-right">
                                            <a href="javascript:void(0);" class="btn btn-outline-secondary"><i
                                                    class="fa fa-camera"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-outline-primary"><i
                                                    class="fa fa-image"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-outline-info"><i
                                                    class="fa fa-cogs"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-outline-warning"><i
                                                    class="fa fa-question"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-history">
                                    <ul class="m-b-0">
                                        <?php
                                        // while ($res = mysqli_fetch_assoc($s)) {
                                        // foreach ($messages as $message) {
                                        ?>
                                        <?php
                                        // if (!empty($_GET['buttonPeople'])) {
                                        //     if ($res["recipientID"] == $_GET['buttonPeople']) {
                                        ?>

                                        <?php
                                        // if ($res["senderID"] == $_GET['buttonPeople']) {
                                        ?>
                                        <li class="clearfix">
                                            <div class="message-data">
                                                <span class="message-data-time">Start Boot</span>
                                            </div>
                                            <div class="message my-message w-100">
                                                <?php
                                                // if ($_SESSION['sec']) {
                                                ?>
                                                <p id="txt"></p>
                                                <?php
                                                // echo $message["message"];
                                                echo "<br>";
                                                // }
                                                ?>
                                            </div>
                                        </li>
                                        <?php
                                        // }
                                        // }
                                        // }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <?php
                            if (!empty($_GET['buttonPeople'])) {
                                ?>
                                <div class="chat-message clearfix">
                                    <!-- <form class="input-group mb-0"
                                    action="chat.php?buttonPeople=<?php //echo $_GET['buttonPeople'] ?>" method="POST"> -->
                                    <button type="submit" class="input-group-prepend btn btn-success" onclick="sendMsg()">
                                        <span class="input-group-text btn-send"><i class="fa fa-send"></i></span>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter text here..." name="msgContent"
                                        autocomplete="off" id="myMsg" style="width: 88%; display: inline-block;">
                                    <!-- </form> -->
                                </div>
                            </div>
                            <?php
                            }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        var div = document.getElementById("chat");
        div.scrollTop = div.scrollHeight;
        // Function to reload the page content
        function sendMsg() {
            // Make an AJAX request to the server to check for updates
            var xhr = new XMLHttpRequest();
            var msg = document.getElementById("myMsg").value;
            // var msg = document.getElementById("myMsg").value;
            // var msg = document.getElementById("myMsg").value;
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("txt").innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "../models/chat.php?m=" + msg + "&sID=<?php echo $_SESSION['userID'] ?>&rID=<?php echo $_GET['buttonPeople'] ?>&sName=<?php $staff["name"]; ?>", true);
            xhr.send();
        }

    // Reload the content every 5 seconds
    // setInterval(reloadContent, 5000);
    </script>
</body>

<?php require_once "../views/includes/footer.php" ?>