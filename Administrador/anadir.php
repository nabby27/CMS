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
/*--CABECERA-----------------------------------------------------------------------------------------------*/
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			if (isset($_REQUEST['nombrec'])){
				$id_categoria_padre=$_REQUEST['id_categoria_padre'];
				$nombre=$_REQUEST['nombre'];
				$id_categoria=$_REQUEST['id_categoria'];
				$cond="INSERT INTO cms_categoria VALUES (".$id_categoria_padre.", ".$id_categoria.", '".$nombre."', ".$id_empresa_a_mostrar.")";
				
				if ($result=mysqli_query($link, $cond)){
					echo "<div class='formulario_inicio_sesion'>";
						echo "Registro insertado correctamente<br>";
						echo "<a href='categorias.php'>ATRAS</a>";
					echo "</div>";
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Fallo al insertar el registro<br>";
						echo "<a href='categorias.php?nombrea=a'>ATRAS</a>";
					echo "</div>";
				}
			}
			elseif (isset($_REQUEST['nombrea'])){
				$id_articulo=$_REQUEST['id_articulo'];
				$nombre=$_REQUEST['nombre'];
				$descripcion=$_REQUEST['descripcion'];
				$id_categoria=$_REQUEST['id_categoria'];

				if (is_uploaded_file ($_FILES['foto']['tmp_name'])){
					$nombreDirectorio="./img/";
					$idUnico = time();
					$nombreFichero = $idUnico."-".$_FILES['foto']['name'];
					move_uploaded_file($_FILES['foto']['tmp_name'], ".".$nombreDirectorio.$nombreFichero);
					$foto=$nombreFichero;

					$cond="INSERT INTO cms_articulo VALUES (".$id_articulo.", '".$nombre."', '".$descripcion."', '".$foto."', ".$id_categoria.")";

					if ($result=mysqli_query($link, $cond)){
						echo "<div class='formulario_inicio_sesion'>";
							echo "Registro insertado correctamente<br>";
							echo "<a href='articulos.php'>ATRAS</a>";
						echo "</div>";
					}
					else{
						echo "<div class='formulario_inicio_sesion'>";
							echo "Fallo al insertar el registro<br>";
							echo "<a href='articulos.php?nombrea=a'>ATRAS</a>";
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