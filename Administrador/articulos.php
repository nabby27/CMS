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
			if (isset($_REQUEST['enviar'])){
				$descripcion=$_REQUEST['descripcion'];
				$nombre=$_REQUEST['nombre'];
				$id_categoria=$_REQUEST['id_categoria'];
				$id_articulo=$_REQUEST['id_articulo'];
				if (is_uploaded_file($_FILES['foto']['tmp_name'])){
					$nombreDirectorio="../img/";
					$idUnico = time();
					$nombreFichero = $idUnico."-".$_FILES['foto']['name'];
					move_uploaded_file($_FILES['foto']['tmp_name'], $nombreDirectorio.$nombreFichero);
					$foto=$nombreFichero;
					$cond="UPDATE cms_articulo set nombre='".$nombre."', descripcion='".$descripcion."', id_categoria='".$id_categoria."', foto='".$foto."' where id_articulo=".$id_articulo."";
				}
				else{
					$cond="UPDATE cms_articulo set nombre='".$nombre."', descripcion='".$descripcion."', id_categoria='".$id_categoria."' where id_articulo=".$id_articulo."";
				}
				if ($result = mysqli_query($link, $cond)){
					echo "<div class='formulario_inicio_sesion'>";
						echo "Actualizacion exitosa<br>";
						echo "<a href='articulos.php'>ATRAS</a>";
					echo "</div>";
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Actualizacion fallida<br>";
						echo "<a href='articulos.php?nombrea=a'>ATRAS</a>";
					echo "</div>";
				}
			}				
			else{
				if (isset($_REQUEST['id_articulo'])){
					$id_articulo=$_REQUEST['id_articulo'];
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='principal.php'>INICIO</a></li>";
							echo "<li><a href='fotos.php?id_articulo=$id_articulo'>FOTOS</a></li>";
							echo "<li><a href='articulos.php'>ATRAS</a></li>";
							echo "<li><a href='enlaces.php?id_articulo=$id_articulo'>ENLACES</a></li>";

						echo "</ul>";
					echo "</nav>";
					formulario_articulo('cms_articulo', 'id_articulo', $id_articulo);
				}
				elseif(isset($_REQUEST['nombrea'])){
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='principal.php'>INICIO</a></li>";
						echo "</ul>";
					echo "</nav>";
					$result_max=mysqli_query($link, "SELECT max(id_articulo) as max from cms_articulo");
					$row_max=mysqli_fetch_assoc($result_max);
					$max=$row_max['max'];
					$max+=1;
					$categoria="";
					$cond_categoria="SELECT * from cms_categoria";
					$result_categoria= mysqli_query($link, $cond_categoria);
					$añadir="añadir";
					echo "<form action='anadir.php?nombrea=".$añadir."' method='POST' class='formulario_articulos' id='form_art' enctype='multipart/form-data'>"; 
						echo "Nombre: <br><br><input type='text' name='nombre'><br><br>";
						echo "Descripcion: <br><br><textarea name='descripcion' form='form_art' rows='15' cols='50'></textarea><br><br>";
						echo "Foto principal:<br><br><input type='file' name='foto'><br><br>";
						echo "Categoria: <br><br>";
						echo "<select name='id_categoria'><br><br>";
							while ($row_categoria=mysqli_fetch_assoc($result_categoria)) {
								$cond_p="SELECT nombre from cms_categoria where id_categoria in (select id_categoria_padre from cms_categoria where id_categoria=".$row_categoria['id_categoria'].")";
								$result_p=mysqli_query($link, $cond_p);
								$row_p=mysqli_fetch_assoc($result_p);
								if ($row_categoria['id_categoria']==0){
									echo "<option value='".$row_categoria['id_categoria']."' selected>".$row_p['nombre']."&nbsp".$row_categoria['nombre']."</option>";
								}
								else{
									echo "<option value='".$row_categoria['id_categoria']."'>".$row_p['nombre']."&nbsp".$row_categoria['nombre']."</option>";
								}
							}
						echo "</select><br><br>";
						echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
						echo "<input type='hidden' name='id_articulo' value=".$max.">";
					echo "</form>";			
				}
				else{
					$cond="SELECT * from cms_articulo order by nombre";
					$result=mysqli_query($link, $cond);
					$a="";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='principal.php'>INICIO</a></li>";
							echo "<li><a href='articulos.php?nombrea=".$a."'>AÑADIR</a></li>";
						echo "</ul>";
					echo "</nav>";
					while ($row=mysqli_fetch_assoc($result)){
						echo "<a href='articulos.php?id_articulo=".$row['id_articulo']."'><div class='subcategorias' class='boton'>";
							echo $row['nombre'];
						echo "</div></a>";
						echo "<div class='papelera'>";
							echo "<a width='0px' href='borrar.php?id_articulo=".$row['id_articulo']."'>";
								echo "<div class='icon-basura'></div>";
							echo "</a>";
						echo "</div>";
						echo "<div class='lapiz'>";
							echo "<a width='0px' href='articulos.php?id_articulo=".$row['id_articulo']."'>";
								echo "<div class='icon-pencil2'></div>";
							echo "</a>";
						echo "</div>";
					}
				}
			}
		}
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>