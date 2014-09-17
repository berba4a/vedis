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

$page_title='Vedis  преглед на продукт';

include_once('includes/header_meta.php');
?>

<!--tiny carousel-->
<link type='text/css' rel='stylesheet' href='<?php echo SITE_CSS;?>tinycarousel.css' />
<script type='text/javascript' src='<?php echo SITE_JS;?>jquery.tinycarousel.js'></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#slider1').tinycarousel();
	});
</script>

<!--end tiny carousel-->

<!--zoom image-->
<style type='text/css'>
	.zoom {
		height:75%
		width:auto;
		display:block;
		position: relative;
	}
		/* magnifying glass icon */
		.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(../images/icon.png);
		}

		.zoom img {
			display: block;
		}

		.zoom img::selection { background-color: transparent; }
</style>
<script type='text/javascript' src='<?php echo SITE_JS;?>jquery.zoom.min.js'></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#zoom').zoom();
	});
</script>
<!--End zoom image-->



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
	
	/*set back to list link href*/
	$('.back_link').attr('href','<?php echo SITE_URL.SITE_ROOT;?>pages/products.php'+window.location.hash);
	window.setTimeout(function()
	{
		window.location.hash = "";
	},300);
});
</script>
</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='loading'></div>
				<div class='content_column wider'>
					<?php include_once('includes/product_preview_content.php');?>
				</div>
				<?php include_once('includes/right_sidebar_product_preview.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>