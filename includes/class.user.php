<!-- class to prove and manage user data -->

<?php
    
class User
{

      public $UserId;
      public $UserName;
      public $UserTel;
      public $UserEmail;
      public $Password;
      public $UserRole;
      public $Permissions;
      public $UserStatus;
    /**
     * Get user name from cookie or login form and request all data
     * 
     * @param $username string
     *  */
    function __construct($username)
    {
        //import database connection
        $sql = new Database;
        
        //import all data of current user from database
        $stmt = $sql->connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt-> bind_param("s", $username);
        $stmt-> execute();
        $result = $stmt-> get_result();
        $result_user = $result ->fetch_assoc();

        $this->UserId = $result_user["user_id"];
        $this->UserName = htmlspecialchars($result_user ["username"]);
        $this->UserTel = $result_user["user_tel"];
        $this->UserEmail = $result_user["user_email"];
        $this->Password = $result_user["user_password"];
        $this->UserRole = $result_user["user_role"];
        $this->Permissions = $result_user["user_permissions"];
        $this->UserStatus = $result_user["user_status"];
    }
}

class UserLogin extends User
{

      public $UserOk = true;
      public $err; 

    /**
     * Verifying userName from cookie for connected users
     * 
     * @return any
     */
    public function proveConnectedUser()
    {
        if (!$this->UserName) { // if not exists in the system
            $this->UserOk = false; // blocked login
            setcookie('old_user', '', time() -3600, "/tyybeitshemesh"); //deletes not relevant cookie
        }
    }

    /**
     * Verifying data from login form for not connected users
     * 
     * @param $password       password from login form
     * @param $stay_connected if stay connected checked
     * 
     * @return any
     *  */ 
    public function proveNotConnectedUser($password, $stay_connected)
    {
        // Verifying password from the form against what exists in the system under this username
        if (!password_verify($password, $this->Password)) { //if Unmatched
            $this->UserOk = false;
            $this->err = "<span class='err'>One of the data is incorrect</span>"; //display error
        
            // if checkbox 'stay connected' checked
        } elseif ($stay_connected) {
            // create cookie with user name for straight entrance next time
            setcookie('old_user', $this->UserName, time() + (86400 * 30 * 12), $_SERVER['SERVER_NAME']."/tyybeitshemesh"); 
        }
    }

    /**
     * Create session with all user data
     * 
     * @return arry
     */
    public function setUserSession()
    {
        $_SESSION['tyy_User']['User_id']= $this->UserId;
        $_SESSION['tyy_User']['User_name']= $this->UserName;
        $_SESSION['tyy_User']['user_tel']= $this->UserTel;
        $_SESSION['tyy_User']['User_email']= $this->UserEmail;
        $_SESSION['tyy_User']['user_role']= $this->UserRole;
        $_SESSION['tyy_User']['user_permissions']= $this->Permissions;
        $_SESSION['tyy_User']['user_status']= $this->UserStatus;
      
    }

}
?>    