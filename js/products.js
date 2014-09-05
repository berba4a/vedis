function listProducts(url,hash)
{
	var url_request_string="";
	if(hash!='')
	{
		var url_arr = hash.split('#');
		for(var i=1;i<url_arr.length;i++)
		{
			url_request_string += "&"+url_arr[i];
		}
	}
	
	/*list items*/
	$.ajax({
		url : url+'ajax/products_listing.php',
		method : 'GET' ,
		data : 'ajax=1'+url_request_string,
		beforeSend : function()
		{
			$('.loading').css('display','block');
		},
		complete : function()
		{
			$('.loading').css('display','none');
		},
		success : function(response)
		{
			if(response!=-1)
			{
				$('.content_column').html(response);
			}
			else
			{
				alert('invalid hash parameter');
			}
		},
		error : function(error)
		{
			alert(error);
		}
	});
	
	/*draw filters*/
	$.ajax({
		url : url+'ajax/product_filters.php',
		method : 'GET' ,
		data : 'ajax=1'+url_request_string,
		success : function(response)
		{
			if(response!=-1)
			{
				$('.last_models.products').html(response);
				/*show filters*/
				$('.last_models').find('.accordion_ithem').each(function()
				{
					$(this).slideDown(50);
				});
				$('.last_models').find('.accordion_link').click(function()
				{
					$(this).next().slideToggle('slow');
				});
				
				/*initialize datapickers*/
				$('input#date_from').Zebra_DatePicker({
						direction:false,
						format: 'd-M-Y'
					});
					
					
				$('input#date_to').Zebra_DatePicker({
					direction : false,
					format: 'd-M-Y',
					pair : $('#date_from')
				});
				
				/*initalize inputs onchange*/
				$('.last_models.products').find('input').change(function()
				{
					createHashQuery();
				});
				$('.Zebra_DatePicker').find('table.dp_daypicker,table.dp_footer tr td').click(function()
				{	
					if($('.Zebra_DatePicker').css('display')=='none')
					{
						$('input.datepicker').each(function()
						{
							if($(this).is(':focus'))
							{
								$(this).blur();
							}
						});
					}
				});
				$('input.datepicker').on('blur',function()
				{
					alert($(this).val());
					createHashQuery();
				});
			}
			else
			{
				alert('invalid hash parameter');
			}
		},
		error : function(error)
		{
			alert(error);
		}
	});
}

function createHashQuery()
{
	alert("creating query");
}	