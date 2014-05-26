$(document).ready(function()
{
	$('.deleteIthem').click(function()
	{
		var ithemID = parseInt($(this).attr('id'));
		deleteDialogue(ithemID);
	});
});

function deleteDialogue(ithemid)
{
	alert("deleting "+ithemid);
}