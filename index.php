<!--default screen-->

<?php
	require 'includes/functions.php';
	require 'includes/db_connection.php';
	require 'includes/class.user.php';

if (isset($_GET['page_slug'])) {
    $page_slug = $_GET['page_slug'];
} else {
    $page_slug = 'login';
}
			
?>

<!DOCTYPE html>
<html lang="he">
	<head>
		<title>ת"ת סקווירא בית שמש</title>
		<!-- Required meta tags -->
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
		<meta name="description" 
		content="תלמוד תורה תולדות יעקב יוסף דחסידי סקווירא בית שמש - מערכת לניהול מערך הסעות התלמידים"/>
		<?php require 'includes/link.php';?>
		<!-- Required style sheets -->
		<link rel="stylesheet" href="../tyybeitshemesh/css/main.css">
		<link rel="stylesheet" href="css/login.css">
		<link rel="icon" href="image/logo.png">
	</head>
	<body dir="rtl">
		<?php
			 require $page_slug.'.php';
		  ?>	
	</body>
</html>