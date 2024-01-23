<div class="popup-general" id="addCommunityPopup">
    <div class="modal-box">
        <div class="scroll-box">
            <div class="form-box">
                <div class="title">Добавить сообщество</div>
                <div class="subtitle">Заполните поля ниже</div>
                <form>
                    <div class="form-group">
                        <h2>Заголовок Сообщества *</h2>
                        <label class="form-label">
                            <input type="text" class="form-control"
                                   placeholder="Введите текст до 60 знаков с пробелами">
                        </label>
                    </div>
                    <div class="form-group">
                        <h2 class="pt-xs-0">Загрузите фотографию</h2>
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
                    <div class="form-group">
                        <h2>Описание Сообщества</h2>
                        <textarea class="form-control"
                                  placeholder="Введите текст до 1200 символов с пробелами"></textarea>
                    </div>

                    <h2>Контактные данные *</h2>
                    <div class="form-group">
                        <label class="form-label -with-icon">
                            <span class="input-icon -name"></span>
                            <input type="text" class="form-control" placeholder="Имя">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label -with-icon">
                            <span class="input-icon -telegram"></span>
                            <input type="text" class="form-control" placeholder="Telegram">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label -with-icon">
                            <span class="input-icon -phone"></span>
                            <input type="text" class="form-control" placeholder="Телефон">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label -with-icon">
                            <span class="input-icon -viber"></span>
                            <input type="text" class="form-control" placeholder="Viber">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label -with-icon">
                            <span class="input-icon -phone"></span>
                            <input type="text" class="form-control" placeholder="Дополнительный номер телефона">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label -with-icon">
                            <span class="input-icon -whatsapp"></span>
                            <input type="text" class="form-control" placeholder="Whatsapp">
                        </label>
                    </div>

                    <div class="required-text">* Обязательно для заполнения</div>

                    <div class="text-xs-center">
                        <input type="submit" class="btn btn-green" value="Добавить сообщество">
                    </div>
                </form>
            </div>
            <div class="success-box" style="display: none">
                <p>Сообщество добавлено, спасибо</p>
                <p>Шоб вы так жили как мы вас ждем!</p>
            </div>
        </div>
    </div>
</div>