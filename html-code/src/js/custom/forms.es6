$(document).ready(function() {
    $('.form-select:not(.-with-icon)').select2();
    $('.form-select.-with-icon').select2({
        minimumResultsForSearch: -1
    });
});