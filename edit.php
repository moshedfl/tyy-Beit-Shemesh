<!--edit screen-->

<?php

require 'includes/functions.php';

//Checks whether the user has edit permission
if($_SESSION['tyy_User']['user_permissions'] < 9) user_logout();

?>


<!DOCTYPE html>
<html lang="he">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118834345-3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-118834345-3');
		</script>
		<title>ת"ת סקווירא בי"ש</title>
		<!-- Required meta tags -->
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex,follow" />
		<meta name="description" 
		content="ת&quot;ת סקווירא בית שמש, תלמוד תורה תולדות יעקב יוסף דחסידי סקווירא בית שמש - מערכת לניהול מערך הסעות התלמידים | דף עריכה"/>
		<meta name="url" content="http://www.phreizel.prog-sites.co.il/tyybeitshemesh/">
		<meta name="identifier-URL" content="http://www.phreizel.prog-sites.co.il/tyybeitshemesh/">
		<?php require 'includes/link.php';?>
		<!-- Required style sheets -->
		<link rel="stylesheet" href="css/login.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/routes.css">
		<link rel="stylesheet" href="plugins/dragula/dragula.css">
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