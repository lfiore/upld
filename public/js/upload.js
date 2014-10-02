$('#image-input').on('change', function()
{
	var selectImageElem = $("#select-image");
	selectImageElem.text('click again to upload ' + $(this).val().replace('C:\\fakepath\\', ''))
			.css('margin-bottom', '10px')
			.css('display', 'block')
			.off()
			.on('click', function() {
				selectImageElem.off();
				$('#cancel-image').css('display', 'none');
				$('#upload-form').submit();
				selectImageElem.text('Your image is uploading, please wait');
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
