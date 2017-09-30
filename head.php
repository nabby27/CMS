<?php
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/	

/*--Inicializamos variables globales-----------------------------------------------------------------------*/
		$id_empresa_a_mostrar=1;
/*--META, TITLE, LINKS--------------------------------------------------------------------*/
		echo "<head>";
			echo "<meta charset='UTF-8'>";
			echo "<title>";
				$cond="SELECT nombre from cms_empresa where id_empresa=$id_empresa_a_mostrar";
				$result = mysqli_query($link, $cond);
				while($row = mysqli_fetch_array($result)){
					echo $row['nombre'];
				}
			echo "</title>";
			echo "<link rel='icon' type='image/ico' href='./img/favicon.ico'/>";
			echo "<link href='./css/normalize.css' type='text/css' rel='stylesheet'>";
			echo "<link href='./css/diseño_principal.css' type='text/css' rel='stylesheet'>";
		echo "</head>";
?>