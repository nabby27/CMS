<?php
session_start();
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
echo "<!DOCTYPE html>";
/*--Conexion con la base de datos--------------------------------------------------------------------------*/
	include 'inicio_conjunto.php';
/*--Ficher de funciones------------------------------------------------------------------------------------*/
	include 'funciones.php';
/*--META, TITLE, LINKS-------------------------------------------------------------------------------------*/
	include 'head.php';
/*--BODY---------------------------------------------------------------------------------------------------*/
	echo "<body>";
/*--CABECERA-----------------------------------------------------------------------------------------------*/
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			if(isset($_REQUEST['enviar'])){
				$id_foto=$_REQUEST['id_foto'];
				$id_articulo=$_REQUEST['id_articulo'];
				$articulo=$_REQUEST['articulo'];
				$descripcion=$_REQUEST['descripcion'];
				if (is_uploaded_file($_FILES['foto']['tmp_name'])){
					$nombreDirectorio="../img/";
					$idUnico = time();
					$nombreFichero = $idUnico."-".$_FILES['foto']['name'];
					move_uploaded_file($_FILES['foto']['tmp_name'], $nombreDirectorio.$nombreFichero);
					$foto=$nombreFichero;
					$cond="UPDATE cms_foto set foto='".$foto."', descripcion='".$descripcion."', id_articulo=".$id_articulo." where id_foto=".$id_foto."";
				}
				else{
					$cond="UPDATE cms_foto set descripcion='".$descripcion."', id_articulo=".$id_articulo." where id_foto=".$id_foto."";
				}
				if($result=mysqli_query($link, $cond)){
					header("Location:fotos.php?id_articulo=".$articulo."");
				}
			}
			elseif(isset($_REQUEST['id_foto'])){
				$id_foto=$_REQUEST['id_foto'];
				$id_articulo=$_REQUEST['id_articulo'];
				echo "<div class='nombre_seccion'>".$row['nombre']."</div>";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='fotos.php?id_articulo=$id_articulo'>ATRAS</a></li>";
						echo "<li><a href='anadir_foto.php?id_articulo=$id_articulo'>AÑADIR</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='seccion_fotos_formulario'>";
					$cond="SELECT * from cms_foto where id_foto=$id_foto";
					$result = mysqli_query($link, $cond);
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='foto_formulario23'>";
							echo "<form action='fotos.php' method='POST' enctype='multipart/form-data'>";
								echo "<img src='../img/".$row['foto']."' style='width: 80%'><br><br>";
								echo "<input type='file' name='foto'><br><br>";
								echo "<textarea name='descripcion' rows='2' cols='40'>".$row['descripcion']."</textarea><br><br>";
								$cond2="SELECT * from cms_articulo";
								$result2=mysqli_query($link, $cond2);
								echo "<select name='id_articulo'>";
									while($row2=mysqli_fetch_assoc($result2)){
										if ($row['id_articulo']==$row2['id_articulo']){
											echo "<option value='".$row2['id_articulo']."' selected>".$row2['nombre']."</option>";
										}
										else{
											echo "<option value='".$row2['id_articulo']."'>".$row2['nombre']."</option>";
										}
									}
								echo "</select><br><br>";
								echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
								echo "<div class='papelera2'>";
									echo "<a width='0px' href='borrar.php?id_foto=".$row['id_foto']."'>";
										echo "<div class='icon-basura'></div>";
									echo "</a>";
								echo "</div>";
								echo "<input type='hidden' name='id_foto' value=".$id_foto.">";
								echo "<input type='hidden' name='articulo' value=".$id_articulo.">";
							echo "</form>";
						echo "</div>";
					}
				echo "</div>";
			}
			else{
				$id_articulo=$_REQUEST['id_articulo'];
				$result=mysqli_query($link, "SELECT nombre from cms_articulo where id_articulo=$id_articulo");
				$row=mysqli_fetch_assoc($result);
				echo "<div class='nombre_seccion'>".$row['nombre']."</div>";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='articulos.php?id_articulo=$id_articulo'>ATRAS</a></li>";
						echo "<li><a href='anadir_foto.php?id_articulo=$id_articulo'>AÑADIR</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='seccion_fotos_formulario'>";
					$cond="SELECT * from cms_foto where id_articulo=$id_articulo";
					$result = mysqli_query($link, $cond);
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='foto_formulario'>";
								echo "<img src='../img/".$row['foto']."' style='width: 80%'><br><br>";
								echo "<div class='boton2'><a href='fotos.php?id_foto=".$row['id_foto']."&id_articulo=".$id_articulo."'>EDITAR</a></div>";
						echo "</div>";
					}
				echo "</div>";
			}
		}	
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>