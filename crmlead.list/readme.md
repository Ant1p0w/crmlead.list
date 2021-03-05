# Список лидов CRM на D7

Пример вызова:

~~~
global $arLeadFilter;
$arLeadFilter = ['><DATE_CREATE' => [date("d.m.Y 00:00:00"), date("d.m.Y 23:59:99")]];

$APPLICATION->IncludeComponent(
    "antipow:crmlead.list",
    "",
    [
        "CACHE_TIME"    => "86000",
        "CACHE_TYPE"    => "A",
        "FIELD_CODE"    => ["ID", "LEAD_ID", "TITLE", "COMMENTS", "DATE_CREATE", "CREATED_BY"],
        "SORT_BY"       => "DATE_CREATE",
        "SORT_ORDER"    => "DESC",
        "ELEMENT_COUNT" => 10,
        "FILTER_NAME"   => "arLeadFilter"
    ]
);
~~~
