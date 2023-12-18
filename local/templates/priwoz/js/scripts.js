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

    $('.item-phone').mask('+359 99 99 99 99 99');
    $('.item-dopphone').mask('+359 99 99 99 99 99');

    $('.delete-img').change(function() {
        if ($(this).is(':checked')) {
            $(this).parent('.upload-file-custom').find('label.delete').addClass('active');
        }else{
            $(this).parent('.upload-file-custom').find('label.delete').removeClass('active');
        }
    });
    $(".delete-item-user").click(function () {
        let id = $(this).data('id');
        let block = $('.grid.products-masonry.my-products');
        $.ajax({
            type: "POST",
            url: '/ajax/delete-announcement.php',
            data: {'id':id},
            success: function (data) {
                // Вывод текста результата отправки
                $(block).html(data);
                var $grid = $('.grid').masonry({});
                $grid.masonry('reloadItems');
            }
        });
        return false;
    });
});

