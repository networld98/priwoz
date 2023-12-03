$(document).ready(function() {
    $('.products-masonry').masonry({
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        itemSelector: '.grid-item',
        percentPosition: true,
        // horizontalOrder: true
    }).css('opacity', '1');

    $('.products-masonry.my-products .box').on('click', function (e) {
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.products-masonry.my-products .box').removeClass('active');
            $(this).addClass('active');
        }
    });
});