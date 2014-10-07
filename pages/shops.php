<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$page_title = "Vedis style магазини";
include_once('includes/header_meta.php');
include_once('includes/slimscroll_scripts.php');
?>
	<script type="text/javascript">
		/*set scrollable area height*/
			$(document).ready(function()
			{
				var column_height = parseInt($('.content_column').css('height'));
				var header_height = parseInt($('.content_column h1').css('height'));
				var height = column_height-header_height-105;
			  $('.scrollable').slimScroll({
					height: height,
					color: '#000000'
			  });
			});
		</script>
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column'>
					<h1 class='cir'>магазини</h1>
					<h3>* ако желаете Вашият магазин да бъде включен в списъка с магазини предлагащи нашите продукти моля свържете се с нас чрез секция <a href='<?php echo SITE_URL.SITE_ROOT;?>pages/contacts.php'>контакти</a></h3>
					<?php include_once('includes/shops_content.php');?>
				</div>
				<?php include_once('includes/right_sidebar.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>