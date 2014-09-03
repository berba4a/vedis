<?php
//$docroot="D:/SERVER/htdocs/web/vedis/";
$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$product_type = "Чанти";
$product_gender = "Дамски";

/*$_GET['product_type'] because for now is only bags product type set*/
if(isset($_GET['product_type'])&&$_GET['product_type']==1)
{	
	$product_type_arr = $db->getById($_GET['product_type'],'product_type');
	$product_type = $product_type_arr['name'];
}

/*$_GET['product_gender'] >0 <4 because for now we have only 3 genders*/
if(isset($_GET['product_gender'])&&$_GET['product_gender']>0&&$_GET['product_gender']<4)
{	
	$product_gender_arr = $db->getById($_GET['product_gender'],'product_gender');
	$product_gender = $product_gender_arr['name'];
}
$page_title = "Vedis style products";
include_once('includes/header_meta.php');
include_once('includes/slimscroll_scripts.php');
?>
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column'>
					<h1 class='cir' onclick='location.hash="test"'><?php echo $product_gender."&nbsp;".$product_type;?></h1>
					
				</div>
				<?php include_once('includes/right_sidebar.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>