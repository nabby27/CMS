<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			$id_articulo=$_REQUEST['id_articulo'];
			$result=mysqli_query($link, "SELECT nombre from cms_articulo where id_articulo=$id_articulo");
			$row=mysqli_fetch_assoc($result);
			echo "<div class='nombre_seccion'>".$row['nombre']."</div>";
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='links.php?id_articulo=$id_articulo'>ATRAS</a></li>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['enviar'])){
				$id_articulo=$_REQUEST['id_articulo'];
				$id_link=$_REQUEST['id_link'];
				$texto=$_REQUEST['texto'];
				$vinculo=$_REQUEST['vinculo'];
				$cond="INSERT INTO cms_links VALUES (".$id_link.", '".$texto."', '".$vinculo."', ".$id_articulo.")";
				if ($result=mysqli_query($link, $cond)){
					header( "Location: links.php?id_articulo=$id_articulo");
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Fallo al insertar el registro<br>";
						echo "<a href='add_links.php?id_articulo=$id_articulo'>VOLVER A INTENTARLO</a>";
					echo "</div>";
				}
			}
			else{
				$result_max=mysqli_query($link, "SELECT max(id_link) as max from cms_links");
				$row_max=mysqli_fetch_assoc($result_max);
				$max=$row_max['max'];
				$max+=1;
				echo "<div class='seccion_fotos_formulario'>";
					echo "<div class='foto_formulario23'>";
						echo "<form action='add_links.php?id_articulo=$id_articulo' method='POST' enctype='multipart/form-data'>";
							echo "Texto a mostrar:<br><br><input type='text' name='texto' size='30'><br><br>";
							echo "Vinculo:<br><br><input type='text' size='60' name='vinculo'><br><br>";
							$cond="SELECT * from cms_articulo";
							$result=mysqli_query($link, $cond);
							echo "<select name='id_articulo'>";
								while($row=mysqli_fetch_assoc($result)){
									if ($id_articulo==$row['id_articulo']){
										echo "<option value='".$row['id_articulo']."' selected>".$row['nombre']."</option>";
									}
									else{
										echo "<option value='".$row['id_articulo']."'>".$row['nombre']."</option>";
									}
								}
							echo "</select><br><br>";
							echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
							echo "<input type='hidden' name='id_link' value=".$max.">";
							echo "<input type='hidden' name='articulo' value=".$id_articulo.">";
						echo "</form>";
					echo "</div>";
				echo "</div>";
			}
		}
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>