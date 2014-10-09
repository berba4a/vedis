<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$main_table_PrKey = $db->getPrKey('products');
$where_clause = " WHERE 1=1 AND products.is_active='1' ";
$db_tables_array = $db->getTables();

$requested_tables = array();


/*construct header*/
$product_type = "Продукти";
$product_gender = "Всички"; 
$product_usage = "";
$header_arr = array('product_gender','product_type','product_usage');
foreach($header_arr as $table)
{
	if(isset($_GET[$table])&&$_GET[$table]!="")
	{
		$product_arr = $db->getById($_GET[$table],$table);
		${$table} = $product_arr['name'];
	}
}
echo "<h1>".$product_gender."&nbsp;".$product_usage."&nbsp;".$product_type."</h1>";
/*End header*/	
	
/*check if into the request has valid tables*/
$hash = "";
foreach($_GET as $key=>$value)
{
	/*create hash query for back link*/
	if($key!='ajax')
		$hash .="#".$key."=".$value;
	
	/*skip no tables parameters*/
	if($key=='ajax'||strpos($key,'date')!==false||$key=='search')
		continue;
	
	/*check for valid tables and create requested tables array*/
	if(in_array($key,$db_tables_array))
	{
		/*check for negative or empty values into the parameters*/
		if($value<0||$value=="")
		{
			echo -1;
			exit;
		}	
		$requested_tables[$key] = $value;
	}
	else
	{
		echo -1;
		exit;
	}
}

if(!empty($requested_tables))
{
	foreach($requested_tables as $key=>$value)
	{
		$table_prKey = $db->getPrKey($key);
		$where_clause .=" AND ".$key.".".$table_prKey." = ".$value;
	}
}


/*creating date filters*/
$date_from = "";
$date_to = "";

if(isset($_GET['date_from'])&&(-1!==strtotime($_GET['date_from'])||false!==$_GET['date_from']))
	$date_from = date(('Y-m-d'),strtotime($_GET['date_from']));
	
if(isset($_GET['date_to'])&&(-1!==strtotime($_GET['date_to'])||false!==$_GET['date_to']))
	$date_to = date(('Y-m-d'),strtotime($_GET['date_to']));
	
if(""!=$date_from&&""!=$date_to)
	$where_clause .= " AND release_date BETWEEN '".$date_from."' AND '".$date_to."' ";
else if(""==$date_from&&""!=$date_to)
	$where_clause .= " AND release_date <='".$date_to."' ";
else if(""!=$date_from&&""==$date_to)
	$where_clause .= " AND release_date >='".$date_from."' ";

/*create search main search TO BE FINISGHED*/
if(isset($_GET['search'])&&""!=$_GET['search'])
	$where_clause .= " AND products.catalogueID =".$_GET['search']." ";
	
$query = " SELECT 
		products.".$main_table_PrKey ." as id,
		products.catalogueID as catalogue_num,
		product_type.name as type_name,
		product_gender.name as gender_name,
		product_usage.name as usage_name,
		products.description as description ,
		products.release_date as rdate,
		products.is_active as activity
		FROM products 
		INNER JOIN product_type ON product_type.".$db->getPrKey('product_type')." = products.".$db->getPrKey('product_type')."
		INNER JOIN product_gender ON product_gender.".$db->getPrKey('product_gender')." = products.".$db->getPrKey('product_gender')."
		INNER JOIN product_usage ON product_usage.".$db->getPrKey('product_usage')." = products.".$db->getPrKey('product_usage')."
		".$where_clause." ORDER BY release_date DESC
	";

$stmt = $db->query($query);
$num_res = $db->numRows($stmt);
if($num_res>0)
{
	echo "<p class='result_num'>Намерени ".$num_res." резултата </p>";
	echo "<div class='scrollable_div'>";
	while($row = $db->fetchObject($stmt))
	{
		echo "<div class='product_containter'>";
		echo "<a href='".SITE_URL.SITE_ROOT."pages/product_preview.php?".$main_table_PrKey."=".$row->id.$hash."'><span>Модел&nbsp;".$row->catalogue_num."</span></a><br />";
		$image = $db->fquery("SELECT name FROM product_images WHERE ".$main_table_PrKey." = ".$row->id." LIMIT 0,1 ");
			echo "<div class='image_containter'>";
				echo "<a href='".SITE_URL.SITE_ROOT."pages/product_preview.php?".$main_table_PrKey."=".$row->id.$hash."'>";
				if(isset($image))
					echo "<img src='".UPLOADED_IMAGES.$image->name."' alt='".$row->catalogue_num."' title ='".$row->catalogue_num."' /></a>" ;
				else
					echo "<img src='".SITE_UPOLADS."no_image.png' alt='Без изображение' title='Без изображение' />";
				echo "</a>";
			echo "</div>";
			echo "<span>".$row->usage_name."</span>";
		echo "</div>";
	}
	echo "</div>";
}
else
	echo "<p>Няма намерени разултати по зададения критерии . Моля променете критериите за филтриране на разултатите!</p>";
?>