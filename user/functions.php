<?php 
include './database_connection.php'; 
if (isset($_SESSION['s_user'])){
	
	function show($table, $id, $field, $value, $field_show){
		global $link;
		if(isset($_SESSION['s_id_category'])){
			$class='press';
		}
		if (isset($_SESSION['s_id_subcategory'])){
		 	$class='press';
		}
		if ($result = mysqli_query($link, "SELECT * from $table where $field=$value order by name")){
			while($row = mysqli_fetch_assoc($result)) {
				if ($value==0){
					if ($row[$id]!=0){ 
						if (isset($_SESSION['s_id_category']) && $row[$id]==$_SESSION['s_id_category']){
							echo "<li id='".$class."'><a href='main.php?id_category=".$row[$id]."'><strong>".$row[$field_show]."</strong></a></li>";

						}
						else{
							echo "<li><a href='main.php?id_category=".$row[$id]."'><strong>".$row[$field_show]."</strong></a></li>";
						}
					}
				}
				elseif ($table=='cms_category'){
					if(isset($_SESSION['s_id_subcategory']) && $row[$id]==$_SESSION['s_id_subcategory']){
						echo "<a href='main.php?id_subcategory=".$row[$id]."'><div class='subcategories-".$class."'><strong>".$row[$field_show]."</strong></div></a>";
					}
					else{
						echo "<a href='main.php?id_subcategory=".$row[$id]."'><div class='subcategories'><strong>".$row[$field_show]."</strong></div></a>";
					}
				}
				else{
					$parameter='id_article='.$row[$id];
					echo '<div class="general_section">';
						echo "<div class='picture_section'><img src='../img/".$row['picture']."' style='width: 100%; height: 100%'></div>";
						if($field!='id_article'){
							echo "<a href='detail.php?".$parameter."'><div class='name_section'>".$row[$field_show]."</div></a>";
						}
						else{
							echo '<div class="description_section">'.$row[$field_show].'</div>';
						}
					echo '</div>';
				}
			}
		}
	}

	/*
	function validateUser($user, $password){
		global $link;
		$sql = mysqli_query($link, "SELECT id_user FROM cms_users where (id_user='$user' or email='$user') and password = '$password'");
		if ($row = mysqli_fetch_assoc($result)){
			return true;
		}
		return ;
	}

	function isLogin(){
		global $link;
		if (isset($_SESSION['s_user'])){
			header('Location: main.php');
		}
	}

	function loginSuccess(){
		if (isset($_POST['send'])){
			$user = $_POST['name'];
			$password = $_POST['password'];
			$cond = "SELECT id_user FROM cms_users where (id_user='$user' or email='$user') and password = '$password'";
			$result = mysqli_query($link, $cond);
			if ($row = mysqli_fetch_assoc($result)){
				$_SESSION['s_user']=$row['id_user'];
				return true;
				
			}
			return false;
		}
	}

	function getCompanyInfo($id_company){
		global $link;
		$sql = mysqli_query($link, "SELECT * from cms_company where id_company=$id_company");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($sql)) {
      		$result[$i]['name'] = $row['name'];
			$result[$i]['email'] = $row['email'];
			$result[$i]['telephon'] = $row['telephon'];
			$result[$i]['logo'] = $row['logo'];
			$result[$i]['header_picture'] = $row['header_picture'];
			$result[$i]['background_picture'] = $row['background_picture'];
			$result[$i]['address'] = $row['address'];
			$i++;			  
   		}
   		return $result;
	}

	function getMainCategories() {
		global $link;
		$sql = mysqli_query($link, "SELECT * from cms_category where id_category_father=0 and id_category > 0 order by name");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($sql)) {
      		$result[$i]['name'] = $row['name'];
			$result[$i]['id'] = $row['id_category'];
			$i++;			  
   		}
   		return $result;
	}

	function getSubcategoriesFromCategoryFather($id_category_father) {
		global $link;
		$sql = mysqli_query($link, "SELECT * from cms_category where id_category_father=$id_category_father order by name");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($sql)) {
      		$result[$i]['name'] = $row['name'];
			$result[$i]['id'] = $row['id_category'];
			$i++;			  
   		}
   		return $result;
	}

	function getArticlesFromCategory($id_category) {
		global $link;
		$sql = mysqli_query($link, "SELECT * from cms_article where id_category=$id_category order by name");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($sql)) {
			$result[$i]['name'] = $row['name'];
			$result[$i]['description'] = $row['description'];
			$result[$i]['image'] = $row['image'];
			$result[$i]['id'] = $row['id_article'];
			$i++;			  
   		}
   		return $result;
	}

	function getImagesFromArticle($id_article) {
		global $link;
		$sql = mysqli_query($link, "SELECT * from cms_image where id_article=$id_article");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($sql)) {
			$result[$i]['description'] = $row['description'];
			$result[$i]['image'] = $row['image'];
			$result[$i]['id'] = $row['id_image'];
			$i++;			  
   		}
   		return $result;
	}

	function getLinksFromArticle($id_article) {
		global $link;
		$sql = mysqli_query($link, "SELECT link from cms_links where id_article=$id_article");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($sql)) {
			$result[$i]['link'] = $row['link'];
			$result[$i]['name'] = $row['name'];
			$result[$i]['id'] = $row['id_link'];
			$i++;			  
   		}
   		return $result;
	}

	function getAllFromImage($id_image) {
		global $link;
		$sql = mysqli_query($link, "SELECT name from cms_image where id_image=$id_image");
		$result = array ();
  		$i = 0;
   		while ($row = mysqli_fetch_assoc($C)) {
			$result[$i]['description'] = $row['description'];
			$result[$i]['image'] = $row['image'];
			$i++;			  
   		}
   		return $result;
	}
	*/
}
?>
