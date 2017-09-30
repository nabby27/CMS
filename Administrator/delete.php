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
			if (isset($_REQUEST['id_categoria'])){
				$id_categoria=$_REQUEST['id_categoria'];
				$cond="DELETE FROM cms_foto where id_articulo in (SELECT id_articulo from cms_articulo where id_categoria=".$id_categoria.")";
				$cond2="DELETE FROM cms_links where id_articulo in (SELECT id_articulo from cms_articulo where id_categoria=".$id_categoria.")";
				$cond3="DELETE FROM cms_articulo where id_categoria=".$id_categoria."";
				$cond4="DELETE FROM cms_categoria where id_categoria=".$id_categoria."";

				if ($result = mysqli_query($link, $cond)){
					if ($result2 = mysqli_query($link, $cond2)){
						if ($result3 = mysqli_query($link, $cond3)){
							if ($result4 = mysqli_query($link, $cond4)){
								header("Location: categories.php");
							}
						}
					}
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Eliminacion fallida <br>";
						echo "<a href='categories.php'>volver a intentarlo</a>";
					echo "</div>";
				}
			}
			elseif (isset($_REQUEST['id_articulo'])){
				$id_articulo=$_REQUEST['id_articulo'];
				$cond="DELETE FROM cms_foto where id_articulo=".$id_articulo."";
				$cond2="DELETE FROM cms_links where id_articulo=".$id_articulo."";
				$cond3="DELETE FROM cms_articulo where id_articulo=".$id_articulo."";
				if ($result = mysqli_query($link, $cond)){
					if ($result2 = mysqli_query($link, $cond2)){
						if ($result3 = mysqli_query($link, $cond3)){
							header("Location: articles.php");
						}
					}
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Eliminacion fallida <br>";
						echo "<a href='articles.php'>volver a intentarlo</a>";
					echo "</div>";
				}
			}
			elseif (isset($_REQUEST['id_link'])){
				$id_link=$_REQUEST['id_link'];
				$cond="SELECT id_articulo from cms_links where id_link=$id_link";
				$result=mysqli_query($link, $cond);
				$row=mysqli_fetch_assoc($result);
				$cond2="DELETE FROM cms_links where id_link=".$id_link."";
				if ($result = mysqli_query($link, $cond2)){
					header("Location: links.php?id_articulo=".$row['id_articulo']);
				}
			}
			elseif (isset($_REQUEST['id_foto'])){
				$id_foto=$_REQUEST['id_foto'];
				$cond="SELECT id_articulo from cms_foto where id_foto=$id_foto";
				$result=mysqli_query($link, $cond);
				$row=mysqli_fetch_assoc($result);
				$cond2="DELETE FROM cms_foto where id_foto=".$id_foto."";
				if ($result = mysqli_query($link, $cond2)){
					header("Location: pictures.php?id_articulo=".$row['id_articulo']);
				}
			}
			elseif (isset($_REQUEST['id_usuario'])){
				$id_usuario=$_REQUEST['id_usuario'];
				echo $id_usuario;
				$cond="DELETE from cms_usuarios where id_usuario='".$id_usuario."'";
				if ($result=mysqli_query($link, $cond)){
					header("Location: users.php");
				}
			}
		}
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>