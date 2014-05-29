
/*check form for errors and submit*/
$(document).ready(function()
{
	$('.submit_btn').click(function()
	{
		var errors = 0;
		//var img_errors = 0;
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
					//img_errors++;
					//$(this).parents('.input_file').css('border','2px solid #ff0000');
					//$(this).parents('.input_file').attr('onclick','removeMe(this)');
					errors++;
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
		
		if(errors==0)
		{
			$('#add_adit_form').submit();
		}
		else
		{
			if($('.wrong_fields').length<1)
			{
				$('.input_fields').append('<span class="red wrong_fields">Полетата със * са задължителни</span>');
			}
			/*if($('.wrong_images').length<1&&img_errors>0)
			{
				$('fieldset').append('<span class="red wrong_images">Некоректен формат на изображенията кликни върху маркирания с червено файл за изтриване!</span>');
			}*/
		}
	});
});

/*function removeMe(element)
{
	$(element).remove();
}*/

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
function readURL(input) {

    if (input.files && input.files[0]) 
	{
        var reader = new FileReader();

        reader.onload = function (e) 
		{
			if($(input).siblings('img').length>0)
			{
				$(input).siblings('img').attr('src',e.target.result);
			}
			else
			{
				$(input).before('<img src="'+e.target.result+'" />');
			}
        }

        reader.readAsDataURL(input.files[0]);
		/*Chrome fix for scrolling issue with marked elements*/
		$(input).blur();
    }
}
