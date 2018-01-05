<?php
session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (empty($_REQUEST['id_category'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>$S_home</li></a>";
				echo "</ul>";
			echo "</nav>";
		}
		if (isset($_SESSION['s_admin'])){
			if (isset($_REQUEST['send'])){
				$id_category_father=$_REQUEST['id_category_father'];
				$name=$_REQUEST['name'];
				$id_category=$_REQUEST['id_category'];

				if ($result=mysqli_query($link, "UPDATE cms_category set name='".$name."', id_category_father='".$id_category_father."' where id_category=".$id_category."")){
					echo "<div class='login_form'>";
						echo "<br>";
						echo "<a href='categories.php'>$S_back</a>";
					echo "</div>";
				}
				else{
					echo "<div class='login_form'>";
						echo "$S_update_failed<br>";
						echo "<a href='categories.php?namea=a'>$S_back</a>";
					echo "</div>";
				}
			}
			else{
				if (isset($_REQUEST['id_update_category'])){
					$id_category=$_REQUEST['id_update_category'];
					category_form('cms_category', 'id_category', $id_category);
				}
				elseif(isset($_REQUEST['add_father'])){
					$id_category_father=$_REQUEST['add_father'];
					$result= mysqli_query($link, "SELECT * from cms_category order by name");
					$result_max=mysqli_query($link, "SELECT max(id_category) as max from cms_category");
					$row_max=mysqli_fetch_assoc($result_max);
					$max=$row_max['max'];
					$max++;
					$category="";
					$add="add";
					echo "<form action='add.php?namec=".$add."' method='POST' class='login_form'>"; 
						echo "category father: <br><br>";
						echo "<select name='id_category_father'><br><br>";
							while ($row=mysqli_fetch_assoc($result)) {
								if ($row['id_category']==$id_category_father){
									echo "<option value='".$row['id_category']."' selected>".$row['name']."</option>";
								}
								else{
									echo "<option value='".$row['id_category']."'>".$row['name']."</option>";
								}
							}
						echo "</select><br><br>";
						echo "name: <br><br><input type='text' name='name'><br><br>";
						echo "<input type='submit' name='send' value=".$S_save_changes."><br>";
						echo "<input type='hidden' name='id_category' value=".$max.">";
					echo "</form>";
				}
				elseif (isset($_REQUEST['id_category_father'])) {
					$id_category_father=$_REQUEST['id_category_father'];
					$result=mysqli_query($link, "SELECT * from cms_category where id_category_father=$id_category_father order by name");
					$c="";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='categories.php?add_father=".$id_category_father."'>".$S_add."</a></li>";
						echo "</ul>";
					echo "</nav>";
					while ($row=mysqli_fetch_assoc($result)){
						echo "<a href='categories.php?id_category_father=".$row['id_category']."'><div class='subcategories' class='boton'>";
							echo $row['name'];
						echo "</div></a>";
						echo "<div class='trash'>";
							echo "<a width='0px' href='delete.php?id_category=".$row['id_category']."'>";
								echo '<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>';
							echo "</a>";
						echo "</div>";
						echo "<div class='pencil'>";
							echo "<a width='0px' href='categories.php?id_update_category=".$row['id_category']."'>";
								echo "<i class='fa fa-pencil fa-2x' aria-hidden='true'></i>";
							echo "</a>";
						echo "</div>";
					}
				}
				else{
					$result=mysqli_query($link, "SELECT * from cms_category");
					$c="0";
					echo "<nav>";
						echo "<ul>";
							echo "<li><a href='categories.php?add_father=".$c."'>".$S_add."</a></li>";
						echo "</ul>";
					echo "</nav>";
					while ($row=mysqli_fetch_assoc($result)){
						if ($row['id_category']!=0){
							if($row['id_category_father']==0){
								echo "<a href='categories.php?id_category_father=".$row['id_category']."'><div class='subcategories' class='boton'>";
									echo $row['name'];
								echo "</div></a>";
								echo "<div class='trash'>";
									echo "<a width='0px' href='delete.php?id_category=".$row['id_category']."'>";
										echo '<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>';
									echo "</a>";
								echo "</div>";
								echo "<div class='pencil'>";
									echo "<a width='0px' href='categories.php?id_update_category=".$row['id_category']."'>";
										echo "<i class='fa fa-pencil fa-2x' aria-hidden='true'></i>";
									echo "</a>";
								echo "</div>";
							}
						}
					}
				}
			}
		}
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>