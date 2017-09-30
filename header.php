<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

$cond="SELECT foto_fondo from cms_empresa where id_empresa=$id_empresa_a_mostrar";
$result = mysqli_query($link, $cond);
while($row = mysqli_fetch_array($result)){
	echo "<img alt='full screen background image' src='./img/".$row['foto_fondo']."' id='full-screen-background-image' />";
}
echo "<div class='cabecera'>";
	$cond="SELECT foto_cabecera from cms_empresa where id_empresa=$id_empresa_a_mostrar";
	$result = mysqli_query($link, $cond);
	while($row = mysqli_fetch_array($result)){
		echo "<img src='./img/".$row['foto_cabecera']."' style='width: 100%; height: 100%'>";
	}	
	echo "<div class='nombre_empresa'><h1>";
		$cond="SELECT nombre from cms_empresa where id_empresa=$id_empresa_a_mostrar";
		$result = mysqli_query($link, $cond);
		while($row = mysqli_fetch_array($result)){
			$i="i";
			echo "<a href ='main.php?inicio=".$i."'>".$row['nombre']."</a>";
		}
	echo "</h1></div>";
	
	echo "<div class='logo_empresa'>";
		$cond="SELECT logo from cms_empresa where id_empresa=$id_empresa_a_mostrar";
		$result = mysqli_query($link, $cond);
		while($row = mysqli_fetch_array($result)){
			echo "<img src='./img/".$row['logo']."'style='width: 100%; height: 100%'>";
		}
	echo "</div>";

	echo "<div class='sesion'>";
		if (isset($_SESSION['s_usuario'])){
			echo "Bienvenido ".$_SESSION['s_usuario']."<br><hr>";
			echo "<a href='exit.php'>Cerrar sesión</a>";
		}
	echo "</div>";
echo "</div>";
?>