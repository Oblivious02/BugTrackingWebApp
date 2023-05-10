<?php
session_start();
if (!isset($_SESSION['userType'])) {
    header("location: login.php");
} else {
    $pageTitle = 'Chat';
    require_once "../views/includes/navbar.php";
    require_once '../models/user.php';
    require_once '../controllers/MainController.php';
    require_once '../models/admin.php';

    $user = new User;
    $admin = new Admin;
    if ($_SESSION['userType'] == 1) {
        $staffs = $admin->getAllStaff();
    } elseif ($_SESSION['userType'] == 0) {
        $staffs = $admin->getStaffChat();
    } else {
        $staffs = $admin->getCustomerChat();
    }
}
?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<body onload="sendMsg()">


    <div class="container-fluid">
        <div class="row clearfix chat-position">
            <div class="col-lg-12 overflow-hidden">
                <div class="card chat-app">
                    <div id="plist" class="people-list">

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
                                        <div class="col-lg-6 d-flex align-items-center">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                                <img src="images/avatar2.png" alt="avatar">
                                            </a>
                                            <div class="chat-about">
                                                <h6 class="m-b-0">
                                                    <?php
                                                    $name = $admin->chatName($_GET['buttonPeople']);
                                                    echo $name[0]['name'];
                                                    ?>
                                                </h6>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="chat-history">
                                    <ul class="m-b-0">

                                        <li class="clearfix">
                                            <div class="message-data">

                                            </div>
                                            <div class="message my-message w-100">

                                                <p id="txt"></p>
                                                <?php
                                                echo "<br>";
                                                ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <?php
                            if (!empty($_GET['buttonPeople'])) {
                            ?>
                                <div class="chat-message clearfix">
                                    <!-- <form class="input-group mb-0"
                                    action="chat.php?buttonPeople=<?php //echo $_GET['buttonPeople'] 
                                                                    ?>" method="POST"> -->
                                    <button type="submit" class="input-group-prepend btn btn-success" onclick="sendMsg()">
                                        <span class="input-group-text btn-send"><i class="fa fa-send"></i></span>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter text here..." name="msgContent" autocomplete="off" id="myMsg" style="width: 88%; display: inline-block;">
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

        function sendMsg() {
            var xhr = new XMLHttpRequest();
            var msg = document.getElementById("myMsg").value;
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("txt").innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "../models/chat.php?m=" + msg + "&sID=<?php echo $_SESSION['userID'] ?>&rID=<?php echo $_GET['buttonPeople'] ?>&sName=<?php $staff["name"]; ?>", true);
            xhr.send();
        }
    </script>
</body>

<?php require_once "../views/includes/footer.php" ?>