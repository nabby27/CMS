<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

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
				$id_subcategory=$row[$result];
		?>
				<nav>
					<ul>
						<li><a href='main.php?home'><?= $S_home ?></a></li>
						<?php echo '<li><a href='.'\'main.php?id_subcategory=$id_subcategory\'>'$S_back'</a></li>'?>
					</ul>
				</nav>
				<div class='tittle'>
					<?php
					$cond = "SELECT name from cms_article where id_article=$id_article";
					$result = mysqli_query($link, $cond);
					echo $row[$result];
					?>
				</div>
				<div class='general_picture'>
					<?php mostrar("cms_article", "id_article", "id_article", $id_article, "description"); ?>
					<div class='section_pictures'>
						<?php
						$cond = "SELECT id_picture, picture from cms_picture where id_article=$id_article";
						$result = mysqli_query($link, $cond);
						do{
							echo "<div class='picture'>";
								echo "<a href='detail.php?picture=".$row['id_picture']."'><img src='./img/".$row['picture']."' style='width: 100%'></a>";
							echo "</div>";
						}while($row = mysqli_fetch_assoc($result));
						?>
					</div>
				</div>
				<div class='section_links'>
					<?php	
					$cond = "SELECT link, name from cms_links where id_article=$id_article";
					$result = mysqli_query($link, $cond);
					echo "<hr>";
					do{
						echo "<div class='links'>";
							echo "<a target='_blank' href='".$row['link']."' >".$row['name']."</a>";
						echo "</div>";
						echo "<hr>";
					}while($row = mysqli_fetch_assoc($result));
					?>
				</div>
			}
			<?php
			elseif (isset($_REQUEST['picture'])){
				$id_picture=$_REQUEST['picture'];
				$cond = "SELECT id_article from cms_picture where id_picture=$id_picture";
				$result = mysqli_query($link, $cond);
			?>
				<nav>
					<ul>
						<li><a href='main.php?home'><?= $S_home ?></a></li>
						<?php
						do{
							echo "<li><a href='detail.php?id_article=".$row['id_article']."'>"$S_back"</a></li>";
						}while ($row=mysqli_fetch_assoc($result));
						?>
					</ul>
				</nav>
				<?php
				$cond = "SELECT description, picture from cms_picture where id_picture=$id_picture";
				$result = mysqli_query($link, $cond);
				echo "<div class='container_picture'>";
					do{
						echo "<div class='single_picture'>";
							echo "<img src='./img/".$row['picture']."' style='width: 100%'>";
						echo "</div>";
						echo "<div class='picture_description'>";
							echo $row['description'];
						echo "</div>";
					}while($row = mysqli_fetch_assoc($result))
				?>
				</div>
			}
		}
		<?php header("Location: index.php"); ?>
	</body>
	<?php include 'scripts.php'; ?>
</html>
