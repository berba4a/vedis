/*add selected class to lateral menu TO BE REDONE*/
$(document).ready(function()
{
	var currUrl = window.location.href;
	colorLinks(currUrl);
	
});


/*color Links*/
function colorLinks(url)
{
	$('.lateral_menu').find('li').each(function()
	{
		var curr_id="";
		if($(this).attr('id'))
		{
			curr_id = $(this).attr('id');
		}
		if(url.indexOf(curr_id)>-1&&curr_id!='home')
		{
			$(this).addClass('selected');
		}
		else if(curr_id == "home"&&url.indexOf(".php")==-1)
		{
			$(this).addClass('selected');
		}
		else
		{
			if($(this).hasClass('selected'))
			{
				$(this).removeClass('selected')
			}
		}
	});
}

/*set bottom_link icons division width*/
$(document).ready(function()
{
	var width = $('.bottom_link').parent('.lateral_column').css('width');
	$('.bottom_link').css('width',width);
});

/*change placeholder for search input*/
$(document).ready(function()
{
	$('.search_form').find('input[type="radio"]').change(function()
	{
		var radio_value = $('.search_form').find('input[type="radio"]:checked').attr('value');
		var new_value = '';
		//var action = '';
		if(radio_value=='product')
		{
			new_value = "Продукт";
			//action = 'product.php';
		}
		if(radio_value=='shop')
		{
			new_value = "Магазин";
			//action = 'shop.php';
		}
		$('.search_form').find('input[type="text"]').attr('placeholder','търси : '+new_value);
		//$('.search_form').find('form').attr('action',action);
	});
});

/*submit simple search form*/
$(document).ready(function()
{
	$('#form_submit').click(function()
	{
		$(this).parent('form').submit();
	});
});


/*show hide submenus*/
$(document).ready(function()
{
	/*var currUrl = window.location.href;
	if(currUrl.indexOf('products.php')>-1)
	{
		
	}*/
	$('.parent_submenu').click(function()
	{
		$(this).siblings('ul').slideToggle('slow',function()
		{
			if($(this).css('display')=='none')
			{
				$('span.arrow').html('&#x25BE;');
			}
			else
			{
				$('span.arrow').html('&#x25B4;');
			}
		});
	});
});