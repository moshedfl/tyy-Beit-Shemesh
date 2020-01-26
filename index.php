<?php
	
	include 'includes/db_connection.php';
	include 'includes/functions.php';
	include 'includes/class.user.php';

	if(isset($_GET[page_slug])){
		$page_slug = $_GET['page_slug'];
	}else{
		$page_slug = 'login';
	}
			
?>

<!DOCTYPE html>
<html lang="he">
	<head>
		<title>ת"ת סקווירא בי"ש</title>
		<!-- Required meta tags -->
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include 'includes/link.php';?>
		<link rel="stylesheet" href="css/login.css">
		<link rel="icon" href="image/logo.png">
	</head>
	<body dir="rtl">
		<?php
			include ($page_slug.'.php');
		?>	
	</body>
</html>