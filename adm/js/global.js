$(document).ready(function()
{
	/*on delete item button click show dialogue panel with proper parameters*/
	$('.deleteIthem').click(function()
	{
		var table = $(this).attr('table');
		var ithemID = $(this).attr('id');
		var prKey = $(this).attr('pr_key');
		//var full_id = $(this).attr('id');
		//var prKey = full_id.substring(0,full_id.indexOf('_'));
		//var ithemID = parseInt(full_id.substring(full_id.indexOf('_')+1));
		
		/*remove marker if some other field is marked*/
		$(this).parents('.parent_mark').siblings('.parent_mark').each(function()
		{
			if($(this).hasClass('marked'))
			{
				$(this).removeClass('marked');
			}
		});
		$(this).parents('.parent_mark').addClass('marked');
				
		deleteDialogue(ithemID,prKey,table);
	});
	
	/*make dialogue panel draggable*/
	$('.dialogue').drags();
});

function deleteDialogue(ithemid,prkey_name,table)
{
	$.ajax({
		url : '../ajax/delete_record.php',
		type : 'POST',
		data : 'show_dialog=1&table='+table+'&pr_key='+prkey_name+'&'+prkey_name+'='+ithemid+'',
		success : function(response)
		{
			$('.dialogue').html(response);
			$('.dialogue').fadeIn('slow');
		}
	});
}

function closeDialogue()
{
	$('.marked').removeClass('marked');
	$('.dialogue').fadeOut('slow');
}

/*deleting ithem*/
function deleteIthem()
{
	$.ajax({
		url : '../ajax/delete_record.php',
		type : 'POST',
		data : $('#delete_form').serialize(),
		success : function(response)
		{
			$('.dialogue').html("<div class='dialogue_text'>"+response+"</div>");
			window.setTimeout(function()
			{
				$('.dialogue').fadeOut('slow');
				if($('.err_msg').length==0)
				{
					$('.marked').remove();
				}
				else
				{
					$('tr.marked').removeClass('marked');
				}
			},2000);
		},
		error : function(error)
		{
			$('.dialogue').html(error);
		}
	});
}