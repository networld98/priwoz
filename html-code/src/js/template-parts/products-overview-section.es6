$('.products-overview-section [data-collapsed]').on('click', function (e) {
    let content_id = $(this).data('collapsed');
    if($(this).hasClass('active')) {
        $(this).removeClass("active");
        $(content_id).slideUp();
    } else {
        $('.products-overview-section .collapsed-content').slideUp();
        $('.products-overview-section [data-collapsed]').removeClass("active");
        $(this).addClass("active");
        $(content_id).slideDown();
    }

});

$(window).resize(function () {
    $('.products-overview-section  [data-collapsed]').removeClass("active");
    $('.products-overview-section  .collapsed-content').removeAttr("style");
});