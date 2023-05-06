<?php

class User
{

    private $userID;
    private $username;
    private $password;
    private $name;
    private $userType;

    // getting & setting function
    public function getUserID()
    {
        return $this->userID;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getUserType()
    {
        return $this->userType;
    }

    public function setUserID($id)
    {
        $this->userID = $id;
    }
    public function setUsername($user)
    {
        $this->username = $user;
    }
    public function setPassword($pass)
    {
        $this->password = $pass;
    }
    public function setName($nam)
    {
        $this->name = $nam;
    }
    public function setUserType($type)
    {
        $this->userType = $type;
    }



}

?>