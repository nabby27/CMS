<?php
echo '<header>';
	$cond = 'SELECT background_picture from cms_company where id_company = '.$id_show_company;
	$result = mysqli_query($link, $cond);
	if($row = mysqli_fetch_array($result)){
		echo "<img alt='full screen background image' src='../cms_img/".$row['background_picture']."' id='full_screen_background_image' />";
	}
	echo '<div class="header">';
		$cond = 'SELECT header_picture from cms_company where id_company = '.$id_show_company;
		$result = mysqli_query($link, $cond);
		if($row = mysqli_fetch_array($result)){
			echo "<img src='../cms_img/".$row['header_picture']."' style='width: 100%; height: 100%'>";
		}
		echo '<div class="company_name">';
			echo '<h1>';
				$cond = 'SELECT name from cms_company where id_company = '.$id_show_company;
				$result = mysqli_query($link, $cond);
				if($row = mysqli_fetch_assoc($result)){
					echo "<a href='main.php?home'>".$row['name']."</a>";
				}
			echo '</h1>';
		echo '</div>';
		echo '<div class="company_logo">';
			$cond = 'SELECT logo from cms_company where id_company = '.$id_show_company;
			$result = mysqli_query($link, $cond);
			if($row = mysqli_fetch_array($result)){
				echo "<img src='../cms_img/".$row['logo']."' style='width: 100%; height: 100%'>";
			}
		echo '</div>';
		echo '<div class="session">';
			if (isset($_SESSION['s_user'])){
				echo $S_welcome.' '.$_SESSION['s_user'].'<br><hr>';
				echo '<a href="exit.php">'.$S_sign_off.'</a>';
			}
		echo '</div>';
	echo '</div>';
echo '</header>';
?>
