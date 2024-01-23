const submenuOpener = $('[data-open]');
const popupMenu = $('.popup-menu');
const reportPopup = $('.report-popup');
const itemHasChildMobileMenu = $('.main-menu .item-has-child a[href="#"], .main-menu .item-has-child a[href=""], .main-menu .item-has-child .arrow');
const popupOpener = $('[data-popup]');
const popupGeneral = $('.popup-general');

submenuOpener.on('click', function (e) {
    e.preventDefault();
    const currentPopup = $(this).data('open');

    if ($('#' + currentPopup).length > 0) {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('#' + currentPopup).removeClass('active');
            $('body').removeClass('-overflow-hidden');
        } else {
            submenuOpener.removeClass('active');
            popupMenu.removeClass('active');
            $(this).addClass('active');
            $('#' + currentPopup).addClass('active');
            $('body').addClass('-overflow-hidden');
        }
    }
});

popupOpener.on('click', function (e) {
    e.preventDefault();
    const currentPopup = $(this).data('popup');

    if ($('#' + currentPopup).length > 0) {
        $(this).addClass('active');
        $('#' + currentPopup).addClass('active');
        $('body').addClass('-overflow-hidden');
    }
});

itemHasChildMobileMenu.on('click', function (e) {
    if (e.target !== this) return;
    e.preventDefault();

    const parentItem = $(this).closest('.item-has-child');
    const thisSubMenu = parentItem.find('> .sub-menu');

    if (thisSubMenu.length > 0) {
        if (parentItem.hasClass('active')) {
            parentItem.removeClass('active');
            thisSubMenu.slideUp();
        } else {
            parentItem.addClass('active');
            thisSubMenu.slideDown();
        }
    }
});

popupMenu.on('click', function (e) {
    if (e.target !== this) return;

    submenuOpener.removeClass('active');
    popupMenu.removeClass('active');
    $('body').removeClass('-overflow-hidden');
});

popupGeneral.on('click', function (e) {
    if (e.target !== this) return;

    popupGeneral.removeClass('active');
    $('body').removeClass('-overflow-hidden');
});

$(window).on('resize', function () {
    $('.form-select').select2('close');
    submenuOpener.removeClass('active');
    popupMenu.removeClass('active');
    if (popupGeneral.length > 0) {
        popupGeneral.removeClass('active');
    }
    if (reportPopup.length > 0) {
        reportPopup.removeClass('-open');
    }

    $('body').removeClass('-overflow-hidden');
});
