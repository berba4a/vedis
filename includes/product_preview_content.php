<?php
/*all tables primary keys names are defined into the product preview.php script*/
$header = "";
$sub_header = "";
if(isset($_GET[$main_prKey])&&""!=$_GET[$main_prKey]&&$_GET[$main_prKey]>0)	
{
	$query = "
		SELECT
		p.catalogueID as catNum,
		pu.name as usе_type,
		pg.name as gender,
		pt.name as type
		FROM products p 
		INNER JOIN product_usage AS pu ON pu.".$usageID." = p.".$usageID."
		INNER JOIN product_gender AS pg ON pg.".$genderID." = p.".$genderID."
		INNER JOIN product_type AS pt ON pt.".$typeID." = p.".$typeID."
		WHERE p.is_active = '1' AND p.".$main_prKey." = ".$_GET[$main_prKey]."
	";
	$stmt = $db->query($query);
	if($db->numRows($stmt)>0)
	{
		while($row = $db->fetchObject($stmt))
		{
			$header = "Модел &nbsp;".$row->catNum;
			$sub_header = $row->gender."&nbsp;".$row->usе_type."&nbsp;".$row->type;
		}
	}
	else
		$header .= "Няма продукт с такъв номер !"; 
}
else
	$header .= "Невалиден продуктов номер !";	
	

echo "<a class='back_link' href='#' >&laquo; Обратно в списъка</a>";
echo "<h1>".$header."</h1>";
echo "<h2>".$sub_header."</h2>";

/*images*/
echo "<div class='images_holder'>";
	$img_stmt = $db->query("
		SELECT name FROM product_images WHERE ".$main_prKey." = ".$_GET[$main_prKey]."
	");
	if($db->numRows($img_stmt)>0)
	{
		$img_cnt = 0;
		while($img_row = $db->fetchObject($img_stmt))
		{
			$img_cnt++;
			if($img_cnt==1)
			{
				echo "<div class='zoom' id='zoom'>";
					echo "<img class='big_img' src='".UPLOADED_IMAGES.$img_row->name."' alt='' title='' />";
					echo "<div class='zoom_icon'></div>";
				echo "</div>";
				
				echo "<div id='slider1'>";
					echo "<a class='buttons prev' href='#'>&nbsp;</a>";
					echo "<div class='viewport'>";
						echo "<ul class='overview'>";
			}
					
							echo "<li><img src='".UPLOADED_IMAGES.$img_row->name."' alt='снимка ".$img_row->name."' title='снимка ".$img_row->name."' /></li>";
		}
							/*fix in order t osee the last image in tinycarousel*/
							echo "<li>&nbsp;</li>";
						echo "</ul>";
					echo "</div>";
					echo "<a class='buttons next' href='#'>&nbsp;</a>";
				echo "</div>";
	}
	else
		echo "<img class='big_img' src='".SITE_UPOLADS."no_image.png' alt='Няма изображение' title='Няма изображение' />";
echo "</div>";
?>

