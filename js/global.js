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
		if(radio_value=='product')
		{
			new_value = "Продукт";
		}
		if(radio_value=='shop')
		{
			new_value = "Магазин";
		}
		$('.search_form').find('input[type="text"]').attr('placeholder','търси : '+new_value);
	});
});

/*show hide submenus*/
$(document).ready(function()
{
	$('.parent_submenu').click(function()
	{
		$(this).siblings('ul').slideToggle('slow');
	});
});