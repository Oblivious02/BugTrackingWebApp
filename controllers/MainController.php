<?php

require_once '../models/user.php';
require_once '../controllers/DBController.php';
class MainController
{
    protected $db;
    public function login(User $user)
    {
        $this->db = new DBController;
        if ($this->db->openConnect()) {
            $email = $user->getUsername();
            $pass = $user->getPassword();
            $type = $user->getUserType();
            $query = "SELECT * FROM user WHERE username='$email' AND password='$pass'";
            $result = $this->db->select($query);
            if ($result === false) {
                echo "error in query";
                return false;
            } else {
                if (count($result) == 0) {
                    $_SESSION["errMsg"] = "you have entered wrong email or password";
                    return false;
                } else {
                    session_start();
                    $_SESSION['userID'] = $result[0]["staffID"];
                    $_SESSION['Name'] = $result[0]["name"];
                    $_SESSION['userType'] = $result[0]["typeID"];
                    $_SESSION['userName'] = $result[0]["username"];
                    $_SESSION['password'] = $result[0]["password"];
                    $this->db->closeConnect();
                    return true;
                }
            }
        } else {
            echo "ERROR IN CONNECTION";
            return false;
        }
    }

    public function Registration(User $user)
    {
        $this->db = new DBController;
        if ($this->db->openConnect()) {
            $username = $user->getUsername();
            $password = $user->getPassword();
            $name = $user->getName();
            $query = "INSERT INTO user VALUES ('','$username','$password','$name',2)";
            $result = $this->db->insert($query);
            if ($result != false) {
                session_start();
                $_SESSION['userID'] = $result;
                $_SESSION['Name'] = $user->getName();
                $_SESSION['userType'] = 0;
                $_SESSION['username'] = $user->getUsername();
                $this->db->closeConnect();
                return true;
            } else {
                $_SESSION['errMsg'] = "Something wrong";
                $this->db->closeConnect();
                return false;
            }
        } else {
            echo "ERROR IN CONNECTION";
            return false;
        }
    }
}
?>