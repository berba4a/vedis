<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$shops_prKey = $db->getPrKey('shops');

$page_title = "Vedis style преглед на магазин";
include_once('includes/header_meta.php');
//include_once('includes/slimscroll_scripts.php');
?>
	<!--script type="text/javascript">
		/*set scrollable area height*/
			$(document).ready(function()
			{
				var column_height = parseInt($('.content_column').css('height'));
				var header_height = parseInt($('.content_column h1').css('height'));
				var height = column_height-header_height-55;
			  $('.scrollable').slimScroll({
					height: height,
					color: '#000000'
			  });
			});
		</script-->
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column'>
					<?php include_once('includes/shops_preview_content.php');?>
				</div>
				<?php include_once('includes/right_sidebar.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>