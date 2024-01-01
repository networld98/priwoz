<section class="products-overview-section">
    <div class="container">
        <div class="title-box">
            <h1 class="page-title">Доска объявлений</h1>
            <a href="/" class="btn btn-orange d-xs-none d-xl-inline-flex">Добавить объявление</a>
        </div>
        <div class="collapse-head search-box-opener" data-collapsed="#search-box">Поиск на доске объявлений <span class="arrow"></span></div>
        <form id="search-box" class="collapsed-content search-box">
            <label class="form-label">
                <input type="text" class="form-control -search"
                       placeholder="Шо найти на Priwoze">
            </label>
            <label class="form-label">
                <select class="form-select -simple-location">
                    <option value="All" selected>Все объявления</option>
                    <option value="12">София</option>
                    <option value="123">Пловдив</option>
                    <option value="1234">Варна</option>
                    <option value="12345">Бургас</option>
                    <option value="123456">Благоевградская область</option>
                    <option value="1234457">Бургасская область</option>
                    <option value="12345436">Добричская область</option>
                    <option value="123874">Габровская область</option>
                    <option value="1238765">Хасковская область</option>
                    <option value="123876">Кырджалийская область</option>
                    <option value="12387">Кюстендилская область</option>
                    <option value="1238">Ловечская область</option>
                    <option value="1235674">Монтанская область</option>
                    <option value="12345">Пазарджикская область</option>
                    <option value="12453">Перникская область</option>
                    <option value="123453">Плевенская область</option>
                    <option value="123523">Пловдивская область</option>
                    <option value="123243">Разградская область</option>
                    <option value="12365">Русенская область</option>
                    <option value="12398">Шуменская область</option>
                    <option value="123456">Силистренская область</option>
                    <option value="123234">Сливенская область</option>
                    <option value="12324">Смолянская область</option>
                    <option value="123214">Софийская область</option>
                    <option value="123225">Старозагорская область</option>
                    <option value="12354">Тырговиштская область</option>
                    <option value="12364">Варненская область</option>
                    <option value="12376">Великотырновская область</option>
                    <option value="12385">Видинская область</option>
                    <option value="12348">Врацкая область</option>
                    <option value="1233788">Ямбольская область</option>
                </select>
            </label>
            <div class="btn-box">
                <input type="submit" class="btn btn-search" value="Поиск">
            </div>
        </form>
        <div class="collapse-head filter-box-opener" data-collapsed="#filter-box">Фильтры поиска <span class="arrow"></span></div>
        <div id="filter-box" class="collapsed-content bx_filter">
            <div class="bx_filter_section">
                <form class="smartfilter">
                    <div class="bx_filter_parameters_box active">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title">Категория</div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <select class="form-select -without-search">
                                    <option data-count="36643" value="All" selected>Все объявления</option>
                                    <option data-count="126" value="avto">Авто</option>
                                    <option data-count="3644" value="det_mir">Детский мир</option>
                                    <option data-count="14826" value="dom_i_sad">Дом и сад</option>
                                    <option data-count="10433" value="zyvotnye">Животные</option>
                                    <option data-count="456" value="krasota">Красота</option>
                                    <option data-count="8210" value="nedv">Недвижимость</option>
                                    <option data-count="11325" value="odeg">Одежда</option>
                                    <option data-count="15247" value="darom">Отдам даром</option>
                                    <option data-count="456" value="rabota">Работа</option>
                                    <option data-count="8210" value="hobbi">Хобби и спорт</option>
                                    <option data-count="11325" value="uslugi">Услуги</option>
                                    <option data-count="15247" value="electr">Электроника</option>
                                </select>
                            </div>
                            <div class="clb"></div>
                        </div>
                    </div>
                    <div class="bx_filter_parameters_box active">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title">Подкатегория</div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <select class="form-select -without-search">
                                    <option data-count="3008" value="All" selected>Все объявления</option>
                                    <option data-count="126" value="prod_avto">Продажа авто</option>
                                    <option data-count="3644" value="arenda_avto">Аренда авто</option>
                                    <option data-count="14826" value="zapas_avto">Запасные части</option>
                                    <option data-count="10433" value="sto">СТО</option>
                                </select>
                            </div>
                            <div class="clb"></div>
                        </div>
                    </div>
                    <div class="bx_filter_parameters_box active">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title">Стоимость</div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <div class="bx_filter_parameters_box_container_block">
                                    <div class="bx_filter_input_container">
                                        <label class="form-label -min-max-label">
                                            от:
                                            <input class="min-price" type="text" name="arrFilter_525_MIN"
                                                   id="arrFilter_525_MIN" value="" size="5"
                                                   onkeyup="smartFilter.keyup(this)" placeholder="">
                                        </label>
                                    </div>
                                </div>
                                <div class="bx_filter_parameters_box_container_block">
                                    <div class="bx_filter_input_container">
                                        <label class="form-label -min-max-label">
                                            до:
                                            <input class="max-price" type="text" name="arrFilter_525_MAX"
                                                   id="arrFilter_525_MAX" value="" size="5"
                                                   onkeyup="smartFilter.keyup(this)" placeholder="">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="clb"></div>
                        </div>
                    </div>
                    <div class="bx_filter_parameters_box active">
                        <span class="bx_filter_container_modef"></span>
                        <div class="bx_filter_parameters_box_title">Состояние</div>
                        <div class="bx_filter_block">
                            <div class="bx_filter_parameters_box_container">
                                <select class="form-select -without-search">
                                    <option value="all" selected>все объявления</option>
                                    <option value="bu">б/у</option>
                                    <option value="new">новое</option>
                                </select>
                            </div>
                            <div class="clb"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-overlay">
        <div class="container">

            <div class="advertisement advertisement-type-3">
                <div class="box">
                    <img class="bg-img" src="/html-code/temporary-images/products/adv-bg.png" alt="Priwoz ad">
                    <h2 class="main-text">Купить грузовик MAN в Болгарии</h2>
                    <div class="bottom-block">
                        <div class="logo"><img src="/html-code/temporary-images/products/company-logo.png"
                                               alt="Priwoz ad"></div>
                        <div class="text">от официального диллера</div>
                        <a href="tel:+359293760160" class="number">+359 293 760 160</a>
                    </div>
                </div>
            </div>

            <div class="products-wrap">
                <div class="grid products-masonry">
                    <div class="grid-sizer"></div>
                    <div class="gutter-sizer"></div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="img">
                                <img class="bg-img" src="/html-code/temporary-images/home/product1.png"
                                     alt="Priwoz product">
                            </div>
                            <div class="text">
                                <h2 class="product-title">Диски Original Renault Master III (2023) 5/130 R16 7J ET66
                                    dia89.1
                                    Диски Original Renault Master III (2023) 5/130 R16 7J</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">6700 BGN</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="img">
                                <img class="bg-img" src="/html-code/temporary-images/home/product2.png"
                                     alt="Priwoz product">
                            </div>
                            <div class="text">
                                <h2 class="product-title">Диски Original Renault Master III (2023) 5/130 R16 7J ET66
                                    dia89.1</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">6700 BGN</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="text">
                                <h2 class="product-title">Срочно требуется грузчик, оплата ежедневная</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="img">
                                <img class="bg-img" src="/html-code/temporary-images/home/product4.png"
                                     alt="Priwoz product">
                            </div>
                            <div class="text">
                                <h2 class="product-title">Диски Original Renault Master III </h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="img">
                                <img class="bg-img" src="/html-code/temporary-images/home/product5.png"
                                     alt="Priwoz product">
                            </div>
                            <div class="text">
                                <h2 class="product-title">Диски Original Renault Master III (2023) 5/130 R16 7J ET66
                                    dia89.1 </h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="text">
                                <h2 class="product-title">Срочно требуется грузчик, оплата ежедневная</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="text">
                                <h2 class="product-title">Срочно требуется грузчик, оплата ежедневная</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box -adv">
                            <div class="img">
                                <img class="bg-img" src="/html-code/temporary-images/home/advertisement-3.png"
                                     alt="Priwoz advertisement">
                            </div>
                            <div class="text">
                                <div class="adv-logo"><img
                                            src="/html-code/temporary-images/home/advertisement-3-logo.png"
                                            alt="Priwoz advertisement"></div>
                                <div class="date">с 30 сентября 2023</div>
                                <h2 class="product-title">Золотые пески </h2>
                            </div>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="text">
                                <h2 class="product-title">Срочно требуется грузчик, оплата ежедневная</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <div class="grid-item product-grid-item">
                        <a href="/" class="box">
                            <div class="text">
                                <h2 class="product-title">Срочно требуется грузчик, оплата ежедневная</h2>
                                <div class="location-date">
                                    <div class="location">Варна</div>
                                    <time datetime="2023-10-14" class="date">14 окт 2023</time>
                                </div>
                                <div class="price">Договорная</div>
                            </div>
                        </a>
                        <a href="#" class="add-to-favourite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                 fill="none">
                                <path d="M7.22704 3.7542C7.89956 2.0143 8.23581 1.14435 8.78212 1.02378C8.92577 0.992074 9.07423 0.992074 9.21788 1.02378C9.76419 1.14435 10.1004 2.0143 10.773 3.7542C11.1554 4.74364 11.3466 5.23837 11.7044 5.57486C11.8048 5.66924 11.9137 5.7533 12.0297 5.82585C12.4433 6.08452 12.9596 6.13251 13.9921 6.22847C15.74 6.39092 16.6139 6.47214 16.8808 6.98926C16.936 7.09636 16.9736 7.21232 16.9919 7.33231C17.0804 7.9117 16.438 8.51829 15.153 9.73148L14.7962 10.0684C14.1954 10.6356 13.8951 10.9192 13.7213 11.2731C13.6171 11.4854 13.5472 11.714 13.5145 11.9499C13.4599 12.343 13.5479 12.7544 13.7238 13.5772L13.7866 13.8712C14.1021 15.3468 14.2599 16.0846 14.0629 16.4473C13.8861 16.773 13.5603 16.9816 13.2004 16.9994C12.7997 17.0193 12.2352 16.5419 11.1061 15.5871C10.3622 14.958 9.99029 14.6435 9.5774 14.5206C9.20007 14.4084 8.79993 14.4084 8.4226 14.5206C8.00971 14.6435 7.63777 14.958 6.89389 15.5871C5.7648 16.5419 5.20026 17.0193 4.79961 16.9994C4.43972 16.9816 4.11393 16.773 3.93705 16.4473C3.74015 16.0846 3.89789 15.3468 4.21336 13.8712L4.27621 13.5772C4.45213 12.7544 4.54009 12.343 4.4855 11.9499C4.45276 11.714 4.38288 11.4854 4.27866 11.2731C4.10493 10.9192 3.80456 10.6356 3.20382 10.0684L2.847 9.73149C1.56205 8.5183 0.919574 7.9117 1.00805 7.33231C1.02638 7.21232 1.06396 7.09636 1.11923 6.98926C1.38611 6.47214 2.26005 6.39092 4.00792 6.22847C5.04044 6.13251 5.55671 6.08452 5.97026 5.82585C6.08626 5.7533 6.19521 5.66924 6.29557 5.57486C6.65337 5.23837 6.8446 4.74364 7.22704 3.7542Z"
                                      stroke="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>