<?php
//$doc_root="D:/SERVER/htdocs/web/vedis/";
$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$page_title='Vedis products list';

include_once('includes/header_meta.php');
/*include_once('includes/slimscroll_scripts.php');*/
?>
	<script type='text/javascript' src='<?php echo SITE_JS;?>products.js'></script>
	<script type='text/javascript'>
		$(document).ready(function()
		{
			var site_url = '<?php echo SITE_URL.SITE_ROOT;?>';
			listProducts(site_url,window.location.hash);
			
			$(window).on('hashchange',function() 
			{
				listProducts(site_url,location.hash);
				
				var currUrl = window.location.href+window.location.hash;
				colorLinks(currUrl)
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
				<div class='content_column'></div>
				<?php include_once('includes/right_sidebar_products.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>