$(document).ready(function() {
    $('.companies-masonry').masonry({
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        itemSelector: '.grid-item',
        percentPosition: true
    }).css('opacity', '1');

    $('.companies-masonry.my-companies .box').on('click', function (e) {
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.companies-masonry.my-companies .box').removeClass('active');
            $(this).addClass('active');
        }
    });
});