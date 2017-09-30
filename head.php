<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

$id_show_company=1;
echo "<head>";
	echo "<meta charset='UTF-8'>";
	echo "<title>";
		$result = mysqli_query($link, "SELECT name from cms_company where id_company=$id_show_company");
		while($row = mysqli_fetch_array($result)){
			echo $row['name'];
		}
	echo "</title>";
	echo "<link rel='icon' type='image/ico' href='./img/favicon.ico'/>";
	echo "<link href='./css/normalize.css' type='text/css' rel='stylesheet'>";
	echo "<link href='./css/main_desingn.css' type='text/css' rel='stylesheet'>";
//	echo "<link href='./bootstrap/css/bootstrap.min.css' media='screen' rel='stylesheet'>";
echo "</head>";
?>