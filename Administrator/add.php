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
		if (isset($_SESSION['s_admin'])){
			if (isset($_REQUEST['namec'])){
				$id_category_father=$_REQUEST['id_category_father'];
				$name=$_REQUEST['name'];
				$id_category=$_REQUEST['id_category'];
				if ($result=mysqli_query($link, "INSERT INTO cms_category VALUES (".$id_category_father.", ".$id_category.", '".$name."', ".$id_empresa_a_mostrar.")")){
					echo "<div class='login_form'>";
						echo "Registro insertado correctamente<br>";
						echo "<a href='categories.php'>ATRAS</a>";
					echo "</div>";
				}
				else{
					echo "<div class='login_form'>";
						echo "Fallo al insertar el registro<br>";
						echo "<a href='categories.php?namea=a'>ATRAS</a>";
					echo "</div>";
				}
			}
			elseif (isset($_REQUEST['namea'])){
				$id_article=$_REQUEST['id_article'];
				$name=$_REQUEST['name'];
				$description=$_REQUEST['description'];
				$id_category=$_REQUEST['id_category'];
				if (is_uploaded_file ($_FILES['picture']['tmp_name'])){
					$nameDirectory="./img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'];
					move_uploaded_file($_FILES['picture']['tmp_name'], ".".$nameDirectory.$nameFile);
					$picture=$nameFile;
					if ($result=mysqli_query($link, "INSERT INTO cms_article VALUES (".$id_article.", '".$name."', '".$description."', '".$picture."', ".$id_category.")")){
						echo "<div class='login_form'>";
							echo "Registro insertado correctamente<br>";
							echo "<a href='articles.php'>ATRAS</a>";
						echo "</div>";
					}
					else{
						echo "<div class='login_form'>";
							echo "Fallo al insertar el registro<br>";
							echo "<a href='articles.php?namea=a'>ATRAS</a>";
						echo "</div>";
					}
				}
			}
		}
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>