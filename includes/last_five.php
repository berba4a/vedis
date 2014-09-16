<?php
$pr_key = $db->getPrKey('products');
$typeID = $db->getPrKey('product_type');
$query = "
	SELECT 
	p.".$pr_key.",
	p.catalogueID as catnum,
	p.description as descr ,
	pi.name,
	pt.".$typeID." as typeID
	from products p 
	LEFT JOIN product_images pi ON pi.".$pr_key." = p.".$pr_key."
	INNER JOIN product_type AS pt ON pt.".$typeID."= p.".$typeID."
	WHERE is_active = '1'  
	GROUP BY p.".$pr_key."
	ORDER BY p.release_date , p.last_update DESC
	LIMIT 0,5
	";
$stmt = $db->query($query);
$num_rows = $db->numRows($stmt);
if($num_rows>0)
{
	echo "<ul>";
	while($row = $db->fetchArray($stmt))
	{
		echo "<li>";
			echo "<div class='accordion_link'>";
				echo "<a href='javascript:void(0)'>Модел ".$row['catnum']."</a>";
			echo "</div>";
			echo "<div class='accordion_ithem'>";
				echo "<div class='short_text'>";
					$cut_descr = "";
					if(strlen($row['descr'])>100)
						$cut_descr = substr($row['descr'], 0, strrpos(substr($row['descr'], 0, 100), ' '))."...";
					else
						$cut_descr = $row['descr'];
					echo "<span>".$cut_descr."</span>";
				echo "</div>";
				echo "<a href='".SITE_URL.SITE_ROOT."pages/product_preview.php?".$pr_key."=".$row[$pr_key]."#product_type=".$row['typeID']."'>";
				if(isset($row['name'])&&""!=$row['name'])
					echo "<img src='".SITE_UPOLADS."product_images/".$row['name']."' alt='модел ".$row['catnum']."' title='модел ".$row['catnum']."' />";
				else
					echo "<img src='".SITE_UPOLADS."no_image.png' alt='без изображение' title='без изображение' />";
				echo "</a>";
				echo "<div class='clear'></div>";
				echo "<a class='last_model_link' href='".SITE_URL.SITE_ROOT."pages/product_preview.php?".$pr_key."=".$row[$pr_key]."#product_type=".$row['typeID']."'>&raquo; Виж подробности</a>";
			echo "</div>";
		echo "</li>";
	}
	echo "</ul>";
}
else
	echo "Няма записи в базата данни!";

 ?>