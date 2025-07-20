<?
// Устанавливаем prolog_before, чтобы не подключать лишние модули и шаблон сайта
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;
use Bitrix\Main\Loader;

// Получаем ID объекта недвижимости из запроса
$request = Context::getCurrent()->getRequest();
$objectId = (int)$request->get("objectId");

if ($objectId <= 0 || !Loader::includeModule("iblock")) {
    echo json_encode(['error' => 'Invalid parameters']);
    die();
}

// --- Получаем ID всех привязанных фотоотчетов ---
// ID инфоблока "Объекты недвижимости". УБЕДИТЕСЬ, ЧТО ОН ВЕРНЫЙ!
$realEstateIblockId = 3; 
$photoReportsPropertyCode = "PHOTO_REPORTS";

$res = CIBlockElement::GetProperty(
    $realEstateIblockId,
    $objectId,
    [],
    ["CODE" => $photoReportsPropertyCode]
);

$reportIds = [];
while ($ob = $res->GetNext()) {
    if (!empty($ob['VALUE'])) {
        $reportIds[] = $ob['VALUE'];
    }
}

if (empty($reportIds)) {
    echo json_encode([]); // Возвращаем пустой массив, если отчетов нет
    die();
}

// --- Теперь получаем детали каждого фотоотчета ---
$arReports = [];
// ID инфоблока "Фотоотчеты по строительству". УБЕДИТЕСЬ, ЧТО ОН ВЕРНЫЙ!
$photoReportsIblockId = 10; 

$arFilter = [
    "IBLOCK_ID" => $photoReportsIblockId,
    "ID" => $reportIds,
    "ACTIVE" => "Y"
];
$arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_REPORT_YEAR", "PROPERTY_REPORT_MONTH"];

$rsElements = CIBlockElement::GetList(["PROPERTY_REPORT_YEAR" => "DESC", "PROPERTY_REPORT_MONTH" => "DESC"], $arFilter, false, false, $arSelect);

while ($ob = $rsElements->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

    $photos = [];
    if (!empty($arProps["PHOTOS"]["VALUE"]) && is_array($arProps["PHOTOS"]["VALUE"])) {
        foreach ($arProps["PHOTOS"]["VALUE"] as $photoId) {
            $file = CFile::GetFileArray($photoId);
            if ($file) {
                $photos[] = [
                    'src' => $file['SRC'],
                    'description' => $file['DESCRIPTION']
                ];
            }
        }
    }
    
    $arReports[] = [
        'id' => $arFields['ID'],
        'year' => $arFields['PROPERTY_REPORT_YEAR_VALUE'],
        'month' => $arProps['REPORT_MONTH']['VALUE_ENUM'],
        'photos' => $photos
    ];
}

// Отдаем финальный ответ в формате JSON
header('Content-Type: application/json');
echo json_encode($arReports);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>