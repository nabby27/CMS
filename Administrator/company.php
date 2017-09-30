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
		if (isset($_SESSION['s_admin'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>INICIO</li></a>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['enviar'])){
				$nombre=$_REQUEST['nombre'];
				$email=$_REQUEST['email'];
				$telefono=$_REQUEST['telefono'];
				$direccion=$_REQUEST['direccion'];
				$id_empresa=$_REQUEST['id_empresa'];

				if (is_uploaded_file($_FILES['imagen']['tmp_name'][0])){
					$nombreDirectorio="../img/";
					$idUnico = time();
					$nombreFichero = $idUnico."-".$_FILES['imagen']['name'][0];
					move_uploaded_file($_FILES['imagen']['tmp_name'][0], $nombreDirectorio.$nombreFichero);
					$logo=$nombreFichero;
				}
				else{
					$logo=$_REQUEST['logo_ant'];
				}
				if (is_uploaded_file($_FILES['imagen']['tmp_name'][1])){
					$nombreDirectorio="../img/";
					$idUnico = time();
					$nombreFichero = $idUnico."-".$_FILES['imagen']['name'][1];
					move_uploaded_file($_FILES['imagen']['tmp_name'][1], $nombreDirectorio.$nombreFichero);
					$foto_cabecera=$nombreFichero;
				}
				else{
					$foto_cabecera=$_REQUEST['foto_cabecera_ant'];
				}
				if (is_uploaded_file($_FILES['imagen']['tmp_name'][2])){
					$nombreDirectorio="../img/";
					$idUnico = time();
					$nombreFichero = $idUnico."-".$_FILES['imagen']['name'][2];
					move_uploaded_file($_FILES['imagen']['tmp_name'][2], $nombreDirectorio.$nombreFichero);
					$foto_fondo=$nombreFichero;
				}
				else{
					$foto_fondo=$_REQUEST['foto_fondo_ant'];
				}
				$cond="UPDATE cms_empresa set nombre='".$nombre."', email='".$email."', telefono='".$telefono."', direccion='".$direccion."', logo='".$logo."', foto_cabecera='".$foto_cabecera."', foto_fondo='".$foto_fondo."' where id_empresa=".$id_empresa."";
				$result = mysqli_query($link, $cond);
			}
			$cond="SELECT * from cms_empresa";
			$result=mysqli_query($link, $cond);
			while($row=mysqli_fetch_assoc($result)){
				echo "<form action='company.php' method='POST' class='formulario_empresa' enctype='multipart/form-data'>"; 
					echo "Nombre: <br><br><input type='text' name='nombre' value='".$row['nombre']."'><br><br>";
					echo "Email: <br><br><input type='text' name='email' value='".$row['email']."'><br><br>";
					echo "Teléfono: <br><br><input type='number' name='telefono' value='".$row['telefono']."'><br><br>";
					echo "Dirección: <br><br><input type='text' name='direccion' value='".$row['direccion']."'><br><br>";
					echo "Logo: <br><br><img src='../img/".$row['logo']."'><br><br>";
					echo "<input type='file' name='imagen[]'><br><br>";
					echo "Cabecera: <br><br><img src='../img/".$row['foto_cabecera']."' style='width: 100%'>";
					echo "<input type='file' name='imagen[]'><br><br>";
					echo "Fondo: <br><br><img src='../img/".$row['foto_fondo']."' style='width: 100%'>";
					echo "<input type='file' name='imagen[]'><br><br>";
					echo "<input type='submit' name='enviar' value='Guardar cambios'><br>";
					echo "<input type='hidden' name='id_empresa' value='".$row['id_empresa']."'>";
					echo "<input type='hidden' name='logo_ant' value='".$row['logo']."'>";
					echo "<input type='hidden' name='foto_cabecera_ant' value='".$row['foto_cabecera']."'>";
					echo "<input type='hidden' name='foto_fondo_ant' value='".$row['foto_fondo']."'>";
				echo "</form>";			
			}
		}	
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>