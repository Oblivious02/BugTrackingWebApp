<?php
require_once '../controllers/MainController.php';
require_once '../models/customer.php';
class Bug extends Customer
{
    private $bugID;
    private $bugTitle;
    private $bugDetails;
    private $customerReportedID;
    private $staffAssignedID;
    public function getAllBugs()
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM bug";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function getBug($bugID)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM bug WHERE bugID = $bugID";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
}
