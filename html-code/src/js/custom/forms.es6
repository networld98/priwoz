$(document).ready(function () {
    $('.form-select').each(function () {
        let classes = $(this).attr('class');
        let clearClasses = classes.replace('form-select', '');
        if ($(this).hasClass('-with-icon') || $(this).hasClass('-without-search')) {
            $(this).select2({
                minimumResultsForSearch: -1,
                templateResult: formatState,
                dropdownCssClass: clearClasses,
                language: {
                    noResults: function() {
                        return "Ничего не найдено";
                    }
                }
            });
        } else {
            $(this).select2({
                templateResult: formatState,
                dropdownCssClass: clearClasses,
                language: {
                    noResults: function() {
                        return "Ничего не найдено";
                    }
                }
            });
        }
    });

    $('.form-select').on('select2:open', function (e) {
        if($(this).hasClass('-location')) {
            let select2 = $(this).data('select2');
            let dropdown = select2.dropdown.$dropdown;
            let dropdownPosition = dropdown.parent().css('top');
            let dropdownList = dropdown.find('.select2-results');

            let newPositionValue = parseInt(dropdownPosition, 10) + 21;
            let newDropdownPosition = newPositionValue + 'px';

            $('body').addClass('-overflow-hidden');
            dropdownList.css('top', newDropdownPosition);
        }
    });
    $('.form-select').on('select2:close', function (e) {
        if($(this).hasClass('-location')) {
            $('body').removeClass('-overflow-hidden');
        }
    });

    $("body").on("click", ".select2-dropdown.-location .select2-results", function(e) {
        if (e.target !== this) return;
        $('.form-select').select2('close');
    });

    $(".toggle-password-button").on("click", function () {
        const passwordInput = $(this).siblings("input");
        const eyeIcon = $(this).parent().find(".icon");
        togglePasswordVisibility(passwordInput, eyeIcon);
    });
});

function togglePasswordVisibility(passwordInput, eyeIcon) {
    if (passwordInput.attr("type") === "password") {
        passwordInput.attr("type", "text");
        eyeIcon.removeClass("icon-eye").addClass("icon-eye-off");
    } else {
        passwordInput.attr("type", "password");
        eyeIcon.removeClass("icon-eye-off").addClass("icon-eye");
    }
}


function formatState(state) {
    var count = $(state.element).data('count');
    if (!count) {
        return state.text;
    }

    var $state = $('<span class="text">' + state.text + '</span> <span class="count">' + count + '</span>');

    return $state;
};