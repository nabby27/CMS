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
			if (isset($_REQUEST['id_category'])){
				$id_category=$_REQUEST['id_category'];
				$cond="DELETE FROM cms_picture where id_article in (SELECT id_article from cms_article where id_category=".$id_category.")";
				$cond2="DELETE FROM cms_links where id_article in (SELECT id_article from cms_article where id_category=".$id_category.")";
				$cond3="DELETE FROM cms_article where id_category=".$id_category."";
				$cond4="DELETE FROM cms_category where id_category=".$id_category."";

				if ($result = mysqli_query($link, $cond)){
					if ($result2 = mysqli_query($link, $cond2)){
						if ($result3 = mysqli_query($link, $cond3)){
							if ($result4 = mysqli_query($link, $cond4)){
								header("Location: categories.php");
							}
						}
					}
				}
				else{
					echo "<div class='login_form'>";
						echo $S_elimination_failed"<br>";
						echo "<a href='categories.php'>"$S_try_again"</a>";
					echo "</div>";
				}
			}
			elseif (isset($_REQUEST['id_article'])){
				$id_article=$_REQUEST['id_article'];
				$cond="DELETE FROM cms_picture where id_article=".$id_article."";
				$cond2="DELETE FROM cms_links where id_article=".$id_article."";
				$cond3="DELETE FROM cms_article where id_article=".$id_article."";
				if ($result = mysqli_query($link, $cond)){
					if ($result2 = mysqli_query($link, $cond2)){
						if ($result3 = mysqli_query($link, $cond3)){
							header("Location: articles.php");
						}
					}
				}
				else{
					echo "<div class='login_form'>";
						echo $S_elimination_failed"<br>";
						echo "<a href='articles.php'>"$S_try_again"</a>";
					echo "</div>";
				}
			}
			elseif (isset($_REQUEST['id_link'])){
				$id_link=$_REQUEST['id_link'];
				$cond="SELECT id_article from cms_links where id_link=$id_link";
				$result=mysqli_query($link, $cond);
				$row=mysqli_fetch_assoc($result);
				$cond2="DELETE FROM cms_links where id_link=".$id_link."";
				if ($result = mysqli_query($link, $cond2)){
					header("Location: links.php?id_article=".$row['id_article']);
				}
			}
			elseif (isset($_REQUEST['id_picture'])){
				$id_picture=$_REQUEST['id_picture'];
				$result=mysqli_query($link, "SELECT id_article from cms_picture where id_picture=$id_picture");
				$row=mysqli_fetch_assoc($result);
				if ($result = mysqli_query($link, "DELETE FROM cms_picture where id_picture=".$id_picture."")){
					header("Location: pictures.php?id_article=".$row['id_article']);
				}
			}
			elseif (isset($_REQUEST['id_user'])){
				$id_user=$_REQUEST['id_user'];
				echo $id_user;
				if ($result=mysqli_query($link, "DELETE from cms_users where id_user='".$id_user."'")){
					header("Location: users.php");
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