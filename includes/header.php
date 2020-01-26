<?php

    $username = ($_SESSION[tyy_User][User_name]);
	if(isset($_POST[User_logged_out])){
		setcookie('old_user','',time() -3600, "/tyybeitshemesh");
		unset($_SESSION[tyy_User],$_SESSION[history]);
	}
	if(!$_SESSION[tyy_User]){
		header("Location:./");
	}

?>

<div id="top" class="d-print-none">

	<!--user disconetion-->
	<div id="logout">
		<form method="post">
			<button type="submit" name="User_logged_out" class="btn btn-secondary button" >
				<i class="fas fa-sign-out-alt" ></i> יציאה
			</button>
		</form>
	</div>

	<!--display user name-->
	<div id="user-name">
		<h4 class="h4"><?= $username ?></h4>
	</div>

	<!--menu-->
	<nav id="nav">

	</nav>
</div>
