<?php
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/

include 'inicio_conjunto.php';
if (isset($_SESSION['s_admin'])){
	function mostrar($tabla, $id, $campo, $valor, $campo_mostrar){
		global $link;
		$result = mysqli_query($link, "SELECT * from $tabla where $campo=$valor");
		while($row = mysqli_fetch_assoc($result)) {
			if ($valor==0){
				echo "<li><a href='principal.php?id_categoria=".$row[$id]."'>".$row[$campo_mostrar]."</a></li>";
			}
			elseif ($tabla=='cms_categoria'){
				echo "<li><a href='principal.php?id_subcategoria=".$row[$id]."'>".$row[$campo_mostrar]."</a></li>";
			}
			else{
				if($campo!="id_articulo"){
					$parametro="id_articulo=".$row[$id]."";
					echo "<div class='seccion_general'>";
						echo "<div class='seccion_imagen'><img src='".$row['foto']."' style='width: 100%; height: 100%'></div>";
						echo "<div class='seccion_nombre'><a href='detalles.php?".$parametro."'>".$row[$campo_mostrar]."</a></div>";
					echo "</div>";
				}
				else{
					$parametro="id_articulo=".$row[$id]."";
					echo "<div class='seccion_general'>";
						echo "<div class='seccion_imagen'><img src='".$row['foto']."' style='width: 100%; height: 100%'></div>";
						echo "<div class='seccion_nombre'>".$row[$campo_mostrar]."</div>";
					echo "</div>";
				}
			}
		}
	}

	function formulario_categoria($tabla, $campoId, $valorId){
		global $link;
		$cond="SELECT * from $tabla";
		$result= mysqli_query($link, $cond);
		$cond2="SELECT * from $tabla where $campoId=$valorId";
		$result2 = mysqli_query($link, $cond2);
		while ($row2 = mysqli_fetch_assoc($result2)){
			echo "<form action='categorias.php' method='POST' class='formulario_inicio_sesion'>"; 
				echo "Categoria padre: <br><br>";
					echo "<select name='id_categoria_padre'><br><br>";
						while ($row=mysqli_fetch_assoc($result)) {
							if ($row['id_categoria']==$row2['id_categoria_padre']){
								echo "<option value='".$row['id_categoria']."' selected>".$row['nombre']."</option>";
							}
							else{
								echo "<option value='".$row['id_categoria']."'>".$row['nombre']."</option>";
							}
						}
					echo "</select><br><br>";
				echo "Nombre: <br><br><input type='text' name='nombre' value=".$row2['nombre']."><br><br>";
				echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
				echo "<input type='hidden' name='id_categoria' value=".$valorId.">";
			echo "</form>";
		}
	}

	function formulario_articulo($tabla, $campoId, $valorId){
		global $link;
		$cond="SELECT * from cms_categoria";
		$result= mysqli_query($link, $cond);
		$cond2="SELECT * from $tabla where $campoId=$valorId";
		$result2 = mysqli_query($link, $cond2);
		while ($row2 = mysqli_fetch_assoc($result2)){
			echo "<form action='articulos.php' method='POST' class='formulario_empresa' id='form_art' enctype='multipart/form-data'>"; 
				echo "Nombre: <br><br><input type='text' name='nombre' value='".$row2['nombre']."'><br><br>";
				echo "Descripcion: <br><br><textarea name='descripcion' form='form_art' rows='15' cols='50'>".$row2['descripcion']."</textarea><br><br>";
				echo "Foto principal:<br><br><img src='../img/".$row2['foto']."'style='width: 100%; height: 100%'><input type='file' name='foto'><br><br>";
				echo "Categoria: <br><br>";
					echo "<select name='id_categoria'><br><br>";
						while ($row=mysqli_fetch_assoc($result)){
							$cond_p="SELECT nombre from cms_categoria where id_categoria in (select id_categoria_padre from cms_categoria where id_categoria=".$row['id_categoria'].")";
							$result_p=mysqli_query($link, $cond_p);
							$row_p=mysqli_fetch_assoc($result_p);
							if ($row['id_categoria']==$row2['id_categoria']){
								echo "<option value='".$row['id_categoria']."' selected>".$row_p['nombre']."&nbsp".$row['nombre']."</option>";
							}
							else{
								echo "<option value='".$row['id_categoria']."'>".$row_p['nombre']."&nbsp".$row['nombre']."</option>";
							}
						}
					echo "</select><br><br>";
				echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
				echo "<input type='hidden' name='id_articulo' value=".$valorId.">";
			echo "</form>";
		}
	}
}	
else{
	header("Location: index.php");
}	
?>