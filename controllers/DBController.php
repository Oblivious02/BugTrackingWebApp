<?php

class DBController
{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "bug_tracking";
    public $connection;
    public function openConnect()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if ($this->connection->connect_error) {
            echo "error in connection : " . $this->connection->connect_error;
            return false;
        } else {
            return true;
        }
    }
    public function closeConnect()
    {
        if ($this->connection) {
            $this->connection->close();
        } else {
            echo "connection is not open";
        }
    }

    public function select($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "ERROR : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insert($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "ERROR : " . mysqli_error($this->connection);
            return false;
        } else {
            return $this->connection->insert_id;
        }
    }
    public function delete($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "ERROR : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result;
        }
    }
    public function update($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "ERROR : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result;
        }
    }
}

?>