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
			if(isset($_REQUEST['send'])){
				$id_link=$_REQUEST['id_link'];
				$name=$_REQUEST['name'];
				$link=$_REQUEST['link'];
				$id_article=$_REQUEST['id_article'];
				$article=$_REQUEST['article'];
				if($result=mysqli_query($link, "UPDATE cms_links set id_article=".$id_article.", name='".$name."', link='".$link."' where id_link=".$id_link."")){
					header( "Location: links.php?id_article=$article");
				}
			}
			elseif(isset($_REQUEST['id_link'])){
				$id_link=$_REQUEST['id_link'];
				$id_article=$_REQUEST['id_article'];
				echo "<div class='section_name'>".$row['name']."</div>";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='links.php?id_article=$id_article'>"$S_back"</a></li>";
						echo "<li><a href='add_links.php?id_article=$id_article'>"$S_add"</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='section_pictures_form'>";
					$result = mysqli_query($link, "SELECT * from cms_links where id_link=$id_link");
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='picture_form23'>";
							echo "<form action='links.php?id_article=$id_article' method='POST' enctype='multipart/form-data'>";
								echo $S_text_to_show":<br><br><input type='text' name='name' size='30' value='".$row['name']."'><br><br>";
								echo "link:<br><br><input type='text' size='60' name='link' value='".$row['link']."'><br><br>";
								echo "article:<br><br>";
								$result2=mysqli_query($link, "SELECT * from cms_article");
								echo "<select name='id_article'>";
									while($row2=mysqli_fetch_assoc($result2)){
										if ($row['id_article']==$row2['id_article']){
											echo "<option value='".$row2['id_article']."' selected>".$row2['name']."</option>";
										}
										else{
											echo "<option value='".$row2['id_article']."'>".$row2['name']."</option>";
										}
									}
								echo "</select><br><br>";
								echo "<input type='submit' name='send' value="$S_save_changes"><br><br>";
								echo "<div class='trash2'>";
									echo "<a width='0px' href='delete.php?id_link=".$row['id_link']."'>";
										echo "<div class='icon-basura'></div>";
									echo "</a>";
								echo "</div>";
								echo "<input type='hidden' name='id_link' value=".$row['id_link'].">";
								echo "<input type='hidden' name='article' value=".$id_article.">";
							echo "</form>";
						echo "</div>";
					}
				echo "</div>";
			}
			else{
				$id_article=$_REQUEST['id_article'];
				$result=mysqli_query($link, "SELECT name from cms_article where id_article=$id_article");
				$row=mysqli_fetch_assoc($result);
				echo "<div class='section_name'>".$row['name']."</div>";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='articles.php?id_article=$id_article'>"$S_back"</a></li>";
						echo "<li><a href='add_links.php?id_article=$id_article'>"$S_add"</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='section_pictures_form'>";
					$cond="SELECT * from cms_links where id_article=$id_article";
					$result = mysqli_query($link, $cond);
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='picture_form'>";
							echo "name a mostrar:<br><br><input type='text' name='name' size='30' value='".$row['name']."'><br><br>";
								echo "<div class='boton2'><a href='links.php?id_link=".$row['id_link']."&id_article=".$id_article."'>EDITAR</a></div>";
						echo "</div>";
					}
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