<?php
session_start();
unset($_SESSION['s_admin']);
header("Location: index.php");
?>