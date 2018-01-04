<?php
session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='categories.php'>"$S_categories"</a></li>";
					echo "<li><a href='company.php'>"$S_company"</a></li>";
					echo "<li><a href='articles.php'>"$S_articles"</a></li>";
					echo "<li><a href='users.php'>"$S_users"</a></li>";
				echo "</ul>";
			echo "</nav>";
		}
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>