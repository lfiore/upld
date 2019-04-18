const fileInput = document.getElementById("image-input");
window.addEventListener('paste', e => {
 fileInput.files = e.clipboardData.files;
$('#upload-form').submit();
});

$('#image-input').on('change', function()
{
	var selectImage = $('#select-image');
	var cancelImage = $('#cancel-image');

	selectImage.text('click again to upload ' + $(this).val().replace('C:\\fakepath\\', '')).css({
		'margin-bottom' : '10px',
		'display' : 'block'
	});

	cancelImage.removeClass('hidden');

	selectImage.off();

	selectImage.on('click', function() {
			selectImage.off();
			cancelImage.addClass('hidden');
			$('#upload-form').submit();
			selectImage.text('Your image is uploading, please wait');
		}
	);
});

$('#select-image, #cancel-image').on('click', function()
{
	$('#image-input').click();
});

$('.delete').on('click', function() {
	return confirm('Are you sure? This image WILL BE DELETED');
});

$('#ban').on('click', function() {
	return confirm('Are you sure? This user will be BANNED and ALL OF THEIR IMAGES WILL BE DELETED');
});

$('#links li input').on('click', function()
{
	$(this).select();
});
