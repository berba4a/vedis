/*initialize tinycarousel*/

$(document).ready(function()
{
	/*set images height*/
	var overview_height = $('#slider1').height();
	$('#slider1').find('img').css('height',overview_height);
	$('#slider1').find('img').css('width','auto');
	window.setTimeout(function()
	{
		$('#slider1').tinycarousel({
			infinite: false,
			start: 0
			});
	},500);
});


/*initialize zoom*/
$(document).ready(function()
{
	window.setTimeout(function()
	{
		$('#zoom').zoom();
	},500);
});

/*open all accordion items */
$(document).ready(function()
{
	var el_num = 0;
	$('.accordion_ithem').each(function()
	{
		if($(this).css('display')=='none')
		{
			$(this).slideDown(50,function()
			{
				/*make description scrollable , to be removed if no needed*/
				el_num++;
				if(el_num==$('.accordion_ithem').length)
				{
					var height = $('.big_img').height()-5;
					$('.scrollable_descr').slimScroll({
						height: height,
						color: '#979696',
						railVisible: false,
						alwaysVisible: false
					});						
				} 
			});
		}
	});
	
	$('.accordion_link').click(function()
	{
		$(this).siblings('.accordion_ithem').slideToggle('slow');
	});
});


/*set back to list link href*/
function setBackLink(url)
{
	$('.back_link').attr('href',url);
	window.setTimeout(function()
	{
		window.location.hash = "";
	},300);
}

/*change zoomed image*/
$(document).ready(function()
{
	$('#slider1').find('img').click(function()
	{
		var clicked_src = $(this).attr('src');
		$('img.big_img').attr('src',clicked_src);
		$('#zoom').zoom();	
		setZoomArea();
	});
});

/*set zoom image icon position*/
$(document).ready(function()
{
	window.setTimeout(function()
	{
		setZoomArea();
	},600);
});

function setZoomArea()
{
	var zoom_width = $('.zoom').width();
	var img_width = $('img.big_img').width();
	var empty_space = (zoom_width-img_width)/2;
	$('.zoom').css('width',img_width);
	$('.zoom_icon').fadeIn('slow');
	//$('.zoom').css('margin-left',empty_space);
	//$('.zoom_icon').css('right',0);
}