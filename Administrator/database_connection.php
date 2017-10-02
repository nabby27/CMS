<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

$link = mysqli_connect("localhost", "root", "") or die ($S_can_not_connect_to_server);
mysqli_select_db( $link, "cms") or die ($S_failed_to_select_the_database);
$tildes = $link->query("SET NAMES 'utf8'")
?>