$( document ).ready(function() {
	//Удаляем параметр social при загрузке
	const url = new URL(document.location);
	const searchParams = url.searchParams;
	searchParams.delete("social");
	window.history.pushState({}, '', url.toString());

	$('.social-tabs .social-tab').click(function() {
		let name = $(this).data('name'), currentUrl = $(location).attr('href');
		if( $(this).hasClass("active")){
			$(".community-overview-section").load(currentUrl+" #community-section-ajax");
		}else{
			$(".community-overview-section").load(currentUrl +"?social="+name+" #community-section-ajax");
		}

	});
})
$(document).ajaxComplete(function() {
	let grid = $('.grid').masonry({}).css('opacity', '1');;
	grid.masonry('reloadItems');
	$('.social-tabs .social-tab').click(function() {
		let name = $(this).data('name'), currentUrl = $(location).attr('href');
		if( $(this).hasClass("active")){
			$(".community-overview-section").load(currentUrl+" #community-section-ajax");
		}else{
			$(".community-overview-section").load(currentUrl +"?social="+name+" #community-section-ajax");
		}
	});
})