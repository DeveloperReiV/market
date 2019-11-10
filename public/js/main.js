$(function(){
	$('#currency').change(function(){
		window.location = 'currency/change?curr=' + $(this).val();
		console.log($(this).val());
	});
});