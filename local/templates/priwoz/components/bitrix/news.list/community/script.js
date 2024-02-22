$( document ).ready(function() {
	//Удаляем параметр social при загрузке
	const url = new URL(document.location);
	const searchParams = url.searchParams;
	searchParams.delete("social");
	window.history.pushState({}, '', url.toString());

	$('.social-tabs .social-tab').click(function() {
		let name = $(this).data('name'), currentUrl = $(location).attr('href');
		$('.social-tabs .social-tab').removeClass('active');
		$(this).addClass('active');
		$(".communities-wrap").load(currentUrl +"?social="+name+" #community-section-ajax");

	});
})
$(document).ajaxComplete(function() {
	let grid = $('.grid').masonry({}).css('opacity', '1');
	grid.masonry('reloadItems');
})