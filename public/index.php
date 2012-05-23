<?php
	include_once('../bootstrap.php');
	include_once('../homework_display.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Beatport Homework Assignment</title>
	</head>
	<body style="font-family:Arial;background-image:url('img/back_gradient.png');background-repeat:repeat-x;background-color:#cccbcb;margin:0;padding:0">
		<div style="margin:auto;width:730px;">
			<div style="">
				<img src='img/beatport_logo.png' border='0'>
			</div>
			
			<div style="margin-top:10px;width:100%;background-color:#fff;padding:5px;">
				<div style="background-color:#000;color:#fff;font-size:20pt">
					Credentials in DB
				</div>
				<?php
					echo db_auth();
				?>
				
				<div style="background-color:#000;color:#fff;font-size:20pt">
					Credentials in File
				</div>
				<?php
					echo file_auth();
				?>
				
				<div style="background-color:#000;color:#fff;font-size:20pt">
					Autoloaded Directory contents
				</div>
				<?php
					echo directory_contents();
				?>
			</div>
		</div>
		<div style="margin-top:20px;width:100%;background-color:#000;min-height:50px;">
		</div>
	</body>