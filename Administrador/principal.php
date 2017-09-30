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
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='categorias.php'>CATEGORIAS</a></li>";
					echo "<li><a href='empresa.php'>EMPRESA</a></li>";
					echo "<li><a href='articulos.php'>ARTICULOS</a></li>";
					echo "<li><a href='usuarios.php'>USUARIOS</a></li>";
				echo "</ul>";
			echo "</nav>";
		}
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>