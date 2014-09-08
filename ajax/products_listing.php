<?php
//$doc_root="D:/SERVER/htdocs/web/vedis/";
$doc_root="C:/xampp/htdocs/web/vedis/";
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
$header_arr = array('product_gender','product_type');
foreach($header_arr as $table)
{
	if(isset($_GET[$table])&&$_GET[$table]!="")
	{
		$product_arr = $db->getById($_GET[$table],$table);
		${$table} = $product_arr['name'];
	}
}
echo "<h1>".$product_gender."&nbsp;".$product_type."</h1>";
/*End header*/	
	
/*check if into the request has valid tables*/
foreach($_GET as $key=>$value)
{
	/*skip no tables parameters*/
	if($key=='ajax'||strpos($key,'date')!==false)
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


$query = " SELECT 
		products.".$main_table_PrKey ." as id,
		products.catalogueID as catalogue_num,
		product_type.name as type_name,
		product_gender.name as gender_name,
		product_usage.name as usage_name,
		products.description as description ,
		products.release_date as date,
		products.is_active as activity
		FROM products 
		INNER JOIN product_type ON product_type.".$db->getPrKey('product_type')." = products.".$db->getPrKey('product_type')."
		INNER JOIN product_gender ON product_gender.".$db->getPrKey('product_gender')." = products.".$db->getPrKey('product_gender')."
		INNER JOIN product_usage ON product_usage.".$db->getPrKey('product_usage')." = products.".$db->getPrKey('product_usage')." ".$where_clause."
	";

$stmt = $db->query($query);
while($row = $db->fetchObject($stmt))
{
	var_dump($row);
	echo "<be />------------------------------------<br />";
}
?>