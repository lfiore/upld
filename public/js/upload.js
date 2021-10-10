// drag to upload
var fileInput = document.getElementById('image-input');
var urlInput = document.getElementById('select-url-input');
window.addEventListener('paste', e =>
{
	if (e.clipboardData.getData('text/plain') !== '')
	{
		// contains text, could be a URL
		urlInput.value = e.clipboardData.getData('text/plain');
		$('#url-form').submit();
	}
	else
	{
		// contains a file
		fileInput.files = e.clipboardData.files;
		$('#upload-form').submit();
	}
});
 
$('#image-input').on('change', function()
{
	var selectImage = $('#select-image');
	var cancelImage = $('#cancel-image');
	selectImage.text('Clicca ancora per caricare ' + $(this).val().replace('C:\\fakepath\\', '')).css({
		'margin-bottom' : '10px',
		'display' : 'block'
	});
	cancelImage.removeClass('hidden');
	selectImage.off();
	
	selectImage.on('click', function() {
			selectImage.off();
			cancelImage.addClass('hidden');
			$('#upload-form').submit();
			selectImage.text('La tua immagine è in caricamento, attendi');
		}
	);
});
$('#select-image, #cancel-image').on('click', function()
{
	$('#image-input').click();
});
$('.delete').on('click', function() {
	return confirm('Sei sicuro? Questa immagine verrà cancellata');
});
$('#ban').on('click', function() {
	return confirm('Sei sicuro? l\'Utente verrà bannato e tutti le sue immagini verranno cancellate');
});
$('#links li input').on('click', function()
{
	$(this).select();
});