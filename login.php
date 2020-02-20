<!--login screen-->

<?php

$err = "";

// validate login form
if (isset($_POST['username'])) {
    $user = new UserLogin(trim($_POST['username']));
    $user->ProveNotConnectedUser($_POST['password'], $_POST['Stay_connected']);
    login();
    $err = $user->err;
}
  
?>

<div class="wrapper fadeInDown">
  <div id="formContent">

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="image/logo.png" id="icon" alt="לוגו ת&quot;ת סקווירא בית שמש" />
      <h1>כניסה</h1>
    </div>

    <!-- Login Form -->
    <?= $err?>
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
      <a class="underlineHover" href="?page_slug=includes/message">הירשם עכשיו</a>
    </div>

  </div>
</div>