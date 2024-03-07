<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use App\IntegrationQueue\OneCDataSync\Application\Helpers\StatusNomHelper;
use Carbon\Carbon;
use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\DataObject\MeasureUnit;
use Pimcore\Model\DataObject\Objectbrick;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\ProductClassificator;
use Pimcore\Model\DataObject\ProductDepartment;
use Pimcore\Model\DataObject\ProductGeography;
use Pimcore\Model\DataObject\ProductManufacture;
use Pimcore\Model\DataObject\ProductManufacturer;
use Pimcore\Model\DataObject\ProductNomClass1;
use Pimcore\Model\DataObject\ProductNomClass2;
use Pimcore\Model\DataObject\ProductNomClass3;
use Pimcore\Model\DataObject\ProductNomClass4;
use Pimcore\Model\DataObject\ProductTM;
use Pimcore\Model\DataObject\StatusNom;
use Pimcore\Model\DataObject\WineCountryClass;
use Pimcore\Model\DataObject\WineJoin;


class Product1C extends Product
{

    /**
     * @var Product
     */
    protected $product;

    protected $raw;

    protected $language = 'uk-UA';


    public function __construct($raw, Product $product)
    {
        $this->product = $product;

        $this->raw = $raw;
    }

    private $fuc = [
        'setKey' => ['key' => ['#value', 'Ref'], 'require' => true],
        'setStatus' => ['key' => ['#value', 'АУ_Статус'], 'require' => false],
        'setClassificator' => ['key' => ['#value', 'АУ_Классификация_Классификатор'], 'require' => false],
        'setDepartment' => ['key' => ['#value', 'АУ_Классификация_Отдел'], 'require' => false],
        'setManufacturer' => ['key' => ['#value', 'АУ_Классификация_Производитель'], 'require' => false],
        'setTM' => ['key' => ['#value', 'АУ_Классификация_ТорговаяМарка'], 'require' => false],
        'setPL' => ['key' => ['#value', 'АУ_Классификация_ЛинияПродукта'], 'require' => false],
//        'setGeography' => ['key' => ['#value', 'АУ_Классификация_МестоПроисхождения'], 'require' => false],
        'setCountry' => ['key' => ['#value', 'АУ_Классификация_Страна'], 'require' => false],
        'setRegion' => ['key' => ['#value', 'АУ_Классификация_Регион'], 'require' => false],
        'setPlaceorigin' => ['key' => ['#value', 'АУ_Классификация_МестоПроисхождения'], 'require' => false],
        'setPasteurization' => ['key' => ['#value', 'АУ_Продукты_Пастеризация'], 'require' => false],
        'setBiodynamics' => ['key' => ['#value', 'Биодинамика'], 'require' => false],
        'setOrganics' => ['key' => ['#value', 'АУ_Продукты_Органика'], 'require' => false],
        'setNomClass1' => ['key' => ['#value', 'АУ_Классификация_КлассНоменклатуры1'], 'require' => false],
        'setNomClass2' => ['key' => ['#value', 'АУ_Классификация_КлассНоменклатуры2'], 'require' => false],
        'setNomClass3' => ['key' => ['#value', 'АУ_Классификация_КлассНоменклатуры3'], 'require' => false],
        'setNomClass4' => ['key' => ['#value', 'АУ_Классификация_КлассНоменклатуры4'], 'require' => false],
        'setName' => ['lang_keys' => [
            'en' => ['key' => ['#value', 'АУ_ВЭД_НаименованиеСпецификацииEng'], 'require' => false],
            'uk' => ['key' => ['#value', 'Description'], 'require' => true]
        ]],
        'setCode' => ['key' => ['#value', 'Ref'], 'require' => true],
        //'setDescription' => ['keys' => ['#value', 'Description'], 'lang' => true, 'require' => true],
//        'setDescription' => ['lang_keys' => [
//            'uk_UA' => ['key' => ['#value', 'Description'], 'require' => true]
//        ]],
        'setItemnumber' => ['key' => ['#value', 'Артикул'], 'require' => true],
        'setMesureUnit' => ['key' => ['#value', 'БазоваяЕдиницаИзмерения'], 'require' => true],
        'setPackingType' => ['key' => ['#value', 'ТипТовара']],
        'setGiftbox' => ['key' => [], 'default' => true],
        'setDirect_import' => ['key' => ['#value', 'АУ_ВЭД_ПрямойИмпорт']],
        'setFea_shipper' => ['key' => ['#value', 'НаименованиеПоставщика']],
        'setFea_producer' => ['key' => ['#value', 'АУ_ВЭД_ПроизводительСпецификации']],
        'setFea_country' => ['key' => ['#value', 'АУ_ВЭД_СтранаCпецификации']],
        'setFea_productionaddress' => ['key' => ['#value', 'АУ_ВЭД_АдресПроизводственнойМощности']],

        //'setFullname' => ['keys' => ['#value', 'АУ_НаименованиеПолное'], 'lang' => true],
        'setFullname' => ['lang_keys' => [
            'uk' => ['key' => ['#value', 'АУ_НаименованиеПолное']]
        ]],

        //setProductname' => ['keys' => ['#value', 'АУ_НаименованиеПродукта'], 'lang' => true],
        'setProductname' => ['lang_keys' => [
            'uk' => ['key' => ['#value', 'АУ_НаименованиеПродукта']]
        ]],

        //'setNameforthepricetag' => ['keys' => ['#value', 'АУ_НаименованиеДляЦенника'], 'lang' => true],
        'setNameforthepricetag' => ['lang_keys' => [
            'uk' => ['key' => ['#value', 'АУ_НаименованиеДляЦенника']]
        ]],

        //'setNameforcheck' => ['keys' => ['#value', 'АУ_НаименованиеДляФР'], 'lang' => true],
        'setNameforcheck' => ['lang_keys' => [
            'uk' => ['key' => ['#value', 'АУ_НаименованиеДляФР']]
        ]],
        'setFea_specification' => ['lang_keys' => [
            'en' => ['key' => ['#value', 'АУ_ВЭД_НаименованиеСпецификацииEng']],
            'uk' => ['key' => ['#value', 'АУ_ВЭД_НаименованиеCпецификации']]
        ]],

        //'setSpecification' => ['keys' => ['#value', 'АУ_ВЭД_НаименованиеCпецификации'], 'lang' => true]
        'setSpecification' => ['lang_keys' => [
            'uk' => ['key' => ['#value', 'АУ_ВЭД_НаименованиеCпецификации']]
        ]],
        'setProductFeatures' => [
            'dataset' => [
                'alcohol' => [
                    'year' => ['key' => ['#value', 'АУ_Алкоголь_Год']],
                    'size' => ['key' => ['#value', 'АУ_Алкоголь_Емкость']],
                    'alcohol' => ['key' => ['#value', 'АУ_Алкоголь_Крепость']],
                    'sugar' => ['key' => ['#value', 'АУ_Стикеры_Сахар']],
                    'aging' => ['key' => ['#value', 'АУ_Алкоголь_Выдержка']],
                    'vintage' => ['key' => ['#value', 'АУ_Алкоголь_Винтаж']],
                    //'biodimamics' => ['key' => ['#value', 'Биодинамика']],
                    'orange' => ['key' => ['#value', 'Оранж']],
                    //'organics' => ['key' => ['#value', 'АУ_Продукты_Органика']],
                    'naturalwine' => ['key' => ['#value', 'НатуральноеВино']],
                    'varietalshare' => ['key' => ['#value', 'АУ_ТекстСортовогоСостава']],
                    'classificationwithincountries' => ['key' => ['#value', 'АУ_Алкоголь_КлассификацияВнутриСтран']],
                    'raiting' => ['key' => ['#value', 'АУ_ОбъединеннаяПозицияАлкоголя']],
                    'vintageyear' => ['key' => ['#value', 'АУ_Алкоголь_Год']],
                    'wineStyle' => ['key' => ['#value', 'СтилистикаВина']],
                    'sulfite' => ['key' => ['#value', 'ВсегоСульфитов']],
                ],
                'product' => [
                    //'pasteurization' => ['key' => ['#value', 'АУ_Продукты_Пастеризация']],
                    'allegren' => ['key' => ['#value', 'АУ_Продукты_Аллергены']],
                    'farm' => ['key' => ['#value', 'Фермерский']],
                    'glutenfree' => ['key' => ['#value', 'Безглютеновый']],
                    'halal' => ['key' => ['#value', 'Халяльный']],
                    'vegan' => ['key' => ['#value', 'Веган']],
                    'lactosefree' => ['key' => ['#value', 'Безлактозный']],
                    'coimpositeproduct' => ['key' => ['#value', 'КомпозитныйПродукт']],
                    'kosher' => ['key' => ['#value', 'АУ_Кошерный_Продукт']],
                    'sugarless' => ['key' => ['#value', 'БезСахара']],
                    'vegetarian' => ['key' => ['#value', 'Вегетарианский']],
                    //'organics' => ['key' => ['#value', 'АУ_Продукты_Органика']],
                    //'biodynamics' => ['key' => ['#value', 'Биодинамика']],
                ],
                'nutrition' => [
                    'calories' => ['key' => ['#value', 'АУ_Стикеры_Калорийность']],
                    'fat' => ['key' => ['#value', 'АУ_Стикеры_Жиры']],
                    'protein' => ['key' => ['#value', 'АУ_Стикеры_Белки']],
                    'carb' => ['key' => ['#value', 'АУ_Стикеры_Углеводы']],
                    'sugar' => ['key' => ['#value', 'АУ_Стикеры_Сахар']],
                    'fatcontent' => ['key' => ['#value', 'АУ_Стикеры_Жирность']],
                    'fat_saturated' => ['key' => ['#value', 'Стикеры_НасыщенныеЖиры']],
                    'salt' => ['key' => ['#value', 'Стикеры_Соль']],
                    'fat_polyunsaturated' => ['key' => ['#value', 'Стикеры_ПНЖК']],
                    'na' => ['key' => ['#value', 'Стикеры_Na']],
                    'saltbyreceipt' => ['key' => ['#value', 'Стикеры_СольПоРецептуре']],
                ],
                'sticker' => [
                    'st_description' => ['key' => ['#value', 'АУ_Стикеры_ОписаниеСтикера']],
                    'st_cooking' => ['key' => ['#value', 'АУ_СпособПриготовления']],
                    'st_best_before' => ['key' => ['#value', 'АУ_СрокХранения']],
                    'st_storage_condition' => ['key' => ['#value', 'АУ_Стикеры_УсловияХранения']],
                    'st_composition' => ['key' => ['#value', 'АУ_СоставНоменклатуры']],
                ],
                'assortiment' => [
                    'A_BadBoy' => ['key' => ['#value', 'АУ_Ассортимент_BadBoy'], 'StatusNom' => true],
                    'A_GWEcommerce' => ['key' => ['#value', 'АУ_Ассортимент_GWEcommerce'], 'StatusNom' => true],
                    'A_HoReCa' => ['key' => ['#value', 'АУ_Ассортимент_HoReCa'], 'StatusNom' => true],
                    'A_Natural' => ['key' => ['#value', 'АУ_Ассортимент_Natural'], 'StatusNom' => true],
                    'A_productsdistribution' => ['key' => ['#value', 'АУ_Ассортимент_ДистрибуцияПродуктов'], 'StatusNom' => true],
                    'A_internet' => ['key' => ['#value', 'АУ_Ассортимент_Интернет'], 'StatusNom' => true],
                    'A_massmarket' => ['key' => ['#value', 'АУ_Ассортимент_Массмаркет'], 'StatusNom' => true],
                    'A_mechnikova' => ['key' => ['#value', 'АУ_Ассортимент_Мечникова'], 'StatusNom' => true],
                    'A_obolon' => ['key' => ['#value', 'АУ_Ассортимент_Оболонь'], 'StatusNom' => true],
                    'A_opt' => ['key' => ['#value', 'АУ_Ассортимент_Опт'], 'StatusNom' => true],
                    'A_bybox' => ['key' => ['#value', 'АУ_Ассортимент_ОтгрузкиКратноЯщику'], 'StatusNom' => true],
                    'A_tetrapack' => ['key' => ['#value', 'АУ_Ассортимент_ТетраПак'], 'StatusNom' => true],
                    'A_tsum' => ['key' => ['#value', 'АУ_Ассортимент_ЦУМ'], 'StatusNom' => true],
                    'A_ExclusiveHoReCa' => ['key' => ['#value', 'АУ_Ассортимент_ЭксклюзивнаяHoReCa'], 'StatusNom' => true],
                    'a_type' => ['key' => ['#value', 'АУ_ВидАссортимента']],
                    'a_type_date' => ['key' => ['#value', 'АУ_ВидАссортимента_Дата']],
                    'a_type_cause' => ['key' => ['#value', 'a_type_cause']],
                ],
            ],
        ],
    ];

