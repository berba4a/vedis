/*right side bar vertical accordion*/
$(document).ready(function()
{
	/*check if the accordion items has to be opened in products they are opened after ajax callback success because after callback they have to be redrawn */
	if(!$('.last_models').hasClass('products'))
	{
		/*initial opening of the first ithem*/
		$('.last_models').find('.accordion_link').first().css('background','url(../images/slider_offer_lineUP.png) no-repeat bottom right')
		$('.last_models').find('.accordion_ithem').first().slideDown('slow');
		$('.last_models').find('.accordion_ithem').first().addClass('active');
		
		/*start accorion*/
		$('.last_models').find('.accordion_link').click(function()
		{
			if(!$(this).next().hasClass('active'))
			{
				$('.last_models').find('.accordion_ithem').each(function()
				{
					if($(this).hasClass('active'))
					{
						$(this).slideUp('slow');
						$(this).removeClass('active');
						$(this).prev().css('background','url(../images/slider_offer_lineDOWN.png) no-repeat bottom right');
					}
				});
				
				$(this).next('.accordion_ithem').addClass('active');
				$(this).css('background','url(../images/slider_offer_lineUP.png) no-repeat bottom right');
				$(this).next('.accordion_ithem').slideDown('slow');
			}
		});
	}
});