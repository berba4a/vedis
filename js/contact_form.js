/*open right sidebar items*/
$(document).ready(function()
{
	$('.accordion_ithem').each(function()
	{
		$(this).slideDown(500);
	});
});

/*clear form*/
$(document).ready(function()
{
	$('#clear_btn').click(function()
	{
		$('#contact_form').trigger('reset');
	});
});

/*check phone number*/
$(document).ready(function()
{
	$('#phone').keypress(function(event) 
	{
		  if ( event.which == 13 ) 
		  {
			 event.preventDefault();
		  };
		  var unicode=event.keyCode? event.keyCode : event.charCode;
		  if(unicode<48||unicode>57)
		  {
			alert("Въведения символ не е число!\nМоля въведете число!");
			event.preventDefault();
		  }
	 }); 
});

/*submit form*/
$(document).ready(function()
{
	$('#submit_btn').click(function()
	{
		var err_num = 0;
		$('#contact_form').find('.mandatory').each(function()
		{
			var curr_id = $(this).attr('id');
			if($.trim($(this).val())=="")
			{
				err_num++;
				$('#'+curr_id+'_label').addClass('red');
			}
			else
			{
				if($('#'+curr_id+'_label').hasClass('red'))
				{
					$('#'+curr_id+'_label').removeClass('red');
				}
			}
		});
		
		var mail_err = false;
		if($.trim($('#mail').val())!='')
		{
			mail_err = true;
			var email = $.trim($('#mail').val());
			filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(filter.test(email))
			{
				if($('#mail_label').hasClass('red'))
				{
					$('#mail_label').removeClass('red');
				}
				mail_err = false;
			}
			else
			{
				err_num++;
				if(!$('#mail_label').hasClass('red'))
				{
					$('#mail_label').addClass('red');
				}
			}
		}
		
		if(err_num<1)
		{			
			if($('.warning').css('display')=='block')
			{
				$('.warning').css('display','none');
			}
			$.ajax({
				url: SITE_URL+SITE_ROOT+'ajax/submit_contact_form.php',
				type:'GET',
				data : $('#contact_form').serialize(),
				beforeSend:function()
				{
					$('.loading').css('display','block');
				},
				success:function(response)
				{
					$('#form').html(response);
				},
				complete : function()
				{
					$('.loading').css('display','none');
				},
				error:function(xhr, status, error)
				{
					alert(error);
				}
			});
		}
		else
		{
			if($('.warning').css('display','none'))
			{
				$('.warning').css('display','block');
				if(mail_err===false)
				{
					$('#invalid_email').css('display','none');
				}
			}
		}
	});
});