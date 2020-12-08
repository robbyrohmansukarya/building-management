$(document).ready(function() {
	$('.wysiwyg').summernote({
		height: 150,
		toolbar: [
			//['style', ['style']], // no style button
			//['style', ['bold', 'italic', 'underline', 'clear']],
			['style', ['bold', 'italic', 'underline']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			//['insert', ['picture', 'link', 'video']],
			['insert', ['link',]],
			['table', ['table']],
			//['help', ['help']] //no help button
		]
	});
});