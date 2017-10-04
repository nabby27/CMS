<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

<?php 
include 'database_connection.php';
include 'head.php';
?>

<header>
	<?php
	$cond = "SELECT background_picture from cms_company where id_company=$id_show_company";
	$result = mysqli_query($link, $cond);
	if($row = mysqli_fetch_array($result)){
		echo "<img alt='full screen background image' src='./img/".$row['background_picture']."' id='full_screen_background_image' />";
	}
	?>
	<div class='header'>
		<?php
		$cond = "SELECT header_picture from cms_company where id_company=$id_show_company";
		$result = mysqli_query($link, $cond);
		if($row = mysqli_fetch_array($result)){
			echo "<img src='./img/".$row['header_picture']."' style='width: 100%; height: 100%'>";
		}
		?>	
		<div class='company_name'><h1>
			<?php
			$cond = "SELECT name from cms_company where id_company=$id_show_company";
			$result = mysqli_query($link, $cond);
			if($row = mysqli_fetch_assoc($result)){
				echo "<a href='main.php?home'>".$row['name']."</a>";
			}
			?>
		</h1></div>
		<div class='company_logo'>
			<?php
			$cond = "SELECT logo from cms_company where id_company=$id_show_company";
			$result = mysqli_query($link, $cond);
			if($row = mysqli_fetch_array($result)){
				echo "<img src='./img/".$row['logo']."' style='width: 100%; height: 100%'>";
			}
			?>
		</div>
		<div class='session'>
			<?php
			if (isset($_SESSION['s_user'])){
				echo "Bienvenido ".$_SESSION['s_user']."<br><hr>";
				echo "<a href='exit.php'>$S_sign_off</a>";
			}
			?>
		</div>
	</div>
</header>