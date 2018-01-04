<?php
echo "<header>";
	echo "<div class='header'>";	
		echo "<div class='company_name'><h1>";
			$result = mysqli_query($link, "SELECT name from cms_company where id_company=$id_show_company");
			while($row = mysqli_fetch_array($result)){
				echo "<a href='main.php'>".$row['name']."</a>";
			}
		echo "</h1></div>";
		echo "<div class='logo_company'>";
			$result = mysqli_query($link, "SELECT logo from cms_company where id_company=$id_show_company");
			while($row = mysqli_fetch_array($result)){
				echo "<img src='../img/".$row['logo']."'style='width: 100%; height: 100%'>";
			}
		echo "</div>";
		echo "<div class='session'>";
			if (isset($_SESSION['s_admin'])){
				echo "Bienvenido ".$_SESSION['s_admin']."<br><hr>";
				echo "<a href='delete.php'>"$S_sign_off"</a>";
			}
		echo "</div>";
	echo "</div>";
echo "</header>";
?>