    public function from1C(): Product
    {
        if ($this->product->getParent() == null) {
            // айдишник категории в которую складывать то что летит из ребита
            // папка New на тесте айдишник 7
            $this->product->setParentId($_ENV['PRODUCT_NEW_PARENTID']);
            echo 'New record' . PHP_EOL;
        }

        if (!$this->product->isPublished()) {
            // поставим статус опубликовано
            $this->product->setPublished(true);
        }

        foreach ($this->fuc as $func => $params) {
            if ($func == 'setClassificator') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $classificator = ProductClassificator::getByCode($value)->current();
                    $this->product->setClassificator($classificator);
                    // размещаем в правильной папке
                    if (!empty($classificator)) {
                        $folder = '/products/Products';
                        $rootFolderId = Folder::getByPath($folder)->getId();
                        //
                        $name[1] = str_replace(['/'], ['-'], $classificator->getName1());
                        $name[2] = str_replace(['/'], ['-'], $classificator->getName2());
                        $name[3] = str_replace(['/'], ['-'], $classificator->getName3());
                        //if($name[3] == $name[2] || empty($name[3]) || $name[3] == 'NULL'){
                        if (empty($name[3]) || $name[3] == 'NULL') {
                            unset($name[3]);
                        }
                        if (empty($name[2]) || $name[2] == 'NULL') {
                            unset($name[2]);
                        }
                        $targetFolder = $folder . '/' . implode('/', $name);
                        if (!$folderClass = Folder::getByPath($targetFolder)) {
                            $parentFolderId = $rootFolderId;
                            $searchFolder = $folder;
                            foreach ($name as $level) {
                                $searchFolder .= '/' . $level;
                                if (!$currentLevel = Folder::getByPath($searchFolder)) {
                                    $currentLevel = Folder::create([
                                        'o_parentId' => $parentFolderId,
                                        'o_path' => $searchFolder,
                                        'o_key' => $level,
                                        'o_published' => true
                                    ]);
                                    $currentLevel->save();
                                }
                                $parentFolderId = $currentLevel->getId();
                            }
                            $folderClass = Folder::getByPath($targetFolder);
                        }
                        $targetFolderId = $folderClass->getId();
                        // установим папку на папку из классификатора
                        $this->product->setParentId($targetFolderId);
                    }
                    continue;
                }
            }
            if ($func == 'setNomClass1') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $nomClass1 = ProductNomClass1::getByCode($value)->current();
                    $this->product->setNomClass1($nomClass1);
                    continue;
                }
            }
            if ($func == 'setNomClass2') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $nomClass2 = ProductNomClass2::getByCode($value)->current();
                    $this->product->setNomClass2($nomClass2);
                    continue;
                }
            }
            if ($func == 'setNomClass3') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $nomClass3 = ProductNomClass3::getByCode($value)->current();
                    $this->product->setNomClass3($nomClass3);
                    continue;
                }
            }
            if ($func == 'setNomClass4') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $nomClass4 = ProductNomClass4::getByCode($value)->current();
                    $this->product->setNomClass4($nomClass4);
                    continue;
                }
            }
            if ($func == 'setMesureUnit') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $measureUnit = MeasureUnit::getByCode($value)->current();
                    $this->product->setMesureUnit($measureUnit);
                    continue;
                }
            }
            if ($func == 'setDepartment') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $department = ProductDepartment::getByCode($value)->current();
