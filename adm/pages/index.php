<?php 
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

include_once("includes/DBMYSQL.class.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

$tables_arr = $db->getTables();
$allowed_actions_arr = array('listing','add','edit');
$db_table_name="";
$table_prKey ="";
$num_rows = 0;
$action="";

if(isset($_GET['table'])&&""!=$_GET['table']&&in_array($_GET['table'],$tables_arr))
	$db_table_name = $_GET['table'];
else
	header("location:".SITE_URL.ADMIN."pages/?table=products");

	
$table_prKey = $db->getPrKey($db_table_name);

if(isset($_GET['action'])&&in_array($_GET['action'],$allowed_actions_arr))
	$action = $_GET['action'];
else
	$action = "listing";

/*$stmt = $db->query("SELECT * FROM ".$db_table_name." ");
$num_rows = $db->numRows($stmt);*/


include_once("adm/includes/header.php");
	echo "<div class='body_content'>";
	switch($action)
	{
		case $allowed_actions_arr[0] :
		{
			echo $action;
			break;
		}
		case $allowed_actions_arr[1] :
		{
			echo $action;
			break;
		}
		case $allowed_actions_arr[2] :
		{
			echo $action;
			break;
		}
	}

	echo "</div>";
include_once("adm/includes/footer.php");
?>
