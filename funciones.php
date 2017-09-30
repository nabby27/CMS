<?php
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

include 'inicio_conjunto.php';
if (isset($_SESSION['s_usuario'])){
function mostrar($tabla, $id, $campo, $valor, $campo_mostrar){
	global $link;
	$class='';
	if(isset($_SESSION['id_cat'])){
		$class='pulsado';
	}
	if (isset($_SESSION['id_subcat'])){
	 	$clase='pulsado';
	}
	if ($result = mysqli_query($link, "SELECT * from $tabla where $campo=$valor order by nombre")){
		while($row = mysqli_fetch_assoc($result)) {
			if ($valor==0){
				if ($row[$id]!=0){ 
					if (isset($_SESSION['id_cat']) && $row[$id]==$_SESSION['id_cat']){
						echo "<li id='".$class."'><a href='principal.php?id_categoria=".$row[$id]."'><strong>".$row[$campo_mostrar]."</strong></a></li>";

					}
					else{
						echo "<li><a href='principal.php?id_categoria=".$row[$id]."'><strong>".$row[$campo_mostrar]."</strong></a></li>";
					}
				}
			}
			elseif ($tabla=='cms_categoria'){
				if(isset($_SESSION['id_subcat']) && $row[$id]==$_SESSION['id_subcat']){
					echo "<a href='principal.php?id_subcategoria=".$row[$id]."'><div class='subcategorias-".$clase."'><strong>".$row[$campo_mostrar]."</strong></div></a>";
				}
				else{
					echo "<a href='principal.php?id_subcategoria=".$row[$id]."'><div class='subcategorias'><strong>".$row[$campo_mostrar]."</strong></div></a>";
				}
			}
			else{
				$parametro="id_articulo=".$row[$id]."";
				echo "<div class='seccion_general'>";
					echo "<div class='seccion_imagen'><img src='./img/".$row['foto']."' style='width: 100%; height: 100%'></div>";
					if($campo!="id_articulo"){
						echo "<a href='detalles.php?".$parametro."'><div class='seccion_nombre'>".$row[$campo_mostrar]."</div></a>";
					}
					else{
						echo "<div class='seccion_descripcion'>".$row[$campo_mostrar]."</div>";
					}
				echo "</div>";
			}
		}
	}
}
}
else{
	header("Location: index.php");
}
?>