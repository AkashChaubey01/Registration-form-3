<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f0f0f0;
		}
		.welcome-message {
			color: #00698f;
			font-size: 24px;
			font-weight: bold;
			margin-bottom: 20px;
			text-align: center;
            display: flex;
            justify-content: center;
		}
	</style>
</head>
<body>
	<h1 class="welcome-message">Welcome: <?php echo $_SESSION['username']; ?></h1>
</body>
</html>