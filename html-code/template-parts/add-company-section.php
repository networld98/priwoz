<section class="add-company-section">
    <div class="container">
        <div class="title-box row align-items-xl-baseline">
            <div class="col-xs-12 col-xl-4 col-xxl-3">
                <h1 class="section-title">Добавить компанию</h1>
            </div>
            <div class="col-xs-12 col-xl-8 col-xxl-9">
                <div class="text-1">
                    <p>Добро пожаловать в процесс добавления вашей компании в наш каталог.</p>
                    <p>Шаг 1: Заполните информацию о вашей компании - первый шаг к привлечению новых клиентов. Шаг 2: Загрузите логотип и фотографии - сделайте вашу компанию заметной. Шаг 3: Опубликуйте вашу компанию.  Шаг 4: Дополните информацию о компании в личном кабинете  и начните привлекать клиентов с нашей платформы!</p>
                    <p>Минимум усилий  и ваша страница будет выглядеть <a href="/">примерно так</a></p>
                </div>
            </div>
        </div>

        <div class="product-form">
            <form>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Наименование компании *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <label class="form-label">
                            <input type="text" class="form-control" placeholder="Введите наименование - до 35 знаков с пробелами" required>
                        </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Населенный пункт, область *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <label class="form-label">
                            <div class="form-select-box">
                                <select class="form-select" required>
                                    <option value="">Введите наименование</option>
                                    <option value="Рубрика 1">Город 1</option>
                                    <option value="Рубрика 2">Город 2</option>
                                    <option value="Рубрика 3">Город 3</option>
                                </select>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Направление деятельности *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <div class="form-select-box">
                            <select class="form-select" required>
                                <option value="">Выберите рубрику</option>
                                <option value="Рубрика 1">Рубрика 1</option>
                                <option value="Рубрика 2">Рубрика 2</option>
                                <option value="Рубрика 3">Рубрика 3</option>
                            </select>
                        </div>
                        <div class="form-select-box">
                            <select class="form-select" required>
                                <option value="">Выберите подрубрику</option>
                                <option value="Рубрика 1">Подрубрика 1</option>
                                <option value="Рубрика 2">Подрубрика 2</option>
                                <option value="Рубрика 3">Подрубрика 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Описание компаниии *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <textarea class="form-control" placeholder="Введите текст до 1200 символов с пробелами" required></textarea>
                    </div>
                </div>
                <div class="row form-group mb-xs-0">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Загрузите логотип</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <div class="upload-file-custom">
                            <input type="file" id="customFileInput" style="display: none;"
                                   accept=".png, .jpg, .jpeg, .pdf">
                            <div class="upload-image-box">
                                <label for="customFileInput" id="customFileInputLabel" class="upload-image -default"
                                       data-default="/html-code/images/icons/upload-file.svg"
                                       data-pdf="/html-code/images/icons/PDF_Logo.svg">
                                    <img id="previewImage" class="preview-image"
                                         src="/html-code/images/icons/upload-file.svg" alt="Preview">
                                </label>
                                <div class="hint">Допустимые форматы: png, jpg, pdf до 1 mb</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2 class="pt-xs-0">Загрузите фотографии</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <div class="hint">Первое фото будет на обложке Компании. Перетащите, чтобы изменить порядок.</div>
                        <div class="upload-group">
                            <div class="upload-item-box">
                                <div class="upload-file-custom">
                                    <input type="file" id="customFileInput1" style="display: none;" accept=".png, .jpg, .jpeg, .pdf">
                                    <div class="upload-image-box">
                                        <label for="customFileInput1" id="customFileInputLabel1" class="upload-image -default"
                                               data-default="/html-code/images/icons/upload-file.svg"
                                               data-pdf="/html-code/images/icons/PDF_Logo.svg">
                                            <img class="preview-image" src="/html-code/images/icons/upload-file.svg" alt="Preview">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-item-box">
                                <div class="upload-file-custom">
                                    <input type="file" id="customFileInput2" style="display: none;" accept=".png, .jpg, .jpeg, .pdf">
                                    <div class="upload-image-box">
                                        <label for="customFileInput2" id="customFileInputLabel2" class="upload-image -default"
                                               data-default="/html-code/images/icons/upload-file.svg"
                                               data-pdf="/html-code/images/icons/PDF_Logo.svg">
                                            <img class="preview-image" src="/html-code/images/icons/upload-file.svg" alt="Preview">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-item-box">
                                <div class="upload-file-custom">
                                    <input type="file" id="customFileInput3" style="display: none;" accept=".png, .jpg, .jpeg, .pdf">
                                    <div class="upload-image-box">
                                        <label for="customFileInput3" id="customFileInputLabel3" class="upload-image -default"
                                               data-default="/html-code/images/icons/upload-file.svg"
                                               data-pdf="/html-code/images/icons/PDF_Logo.svg">
                                            <img class="preview-image" src="/html-code/images/icons/upload-file.svg" alt="Preview">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-item-box">
                                <div class="upload-file-custom">
                                    <input type="file" id="customFileInput4" style="display: none;" accept=".png, .jpg, .jpeg, .pdf">
                                    <div class="upload-image-box">
                                        <label for="customFileInput4" id="customFileInputLabel4" class="upload-image -default"
                                               data-default="/html-code/images/icons/upload-file.svg"
                                               data-pdf="/html-code/images/icons/PDF_Logo.svg">
                                            <img class="preview-image" src="/html-code/images/icons/upload-file.svg" alt="Preview">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="upload-item-box">
                                <div class="upload-file-custom">
                                    <input type="file" id="customFileInput5" style="display: none;" accept=".png, .jpg, .jpeg, .pdf">
                                    <div class="upload-image-box">
                                        <label for="customFileInput5" id="customFileInputLabel5" class="upload-image -default"
                                               data-default="/html-code/images/icons/upload-file.svg"
                                               data-pdf="/html-code/images/icons/PDF_Logo.svg">
                                            <img class="preview-image" src="/html-code/images/icons/upload-file.svg" alt="Preview">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hint">Допустимые форматы: png, jpg, pdf до 1 mb</div>
                    </div>
                </div>

                <h2>Сайт компании, социальные сети</h2>
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -site"></span>
                            <input type="text" class="form-control" placeholder="Введите ссылку на сайт">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -facebook"></span>
                            <input type="text" class="form-control" placeholder="Введите ссылку Facebook">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -instagram"></span>
                            <input type="text" class="form-control" placeholder="Введите ссылку Instagram">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -youtube"></span>
                            <input type="text" class="form-control" placeholder="Введите ссылку YouTube">
                        </label>
                    </div>
                </div>

                <h2>Контактные данные компании</h2>
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -email"></span>
                            <input type="text" class="form-control" placeholder="Введите email ">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -telegram"></span>
                            <input type="text" class="form-control" placeholder="Введите номер Telegram">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -phone"></span>
                            <input type="text" class="form-control" placeholder="Введите номер телефона *" required>
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -viber"></span>
                            <input type="text" class="form-control" placeholder="Введите номер Viber">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -phone"></span>
                            <input type="text" class="form-control" placeholder="Дополнительный номер телефона">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -whatsapp"></span>
                            <input type="text" class="form-control" placeholder="Введите номер WhatsApp">
                        </label>
                    </div>
                </div>

                <div class="required-text">* Обязательно  для заполнения</div>

                <div class="text-xs-center">
                    <input type="submit" class="btn btn-green" value="Добавить компанию">
                </div>
                <div class="privacy-policy-text">Нажимая на кнопку “Добавить компанию”, вы соглашаетесь с условиями нашей
                    <a href="/">Политики конфиденциальности</a></div>
            </form>
        </div>

    </div>
</section>