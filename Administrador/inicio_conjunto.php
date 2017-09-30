<?php
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
$link = mysqli_connect("localhost", "root", "") or die ("No se puede conectar con el servidor");
mysqli_select_db( $link, "cms") or die ("No se puede seleccionar la base de datos");
$tildes = $link->query("SET NAMES 'utf8'")
?>