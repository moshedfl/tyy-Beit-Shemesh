<!--edit screen-->

<?php

require 'includes/db_connection.php';
require 'includes/functions.php';
require 'includes/class.user.php';

//Checks whether the user has edit permission
if($_SESSION['tyy_User']['user_permissions'] < 9) user_logout();

?>


<!DOCTYPE html>
<html lang="he">
	<head>
		<title>ת"ת סקווירא בי"ש</title>
		<!-- Required meta tags -->
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--cdn links for external libraries-->
		<?php require 'includes/link.php';?>
		<!-- Required style sheets -->
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/routes.css">
        <link rel="stylesheet" href="css/edit.css">
		<link rel="icon" href="image/logo.png">

	</head>
	<body dir="rtl">
		<?php
			 //include 'update_data/up_student_trans.php';
			 require 'includes/header.php';
			 require 'includes/edroute.php';
		  ?>

		<script src="js/main.js"></script>
	</body>
</html>