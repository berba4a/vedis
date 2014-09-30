$(document).ready(function()
{
	$('.submit_btn').click(function()
	{
		checkSubmitForm();
	});
});

function checkSubmitForm()
{
	alert($('form').serialize());
}