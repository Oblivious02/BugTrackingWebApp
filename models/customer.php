<?php

class Customer extends User
{
    private $bugTitle;
    private $bugDetails;

    public function getBugDetails()
    {
        return $this->bugDetails;
    }

    public function setBugDetails($details)
    {
        $this->bugDetails = $details;
    }
    public function getBugTitle()
    {
        return $this->bugTitle;
    }

    public function setBugTitle($title)
    {
        $this->bugTitle = $title;
    }

    public function raiseBug(User $user)
    {
        $db = new DBController;
        $userID = $user->getUserID();
        $title = $this->getBugTitle();
        $details = $this->getBugDetails();
        if ($db->openConnect()) {
            $query = "INSERT INTO bug VALUES ('',NULL,'$userID','$title','$details',0)";
            return $db->insert($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
    public function getMyBugs($id)
    {
        $db = new DBController;
        if ($db->openConnect()) {
            $query = "SELECT * FROM bug WHERE customerReportedID='$id'";
            return $db->select($query);
        } else {
            echo "error database connection";
            return false;
        }
    }
}
?>