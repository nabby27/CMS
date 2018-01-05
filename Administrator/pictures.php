<?php
session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			if(isset($_REQUEST['send'])){
				$id_picture=$_REQUEST['id_picture'];
				$id_article=$_REQUEST['id_article'];
				$article=$_REQUEST['article'];
				$description=$_REQUEST['description'];
				if (is_uploaded_file($_FILES['picture']['tmp_name'])){
					$nameDirectory="../img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'];
					move_uploaded_file($_FILES['picture']['tmp_name'], $nameDirectory.$nameFile);
					$picture=$nameFile;
					$cond="UPDATE cms_picture set picture='".$picture."', description='".$description."', id_article=".$id_article." where id_picture=".$id_picture."";
				}
				else{
					$cond="UPDATE cms_picture set description='".$description."', id_article=".$id_article." where id_picture=".$id_picture."";
					/*$cond2="DELETE * FROM cms_picture where picture = $_FILES['picture']['name']";*/
				}
				if($result=mysqli_query($link, $cond)){
					/*if ($result2 = mysqli_query($link, $cond2)){*/
						header("Location:pictures.php?id_article=".$article."");
					/*}*/
				}
			}
			elseif(isset($_REQUEST['id_picture'])){
				$id_picture=$_REQUEST['id_picture'];
				$id_article=$_REQUEST['id_article'];
				echo "<div class='section_name'>".$row['name']."</div>";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='pictures.php?id_article=$id_article'>".$S_back."</a></li>";
						echo "<li><a href='add_pictures.php?id_article=$id_article'>".$S_add."</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='section_pictures_form'>";
					$result = mysqli_query($link, "SELECT * from cms_picture where id_picture=$id_picture");
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='picture_form_23'>";
							echo "<form action='pictures.php' method='POST' enctype='multipart/form-data'>";
								echo "<img src='../img/".$row['picture']."' style='width: 80%'><br><br>";
								echo "<input type='file' name='picture'><br><br>";
								echo "<textarea name='description' rows='2' cols='40'>".$row['description']."</textarea><br><br>";
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
								echo "<input type='submit' name='send' value=".$S_save_changes."><br>";
								echo "<div class='trash2'>";
									echo "<a width='0px' href='delete.php?id_picture=".$row['id_picture']."'>";
										echo '<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>';
									echo "</a>";
								echo "</div>";
								echo "<input type='hidden' name='id_picture' value=".$id_picture.">";
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
						echo "<li><a href='articles.php?id_article=$id_article'>".$S_back."</a></li>";
						echo "<li><a href='add_pictures.php?id_article=$id_article'>".$S_add."</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='section_pictures_form'>";
					$result = mysqli_query($link, "SELECT * from cms_picture where id_article=$id_article");
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='picture_form'>";
								echo "<img src='../img/".$row['picture']."' style='width: 80%'><br><br>";
								echo "<div class='boton2'><a href='pictures.php?id_picture=".$row['id_picture']."&id_article=".$id_article."'>".$S_edit."</a></div>";
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