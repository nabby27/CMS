<?php
session_start();
echo '<!DOCTYPE html>';
echo '<html lang="en">';
	include 'head.php';
	echo '<body>';
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_REQUEST['id_article']) && empty($_REQUEST['id_picture'])){
				$id_article = $_REQUEST['id_article'];
				$cond = 'SELECT id_category FROM cms_article WHERE id_article = '.$id_article;
				$result = mysqli_query($link, $cond);
				if ($row = mysqli_fetch_assoc($result)){
					$id_subcategory = $row['id_category'];
				}
				echo '<nav>';
					echo '<ul>';
						echo "<li><a href='main.php?home'>$S_home</a></li>";
						echo "<li><a href='main.php?id_subcategory=$id_subcategory'>$S_back</a></li>"; 
					echo '</ul>';
				echo '</nav>';
				echo '<div class="tittle">';
					$cond = 'SELECT name from cms_article where id_article = '.$id_article;
					$result = mysqli_query($link, $cond);
					if ($row = mysqli_fetch_assoc($result)){
						echo $row['name'];
					}
				echo '</div>';
				echo '<div class="general_picture">';
					mostrar('cms_article', 'id_article', 'id_article', $id_article, 'description'); 
					echo '<div class="picture_section">';
						$cond = 'SELECT id_picture, picture from cms_picture where id_article = '.$id_article;
						$result = mysqli_query($link, $cond);
						while ($row = mysqli_fetch_assoc($result)){
							echo "<div class='picture'>";
								echo "<a href='detail.php?picture=".$row['id_picture']."'><img src='../img/".$row['picture']."' style='width: 100%'></a>";
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
				echo '<div class="link_section">';
					$cond = 'SELECT link, name from cms_links where id_article = '.$id_article;
					$result = mysqli_query($link, $cond);
					echo '<hr>';
					while($row = mysqli_fetch_assoc($result)){
						echo '<div class="links">';
							echo "<a target='_blank' href='".$row['link']."' >".$row['name']."</a>";
						echo '</div>';
						echo '<hr>';
					}
				echo '</div>';
			}
			elseif (isset($_REQUEST['picture'])){
				$id_picture=$_REQUEST['picture'];
				$cond = 'SELECT id_article from cms_picture where id_picture = '.$id_picture;
				$result = mysqli_query($link, $cond);
				echo '<nav>';
					echo '<ul>';
						echo "<li><a href='main.php?home'>$S_home</a></li>";
						if ($row=mysqli_fetch_assoc($result)){
							echo "<li><a href='detail.php?id_article=".$row['id_article']."'>$S_back</a></li>";
						}
					echo "</ul>";
				echo "</nav>";
				$cond = 'SELECT description, picture from cms_picture where id_picture = '.$id_picture;
				$result = mysqli_query($link, $cond);
				echo '<div class="picture_container">';
					if($row = mysqli_fetch_assoc($result)){
						echo '<div class="single_picture">';
							echo "<img src='../img/".$row['picture']."' style='width: 100%'>";
						echo '</div>';
						echo '<div class="description_picture">';
							echo $row['description'];
						echo '</div>';
					}
				echo '</div>';
			}
		}else
			header('Location: ./index.php'); 
		include 'scripts.php';
	echo '</body>';
echo '</html>';
?>
