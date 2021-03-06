<?php
 include "Crud.php";
 include "authenticator.php";
 include_once "DBConnector.php";

 class User implements Crud{
      private $user_id;
      private $first_name;
      private $last_name;
      private $city_name;
      private $username;
      private $password;

      function __construct($first_name,$last_name,$city_name,$username,$password){
          $this->first_name =$first_name;
          $this->last_name =$last_name;
          $this->city_name = $city_name;

          $this->username = $username;
          $this->password = $password;
      }

      //static constructor
      public static function create(){
          $instance = new self(" "," ", "", "", "");
          return $instance;
      }

      //username setter
      public function setUsername($username){
          $this->username=$username;
      }
      //username getter
      public function getUsername(){
          return $this->username;
      }

      public function setPassword($password){
          $this->password =$password;
      }

      public function getPassword(){
          return $this->password;
      }

          public function setUserId($user_id){
              $this->user_id=$user_id;
          }

          public function getUserId(){
              return $this->user_id;
          } 
          public function save(){
              $fn = $this->first_name;
              $ln = $this->last_name;
              $city = $this->city_name;
              $uname = $this->username;
              $this->hashPassword();
              $pass= $this->password;
              $conn= new DBConnector;

              $res = mysqli_query($conn->conn,"INSERT INTO user(first_name, last_name, user_city,username,password)VALUES('$fn','$ln','$city','$uname','$pass')") or die("Error " .mysqli_error($this));
              //$res = mysqli_query("INSERT INTO user(first_name, last_name, user_city) VALUES('Nonny', 'Kahuko', NAirobi')" or die("Error " .$this->conn));
              return $res;
          }

          public function readAll(){
              $conn = new DBConnector;
              $query = mysqli_query($conn->conn,"SELECT * FROM user") or die ("Error" .mysqli_error($this));
              return $query;
          }
          public function readUnique(){
              return null;
          }
          public function search(){
              return null;
          }
          public function update(){
              return null;
          }
          public function removeOne(){
              return null;
          }
          public function removeAll(){
              return null;
          }
          public function valiteForm(){
              //return true if the values are not empty
              $fn =$this->first_name;
              $ln =$this->last_name;
              $city=$this->city_name;
              if ($fn == "" || $ln =="" ||$city == ""){
                  return false;
              }
              return true;
          }  

          public function createFormErrorSessions()
          {
              session_start();
              $_SESSION['form_errors']="All fields are required";
          }   
          public function hashPassword(){
              $this->password =password_hash($this->password,PASSWORD_DEFAULT);
        }
public function isPasswordCorrect(){
    $con =new DBConnector;
    $found =false;
    $res =mysqli_query($con->conn,"SELECT * FROM user") or die("Error" .mysqli_error($this));

    while($row=mysqli_fetch_array($res)){
        if(password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row['username']){
            $found = true;
        }
    }
    $con->closeDatebase();
    return $found;
    //return true
}
public function login(){
    if($this->isPasswordCorrect()){
        header("Location:private_page.php");
    }
}
public function createUserSession(){
    session_start();
    $_SESSION['username'] = $this->getUsername();
}
public function logout(){
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header("Location;lab1.php");
}
}
?>

    

    

          