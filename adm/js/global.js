$(document).ready(function()
{
	$('.deleteIthem').click(function()
	{
		var ithemID = parseInt($(this).attr('id'));
		
		$(this).parent('td').parent('tr').siblings('tr').each(function()
		{
			if($(this).hasClass('marked'))
			{
				$(this).removeClass('marked');
			}
		});
		$(this).parent('td').parent('tr').addClass('marked');
				
		deleteDialogue(ithemID);
	});
	
	$('.dialogue_close').click(function(){closeDialogue()});
	
	$('.dialogue_buttons.cancel').click(function(){closeDialogue()});
	$('.dialogue_buttons.confirm').click(function()
	{
		var full_id = $(this).attr('id');
		var ithemID = parseInt(full_id.substring(6));
		deleteIthem(ithemID);
	});
	
	$('.dialogue').drags();
});

function deleteDialogue(ithemid)
{
	$('.dialogue').fadeIn('slow',function()
	{
		$('.dialogue_buttons.confirm').attr('id','ithem_'+ithemid);
	});
	$('.dialogue_text').html("Найстина ли искате да изтриете маркирания в червено модел?");
	
}

function closeDialogue()
{
	$('.marked').removeClass('marked');
	$('.dialogue').fadeOut('slow');
}

function deleteIthem(ithemid)
{
	alert('deleting '+ithemid);
}