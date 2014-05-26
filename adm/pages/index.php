<?php 
//$doc_root="D:/SERVER/htdocs/web/vedis/";
$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

include_once("includes/DBMYSQL.class.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

$allowed_actions_arr = array('listing','add','edit');

/*variables will be used into the listing , add and edit scripts*/
$tables_arr = $db->getTables();
$db_table_name="products";
$table_prKey ="";
$num_rows = 0;
$action="listing";

if(isset($_GET['table'])&&""!=$_GET['table']&&in_array($_GET['table'],$tables_arr))
	$db_table_name = $_GET['table'];
	
$table_prKey = $db->getPrKey($db_table_name);
$fields_arr = $db->getTableFields($db_table_name);

if(isset($_GET['action'])&&in_array($_GET['action'],$allowed_actions_arr))
	$action = $_GET['action'];


include_once("adm/includes/header.php");
	echo "<div class='body_content'>";
		include_once("adm/includes/".$db_table_name."/".$action.".php");
	echo "</div>";
	
	/*delete confirmation dialogue*/
	echo "<div class='dialogue'></div>";
	
	
include_once("adm/includes/footer.php");
?>
