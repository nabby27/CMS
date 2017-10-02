<?php 
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'strings_es.php'; 
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_REQUEST['id_article']) && empty($_REQUEST['id_picture'])){
				$id_article=$_REQUEST['id_article'];
				$id_subcategory="";
				$result = mysqli_query($link, "SELECT id_category FROM cms_article WHERE id_article=$id_article");
				while($row = mysqli_fetch_assoc($result)){
					$id_subcategory=$row['id_category'];
				}
				$i="i";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='main.php?home=".$i."'>"$S_home"</a></li>";
						echo "<li><a href='main.php?id_subcategory=$id_subcategory'>"$S_back"</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='tittle'>";
					$result = mysqli_query($link, "SELECT name from cms_article where id_article=$id_article");
					while($row = mysqli_fetch_assoc($result)){
						echo $row['name'];
					}
				echo "</div>";
				echo "<div class='general_picture'>";
					mostrar("cms_article", "id_article", "id_article", $id_article, "description");
					echo "<div class='section_pictures'>";
						$result = mysqli_query($link, "SELECT * from cms_picture where id_article=$id_article");
						while($row = mysqli_fetch_assoc($result)){
							echo "<div class='picture'>";
								echo "<a href='detail.php?picture=".$row['id_picture']."'><img src='./img/".$row['picture']."' style='width: 100%'></a>";
							echo "</div>";
						}
					echo "</div>";
				echo "</div>";
				echo "<div class='section_links'>";	
					$result = mysqli_query($link, "SELECT * from cms_links where id_article=$id_article");
					echo "<hr>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='links'>";
							echo "<a target='_blank' href='".$row['link']."' >".$row['name']."</a>";
						echo "</div>";
						echo "<hr>";
					}
				echo "</div>";
			}
			elseif (isset($_REQUEST['picture'])){
				$id_picture=$_REQUEST['picture'];
				$result = mysqli_query($link, "SELECT id_article from cms_picture where id_picture=$id_picture");
				$i="i";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='main.php?home=".$i."'>"$S_home"</a></li>";
						while ($row=mysqli_fetch_assoc($result)){
							echo "<li><a href='detail.php?id_article=".$row['id_article']."'>"$S_back"</a></li>";
						}
					echo "</ul>";
				echo "</nav>";
				$result = mysqli_query($link, "SELECT description, picture from cms_picture where id_picture=$id_picture");
				echo "<div class='container_picture'>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='single_picture'>";
							echo "<img src='./img/".$row['picture']."' style='width: 100%'>";
						echo "</div>";
						echo "<div class='picture_description'>";
							echo $row['description'];
						echo "</div>";
					}
				echo "</div>";
			}
		}
		header("Location: index.php");
	echo "</body>";
	include 'scripts.php';
echo "</html>";
?>