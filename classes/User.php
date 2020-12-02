<?php
require_once 'Database.php';
class User extends DataBase{
    private $FirstName,$LastName;
     public function __construct(){
         $name = $this->doQuery("Select FirstName,LastName from User Where UserName='".$_SESSION['Username']."'");
         $this->FirstName =$name[0][0];
         $this->LastName=$name[0][1];
     }
     public function getFirstName(){
         return $this->FirstName;
     }
     public function getLastName(){
         return $this->LastName;
     }
     public function getInfo($Username){
             return $this->doQuery("Select * from User where UserName='".$Username."'");
         }
      public function update($Id,$FirstName,$LastName,$Email,$Number,$NickName){
          $pdo=$this->connect();
    $stmt = $pdo->prepare("UPDATE User SET FirstName='$FirstName', LastName='$LastName', Email='$Email', MobilePhone='$Number',UserName='$NickName' WHERE Id=$Id");
    $stmt->execute();
      }

}
$user= new User();