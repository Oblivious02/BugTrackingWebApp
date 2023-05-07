<?php

require_once '../controllers/MainController.php';
class Admin extends User
{

    public function addUser(User $user)
    {
        $db = new DBController;
        $username = $user->getUsername();
        $password = $user->getPassword();
        $name = $user->getName();
        if ($db->openConnect()) {
            $query = "INSERT INTO user VALUES ('','$username','$password','$name',0)";
            return $db->insert($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function getAllStaff()
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM user WHERE typeID=0";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function getStaffChat()
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM user WHERE typeID>0";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function chatName($id)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT name FROM user WHERE staffID='$id'";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function getCustomerChat()
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM user WHERE typeID=0";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function deleteUser($id)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "DELETE FROM user WHERE staffID='$id'";
            return $db->delete($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function raiseBug(User $user)
    {
        // session_start();
        $db = new DBController;
        $username = $user->getUsername();
        $id = $user->getUserID();
        $pass = $user->getPassword();
        $name = $user->getName();
        $bug_id = $_SESSION['idOfBug'];
        if ($db->openConnect()) {
            $query = "INSERT INTO staff VALUES ('','$username','$pass','$name','$bug_id','$id')";
            if ($this->updateOfRaise($id, $bug_id)) {
                return $db->insert($query);
            } else {
                echo "updateOfRaise error";
            }

        } else {
            echo "error database connection";
            return false;
        }
    }
    public function updateOfRaise($staffID, $bugID)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "UPDATE bug SET staffAssignedID='$staffID' WHERE bugID='$bugID'";
            return $db->update($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
}

?>