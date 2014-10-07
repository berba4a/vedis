<?php 
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

include_once("includes/DBMYSQL.class.php");
include_once("includes/Utils.class.php");
/*database connect object*/
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

$allowed_actions_arr = array('listing','add','edit');

/*variables will be used into the listing , add and edit scripts*/
$tables_arr = $db->getTables();
$db_table_name=DEFAULT_TABLE;
$table_prKey ="";
$num_rows = 0;
$action="listing";

/*check if proper table is passed and redirect if not*/
if(isset($_GET['table'])&&""!=$_GET['table']&&in_array($_GET['table'],$tables_arr))
	$db_table_name = $_GET['table'];
else if(isset($_GET['table'])&&""!=$_GET['table']&&!in_array($_GET['table'],$tables_arr))
	header("location:".SITE_URL.ADMIN."pages/?table=".DEFAULT_TABLE."");
else
	header("location:".SITE_URL.ADMIN."pages/?table=".DEFAULT_TABLE."");

/*get passed table primary key and fields*/	
$table_prKey = $db->getPrKey($db_table_name);
$fields_arr = $db->getTableFields($db_table_name);
 
/*check if allowed action is passed and redirects if not*/
if(isset($_GET['action'])&&in_array($_GET['action'],$allowed_actions_arr))
{
	$excluded_arr = array('listing');
	if(in_array($_GET['action'],array_diff($allowed_actions_arr,$excluded_arr)))
		$action = "add_edit_form";
}
else if(isset($_GET['action'])&&!in_array($_GET['action'],$allowed_actions_arr))
	header('location:'.SITE_URL.ADMIN.'pages/?table='.$db_table_name.'');

	
/*start output*/
include_once("adm/includes/header.php");
	echo "<div class='body_content'>";
		/*show message from submit*/
		if(isset($_POST['msg'])&&""!=$_POST['msg'])
			echo $_POST['msg'];
		
		/*includes proper script*/
		include_once("adm/includes/".$db_table_name."/".$action.".php");
	echo "</div>";
	
	/*delete confirmation dialogue*/
	echo "<div class='dialogue'></div>";
	
include_once("adm/includes/footer.php");
?>
