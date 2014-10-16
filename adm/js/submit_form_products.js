/*check form for errors and submit*/
$(document).ready(function()
{
	$('.submit_btn').click(function()
	{
		var errors = 0;
		var allowed_ext = ['jpg','png','gif','bmp'];
		/*check inputs for errors*/
		$('.mandatory').each(function()
		{	
			var value = $(this).val().trim();
			if(value==""||($(this).prop('tagName').toLowerCase()=='select'&&value<0))
			{
				$(this).parents('.input_field').find('label').addClass('red');
				errors++;
			}
			else if($(this).attr('id')=='catalogueID')//Check catalogue ID for exsist val 
			{		
				$.ajax({
					url : '../ajax/check_field.php',
					type : 'GET',
					data : 'value='+value+'&table='+$('#table').val()+'&field_name='+$(this).attr('name')+'&'+$('.pr_key').attr('id')+'='+$('.pr_key').val(),
					async : false,
					success : function(response)
					{
						if(response!='0')
						{
							alert(response);
							$("#catalogueID").val('');
							$("#catalogueID").parents('.input_field').find('label').addClass('red');
							errors++;
						}
					},
					error : function(xhr, status, error){alert($.parseJSON(xhr.responseText));}
				});
			}
			else
			{
				if($(this).parents('.input_field').find('label').hasClass('red'))
				{
					$(this).parents('.input_field').find('label').removeClass('red');
				}
			}
		});	
		
		/*check files for wrong extension*/
		$('input:file').each(function()
		{
			var file_val = $(this).val().trim();
			var ext = "";
			if(file_val=="")
			{
				if($('.input_file').length>1)
				{
					$(this).parents('.input_file').remove();
				}
			}
			else
			{
				ext = file_val.substring(file_val.lastIndexOf('.')+1).toLowerCase();
				if(allowed_ext.indexOf(ext)<0)
				{
					if($('.input_file').length>1)
					{
						$(this).parents('.input_file').remove();
					}
					else
					{
						$(this).val("");
						$(this).parents('.input_file').children('img').remove();
					}
				}
			}
		});
		
		if(errors<1)
		{
			$('#add_adit_form').submit();
		}
		else
		{
			if($('.wrong_fields').length<1)
			{
				$('.input_fields').append('<span class="red wrong_fields">Полетата със * са задължителни</span>');
			}
		}
	});
});

/*Chrome fix for scrolling issue with marked elements*/
$(document).ready(function()
{
	$('input[type="checkbox"]').click(function(){$(this).blur();});
});

/*add files fields*/
$(document).ready(function()
{
	$('.add_files').click(function()
	{
		var div = document.createElement('div');
		$(div).addClass('input_file');
		
		var input = document.createElement('input');
		input.type='file';
		input.id='images[]';
		input.name='images[]';
		$(input).attr('onchange','readURL(this)');
		$(div).append(input);
		$(this).parents('fieldset').find('.input_file').first().before(div);
	});
});

/*preview uploaded image function*/
function readURL(input) 
{	
    if (input.files && input.files[0]) 
	{
        var reader = new FileReader();

        reader.onload = function (e) 
		{
			/*loading icon handling*/
			if($(input).siblings('img.loading_img').length<1)
			{
				/*Put loading icon if nothing is loaded*/
				$(input).before('<img class="loading_img" src="../images/loading.gif" alt="new image" />');
			}
			else
			{
				/*Checks if loaded image existing and put loading icon while changes image*/
				$(input).siblings('img.loading_img').attr('src','../images/loading.gif');
			}
			
			/*end loading icon*/
			
			/*loaded image preview*/
			if($(input).siblings('img').length>0)
			{	
				if(e.target.result)
				{
					$(input).siblings('img.loading_img').attr('src',e.target.result);
				}
			}
			else
			{
				$(input).before('<img class="loading_img" src="'+e.target.result+'" alt="image" />');
			}
        }
		
        reader.readAsDataURL(input.files[0]);
		/*Chrome fix for scrolling issue with marked elements*/
		$(input).blur();
    }
}
