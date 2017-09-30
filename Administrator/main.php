<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='categories.php'>CATEGORIAS</a></li>";
					echo "<li><a href='company.php'>EMPRESA</a></li>";
					echo "<li><a href='articles.php'>ARTICULOS</a></li>";
					echo "<li><a href='users.php'>USUARIOS</a></li>";
				echo "</ul>";
			echo "</nav>";
		}
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>