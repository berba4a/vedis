
function checkSubmitForm(url)
{
	var err_num = 0;
	$('.mandatory').each(function()
	{
		var curr_val = $(this).val();
		var curr_label = $(this).parents('.input_field').find('label');
		if($.trim(curr_val)==""||$(this).val()<0)
		{
			$(curr_label).addClass('red');
			err_num++;
		}
		else
		{
			if($(curr_label).hasClass('red'))
			{
				$(curr_label).removeClass('red');
			}
		}	
	});
	if(err_num==0)
	{
		$.ajax({
			url:url+'ajax/submit_form_shops.php',
			type : 'GET',
			data : $('#add_edit_form').serialize(),
			beforeSend : function()
			{
				$('.loading').css('display','block');
			},
			success : function(response)
			{
				$('.dialogue').html(response);
				$('.dialogue').fadeIn('slow');
				if(response.indexOf('ГРЕШКА')==-1)
				{
					window.setTimeout(function()
					{
						$('.dialogue').fadeOut('slow',function()
						{
							window.location = url+'pages/?table=shops';
						});
					},2000);
				}
				else
				{
					$('.dialogue').prepend('<div class="dialogue_close" onclick="dialogueClose()"></div>');
				}
			},
			complete : function()
			{
				$('.loading').css('display','none');
			},
			error : function(xhr, status, error)
			{
				alert(error);
			}
		});
	}
}

function dialogueClose()
{
	$('.dialogue').html("");
	$('.dialogue').fadeOut('slow');
}