<!--home page screen-->

<?php
	require 'includes/db_connection.php';
	require 'includes/functions.php';
	require 'includes/class.user.php';
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
		<link rel="stylesheet" href="../tyybeitshemesh/css/login.css">
		<link rel="stylesheet" href="../tyybeitshemesh/css/main.css">
		<link rel="stylesheet" href="../tyybeitshemesh/css/routes.css">
		<link rel="stylesheet" media="print" href="../tyybeitshemesh/css/print.css">
		<link rel="icon" href="image/logo.png">
		<script src="js/jquery.js"></script>
	</head>
	<body dir="rtl">

		<?php
			 require 'includes/header.php';
			 require 'routes.php';
		  ?>

		<script src="js/main.js"></script>
		<script src="js/routes.js"></script>

	</body>
</html>