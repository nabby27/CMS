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
			if(isset($_REQUEST['enviar'])){
				$id_link=$_REQUEST['id_link'];
				$texto=$_REQUEST['texto'];
				$vinculo=$_REQUEST['vinculo'];
				$id_articulo=$_REQUEST['id_articulo'];
				$articulo=$_REQUEST['articulo'];
				$cond="UPDATE cms_links set id_articulo=".$id_articulo.", texto='".$texto."', vinculo='".$vinculo."' where id_link=".$id_link."";
				if($result=mysqli_query($link, $cond)){
					header( "Location: links.php?id_articulo=$articulo");
				}
			}
			elseif(isset($_REQUEST['id_link'])){
				$id_link=$_REQUEST['id_link'];
				$id_articulo=$_REQUEST['id_articulo'];
				echo "<div class='nombre_seccion'>".$row['nombre']."</div>";
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='links.php?id_articulo=$id_articulo'>ATRAS</a></li>";
						echo "<li><a href='add_links.php?id_articulo=$id_articulo'>AÑADIR</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='seccion_fotos_formulario'>";
					$cond="SELECT * from cms_links where id_link=$id_link";
					$result = mysqli_query($link, $cond);
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='foto_formulario23'>";
							echo "<form action='links.php?id_articulo=$id_articulo' method='POST' enctype='multipart/form-data'>";
								echo "Texto a mostrar:<br><br><input type='text' name='texto' size='30' value='".$row['texto']."'><br><br>";
								echo "Vinculo:<br><br><input type='text' size='60' name='vinculo' value='".$row['vinculo']."'><br><br>";
								echo "Articulo:<br><br>";
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
								echo "<input type='submit' name='enviar' value='Guardar cambios'><br><br>";
								echo "<div class='papelera2'>";
									echo "<a width='0px' href='delete.php?id_link=".$row['id_link']."'>";
										echo "<div class='icon-basura'></div>";
									echo "</a>";
								echo "</div>";
								echo "<input type='hidden' name='id_link' value=".$row['id_link'].">";
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
						echo "<li><a href='articles.php?id_articulo=$id_articulo'>ATRAS</a></li>";
						echo "<li><a href='add_links.php?id_articulo=$id_articulo'>AÑADIR</a></li>";
					echo "</ul>";
				echo "</nav>";
				echo "<div class='seccion_fotos_formulario'>";
					$cond="SELECT * from cms_links where id_articulo=$id_articulo";
					$result = mysqli_query($link, $cond);
					while($row = mysqli_fetch_assoc($result)){
						echo "<div class='foto_formulario'>";
							echo "Texto a mostrar:<br><br><input type='text' name='texto' size='30' value='".$row['texto']."'><br><br>";
								echo "<div class='boton2'><a href='links.php?id_link=".$row['id_link']."&id_articulo=".$id_articulo."'>EDITAR</a></div>";
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