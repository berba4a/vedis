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
	$.ajax({
		url : url+'ajax/products_listing.php',
		method : 'GET' ,
		data : 'ajax=1'+url_request_string,
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
}