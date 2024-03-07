function favoriteInit() {
    var favorites = document.querySelectorAll('.js-favorite');
    favorites.forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            var iblockId = item.getAttribute('data-iblock-id');
            var favoriteEntity = item.getAttribute('data-favorite-entity');
            if (typeof iblockId === "undefined") {
                console.log('attribute `data-iblock-id` undefined');
                return;
            }
            if (typeof favoriteEntity === "undefined") {
                console.log('attribute `data-favorite-entity` undefined');
                return;
            }
            BX.ajax.runAction('neti:favorite.controllers.favorite.sendData', {
                data: {
                    favoriteEntityId: favoriteEntity,
                    iblockId: iblockId
                }
            }).then(function (response) {
                var addClasses = response.data.classAdd.split(' ');
                var removeClasses = response.data.classDelete.split(' ');
                removeClasses.forEach(function (cssClass) {
                    item.classList.remove(cssClass);
                });
                addClasses.forEach(function (cssClass) {
                    item.classList.add(cssClass);
                });
                var count = document.querySelector('#neti_favorites_equation .count');
                if (count) {
                    count.textContent = response.data.count;
                }
                BX.onCustomEvent('controllers-netiFavoriteSendData:success', response);
            })["catch"](function (response) {
                console.log(response);
                BX.onCustomEvent('controllers-netiFavoriteSendData:error', response);
            });
        });
    });
    BX.ajax.runAction('neti:favorite.controllers.favorite.setStatus', {
        method: 'get',
        data: {}
    }).then(function (response) {
        var count = document.querySelector('#neti_favorites_equation .count');
        if (count) {
            count.textContent = response.data.ids.length;
        }
        var favorites = document.querySelectorAll('.js-favorite');
        favorites.forEach(function (item) {
            if (response.data.ids === []) {
                return true;
            }
            var elementId = item.getAttribute('data-favorite-entity');
            var ids = response.data.ids;
            var elementFound = false;
            ids.forEach(function (id) {
                if (elementId == id) {
                    elementFound = true;
                }
            });

            // Удаляем класс по умолчанию
            var removeClasses = response.data.removeClass.split(' ');
            removeClasses.forEach(function (cssClass) {
                item.classList.remove(cssClass);
            });

            //Добавляем класс товарам из избранного
            var addClasses = response.data.addClass.split(' ');
            if (elementFound) {
                addClasses.forEach(function (cssClass) {
                    item.classList.add(cssClass);
                });
                return;
            }

            //Добавляем класс товарам которые не в избранном
            removeClasses.forEach(function (cssClass) {
                item.classList.add(cssClass);
            });
        });
        BX.onCustomEvent('controllers-netiFavoriteSetStatus:success', response);
    })["catch"](function (response) {
        console.log(response);
        BX.onCustomEvent('controllers-netiFavoriteSetStatus:error', response);
    });

    let cleanButton = document.querySelector('.js-favorite-clean');
    if (cleanButton) {
        cleanButton.addEventListener('click', (e) => {
            e.preventDefault();
            BX.ajax.runAction('neti:favorite.controllers.favorite.allClean', {
                method: 'post',
                data: {}
            }).then(function (response) {
                var count = document.querySelector('#neti_favorites_equation .count');
                if (count) {
                    count.textContent = 0;
                }
                location.reload();
                BX.onCustomEvent('controllers-netiFavoriteAllClean:success')
            })["catch"](function (response) {
                console.log(response)
                BX.onCustomEvent('controllers-netiFavoriteAllClean:error')
            })
        })
    }
}

function deleteItem(id,iblock){
    let result = confirm("Вы уверены, что хотите удалить обьявление или компанию?");
    let block = $('.grid.products-masonry.my-products');
    if (result) {
        $.ajax({
            type: "POST",
            url: '/ajax/delete-announcement.php',
            data: {'id':id, 'iblock':iblock},
            success: function (data) {
                alert('Если от имени компании были созданы объявления, они будут деактивированы и привязаны к вашему пользователю. Позже вы их можете подвязать к новой компании или просто активировать!');
                // Вывод текста результата отправки
                $(block).html(data);
                let grid = $('.grid').masonry({}).css('opacity', '1');
                grid.masonry('reloadItems');
            }
        });
    }
    return false;
}
function editItem(id,iblock,active){
        let block = $('.grid.products-masonry.my-products');
        $.ajax({
            type: "POST",
            url: '/ajax/disabled-announcement.php',
            data: {'id':id, 'iblock':iblock,'active':active},
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
                let grid = $('.grid').masonry({}).css('opacity', '1');
                grid.masonry('reloadItems');
            }
        });
        return false;
}
$( document ).ready(function() {
    'use strict';

    ;( function ( document, window, index )
    {
        var inputs = document.querySelectorAll( '.inputfile' );
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    label.querySelector( 'span' ).innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });

            // Firefox bug fix
            input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
            input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
        });
        var inputs = document.querySelectorAll( '.typefile' );
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    label.querySelector( 'span' ).innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });

            // Firefox bug fix
            input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
            input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
        });
    }( document, window, 0 ));
    Fancybox.bind('[data-fancybox="gallery"]', {
        // Your custom options for a specific gallery
    });
    $(".filter-sort").change(function () {
        let url = $(this).val();
        $("#products-wrap").load(url +" #products-masonry");
    })
    $(".btn-refresh").click(function () {
        let currentUrl = $(location).attr('href'), searchParams = new URLSearchParams(window.location.search);
        if(searchParams.has('arrFilter_527') == true){
            $("#products-wrap").load(location.protocol + '//' + location.host + location.pathname +"?del_filter=Сбросить #products-masonry");
            $("#smartFilterAds").load(location.protocol + '//' + location.host + location.pathname +"?del_filter=Сбросить #smartFilterAds-block");
        }else{
            $("#products-wrap").load(currentUrl +"?del_filter=Сбросить #products-masonry");
            $("#smartFilterAds").load(currentUrl +"?del_filter=Сбросить #smartFilterAds-block");
        }
    });
    $(".add-to-favourite").click(function () {
        setTimeout(function(){
            let currentUrl = $(location).attr('href');
            $("#favorite-header-block").load(currentUrl+" #favorite-header");
        }, 500);
     });
    $('.item-phone').mask('+399 99 999 99 99');
    $('.item-dopphone').mask('+399 99 999 99 99');

    $('.delete-img').change(function() {
        if ($(this).is(':checked')) {
            $(this).parent('.upload-file-custom').find('label.delete').addClass('active');
        }else{
            $(this).parent('.upload-file-custom').find('label.delete').removeClass('active');
        }
    });
    var isAndroid = navigator.userAgent.toLowerCase().indexOf("android") > -1;
    if (isAndroid) {
        $('.form-select').select2(
            {
                minimumResultsForSearch: -1
            }
        );
    }else{
        $('.form-select').select2();
    }
    $('.btn-vidget-skarlat').click(function () {
        $('.vidget-content').toggleClass('active');
    });
    $(document).mouseup(function(e) {
        var myBlock = $(".vidget-content.active");

        // Если клик был сделан вне блока, скрываем его
        if (!myBlock.is(e.target) && myBlock.has(e.target).length === 0) {
            myBlock.removeClass('active');
        }
    });
    $("textarea.form-control").emojioneArea(
        {
            tones: false,
            buttonTitle: "Выбрать эмодзи",
            emojiPlaceholder: ":smile_cat:",
            useInternalCDN: true
        }
    );
});
