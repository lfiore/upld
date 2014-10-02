$('#image-input').on('change', function()
{
	$('#select-image').text('click again to upload ' + $(this).val().replace('C:\\fakepath\\', ''));

	$('#select-image').css('margin-bottom', '10px');

	$('#cancel-image').css('display', 'block');

	$('#select-image').off();

	$('#select-image').on('click', function()
	{
		$('#select-image').off();
		$('#cancel-image').css('display', 'none');
		$('#upload-form').submit();
		$('#select-image').text('Your image is uploading, please wait');
	});
});

$('#select-image, #cancel-image').on('click', function()
{

	$('#image-input').click();

});

$('#links li input').on('click', function()
{
	$(this).select();
});