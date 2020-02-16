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
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118834345-3"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-118834345-3');
		</script>

		<title>ת"ת סקווירא בית שמש</title>
		<!-- Required meta tags -->
        <meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
		<meta name="google-site-verification" content="wZP1DbJt2pkbOQPbzP18Q0LOjM42_jVsGhcYv05yId0" />
		<meta name="description" 
		content="ת&quot;ת סקווירא בית שמש, תלמוד תורה תולדות יעקב יוסף דחסידי סקווירא בית שמש - מערכת לניהול מערך הסעות התלמידים | דף כניסה | דף הרשמה"/>
		<meta name="url" content="http://www.phreizel.prog-sites.co.il/tyybeitshemesh/">
		<meta name="identifier-URL" content="http://www.phreizel.prog-sites.co.il/tyybeitshemesh/">
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