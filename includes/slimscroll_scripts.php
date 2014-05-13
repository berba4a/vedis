		<link type='text/css' rel='stylesheet' href='<?php echo SITE_CSS;?>prettify.css' />
		<script type='text/javascript' src='<?php echo SITE_JS;?>prettify.js'></script>
		<script type='text/javascript' src='<?php echo SITE_JS;?>jquery.slimscroll.min.js'></script>		
		<script type="text/javascript">
		/*set scrollable area height*/
			$(document).ready(function()
			{
				var column_height = parseInt($('.content_column').css('height'));
				var header_height = parseInt($('.content_column h1').css('height'));
				var height = column_height-header_height-55;
			  $('.content_column p').slimScroll({
					height: height,
					color: '#000000'
			  });
			});
		</script>