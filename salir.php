<?php
session_start();
unset($_SESSION['s_usuario']);
unset($_SESSION['id_cat']);
unset($_SESSION['id_subcat']);
header("Location: index.php");
?>