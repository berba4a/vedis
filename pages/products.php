<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$page_title='Vedis style Продукти';

include_once('includes/header_meta.php');
include_once('includes/slimscroll_scripts.php');
?>
	<script type='text/javascript' src='<?php echo SITE_JS;?>products.js'></script>
	<script type='text/javascript'>
		$(document).ready(function()
		{
			var site_url = '<?php echo SITE_URL.SITE_ROOT;?>';
			listProducts(site_url,window.location.hash);
			
			$(window).on('hashchange',function() 
			{
				listProducts(site_url,window.location.hash);
				var currUrl = window.location.href;
				colorLinks(currUrl);				
				
				/*if(currUrl.indexOf('product_gender')>-1)
				{
					$('.parent_submenu').siblings('ul').slideDown('slow');
				}
				else
				{
					$('.parent_submenu').siblings('ul').slideUp('slow');
				}*/
			});
			if(window.location.href.indexOf('product_gender')>-1)
			{
				$('.parent_submenu').siblings('ul').slideDown('slow');
			}
			else
			{
				$('.parent_submenu').siblings('ul').slideUp('slow');
			}
		});
	</script>
	</head>
	<body>
		<div class='main_wrapper'>
			<?php
			$season = 's';
			if(9<intval(date('m'))||intval(date('m'))<5)
				$season = 'w';
			echo "<img class='bg' src='".SITE_IMG."background_images/products_".$season.".png' />";
		?>
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/overlay.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='loading'></div>
				<div class='content_column wider'></div>
				<?php include_once('includes/right_sidebar_products.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>