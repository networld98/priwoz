$(document).ready(function() {
    $('.communities-masonry').masonry({
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        itemSelector: '.grid-item',
        percentPosition: true,
        horizontalOrder: true
    }).css('opacity', '1');
});