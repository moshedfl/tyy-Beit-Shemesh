<?php
    
  class User{

      public $UserId;
      public $UserName;
      public $UserTel;
      public $UserEmail;
      public $Password;
      public $UserRole;
      public $UserStatus;

      function __construct($username){
        $sql = new Database;
        $stmt = $sql->connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt-> bind_param("s",$username);
        $stmt-> execute();
        $result = $stmt-> get_result();
        $result_user = $result ->fetch_assoc();

        $this->UserId = $result_user["user_id"];
        $this->UserName = htmlspecialchars($result_user ["username"]);
        $this->UserTel = $result_user["user_tel"];
        $this->UserEmail = $result_user["user_email"];
        $this->Password = $result_user["user_password"];
        $this->UserRole = $result_user["user_role"];
        $this->UserStatus = $result_user["user_status"];
      }
  }

  class UserLogin extends User{

      public $UserOk = true;
      public $err; 

      public function ConnectedUser(){
        
        if(!$this->UserName){
          $this->UserOk = false;
        }
      }

      public function NotConnectedUser($password,$stay_connected){
        
        if(!password_verify($password, $this->Password)){
          $this->UserOk = false;
          $this->err = "<span class='err'>One of the data is incorrect</span>";
        
        }elseif($stay_connected){
          setcookie('old_user', $this->UserName, time() + (86400 * 30), $_SERVER['SERVER_NAME']."/tyybaitshemesh"); 
        }
      }

      public function SetUserSession(){
        $_SESSION[User][User_id]= $this->UserId;
        $_SESSION[User][User_name]= $this->UserName;
        $_SESSION[User][user_tel]= $this->UserTel;
        $_SESSION[User][User_email]= $this->UserEmail;
        $_SESSION[User][user_role]= $this->UserRole;
        $_SESSION[User][user_status]= $this->UserStatus;
      
        header("Refresh:0");
      }

  }
?>    