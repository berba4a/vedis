<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

/*tables primary keys*/
$main_prKey = $db->getPrKey('products');
$typeID = $db->getPrKey('product_type');
$genderID = $db->getPrKey('product_gender');
$usageID = $db->getPrKey('product_usage');

$page_title='Vedis products preview';

include_once('includes/header_meta.php');
?>
<script type='text/javascript'>
	/*open all accordion items */
$(document).ready(function()
{
	$('.accordion_ithem').each(function()
	{
		if($(this).css('display')=='none')
		{
			$(this).slideDown(50);
		}
	});
	
	$('.accordion_link').click(function()
	{
		$(this).siblings('.accordion_ithem').slideToggle('slow');
	});
});
</script>
</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='loading'></div>
				<div class='content_column wider'></div>
				<?php include_once('includes/right_sidebar_product_preview.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>