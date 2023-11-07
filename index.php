<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "priwoz.info");
$APPLICATION->SetPageProperty("description", "priwoz.info");
$APPLICATION->SetTitle("priwoz.info");
?>
    <!-- Навигационная панель -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="logo" href="/"><img src="<?=SITE_TEMPLATE_PATH ?>/images/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <button class="btn btn-outline-primary me-2">RU</button>
                <button class="btn btn-outline-primary me-2">UA</button>
                <button class="btn btn-outline-primary me-2">EN</button>
                <button class="btn btn-outline-primary me-2">Favorites</button>
                <button class="btn btn-primary">Login</button>
            </div>
        </div>
    </nav>
    <!-- Поиск и выбор города -->
    <div class="container">
      <div class="row">
          <div class="col-lg-8">
              <? $APPLICATION->IncludeComponent(
                  "networld:catalog.smart.filter",
                  "search_filter_area_metro",
                  array(
                      "CACHE_GROUPS" => "Y",
                      "CACHE_TIME" => "36000000",
                      "CACHE_TYPE" => "A",
                      "COMPONENT_TEMPLATE" => "search_filter_area_metro",
                      "CONVERT_CURRENCY" => "N",
                      "DISPLAY_ELEMENT_COUNT" => "N",
                      "FILTER_NAME" => "arrFilter",
                      "FILTER_VIEW_MODE" => "vertical",
                      "HIDE_NOT_AVAILABLE" => "N",
                      "IBLOCK_TYPE" => "content",
                      "IBLOCK_ID" => "9",
                      "PAGER_PARAMS_NAME" => "arrPager",
                      "PREFILTER_NAME" => "smartPreFilter",
                      "SAVE_IN_SESSION" => "N",
                      "SECTION_CODE" => "search",
                      "SECTION_DESCRIPTION" => "-",
                      "SECTION_ID" => "",
                      "SECTION_TITLE" => "-",
                      "SEF_MODE" => "N",
                      "TEMPLATE_THEME" => "blue",
                      "XML_EXPORT" => "N",
                      "POPUP_POSITION" => "left",
                      "NOT_FILTER" => "N",
                      "SEF_RULE" => "#SMART_FILTER_PATH#",
                      "SECTION_CODE_PATH" => "",
                      "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"]
                  ),
                  false
              );
              ?>
          </div>
<?/*  <div class="col-lg-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Поиск">
                    <button class="btn btn-primary" type="button">Искать</button>
                </div>
            </div>
            <div class="col-lg-4">
                <select class="form-select" aria-label="Поиск по городу">
                    <option selected>Поиск по городу</option>
                    <option value="city1">Город 1</option>
                    <option value="city2">Город 2</option>
                    <option value="city3">Город 3</option>
                    <!-- Добавьте другие города по аналогии -->
                </select>
            </div>*/?>
            <div class="col-lg-2">
                <button class="btn btn-success" type="button">Добавить компанию</button>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-info" type="button">Добавить объявление</button>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <img src="<?=SITE_TEMPLATE_PATH ?>/images/banner1.jpg" alt="Баннер">
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Популярные объявления</h2>
            </div>
        </div>
        <div class="ads">
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 1">
                <div class="text">
                    <p>Описание объявления 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <span>Город 1</span>
                    <span>Дата 1</span>
                    <span>Цена 1</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 2">
                <div class="text">
                    <p>Описание объявления 2. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <span>Город 2</span>
                    <span>Дата 2</span>
                    <span>Цена 2</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 3. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    <span>Город 3</span>
                    <span>Дата 3</span>
                    <span>Цена 3</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 4">
                <div class="text">
                    <p>Описание объявления 4. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 4</span>
                    <span>Дата 4</span>
                    <span>Цена 4</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 5">
                <div class="text">
                    <p>Описание объявления 5. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                    <span>Город 5</span>
                    <span>Дата 5</span>
                    <span>Цена 5</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 6. Fugiat nulla pariatur. Sint occaecat cupidatat non proident.</p>
                    <span>Город 6</span>
                    <span>Дата 6</span>
                    <span>Цена 6</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 7. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 7</span>
                    <span>Дата 7</span>
                    <span>Цена 7</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 8">
                <div class="text">
                    <p>Описание объявления 8. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 8</span>
                    <span>Дата 8</span>
                    <span>Цена 8</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 9. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 9</span>
                    <span>Дата 9</span>
                    <span>Цена 9</span>
                    <span>★</span>
                </div>
            </div>
            <div class="banner"> <img src="<?=SITE_TEMPLATE_PATH ?>/images/banner3.jpg" alt="Баннер"></div>
        </div>
    </div>

    <div class="container mt-4">
        <img src="<?=SITE_TEMPLATE_PATH ?>/images/banner2.jpg" alt="Баннер">
    </div>


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Популярные объявления</h2>
            </div>
        </div>
        <div class="companys">
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 1">
                <div class="text">
                    <p>Описание объявления 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <span>Город 1</span>
                    <span>Дата 1</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 2">
                <div class="text">
                    <p>Описание объявления 2. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <span>Город 2</span>
                    <span>Дата 2</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 3. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    <span>Город 3</span>
                    <span>Дата 3</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 4">
                <div class="text">
                    <p>Описание объявления 4. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 4</span>
                    <span>Дата 4</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 5">
                <div class="text">
                    <p>Описание объявления 5. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.</p>
                    <span>Город 5</span>
                    <span>Дата 5</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 6. Fugiat nulla pariatur. Sint occaecat cupidatat non proident.</p>
                    <span>Город 6</span>
                    <span>Дата 6</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 7. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 7</span>
                    <span>Дата 7</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <img src="<?=SITE_TEMPLATE_PATH ?>/images/order.jpg" alt="Объявление 8">
                <div class="text">
                    <p>Описание объявления 8. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 8</span>
                    <span>Дата 8</span>
                    <span>Цена 8</span>
                    <span>★</span>
                </div>
            </div>
            <div class="item">
                <div class="text">
                    <p>Описание объявления 9. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                    <span>Город 9</span>
                    <span>Дата 9</span>
                    <span>Цена 9</span>
                    <span>★</span>
                </div>
            </div>
            <div class="banner"> <img src="<?=SITE_TEMPLATE_PATH ?>/images/banner3.jpg" alt="Баннер"></div>
        </div>
    </div>

    <!-- Еще один баннер на всю ширину сайта -->
    <div class="container mt-4">
        <img src="https://via.placeholder.com/1600x200" alt="Баннер">
    </div>

    <!-- Блок "О проекте" -->
    <div class="container mt-4">
        <h2>О проекте</h2>
        <p>Описание вашего проекта и его цели.</p>
    </div>

    <!-- Блок блога -->
    <div class="container mt-4">
        <h2>Блог</h2>
        <div class="row">
            <!-- Первая статья блога -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Изображение статьи 1">
                    <div class="card-body">
                        <h5 class="card-title">Заголовок статьи 1</h5>
                        <p class="card-text">Описание статьи 1</p>
                    </div>
                </div>
            </div>
            <!-- Вторая статья блога -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Изображение статьи 2">
                    <div class="card-body">
                        <h5 class="card-title">Заголовок статьи 2</h5>
                        <p class="card-text">Описание статьи 2</p>
                    </div>
                </div>
            </div>
            <!-- Третья статья блога -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Изображение статьи 3">
                    <div class="card-body">
                        <h5 class="card-title">Заголовок статьи 3</h5>
                        <p class="card-text">Описание статьи 3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>