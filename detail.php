<!DOCTYPE html>
<html lang='en'>
	<?php
	session_start();
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	?>
	<body>
		<?php
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_REQUEST['id_article']) && empty($_REQUEST['id_picture'])){
				$id_article=$_REQUEST['id_article'];
				$cond = "SELECT id_category FROM cms_article WHERE id_article=$id_article";
				$result = mysqli_query($link, $cond);
				if ($row = mysqli_fetch_assoc($result)){
					$id_subcategory = $row['id_category'];
				}
		?>
				<nav>
					<ul>
						<li><a href='main.php?home'><?= $S_home ?></a></li>
						<?= "<li><a href='main.php?id_subcategory=$id_subcategory'>$S_back</a></li>"; ?>
					</ul>
				</nav>
				<div class='tittle'>
					<?php
					$cond = "SELECT name from cms_article where id_article=$id_article";
					$result = mysqli_query($link, $cond);
					if ($row = mysqli_fetch_assoc($result)){
						echo $row['name'];
					}
					?>
				</div>
				<div class='general_picture'>
					<?php mostrar('cms_article', 'id_article', 'id_article', $id_article, 'description'); ?>
					<div class='picture_section'>
						<?php
						$cond = "SELECT id_picture, picture from cms_picture where id_article=$id_article";
						$result = mysqli_query($link, $cond);
						while ($row = mysqli_fetch_assoc($result)){
							echo "<div class='picture'>";
								echo "<a href='detail.php?picture=".$row['id_picture']."'><img src='./img/".$row['picture']."' style='width: 100%'></a>";
							echo '</div>';
						}
						?>
					</div>
				</div>
				<div class='link_section'>
					<?php	
					$cond = "SELECT link, name from cms_links where id_article=$id_article";
					$result = mysqli_query($link, $cond);
					echo '<hr>';
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='links'>";
							echo "<a target='_blank' href='".$row['link']."' >".$row['name']."</a>";
						echo '</div>';
						echo '<hr>';
					}
					?>
				</div>
			<?php
			}
			elseif (isset($_REQUEST['picture'])){
				$id_picture=$_REQUEST['picture'];
				$cond = "SELECT id_article from cms_picture where id_picture=$id_picture";
				$result = mysqli_query($link, $cond);
			?>
				<nav>
					<ul>
						<li><a href='main.php?home'><?= $S_home ?></a></li>
						<?php
						if ($row=mysqli_fetch_assoc($result)){
							echo "<li><a href='detail.php?id_article=".$row['id_article']."'>$S_back</a></li>";
						}
						?>
					</ul>
				</nav>
				<?php
				$cond = "SELECT description, picture from cms_picture where id_picture=$id_picture";
				$result = mysqli_query($link, $cond);
				echo "<div class='picture_container'>";
					if($row = mysqli_fetch_assoc($result)){
						echo "<div class='single_picture'>";
							echo "<img src='./img/".$row['picture']."' style='width: 100%'>";
						echo '</div>';
						echo "<div class='description_picture'>";
							echo $row['description'];
						echo '</div>';
					}
				?>
				</div>
			<?php }
		}else
			header('Location: index.php'); 
		include 'scripts.php';
		?>
	</body>
</html>