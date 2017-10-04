<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

<?php 
include 'database_connection.php'; 
if (isset($_SESSION['s_user'])){
	function mostrar($table, $id, $field, $value, $field_show){
		global $link;
		if(isset($_SESSION['s_id_category'])){
			$class='press';
		}
		if (isset($_SESSION['s_id_subcategory'])){
		 	$clase='press';
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
						echo "<a href='main.php?id_subcategory=".$row[$id]."'><div class='subcategories-".$clase."'><strong>".$row[$field_show]."</strong></div></a>";
					}
					else{
						echo "<a href='main.php?id_subcategory=".$row[$id]."'><div class='subcategories'><strong>".$row[$field_show]."</strong></div></a>";
					}
				}
				else{
					$parameter="id_article=".$row[$id]."";
					echo "<div class='general_section'>";
						echo "<div class='picture_section'><img src='./img/".$row['picture']."' style='width: 100%; height: 100%'></div>";
						if($field!="id_article"){
							echo "<a href='detail.php?".$parameter."'><div class='name_section'>".$row[$field_show]."</div></a>";
						}
						else{
							echo "<div class='description_section'>".$row[$field_show]."</div>";
						}
					echo "</div>";
				}
			}
		}
	}
}
else
	header("Location: index.php");
?>