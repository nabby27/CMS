<?php
$id_show_company=1;
include '../strings/strings_es.php';
include 'database_connection.php';
include 'functions.php';
echo "<head>";
	echo "<meta charset='UTF-8'>";
	echo "<link rel='icon' type='image/ico' href='../cms_img/favicon.ico'/>";
	echo "<link href='../css/normalize.css' type='text/css' rel='stylesheet'>";
	echo "<link href='../css/administrator_style.css' type='text/css' rel='stylesheet'>";
	echo "<title>";
		$result = mysqli_query($link, "SELECT name from cms_company where id_company=$id_show_company");
		while($row = mysqli_fetch_array($result)){
			echo $row['name'];
		}
	echo "</title>";
echo "</head>";
?>