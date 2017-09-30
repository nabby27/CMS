<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/	

$id_empresa_a_mostrar=1;
echo "<head>";
	echo "<meta charset='UTF-8'>";
	echo "<title>";
		$cond="SELECT nombre from cms_empresa where id_empresa=$id_empresa_a_mostrar";
		$result = mysqli_query($link, $cond);
		while($row = mysqli_fetch_array($result)){
			echo $row['nombre'];
		}
	echo "</title>";
	echo "<link rel='icon' type='image/ico' href='../img/favicon.ico'/>";
	echo "<link href='./css/normalize.css' type='text/css' rel='stylesheet'>";
	echo "<link href='./css/main_desingn.css' type='text/css' rel='stylesheet'>";
echo "</head>";
?>