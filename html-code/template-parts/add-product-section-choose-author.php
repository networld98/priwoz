<section class="add-product-section">
    <div class="container">
        <div class="title-box row align-items-xl-baseline">
            <div class="col-xs-12 col-xl-4 col-xxl-3">
                <h1 class="section-title">Добавить объявление</h1>
            </div>
            <div class="col-xs-12 col-xl-8 col-xxl-9">
                <p class="text-1">Все заполненные данные вы сможете изменить в личном кабинете</p>
            </div>
        </div>

        <div class="product-form">
            <form>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Заголовок объявления *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <label class="form-label">
                            <input type="text" class="form-control" placeholder="Введите текст до 60 знаков с пробелами">
                        </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Рубрика *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <div class="form-select-box">
                            <select class="form-select">
                                <option value="">Выберите рубрику</option>
                                <option value="Рубрика 1">Рубрика 1</option>
                                <option value="Рубрика 2">Рубрика 2</option>
                                <option value="Рубрика 3">Рубрика 3</option>
                            </select>
                        </div>
                        <div class="form-select-box">
                            <select class="form-select">
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
                        <h2 class="pt-xs-0">Загрузите фотографии</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <div class="hint">Первое фото будет на обложке объявления. Перетащите, чтобы изменить порядок.</div>
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
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Описание Объявления</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <textarea class="form-control" placeholder="Введите текст до 1200 символов с пробелами"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-xl-4">
                        <h2>Населенный пункт, область *</h2>
                    </div>
                    <div class="col-xs-12 col-xl-8">
                        <input type="text" class="form-control" placeholder="Введите наименование">
                    </div>
                </div>

                <h2>Контактные данные *</h2>
                <div class="row">
                    <div class="form-group col-xs-12 col-md-6">
                        <div class="form-select-box">
                            <select class="form-select -with-icon -name">
                                <option value="">Выберите автора</option>
                                <option value="Рубрика 1">Рубрика 1</option>
                                <option value="Рубрика 2">Рубрика 2</option>
                                <option value="Рубрика 3">Рубрика 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -telegram"></span>
                            <input type="text" class="form-control" placeholder="Telegram">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -phone"></span>
                            <input type="text" class="form-control" placeholder="Телефон">
                        </label>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label class="form-label -with-icon">
                            <span class="input-icon -viber"></span>
                            <input type="text" class="form-control" placeholder="Viber">
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
                            <input type="text" class="form-control" placeholder="Whatsapp">
                        </label>
                    </div>
                </div>

                <div class="required-text">* Обязательно  для заполнения</div>

                <div class="text-xs-center">
                    <input type="submit" class="btn btn-orange" value="Добавить объявление">
                </div>
                <div class="privacy-policy-text">Нажимая на кнопку “Добавить объявление”, вы соглашаетесь с условиями нашей
                    <a href="/">Политики конфиденциальности</a></div>
            </form>
        </div>

    </div>
</section>