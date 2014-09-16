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
?>