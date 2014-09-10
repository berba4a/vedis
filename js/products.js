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
				
				/*make scrollable result area*/
				var column_height = parseInt($('.content_column').css('height'));
				var header_height = parseInt($('.content_column h1').css('height'));
				var height = column_height-header_height-55;
				  $('.scrollable_div').slimScroll({
						height: height,
						color: '#000000',
						railVisible: true,
						alwaysVisible: true
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
					format: 'd-M-Y',
					onSelect : function(value, date)
					{
						createHashQuery('date_from',date,hash);
					},
					onClear : function()
					{
						createHashQuery('date_from',-1,hash);
					}
				});
					
					
				$('input#date_to').Zebra_DatePicker({
					direction : false,
					format: 'd-M-Y',
					pair : $('#date_from'),
					onSelect : function(value, date)
					{
						createHashQuery("date_to",date,hash);
					},
					onClear : function()
					{
						createHashQuery("date_to",-1,hash);
					}
				});
				
				/*initalize inputs onchange*/
				$('.last_models.products').find('input').change(function()
				{
					createHashQuery($(this).attr('name'),$(this).val(),hash);
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

function createHashQuery(param_name,value,hash)
{
	var hash_arr = hash.split("#");
	if(hash.indexOf("#"+param_name)>-1)
	{
		hash="";
		for(var i=1;i<hash_arr.length;i++)
		{
			if(hash_arr[i].indexOf(param_name)>-1)
			{
				if(value!=-1)
				{
					var new_param_val = hash_arr[i].substring(0,hash_arr[i].indexOf("="));
					hash += "#"+new_param_val+"="+value;
				}
			}
			else
			{
				hash+="#"+hash_arr[i];
			}
		}
		
	}
	else
	{
		if(value!==-1)
		{
			hash += "#"+param_name+"="+value;
		}
	}
	 window.location.hash = hash;
	 if(hash.indexOf('product_gender')>-1)
	 {
		$('.parent_submenu').siblings('ul').slideDown('slow');
	 }
	 else
	 {
		$('.parent_submenu').siblings('ul').slideUp('slow');
	 }
}	