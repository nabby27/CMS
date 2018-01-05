<?php
session_start(); 
echo '<!DOCTYPE html>';
echo '<html lang="en">';
	include 'head.php';
	echo '<body>';
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_GET['home'])){
				unset($_SESSION['s_id_category']);
				unset($_SESSION['s_id_subcategory']);
			}
			if (isset($_GET['id_category'])){
				$id_category=$_GET['id_category'];
				unset($_SESSION['s_id_subcategory']);
				$_SESSION['s_id_category']=$id_category;
			}
			if (isset($_GET['id_subcategory'])){
				$id_subcategory=$_GET['id_subcategory'];
				$_SESSION['s_id_subcategory']=$id_subcategory;
			}
			echo '<nav>';
				echo '<ul>';
					show('cms_category', 'id_category', 'id_category_father', 0, 'name');
				echo '</ul>';
			echo '</nav>';
			if (isset($_SESSION['s_id_category'])){	
				echo '<div class="subcategories_section">';
					 show('cms_category', 'id_category', 'id_category_father', $_SESSION['s_id_category'], 'name'); 
				echo '</div>';
				show('cms_article', 'id_article', 'id_category', $_SESSION['s_id_category'], 'name'); 
			}
			if (isset($_SESSION['s_id_subcategory'])){ 
				echo '<div class="subcategories_section">';
					show('cms_category', 'id_category', 'id_category_father', $_SESSION['s_id_subcategory'], 'name');
				echo '</div>';
				echo '<div class="general_picture">';
					show('cms_article', 'id_article', 'id_category', $_SESSION['s_id_subcategory'], 'name');
				echo '</div>';
			}
		}
		else
			header('Location: ./index.php');
		include 'scripts.php';
	echo '</body>';
echo '</html>';
?>
