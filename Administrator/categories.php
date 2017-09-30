<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (empty($_REQUEST['id_categoria'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>INICIO</li></a>";
				echo "</ul>";
			echo "</nav>";
		}
		if (isset($_SESSION['s_admin'])){
			if (isset($_REQUEST['enviar'])){
				$id_categoria_padre=$_REQUEST['id_categoria_padre'];
				$nombre=$_REQUEST['nombre'];
				$id_categoria=$_REQUEST['id_categoria'];
				$cond="UPDATE cms_categoria set nombre='".$nombre."', id_categoria_padre='".$id_categoria_padre."' where id_categoria=".$id_categoria."";

				if ($result=mysqli_query($link, $cond)){
					echo "<div class='formulario_inicio_sesion'>";
						echo "Actualización exitosa<br>";
						echo "<a href='categories.php'>ATRAS</a>";
					echo "</div>";
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Actualización fallida<br>";
						echo "<a href='categories.php?nombrea=a'>ATRAS</a>";
					echo "</div>";
				}
			}
			else{
				if (isset($_REQUEST['id_categoria_actualizar'])){
					$id_categoria=$_REQUEST['id_categoria_actualizar'];
					formulario_categoria('cms_categoria', 'id_categoria', $id_categoria);
				}
				elseif(isset($_REQUEST['añadir_padre'])){
					$id_categoria_padre=$_REQUEST['añadir_padre'];
					$cond="SELECT * from cms_categoria order by nombre";
					$result= mysqli_query($link, $cond);
					$result_max=mysqli_query($link, "SELECT max(id_categoria) as max from cms_categoria");
					$row_max=mysqli_fetch_assoc($result_max);
					$max=$row_max['max'];
					$max+=1;
					$categoria="";
					$añadir="añadir";
					echo "<form action='add.php?nombrec=".$añadir."' method='POST' class='formulario_inicio_sesion'>"; 
						echo "Categoria padre: <br><br>";
						echo "<select name='id_categoria_padre'><br><br>";
							while ($row=mysqli_fetch_assoc($result)) {
								if ($row['id_categoria']==$id_categoria_padre){
									echo "<option value='".$row['id_categoria']."' selected>".$row['nombre']."</option>";
								}
								else{
									echo "<option value='".$row['id_categoria']."'>".$row['nombre']."</option>";
								}
							}
						echo "</select><br><br>";
						echo "Nombre: <br><br><input type='text' name='nombre'><br><br>";
						echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
						echo "<input type='hidden' name='id_categoria' value=".$max.">";
					echo "</form>";
				}
				elseif (isset($_REQUEST['id_categoria_padre'])) {
					$id_categoria_padre=$_REQUEST['id_categoria_padre'];
					$cond="SELECT * from cms_categoria where id_categoria_padre=$id_categoria_padre order by nombre";
					$result=mysqli_query($link, $cond);
					$c="";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='categories.php?añadir_padre=".$id_categoria_padre."'>AÑADIR</a></li>";
						echo "</ul>";
					echo "</nav>";
					while ($row=mysqli_fetch_assoc($result)){
						echo "<a href='categories.php?id_categoria_padre=".$row['id_categoria']."'><div class='subcategorias' class='boton'>";
							echo $row['nombre'];
						echo "</div></a>";
						echo "<div class='papelera'>";
							echo "<a width='0px' href='delete.php?id_categoria=".$row['id_categoria']."'>";
								echo "<div class='icon-basura'></div>";
							echo "</a>";
						echo "</div>";
						echo "<div class='lapiz'>";
							echo "<a width='0px' href='categories.php?id_categoria_actualizar=".$row['id_categoria']."'>";
								echo "<div class='icon-pencil2'></div>";
							echo "</a>";
						echo "</div>";
					}
				}
				else{
					$cond="SELECT * from cms_categoria";
					$result=mysqli_query($link, $cond);
					$c="0";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='categories.php?añadir_padre=".$c."'>AÑADIR</a></li>";
						echo "</ul>";
					echo "</nav>";
					while ($row=mysqli_fetch_assoc($result)){
						if ($row['id_categoria']!=0){
							if($row['id_categoria_padre']==0){
								echo "<a href='categories.php?id_categoria_padre=".$row['id_categoria']."'><div class='subcategorias' class='boton'>";
									echo $row['nombre'];
								echo "</div></a>";
								echo "<div class='papelera'>";
									echo "<a width='0px' href='delete.php?id_categoria=".$row['id_categoria']."'>";
										echo "<div class='icon-basura'></div>";
									echo "</a>";
								echo "</div>";
								echo "<div class='lapiz'>";
									echo "<a width='0px' href='categories.php?id_categoria_actualizar=".$row['id_categoria']."'>";
										echo "<div class='icon-pencil2'></div>";
									echo "</a>";
								echo "</div>";
							}
						}
					}
				}
			}
		}
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>