$(document).ready(function() {
    $('.upload-file-custom input[type="file"]').change(function() {
        handleFileSelect(this);
    });

    function handleFileSelect(input) {
        const parent = $(input).closest('.upload-file-custom');
        const label = parent.find('label');
        const previewImage = label.find('img')[0];
        const defaultImage = label.data('default');
        const pdfImage = label.data('pdf');

        const file = input.files[0];

        if (file) {
            const allowedTypes = ['image/png', 'image/jpeg', 'application/pdf'];
            const maxFileSize = 1 * 1024 * 1024; // 1 MB

            if (allowedTypes.includes(file.type) && file.size <= maxFileSize) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    if (file.type === 'application/pdf') {
                        $(previewImage).attr('src', pdfImage);
                    } else {
                        $(previewImage).attr('src', e.target.result);
                    }
                };

                if (file.type === 'application/pdf') {
                    // Если выбран PDF, используйте pdfImage напрямую, так как FileReader не может читать содержимое PDF
                    $(previewImage).attr('src', pdfImage);
                } else {
                    reader.readAsDataURL(file);
                }

                label.removeClass('-default');
            } else {
                alert('Пожалуйста, выберите файл в формате PNG, JPG, JPEG или PDF и не превышающий 1 MB.');
                // Очистить выбранный файл
                $(input).val('');
                $(previewImage).attr('src', defaultImage);
                label.addClass('-default');
            }
        } else {
            $(previewImage).attr('src', defaultImage);
            label.addClass('-default');
        }
    }
});