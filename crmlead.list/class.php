<?

use Bitrix\Crm;
use Bitrix\Crm\DealTable;
use Bitrix\Crm\ContactTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @property  arParams
 * @property  arResult
 */
class CrmLeadList extends \CBitrixComponent
{
    protected $arrFilter = [];

    public function onPrepareComponentParams($arParams): array
    {
        if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER"])) {
            $arParams["SORT_ORDER"] = "DESC";
        }

        if (!is_array($arParams["FIELD_CODE"])) {
            $arParams["FIELD_CODE"] = [];
        }

        foreach ($arParams["FIELD_CODE"] as $key => $val) {
            if (!$val) {
                unset($arParams["FIELD_CODE"][$key]);
            }
        }

        if (!is_numeric($arParams["ELEMENT_COUNT"]) || !$arParams["ELEMENT_COUNT"] > 0) {
            $arParams["ELEMENT_COUNT"] = 10;
        }

        if (!empty($arParams["FILTER_NAME"]) && preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"])) {
            $arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
            if (is_array($arrFilter)) {
                $this->arrFilter = $arrFilter;
            }
        }

        return $arParams;
    }

    protected function getResult()
    {
        $runtime = [];

        pre( $this->arrFilter);

        $arDeal = DealTable::getList([
            'order'         => [$this->arParams['SORT_BY'] => $this->arParams['SORT_ORDER']],
            'select'        => $this->arParams['FIELD_CODE'],
            'filter'        => $this->arrFilter,
            'group'         => [],
            'limit'         => $this->arParams['ELEMENT_COUNT'],
            'offset'        => 0,
            'count_total'   => 1,
            'runtime'       => $runtime,
            'data_doubling' => false,
            'cache'         => [
                'ttl'         => $this->arParams['CACHE_TIME'],
                'cache_joins' => true
            ],
        ])->fetchAll();

        $this->arResult = $arDeal;
    }

    public function executeComponent()
    {
        try {
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (SystemException $e) {
            ShowError($e->getMessage());
        }
    }
}