//                    if(empty($department)){
//                        $department = new ProductDepartment();
//                        $department->setKey(trim($value));
//                        $department->setCode($value);
//                        $department->setName($value);
//                        $department->save();
//                    }
                    $this->product->setDepartment($department);
                    //echo 'Department: ' . (!empty($department) ? $department->getCurrentFullPath() : $value) . PHP_EOL;
                    continue;
                }
            }
            if ($func == 'setManufacturer') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $manufacturer = ProductManufacturer::getByCode($value)->current();
                    $this->product->setManufacturer($manufacturer);
                    //echo 'Manufacturer: ' . (!empty($manufacturer) ? $manufacturer->getCurrentFullPath() : $value) . PHP_EOL;
                    continue;
                }
            }
            if ($func == 'setTM') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $tm = ProductTM::getByCode($value)->current();
                    $this->product->setTM($tm);
                    continue;
                }
            }

            if ($func == 'setPL') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $tm = ProductTM::getByCode($value)->current();
                    $this->product->setPL($tm);
                    continue;
                }
            }
            if (in_array($func, ['setCountry', 'setRegion', 'setPlaceorigin'])) {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $productManufacture = ProductGeography::getByCode($value)->current();
                    $this->product->$func($productManufacture);
                    continue;
                }
            }

            if ($func == 'setFea_producer') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $productManufacture = ProductManufacturer::getByCode($value)->current();
                    $this->product->setFea_producer($productManufacture);
                    continue;
                }
            }

            if ($func == 'setFea_country') {
                if (!empty($params['key'])) {
                    $value = $this->getValue($params, $func);
                    $geography = ProductGeography::getByCode($value)->current();
                    $this->product->setFea_country($geography);
                    continue;
                }
            }
            if ($func == 'setProductFeatures') {
                if (!empty($params['dataset'])) {
                    $alcohol = $params['dataset']['alcohol'] ?? [];
                    $product = $params['dataset']['product'] ?? [];
                    $nutrition = $params['dataset']['nutrition'] ?? [];
                    $sticker = $params['dataset']['sticker'] ?? [];
                    $assortiment = $params['dataset']['assortiment'] ?? [];
                    $features = new Product\Productfeatures($this->product, 'productfeatures');
                    $alcoFeature = new Objectbrick\Data\AlcoholCharacteristics($this->product);
                    if (!empty($alcohol)) {
                        $alCount = 0;
                        foreach ($alcohol as $attribute => $params) {

                            if ($attribute === 'classificationwithincountries') {
                                if (!empty($params['key'])) {
                                    $value = $this->getValue($params, $func);
                                    if ($value !== $_ENV['EMPTY_REF']) {
                                        echo 'Set Alco Feature classificationwithincountries ' . $attribute . ':' . $value . PHP_EOL;
                                        $wineClass = WineCountryClass::getByRef($value)->current();
                                        $alcoFeature->setClassificationwithincountries([$wineClass]);
                                    }
                                }
                                continue;
                            }

                            if ($attribute === 'raiting') {
                                if (!empty($params['key'])) {
                                    //$value = $this->getValue($params, $func);
                                    //echo '<pre>',htmlspecialchars(print_r($params['key'],1)),'</pre>';
                                    $value = $this->getValue($params, $func);
                                    //echo '<pre>',htmlspecialchars(print_r('1111',1)),'</pre>';
                                    //echo '<pre>',htmlspecialchars(print_r($value,1)),'</pre>';
                                    if (!empty($value) && $value !== $_ENV['EMPTY_REF']) {
                                        $wineClass = WineJoin::getByRef($value)->current();
                                        //echo '<pre>',htmlspecialchars(print_r($wineClass,1)),'</pre>';
                                        echo 'Set Alco Feature raiting ' . $attribute . ':' . $value . PHP_EOL;
                                        //$alcoFeature->setRaiting([$wineClass]);
                                        $alcoFeature->setRaiting($wineClass);
                                    }
                                }else{
                                    echo 'Set Alco Feature raiting  emptyyyy' . PHP_EOL;
                                }
                                continue;
                            }

                            if ($attribute === 'sulfite') {
                                if (!empty($params['key'])) {
                                    $value = (array)$this->getValue($params, $func);
                                    echo 'Set Alco Feature sulfite ' . $attribute . PHP_EOL;
                                    if (!empty($value) && $value['#type'] === 'jxs:decimal') {
                                        $alcoFeature->setSulfite($value['#value']);
                                    }
                                }
                                continue;
                            }

                            $value = $this->getValue($params, $attribute);
                            if ($value != '' || $value != NULL) {
                                echo 'Set Alco Feature ' . $attribute . ':' . PHP_EOL;
                                $alcoFeature->setValue($attribute, $value);
                                $alCount++;
                            }
                        }
                    }
                    $features->setAlcoholCharacteristics($alcoFeature);


                    $productFeature = new Objectbrick\Data\Foodcharacteristics($this->product);
                    if (!empty($product)) {
                        $prCount = 0;
                        foreach ($product as $attribute => $params) {
                            $value = $this->getValue($params, $attribute);
                            if ($value != '' || $value != NULL) {
                                echo 'Set Product Feature ' . $attribute . ':' . $value . PHP_EOL;
                                $productFeature->setValue($attribute, $value);
                                $prCount++;
                            }
                        }
                    }
                    $features->setFoodcharacteristics($productFeature);


                    $nutritionFeature = new Objectbrick\Data\NutritionCharacteristics($this->product);
                    if (!empty($nutrition)) {
                        $nuCount = 0;
                        foreach ($nutrition as $attribute => $params) {
                            $value = $this->getValue($params, $attribute);
                            if ($value != '' || $value != NULL) {
                                echo 'Set Nutrition Feature ' . $attribute . ':' . $value . PHP_EOL;
                                $nutritionFeature->setValue($attribute, $value);
                                $nuCount++;
                            }
                        }
                    }
                    $features->setNutritionCharacteristics($nutritionFeature);

                    $stickerFeature = new Objectbrick\Data\Sticker($this->product);
                    if (!empty($sticker)) {
                        $stCount = 0;
                        foreach ($sticker as $attribute => $params) {
                            $value = $this->getValue($params, $attribute);
                            if ($value != '' || $value != NULL) {
                                echo 'Set Nutrition Feature ' . $attribute . ':' . $value . PHP_EOL;
                                $stickerFeature->setValue($attribute, $value);
                                $stCount++;
                            }
                        }
                    }
                    $features->setSticker($stickerFeature);

                    $assortimentFeature = new Objectbrick\Data\Assortiment($this->product);
                    if (!empty($assortiment)) {
                        echo 'start integrate assortiment bricks' . PHP_EOL;
                        $stCount = 0;
                        foreach ($assortiment as $attribute => $params) {
                            $value = $this->getValue($params, $attribute);
                            if ($value === $_ENV['EMPTY_REF']) {
                                echo 'empty assortiment bricks value: ' . $attribute . PHP_EOL;
                                continue;
                            }
                            if (!empty($params['StatusNom']) && !empty($value)) {
                                $nomModel = StatusNomHelper::checkIfStatusNomExist($value);
                                $assortimentFeature->setValue($attribute, $nomModel);
                                echo 'Set assortiment bricks feature 1 ' . $attribute . ':' . $value . PHP_EOL;
                                $stCount++;
                                continue;
                            }
                            if ($value != '' || $value != NULL) {
                                if ($attribute === 'a_type_date') {
                                    $value = new Carbon($value);
                                }
                                echo 'Set assortiment bricks feature 2 ' . $attribute . ':' . $value . PHP_EOL;
                                $assortimentFeature->setValue($attribute, $value);
                                $stCount++;
                            }
                        }
                    }
                    $features->setAssortiment($assortimentFeature);


                    $this->product->setProductfeatures($features);
                    continue;
                }
            }

            if (!empty($params['key'])) {
                $value = $this->getValue($params, $func);
                if ($value != '' || $value != NULL) {
                    $value = str_replace('/', '-', $value);
                    echo 'Set keyssss ' . $value . PHP_EOL;
                    $this->product->$func(trim($value));
                    //echo 'Processed attribute ' . $func . PHP_EOL;
                }
            }

            if (!empty($params['lang_keys'])) {
                foreach ($params['lang_keys'] as $lang => $data) {
                    $value = $this->getValue($data, $func);
                    if ($value != '' || $value != NULL) {
                        $value = str_replace('/', '-', $value);
                        echo 'Set lang_keys ' . $value . PHP_EOL;
                        $this->product->$func(trim($value), $lang);
                        //echo 'Processed attribute ' . $func . PHP_EOL;
                    }
                }
            }
        }


        return $this->product;


