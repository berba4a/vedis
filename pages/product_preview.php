<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";;
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

$page_title='Vedis  преглед на продукт';

include_once('includes/header_meta.php');
include_once('includes/slimscroll_scripts.php');
?>

<!--tiny carousel-->
<link type='text/css' rel='stylesheet' href='<?php echo SITE_CSS;?>tinycarousel.css' media="screen" />

<script type='text/javascript' src='<?php echo SITE_JS;?>jquery.tinycarousel.js'></script>
<script type='text/javascript' src='<?php echo SITE_JS;?>jquery.zoom.min.js'></script>
<script type='text/javascript' src='<?php echo SITE_JS;?>product_preview.js'></script>



<!--zoom image-->
<style type='text/css'>
	.zoom {
		height:100%
		width:auto;
		margin:0 auto;
		display:block;
		position: relative;
		/*background:url(../images/transp_white_backgr.png) repeat;*/
	}
		/* magnifying glass icon */
		.zoom .zoom_icon {
			content:'';
			display:none; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(../images/icon.png);
			z-index:999;
		}

		.zoom img {
			display: block;
		}

		.zoom img::selection { background-color: transparent; }
</style>
<script type='text/javascript'>
	$(document).ready(function()
	{
		var hash = window.location.hash;	
		/*add product type=1 for bags ,to be removed if more type of products are added*/
		if(hash.indexOf('product_type')==-1)
		{
			hash +='#product_type=1';
		}
		setBackLink('<?php echo SITE_URL.SITE_ROOT;?>pages/products.php'+hash);
	});
</script>

</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column wider'>
					<?php include_once('includes/product_preview_content.php');?>
				</div>
				<?php include_once('includes/right_sidebar_product_preview.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>