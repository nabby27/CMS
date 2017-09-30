<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/	

echo "<div class='cabecera'>";	
	echo "<div class='nombre_empresa'><h1>";
		$cond="SELECT nombre from cms_empresa where id_empresa=$id_empresa_a_mostrar";
		$result = mysqli_query($link, $cond);
		while($row = mysqli_fetch_array($result)){
			echo "<a href='main.php'>".$row['nombre']."</a>";
		}
	echo "</h1></div>";
	echo "<div class='logo_empresa'>";
 		$cond="SELECT logo from cms_empresa where id_empresa=$id_empresa_a_mostrar";
		$result = mysqli_query($link, $cond);
		while($row = mysqli_fetch_array($result)){
			echo "<img src='../img/".$row['logo']."'style='width: 100%; height: 100%'>";
		}
	echo "</div>";
	echo "<div class='sesion'>";
		if (isset($_SESSION['s_admin'])){
			echo "Bienvenido ".$_SESSION['s_admin']."<br><hr>";
			echo "<a href='delete.php'>Cerrar sesión</a>";
		}
	echo "</div>";
echo "</div>";
?>