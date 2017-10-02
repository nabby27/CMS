<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/
include 'strings_es.php'; 
echo "<header>";
	$result = mysqli_query($link, "SELECT background_picture from cms_company where id_company=$id_show_company");
	while($row = mysqli_fetch_array($result)){
		echo "<img alt='full screen background image' src='./img/".$row['background_picture']."' id='full-screen-background-image' />";
	}
	echo "<div class='header'>";
		$result = mysqli_query($link, "SELECT header_picture from cms_company where id_company=$id_show_company");
		while($row = mysqli_fetch_array($result)){
			echo "<img src='./img/".$row['header_picture']."' style='width: 100%; height: 100%'>";
		}	
		echo "<div class='company_name'><h1>";
			$result = mysqli_query($link, "SELECT name from cms_company where id_company=$id_show_company");
			while($row = mysqli_fetch_array($result)){
				$i="i";
				echo "<a href ='main.php?home=".$i."'>".$row['name']."</a>";
			}
		echo "</h1></div>";
		
		echo "<div class='company_logo'>";
			$result = mysqli_query($link, "SELECT logo from cms_company where id_company=$id_show_company");
			while($row = mysqli_fetch_array($result)){
				echo "<img src='./img/".$row['logo']."'style='width: 100%; height: 100%'>";
			}
		echo "</div>";

		echo "<div class='session'>";
			if (isset($_SESSION['s_user'])){
				echo "Bienvenido ".$_SESSION['s_user']."<br><hr>";
				echo "<a href='exit.php'>"$S_sign_off"</a>";
			}
		echo "</div>";
	echo "</div>";
echo "</header>";
?>