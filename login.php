<?php
  // header('X-XSS-Protection:0');
  
  //Checks connected user
  if($_COOKIE[old_user]){
    $user = new UserLogin($_COOKIE[old_user]);
    $user->ConnectedUser();
  
  //Checks not connected user
  }elseif($_POST[username]){
    $user = new UserLogin(trim($_POST[username]));
    $user->NotConnectedUser($_POST[password],$_POST[Stay_connected]);
  }
    
  if($user->UserOk){
    $user->SetUserSession();
    header("Location:home.php");
  }
  
echo '<pre>';
//print_r($user) ;
//print_r($_SESSION[User]) ;
echo '</pre>';
?>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="image/logo.png" id="icon" alt="School logo" />
      <h1>כניסה</h1>
    </div>

    <!-- Login Form -->
    <?= $user->err?>
    <form method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="שם משתמש" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="סיסמא" required>
      <input type="submit" class="fadeIn fourth" value="היכנס לאתר" style="margin-bottom:0">
      <div class="form-check-inline" style="margin:15px 15px 8px; float:right">
        <label class="form-check-label" for="Stay_connected">הישאר מחובר
          <input type="checkbox" class="form-check-input" id="Stay_connected" name="Stay_connected" checked>
        </label>
      </div>
    </form>

    <!-- sign up -->
    <div id="formFooter" style="clear:right">
      <a class="underlineHover" href="?page_slug=signup">הירשם עכשיו</a>
    </div>

  </div>
</div>