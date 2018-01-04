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
			if (isset($_REQUEST['send'])){
				$description=$_REQUEST['description'];
				$name=$_REQUEST['name'];
				$id_category=$_REQUEST['id_category'];
				$id_article=$_REQUEST['id_article'];
				if (is_uploaded_file($_FILES['picture']['tmp_name'])){
					$nameDirectory="../img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'];
					move_uploaded_file($_FILES['picture']['tmp_name'], $nameDirectory.$nameFile);
					$picture=$nameFile;
					$cond="UPDATE cms_article set name='".$name."', description='".$description."', id_category='".$id_category."', picture='".$picture."' where id_article=".$id_article."";
				}
				else{
					$cond="UPDATE cms_article set name='".$name."', description='".$description."', id_category='".$id_category."' where id_article=".$id_article."";
				}
				if ($result = mysqli_query($link, $cond)){
					echo "<div class='login_form'>";
						echo $S_successful_update"<br>";
						echo "<a href='articles.php'>"$S_back"</a>";
					echo "</div>";
				}
				else{
					echo "<div class='login_form'>";
						echo $S_update_failed"<br>";
						echo "<a href='articles.php?namea=a'>"$S_back"</a>";
					echo "</div>";
				}
			}				
			else{
				if (isset($_REQUEST['id_article'])){
					$id_article=$_REQUEST['id_article'];
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='main.php'>"$S_home"</a></li>";
							echo "<li><a href='pictures.php?id_article=$id_article'>"$S_pictures"</a></li>";
							echo "<li><a href='articles.php'>"$S_back"</a></li>";
							echo "<li><a href='links.php?id_article=$id_article'>"$S_links"</a></li>";

						echo "</ul>";
					echo "</nav>";
					article_form('cms_article', 'id_article', $id_article);
				}
				elseif(isset($_REQUEST['namea'])){
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='main.php'>"$S_home"</a></li>";
						echo "</ul>";
					echo "</nav>";
					$result_max=mysqli_query($link, "SELECT max(id_article) as max from cms_article");
					$row_max=mysqli_fetch_assoc($result_max);
					$max=$row_max['max'];
					$max++;
					$category="";
					$result_category= mysqli_query($link, "SELECT * from cms_category");
					$add="add";
					echo "<form action='add.php?namea=".$add."' method='POST' class='formulario_articles' id='form_art' enctype='multipart/form-data'>"; 
						echo $S_name": <br><br><input type='text' name='name'><br><br>";
						echo $S_description": <br><br><textarea name='description' form='form_art' rows='15' cols='50'></textarea><br><br>";
						echo $S_main_image":<br><br><input type='file' name='picture'><br><br>";
						echo $S_category": <br><br>";
						echo "<select name='id_category'><br><br>";
							while ($row_category=mysqli_fetch_assoc($result_category)) {
								$result_p=mysqli_query($link, "SELECT name from cms_category where id_category in (select id_category_padre from cms_category where id_category=".$row_category['id_category'].")");
								$row_p=mysqli_fetch_assoc($result_p);
								if ($row_category['id_category']==0){
									echo "<option value='".$row_category['id_category']."' selected>".$row_p['name']."&nbsp".$row_category['name']."</option>";
								}
								else{
									echo "<option value='".$row_category['id_category']."'>".$row_p['name']."&nbsp".$row_category['name']."</option>";
								}
							}
						echo "</select><br><br>";
						echo "<input type='submit' name='send' value="$S_save_changes"><br>";
						echo "<input type='hidden' name='id_article' value=".$max.">";
					echo "</form>";			
				}
				else{
					$cond="SELECT * from cms_article order by name";
					$result=mysqli_query($link, $cond);
					$a="";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='main.php'>"$S_home"</a></li>";
							echo "<li><a href='articles.php?namea=".$a."'>"$S_add"</a></li>";
						echo "</ul>";
					echo "</nav>";
					while ($row=mysqli_fetch_assoc($result)){
						echo "<a href='articles.php?id_article=".$row['id_article']."'><div class='subcategories' class='boton'>";
							echo $row['name'];
						echo "</div></a>";
						echo "<div class='trash'>";
							echo "<a width='0px' href='delete.php?id_article=".$row['id_article']."'>";
								echo "<div class='icon-basura'></div>";
							echo "</a>";
						echo "</div>";
						echo "<div class='pencil'>";
							echo "<a width='0px' href='articles.php?id_article=".$row['id_article']."'>";
								echo "<div class='icon-pencil2'></div>";
							echo "</a>";
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