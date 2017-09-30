<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_REQUEST['home'])){
				unset($_SESSION['s_id_category']);
				unset($_SESSION['s_id_subcategory']);
			}
			if (isset($_REQUEST['id_category'])){
				$id_category=$_REQUEST['id_category'];
				unset($_SESSION['s_id_subcategory']);
				$_SESSION['s_id_category']=$id_category;
			}
			if (isset($_REQUEST['id_subcategoria'])){
				$id_subcategoria=$_REQUEST['id_subcategoria'];
				$_SESSION['s_id_subcategory']=$id_subcategoria;
			}
			echo "<nav>";
				echo "<ul>";
					mostrar("cms_category", "id_category", "id_category_father", 0, "name");
				echo "</ul>";
			echo "</nav>";
			if (isset($_SESSION['s_id_category'])){	
				echo "<div class='section_subcategories'>";
					mostrar("cms_category", "id_category", "id_category_father", $_SESSION['s_id_category'], "name");
				echo "</div>";
				mostrar("cms_article", "id_article", "id_category", $_SESSION['s_id_category'], "name");
			}
			if (isset($_SESSION['s_id_subcategory'])){
				echo "<div class='section_subcategories'>";
					mostrar("cms_category", "id_category", "id_category_father", $_SESSION['s_id_subcategory'], "name");
				echo "</div>";
				echo "<div class='general_foto'>";
					mostrar("cms_article", "id_article", "id_category", $_SESSION['s_id_subcategory'], "name");
				echo "</div>";
			}
		}
		else{
			echo "<div class='login_form'>";
				echo "Usuario incorrecto <br>";
				echo "<a href='index.php'>volver a intentarlo</a>";
			echo "</div>";
		}
	include 'scripts.php';
	echo "</body>";
echo "</html>";
?>