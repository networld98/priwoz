<?
$aMenuLinks = array(

    array(
        if $GLOBALS['USER']->IsAuthorized() ? "Профиль": "Войти",
        "/personal/",
        array(),
        array(),
        ""
    ),
    array(
        "Избранное",
        "/personal/favorite/",
        array(),
        array(),
        ""
    ),
    array(
        "Добавить обьявление",
        "/personal/announcement/",
        array(),
        array(),
        "\$GLOBALS['USER']->IsAuthorized()"
    ),
    array(
        "Добавить компанию",
        "/personal/company/",
        array(),
        array(),
        "\$GLOBALS['USER']->IsAuthorized()"
    ),
    array(
        "Мои обьявления",
        "/personal/ads-list/",
        array(),
        array(),
        "\$GLOBALS['USER']->IsAuthorized()"
    ),
    array(
        "Выход",
        "/?logout=yes",
        array(),
        array(),
        "\$GLOBALS['USER']->IsAuthorized()"
    )
);
?>