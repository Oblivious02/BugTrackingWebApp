<?php
require_once '../controllers/MainController.php';
require_once '../models/bug.php';
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
        $id = $user->getUserID();
        $bug_id = $_SESSION['idOfBug'];
        if ($db->openConnect()) {
            $query = "UPDATE bug SET staffAssignedID='$id' WHERE bugID='$bug_id'";
            return $db->update($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function updateSolve($bug_id, $staffID)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "UPDATE bug SET solved=1 WHERE bugID='$bug_id'";
            if ($db->update($query)) {
                $staffID = $_SESSION["userID"];
                $staffName = $_SESSION["userID"];
                $bugObject = new Bug;
                $result = $bugObject->getBug($bug_id);
                $customerID = $result[0]["customerReportedID"];
                $bugName = $result[0]["bug title"];

                $qry = "INSERT into messages values ('', '$staffID', '$customerID', 'Solved bug name: ($bugName)')";
                $db->insert($qry);
            }
        } else {
            echo "error database connection";
            return false;
        }
    }
}
