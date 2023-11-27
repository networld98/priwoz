$(document).ready(function() {
    $('.companies-masonry').masonry({
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        itemSelector: '.grid-item',
        percentPosition: true
    }).css('opacity', '1');
});