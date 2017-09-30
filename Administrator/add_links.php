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
			$id_article=$_REQUEST['id_article'];
			$result=mysqli_query($link, "SELECT name from cms_article where id_article=$id_article");
			$row=mysqli_fetch_assoc($result);
			echo "<div class='name_section'>".$row['name']."</div>";
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='links.php?id_article=$id_article'>ATRAS</a></li>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['send'])){
				$id_article=$_REQUEST['id_article'];
				$id_link=$_REQUEST['id_link'];
				$name=$_REQUEST['name'];
				$link=$_REQUEST['link'];
				if ($result=mysqli_query($link, "INSERT INTO cms_links VALUES (".$id_link.", '".$name."', '".$link."', ".$id_article.")")){
					header( "Location: links.php?id_article=$id_article");
				}
				else{
					echo "<div class='login_form'>";
						echo "Fallo al insertar el registro<br>";
						echo "<a href='add_links.php?id_article=$id_article'>VOLVER A INTENTARLO</a>";
					echo "</div>";
				}
			}
			else{
				$result_max=mysqli_query($link, "SELECT max(id_link) as max from cms_links");
				$row_max=mysqli_fetch_assoc($result_max);
				$max=$row_max['max'];
				$max+=1;
				echo "<div class='section_pictures_form'>";
					echo "<div class='picture_form23'>";
						echo "<form action='add_links.php?id_article=$id_article' method='POST' enctype='multipart/form-data'>";
							echo "Nombre a mostrar:<br><br><input type='text' name='name' size='30'><br><br>";
							echo "Enlace:<br><br><input type='text' size='60' name='link'><br><br>";
							$result=mysqli_query($link, "SELECT * from cms_article");
							echo "<select name='id_article'>";
								while($row=mysqli_fetch_assoc($result)){
									if ($id_article==$row['id_article']){
										echo "<option value='".$row['id_article']."' selected>".$row['name']."</option>";
									}
									else{
										echo "<option value='".$row['id_article']."'>".$row['name']."</option>";
									}
								}
							echo "</select><br><br>";
							echo "<input type='submit' name='send' value='Guardar cambios'><br>";
							echo "<input type='hidden' name='id_link' value=".$max.">";
							echo "<input type='hidden' name='article' value=".$id_article.">";
						echo "</form>";
					echo "</div>";
				echo "</div>";
			}
		}
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>