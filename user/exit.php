<?php
session_start();
unset($_SESSION['s_user']);
unset($_SESSION['s_id_category']);
unset($_SESSION['s_id_subcategory']);
header('Location: index.php');
?>
