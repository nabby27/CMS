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
			$id_article=$_REQUEST['id_article'];
			$result=mysqli_query($link, "SELECT name from cms_article where id_article=$id_article");
			$row=mysqli_fetch_assoc($result);
			echo "<div class='section_name'>".$row['name']."</div>";
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='pictures.php?id_article=$id_article'>"$S_back"</a></li>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['send'])){
				$id_article=$_REQUEST['id_article'];
				$id_picture=$_REQUEST['id_picture'];
				$description=$_REQUEST['description'];
				if (is_uploaded_file ($_FILES['picture']['tmp_name'])){
					$nameDirectory="../img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'];
					move_uploaded_file($_FILES['picture']['tmp_name'], $nameDirectory.$nameFile);
					$picture=$nameFile;
					if ($result=mysqli_query($link, "INSERT INTO cms_picture VALUES (".$id_picture.", '".$picture."', '".$description."', ".$id_article.")")){
						header( "Location: pictures.php?id_article=$id_article");
					}
					else{
						echo "<div class='login_form'>";
							echo $S_failure_to_insert_the_record"<br>";
							echo "<a href='add_pictures.php?id_article=$id_article'>"$S_back"</a>";
						echo "</div>";
					}
				}
			}
			else{
				$result_max=mysqli_query($link, "SELECT max(id_picture) as max from cms_picture");
				$row_max=mysqli_fetch_assoc($result_max);
				$max=$row_max['max'];
				$max+=1;
				echo "<div class='section_pictures_form'>";
					echo "<div class='picture_form23'>";
						echo "<form action='add_pictures.php' method='POST' enctype='multipart/form-data'>";
							echo "<input type='file' name='picture'><br><br>";
							echo "<textarea name='description' rows='2' cols='40'></textarea><br><br>";
							$cond="SELECT * from cms_article";
							$result=mysqli_query($link, $cond);
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
							echo "<input type='submit' name='send' value="$S_save_changes"><br>";
							echo "<input type='hidden' name='id_picture' value=".$max.">";
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