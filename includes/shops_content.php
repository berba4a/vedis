<?php
	$shops_prKey = $db->getPrKey('shops');
	$cities_prKey = $db->getPrKey('cities');
	
	$order = "ORDER BY city ASC";
	
	$query = "SELECT 
		sh.".$shops_prKey." as id,
		sh.name as name,
		sh.is_active,
		c.city_name as city
		FROM shops sh
		INNER JOIN cities c ON c.".$cities_prKey." = sh.".$cities_prKey."
		WHERE sh.is_active = '1' ".$order."
	";
	$stmt = $db->query($query);
	if($db->numRows($stmt)>0)
	{
		echo "<div class='scrollable'>";
		while($row=$db->fetchObject($stmt))
		{
			
			echo "<div class='shop_row'>";
				echo "<a class='shops_prev' href='".SITE_URL.SITE_ROOT."pages/shops_preview.php?".$shops_prKey."=".$row->id."'>";
					echo "<span class='left'>".$row->name."</span><span class='right'>".$row->city."</span>";
					echo "<div class='clear'></div>";
				echo "</a>";
			echo "</div>";
			
		}
		echo "</div>";
	}
	else
		echo "Няма записи в тази таблица!";
?>