<?php
require_once '../controllers/MainController.php';
class Staff extends User
{

    public function getMyBugs($id)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM bug WHERE staffAssignedID='$id'";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }

    public function raiseToAnotherStaff(User $user)
    {
        $db = new DBController;
        $username = $user->getUsername();
        $id = $user->getUserID();
        $pass = $user->getPassword();
        $name = $user->getName();
        $bug_id = $_SESSION['idOfBug'];
        if ($db->openConnect()) {
            $query = "INSERT INTO staff VALUES ('','$username','$pass','$name','$bug_id','$id')";
            if ($this->updateOfRaise($id, $bug_id) && $this->updateOfRaiseStaff($id, $bug_id)) {
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

    public function updateOfRaiseStaff($staffID, $bugID)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "UPDATE staff SET bug_id=NULL WHERE id='$staffID'";
            return $db->update($query);
        } else {
            echo "error database connection";
            return false;
        }
    }

    public function updateSolve($id)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "UPDATE bug SET solved=1 WHERE bugID='$id'";
            return $db->update($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
}

?>