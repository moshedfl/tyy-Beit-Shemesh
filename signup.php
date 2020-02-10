<!--signup screen-->

<?php

  //Checks whether the user has signup permission
  if($_SESSION['tyy_User']['user_permissions'] < 10) user_logout();
  
  $new_user = true ;
  $err = ['receiving'=>"", 'username'=>"", 'email'=>"", 'tel'=>"", 'role'=>"", 'password'=>""];
  $permissions = 0;
  $username = "";
  $email = "";
  $tel = "";
  $password = "";
  $confirm_password = "";

// form Validation
// if form submit check if empty fields
if (isset($_POST['username'])) {

    //Insert form data into variables
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $tel = trim($_POST['tel']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Checks the length of the username
    if (strlen($username)<5) {
        $new_user = false ;
        $err['username'] = "<br><span class='err'>שם משתמש חייב להכיל לפחות 5 תווים</span>";
    } else {

        // Checks if the username already exists in the system
        $user = new user($username);
        if ($user->UserName) {
            $new_user = false ;
            $err['username'] = "<br><span class='err''>שם המשתמש כבר קיים במערכת</span>";
        }
    }

    //Checks email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email'] = "<br><span class='err'>נא הכנס כתובת מייל תקינה</span>";
        $new_user = false ;
    }

    //Set user permissions
    switch ($role) {
    case "מנהל מערכת":
          $permissions = 10;
        break;
    case "מזכיר" || "מנהל":
          $permissions = 9;
        break;
    default:
          $permissions = 8;
    }

    // Checks the length of the password
    if (strlen($password)<7) {
        $new_user = false ;
    }

    //Checks password confirmation
    if ($confirm_password != $password) {
        $err['password'] = "<br><span class='err'>אינו תואם את הסיסמה</span>";
        $new_user = false ;
    } 

    //Checks user status
    if ($_POST['user_status']) {
        $user_status = 1;
    } else {
        $user_status = 0;
    }
    
    //Insert form data into database
    if ($new_user==true) {

        $sql_new_user = $conn->prepare(
            "INSERT INTO users (username, user_tel, user_email, user_password, user_role, user_permissions, user_status )
            VALUES (?, ?, ?, ?, ?, ?,? )"
        );
        $sql_new_user->bind_param("sisssii", $username, $tel, $email, $hashed_password, $role, $permissions, $user_status);
        $sql_new_user->execute();
      
        if ($sql_new_user) {
            header("Location:index.php");
        } else {
            $err['receiving'] = "<br><span class='err''>Error receiving data Try again later</span>";
        }
    }
            
    $conn->close();
}            
  
  
?>

<div class="wrapper fadeInDown">
  <div id="formContent">

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="image/logo.png" id="icon" alt="User Icon" />
      <h1>הרשמה</h1>
    </div>

    <!-- Login Form -->
    <form method="post">
      <?= $err['receiving']?>
      <input type="text" id="username" class="fadeIn second " <?=$err['username'] ? 'style="background-color:#ffdddd"' : ""?> 
      name="username" placeholder="שם משתמש" value="<?= $username?>" minlength="5" required>
      <?= $err['username']?>
      
      <input type="email" id="email" class="fadeIn second" <?=$err['email'] ? 'style="background-color:#ffdddd"' : ""?> 
      name="email" placeholder="מייל" value="<?= $email?>" required>
      <?= $err['email']?>
      
      <input type="tel" id="tel" class="fadeIn second" <?=$err['tel'] ? 'style="background-color:#ffdddd"' : ""?> 
      name="tel" placeholder="טלפון" value="<?= $tel?>" minlength="9" required>
      
      <select id="role" class="fadeIn second" <?=$err['role'] ? 'style="background-color:#ffdddd"' : ""?> 
      name="role" value="<?= $role?>" required>
        <option value="">בחר תפקיד</option>
        <option value="מנהל">מנהל</option>
        <option value="מנהל מערכת">מנהל מערכת</option>
        <option value="מזכיר">מזכיר</option>
        <option value="נהג">נהג</option>
        <option value="מלוה">מלוה</option>
      </select>      
      
      <input type="password" id="password" class="fadeIn third" 
      name="password" placeholder="סיסמא" value="<?= $password?>" minlength="7" required>
      
      <input type="password" id="confirm_password" class="fadeIn third" <?=$err['password'] ? 'style="background-color:#ffdddd"' : ""?> 
      name="confirm_password" placeholder="אימות סיסמא" value="<?= $confirm_password?>" required>
      <?= $err['password']?>
      
      <input type="submit" class="fadeIn fourth" value="הירשם" style="margin-bottom:0">
      <div class="form-check-inline" style="margin:15px 15px 8px; float:right">
        <label class="form-check-label" for="user_status">פעיל
          <input type="checkbox" class="form-check-input" id="user_status" name="user_status" checked>
        </label>
      </div>
    </form>

    <!-- log in -->
    <div id="formFooter" style="clear:right">
      <a class="underlineHover" href="?page_slug=login">חזור לדף כניסה</a>
    </div>

  </div>
</div>