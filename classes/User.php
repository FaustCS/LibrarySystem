<?php
require_once 'Database.php';

class User extends DataBase
{
    protected $FirstName, $LastName,$Username;

    public function __construct()
    {
        $name = $this->doQuery("Select FirstName,LastName from User Where UserName='" . $_SESSION['Username'] . "'");
        $this->FirstName = $name[0][0];
        $this->LastName = $name[0][1];
        $this->Username=$_SESSION['Username'];
    }

    public function getFirstName()
    {
        return $this->FirstName;
    }

    public function getLastName()
    {
        return $this->LastName;
    }

    public function getInfo()
    {
        return $this->doQuery("Select * from User where UserName='" .$this->Username . "'");
    }


    public function update($Id, $FirstName, $LastName, $Email, $Number, $NickName)
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE User SET FirstName='$FirstName', LastName='$LastName', Email='$Email', MobilePhone='$Number',UserName='$NickName' WHERE Id=$Id");
        $stmt->execute();
    }
}

class EditUser extends User{

    public function setEmail($Email){
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE User SET Email='$Email' WHERE UserName='".$this->Username."'");
        $stmt->execute();
    }

    public function changePassword($newPassword){
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE User SET Password='$newPassword' WHERE UserName='$this->Username'");
        $stmt->execute();
    }
    public function getPassword(){

        $password= $this->doQuery("Select Password from User where UserName='" .$this->Username . "'");
        return $password[0][0];
    }
}
$editUser = new EditUser();
$user = new User();