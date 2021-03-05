<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Сортировка
$arSorts = ["ASC" => "По возрастания", "DESC" => "По убыванию"];
$arSortFields = [
    "ID"   => "ID",
    "NAME" => "Название",
    "SORT" => "Сортировка"
];

//Параметры
$arComponentParameters = [
    "GROUPS"     => [
    ],
    "PARAMETERS" => [
        "SORT_BY"       => [
            "PARENT"            => "DATA_SOURCE",
            "NAME"              => "Поле сортировки",
            "TYPE"              => "LIST",
            "DEFAULT"           => "ID",
            "VALUES"            => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_ORDER"    => [
            "PARENT"            => "DATA_SOURCE",
            "NAME"              => "Направление сортировки",
            "TYPE"              => "LIST",
            "DEFAULT"           => "ASC",
            "VALUES"            => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "FIELD_CODE"       => [
            "PARENT"  => "BASE",
            "NAME"    => "Поля для вывода",
            "TYPE"    => "LIST",
            "DEFAULT" => ['ID', 'UF_NAME'],
        ],
        "FILTER_NAME"      => [
            "PARENT"  => "BASE",
            "NAME"    => "Имя фильтра",
            "TYPE"    => "STRING",
            "DEFAULT" => "",
        ],
        "CACHE_TIME"    => ["DEFAULT" => 60],
    ],
];
