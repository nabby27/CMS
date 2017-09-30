<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
unset($_SESSION['s_usuario']);
unset($_SESSION['id_cat']);
unset($_SESSION['id_subcat']);
header("Location: index.php");
?>