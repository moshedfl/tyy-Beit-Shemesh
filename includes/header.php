<?php

	$username = ($_SESSION['tyy_User']['User_name']);
	//disconnect the user at the click of the button 'יציאה' or if session user not exists	
	if(isset($_POST['User_logged_out']) || !$_SESSION['tyy_User']) user_logout();
	
?>

<!--header-->
<div id="top" class="d-print-none">

    <!--user disconnection button-->
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

	<!--signup page button-->
	<?php
	   if ($_SESSION['tyy_User']['user_permissions'] == 10) {
        ?>
	<div id="signUp">
		<a href="index.php?page_slug=signup">
			<button type="button" class="btn btn-secondary button" >הרשמה</button>
		</a>
	</div>
        <?php
    }
    ?>
	
	<!--menu-->
	<nav id="nav">

	</nav>

	<div id="spinner-wrapper">
		<img src="image/Loading.gif" id="spinner" alt="spinner" style="width:100%"/>
	</div>
</div>