//       $this->product->setName($this->getRawKey('#value', 'Description'), $this->language);
//
//        $this->product->setDescription($this->getRawKey('#value', 'Description'),  $this->language);
//        $this->product->setItemnumber($this->getRawKey('#value', 'Артикул'));
//        $this->product->setPackingType($this->getRawKey('#value', 'ТипТовара'));
//        $this->product->setGiftbox(true);
//
//
//        $this->product->setFullname($this->getRawKey('#value', 'АУ_НаименованиеПолное'),  $this->language);
//        $this->product->setProductname($this->getRawKey('#value', 'АУ_НаименованиеПродукта'),  $this->language);
//        $this->product->setNameforthepricetag($this->getRawKey('#value', 'АУ_НаименованиеДляЦенника'),  $this->language);
//        $this->product->setNameforcheck($this->getRawKey('#value', 'АУ_НаименованиеДляФР'),  $this->language);
//        // UKR Specification
//        $this->product->setSpecification($this->getRawKey('#value', 'АУ_ВЭД_НаименованиеCпецификации'), $this->language);


//        return $this->product;

    }

    private function getValue($params, $func)
    {
        $value = $this->getRawKey($params['key']);

        if (!empty($params['default'])) {
            $value = $params['default'];
        }

        if (empty($value) && !empty($params['require'])) {
            throw new \Exception('Has not required field - ' . $func);
        }

        return $value;
    }

    private function getRawKey($source)
    {
        $data = $this->raw;


        foreach ($source as $key) {
            if (is_array($data)) {
                if (!isset($data[$key])) {
                    return null;
                }
                $data = $data[$key];
            } elseif (is_object($data)) {
                if (!isset($data->$key)) {
                    return null;
                }
                $data = $data->$key;
            }


        }

        return $data;
    }


}
