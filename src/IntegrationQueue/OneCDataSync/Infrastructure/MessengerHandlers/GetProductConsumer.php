<?php


namespace App\IntegrationQueue\OneCDataSync\Infrastructure\MessengerHandlers;


use pp\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductDescriptionType;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\Amatrix1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\CertificateType1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\Product1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductBarcode1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductCertificate1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductContactors1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductDepartment1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductDescription1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductDescriptionType1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductFacilityAddress1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductFEAC1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductFtCode1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductGeography1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductManufacture1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductMeasureUnits1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductNomClass11C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductNomClass21C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductNomClass31C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductNomClass41C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductPictures1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductTM1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductWineCountry1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ProductWineJoin1C;
use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\RegAmatrix1C;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\AmatrixHelper;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\CertificatesHelper;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\GeographyHelper;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\ManufactureHelper;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\StatusNomHelper;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\WineCountryHelper;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\WineJoinHelper;
use PhpAmqpLib\Message\AMQPMessage;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Amatrix;
use Pimcore\Model\DataObject\Certificates;
use Pimcore\Model\DataObject\CertificatesType;
use Pimcore\Model\DataObject\Contractors;
use Pimcore\Model\DataObject\FTcode;
use Pimcore\Model\DataObject\NomCertWithFEAC;
use Pimcore\Model\DataObject\ProductDepartment;
use Pimcore\Model\DataObject\ProductFacilityAddress;
use Pimcore\Model\DataObject\ProductGeography;
use Pimcore\Model\DataObject\ProductManufacturer;
use Pimcore\Model\DataObject\ProductNomClass1;
use Pimcore\Model\DataObject\ProductNomClass2;
use Pimcore\Model\DataObject\ProductNomClass3;
use Pimcore\Model\DataObject\ProductNomClass4;
use Pimcore\Model\DataObject\ProductTM;
use Pimcore\Model\DataObject\RegAMatrix;
use Pimcore\Model\DataObject\WineCountryClass;
use Pimcore\Model\DataObject\WineJoin;
use Pimcore\Model\Version;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


class GetProductConsumer
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
    /*public function execute(AMQPMessage $msg)
    {
        $startTime = -microtime(true);

        $data = json_decode($msg->getBody());
        $values = (array)$data;

        //disable versions for all inserts/updates
        Version::disable();


        $nomClassesMap = [
            '1' => [
                'base' => ProductNomClass1::class,
                '1C' => ProductNomClass11C::class
            ],
            '2' => [
                'base' => ProductNomClass2::class,
                '1C' => ProductNomClass21C::class
            ],
            '3' => [
                'base' => ProductNomClass3::class,
                '1C' => ProductNomClass31C::class
            ],
            '4' => [
                'base' => ProductNomClass4::class,
                '1C' => ProductNomClass41C::class
            ],
        ];
        switch ($values['#type']) {
            case "jcfg:CatalogObject.Номенклатура":
                ///////////////////////
                try {
                    if (empty($values['#value']->IsFolder) && !empty($values['#value']->Артикул)) {
                        $p = DataObject\Product::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                        if (empty($p)) {
                            $p = DataObject\Product::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                        }
                        if (empty($p)) {
                            $p = DataObject\Product::getByName(trim($values['#value']->Description), 'uk', ['limit' => 1, 'unpublished' => false]);
                        }
                        if (empty($p)) {
                            $p = DataObject\Product::getByName(trim($values['#value']->Description), 'uk', ['limit' => 1, 'unpublished' => true]);
                        }
                        if (empty($p)) {
                            $p = new DataObject\Product();
                        }
                        //check manufacture
                        if (!empty($values['#value']->АУ_Классификация_Производитель) && $values['#value']->АУ_Классификация_Производитель !== $_ENV['EMPTY_REF']) {
                            $pm = ProductManufacturer::getByCode($values['#value']->АУ_Классификация_Производитель, ['limit' => 1]);
                            if (empty($pm)) {
                                echo 'Create new manufacture when handle product: ' . $values['#value']->АУ_Классификация_Производитель . PHP_EOL;
                                $pmParent = new ProductManufacturer();
                                $pmParent
                                    ->setParentId($_ENV['PRODUCT_MANUFACTURE_ID'])
                                    ->setKey($values['#value']->АУ_Классификация_Производитель)
                                    ->setCode($values['#value']->АУ_Классификация_Производитель)
                                    ->setPublished(true);
                                if ($pmParent->save()) {
                                    echo 'Saved new manufacture when handle product ' . $values['#value']->АУ_Классификация_Производитель . PHP_EOL;
                                }
                            } else {
                                echo 'Found product manufacture when handle product : ' . $values['#value']->АУ_Классификация_Производитель . PHP_EOL;
                            }
                        }

                        //check TM
                        if (!empty($values['#value']->АУ_Классификация_ТорговаяМарка) && $values['#value']->АУ_Классификация_ТорговаяМарка !== $_ENV['EMPTY_REF']) {
                            ManufactureHelper::checkManufactureExist($values['#value']->АУ_Классификация_ТорговаяМарка);
                        }

                        //check PL
                        if (!empty($values['#value']->АУ_Классификация_ЛинияПродукта) && $values['#value']->АУ_Классификация_ЛинияПродукта !== $_ENV['EMPTY_REF']) {
                            ManufactureHelper::checkManufactureExist($values['#value']->АУ_Классификация_ЛинияПродукта);
                        }

                        //check fea_producer
                        if (!empty($values['#value']->АУ_ВЭД_ПроизводительСпецификации) && $values['#value']->АУ_ВЭД_ПроизводительСпецификации !== $_ENV['EMPTY_REF']) {
                            ManufactureHelper::checkManufactureExist($values['#value']->АУ_ВЭД_ПроизводительСпецификации);
                        }

                        //check geo country
                        if (!empty($values['#value']->АУ_Классификация_Страна) && $values['#value']->АУ_Классификация_Страна !== $_ENV['EMPTY_REF']) {
                            GeographyHelper::checkIfGeographyExist($values['#value']->АУ_Классификация_Страна);
                        }
                        //check geo region
                        if (!empty($values['#value']->АУ_Классификация_Регион) && $values['#value']->АУ_Классификация_Регион !== $_ENV['EMPTY_REF']) {
                            GeographyHelper::checkIfGeographyExist($values['#value']->АУ_Классификация_Регион);
                        }
                        //check geo placeorigin
                        if (!empty($values['#value']->АУ_Классификация_МестоПроисхождения) && $values['#value']->АУ_Классификация_МестоПроисхождения !== $_ENV['EMPTY_REF']) {
                            GeographyHelper::checkIfGeographyExist($values['#value']->АУ_Классификация_МестоПроисхождения);
                        }
                        //check geo fea_country
                        if (!empty($values['#value']->АУ_ВЭД_СтранаCпецификации) && $values['#value']->АУ_ВЭД_СтранаCпецификации !== $_ENV['EMPTY_REF']) {
                            GeographyHelper::checkIfGeographyExist($values['#value']->АУ_ВЭД_СтранаCпецификации);
                        }

                        //check classificationwithincountries
                        if (!empty($values['#value']->АУ_Алкоголь_КлассификацияВнутриСтран) && $values['#value']->АУ_Алкоголь_КлассификацияВнутриСтран !== $_ENV['EMPTY_REF']) {
                            WineCountryHelper::checkIfWineCountryExist($values['#value']->АУ_Алкоголь_КлассификацияВнутриСтран);
                        }

                        //check wineJoin
                        if (!empty($values['#value']->АУ_ОбъединеннаяПозицияАлкоголя) && $values['#value']->АУ_ОбъединеннаяПозицияАлкоголя !== $_ENV['EMPTY_REF']) {
                            WineJoinHelper::checkIfWineExist($values['#value']->АУ_ОбъединеннаяПозицияАлкоголя);
                        }


                        //check department
                        if (!empty($values['#value']->АУ_Классификация_Отдел) && $values['#value']->АУ_Классификация_Отдел !== $_ENV['EMPTY_REF']) {
                            $dep = ProductDepartment::getByCode($values['#value']->АУ_Классификация_Отдел, ['limit' => 1]);
                            if (empty($dep)) {
                                echo 'Create new department when handle product: ' . $values['#value']->АУ_Классификация_Отдел . PHP_EOL;
                                $geoParent = new ProductDepartment();
                                $geoParent
                                    ->setParentId($_ENV['PRODUCT_DEPARTMENT_PARENTID'])
                                    ->setKey($values['#value']->АУ_Классификация_Отдел)
                                    ->setCode($values['#value']->АУ_Классификация_Отдел)
                                    ->setPublished(true);
                                if ($geoParent->save()) {
                                    echo 'Saved new department when handle product ' . $values['#value']->АУ_Классификация_Отдел . PHP_EOL;
                                }
                            } else {
                                echo 'Found product department when handle product : ' . $values['#value']->АУ_Классификация_Отдел . PHP_EOL;
                            }
                        }

                        //check nom{1,2,3,4}
                        $this->handleNomObject($values['#value']->АУ_Классификация_КлассНоменклатуры1, $nomClassesMap['1']['base'], 1);
                        $this->handleNomObject($values['#value']->АУ_Классификация_КлассНоменклатуры2, $nomClassesMap['2']['base'], 2);
                        $this->handleNomObject($values['#value']->АУ_Классификация_КлассНоменклатуры3, $nomClassesMap['3']['base'], 3);
                        $this->handleNomObject($values['#value']->АУ_Классификация_КлассНоменклатуры4, $nomClassesMap['4']['base'], 4);

                        $model = (new Product1C($data, $p))->from1c();
                        if (!empty($model)) {
                            $model->save();
                            $endTime = microtime(true);
                            echo '------------------' . PHP_EOL;
                            echo 'Saved product with id: ' . $model->getId() . ' code 1C: ' . $values['#value']->Ref . ' ' . round($startTime + $endTime, 4) . ' sec' . PHP_EOL;
                            echo '------------------' . PHP_EOL;
                        }
                    } elseif (empty($values['#value']->Артикул)) {
                        echo '------------------' . PHP_EOL;
                        echo 'Product has no itemnumber: Empty Артикул' . PHP_EOL;
                        //var_dump($values['#value']);
                        echo '------------------' . PHP_EOL;
                    }

                } catch (\Exception $exception) {
                    echo '------------------' . PHP_EOL;
                    echo('Error on save 1c product: ' . $exception->getMessage());
                    echo PHP_EOL;
                    echo('line: ' . $exception->getTraceAsString());
                    echo PHP_EOL;
                    echo(!empty($values['#value']->Ref) ? 'Code 1C: ' . $values['#value']->Ref : 'Empty 1c code');
                    echo PHP_EOL;
                    echo(!empty($values['#value']->Артикул) ? 'Артикул: ' . $values['#value']->Артикул : 'Empty Артикул');
                    echo PHP_EOL;
                    file_put_contents(__DIR__ . '/error.log', $exception->getTraceAsString());
                    echo '------------------' . PHP_EOL;
                    return;
                }
                ///////////////////////
                break;
            case "jcfg:InformationRegisterRecordSet.ШтриховыеКоды":
                try {
                    foreach ($values['#value']->Record as $record) {
                        $new = false;
                        $pb = DataObject\ProductBarcode::getByBarcode($record->ШтрихКод, ['limit' => 1, 'unpublished' => true]);
                        if (empty($pb)) {
                            $pb = DataObject\ProductBarcode::getByBarcode($record->ШтрихКод, ['limit' => 1, 'unpublished' => false]);
                        }
                        if (empty($pb)) {
                            $new = true;
                            $pb = new DataObject\ProductBarcode();
                            $pb->setKey($record->ШтрихКод);
                        }
                        $productDescription = (new ProductBarcode1C($record, $pb))->from1C();
                        if ($productDescription->save()) {
                            echo ($new == false ? 'Updated' : 'Saved') . ' product barcode ' . $record->ШтрихКод . PHP_EOL;
                        }
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c product barcode: ' . $exception->getMessage()) . PHP_EOL;
                }
                break;
            case "jcfg:InformationRegisterRecordSet.АУ_ОписанияНоменклатуры":
                try {
                    foreach ($values['#value']->Record as $record) {
                        if (empty($record->Описание)) {
                            continue;
                        }
                        $new = false;
                        $code = md5($record->Номенклатура . $record->ВидОписания);
                        $pd = DataObject\ProductDescription::getByCode($code, ['limit' => 1, 'unpublished' => true]);
                        if (empty($pd)) {
                            $pd = DataObject\ProductDescription::getByCode($code, ['limit' => 1, 'unpublished' => false]);
                        }
                        if (empty($pd)) {
                            $new = true;
                            $pd = new DataObject\ProductDescription();
                            $pd->setCode($code);
                            $pd->setKey($code);
                        }
                        $productDescription = (new ProductDescription1C($record, $pd))->from1C();
                        if ($productDescription->save()) {
                            echo ($new == false ? 'Updated' : 'Saved') . ' product description Code ' . $code . PHP_EOL;
                        }
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c product description: ' . $exception->getMessage()) . PHP_EOL;
                }
                break;
            case "jcfg:CatalogObject.АУ_ОписанияТовара":
                try {
                    $pt = DataObject\ProductDescriptionType::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($pt)) {
                        $pt = DataObject\ProductDescriptionType::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($pt)) {
                        $pt = new DataObject\ProductDescriptionType();
                    }
                    $productDescriptionType = (new ProductDescriptionType1C($values['#value'], $pt))->from1C();
                    if ($productDescriptionType->save()) {
                        echo 'Saved product description type Code ' . $values['#value']->Code . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c product description type : ' . $exception->getMessage()) . PHP_EOL;
                }
                break;
            case "jcfg:InformationRegisterRecordSet.СсылкиНаФотоСайта":
                try {
                    foreach ($values['#value']->Record as $record) {
                        if (!preg_match('/\.(jpg|png)$/', trim($record->URL))) {
                            continue;
                        }
                        $pp = DataObject\ProductPictures::getByProduct($record->Номенклатура, ['limit' => 1, 'unpublished' => true]);
                        if (empty($pp)) {
                            $pp = DataObject\ProductPictures::getByProduct($record->Номенклатура, ['limit' => 1, 'unpublished' => false]);
                        }
                        if (empty($pp)) {
                            $pp = new DataObject\ProductPictures();
                        }
                        $productPicture = (new ProductPictures1C($record, $pp))->from1C();
                        if ($productPicture->save()) {
                            echo 'Saved picture for product ' . $record->Номенклатура . PHP_EOL;
                        }
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c product picture : ' . $exception->getMessage()) . PHP_EOL;
                }
                break;
            case "jcfg:CatalogObject.А_ЕдиницыИзмерения":
                try {
                    $pm = DataObject\AMeasureUnits::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($pm)) {
                        $pm = DataObject\AMeasureUnits::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($pm)) {
                        $pm = new DataObject\AMeasureUnits();
                    }
                    $measureUnit = (new ProductMeasureUnits1C($values['#value'], $pm))->from1C();
                    if ($measureUnit->save()) {
                        echo 'Saved AMeasureUnits for product ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c AMeasureUnits : ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                }
                break;
            case "jcfg:DocumentObject.АУ_УстановкаЦенНоменклатуры":
                try {
                    echo 'queue АУ_УстановкаЦенНоменклатуры turn off...' . PHP_EOL;
//                    foreach ($values['#value']->Товары as $record) {
//                        if ($record->ТипЦен != 'eb379b2a-643b-442d-b0c9-edca56c5f009') {
//                            continue;
//                        }
//                        $code = md5($record->Номенклатура . $record->ТипЦен . $values['#value']->Date . $record->ЕдиницаИзмерения);
//
//                        $pp = DataObject\Prices::getByCode($code, ['limit' => 1, 'unpublished' => true]);
//                        if (empty($pp)) {
//                            $pp = DataObject\Prices::getByCode($code, ['limit' => 1, 'unpublished' => false]);
//                        }
//                        if (empty($pp)) {
//                            $pp = new DataObject\Prices();
//                        } else {
//                        }
//
//                        $record->Date = $values['#value']->Date;
//
//                        $productPrice = (new ProductPrice1C($record, $pp))->from1C();
//                        if ($productPrice->save()) {
//                            echo 'Saved Price for product ' . $record->Номенклатура . PHP_EOL;
//                        }
//                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c Prices : ' . $exception->getMessage()) . ' code ' . $values['#value']->Code . PHP_EOL;
                }
                //die;
                break;
            case "jcfg:CatalogObject.АУ_ОтделыМагазинов":
                try {
                    $pd = ProductDepartment::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($pd)) {
                        $pd = ProductDepartment::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($pd)) {
                        $pd = new ProductDepartment();
                    }
                    $productDepartment = (new ProductDepartment1C($values['#value'], $pd))->from1C();
                    if ($productDepartment->save()) {
                        echo 'Saved Product Department ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c Product Department : ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_Номенклатура_КлассНоменклатуры1":
            case "jcfg:CatalogObject.АУ_Номенклатура_КлассНоменклатуры2":
            case "jcfg:CatalogObject.АУ_Номенклатура_КлассНоменклатуры3":
            case "jcfg:CatalogObject.АУ_Номенклатура_КлассНоменклатуры4":
                try {
                    $handleClasses = $nomClassesMap[substr($values['#type'], -1)];
                    if (empty($handleClasses)) {
                        throw new \Exception('Undefined class for handle query');
                    }
                    $n1 = $handleClasses['base']::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($n1)) {
                        $n1 = $handleClasses['base']::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($n1)) {
                        $n1 = new $handleClasses['base']();
                    }
                    $nom1 = (new $handleClasses['1C']($values['#value'], $n1))->from1C();
                    if ($nom1->save()) {
                        echo 'Saved Product Nom ' . substr($values['#type'], -1) . ' ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c Product Nom ' . substr($values['#type'], -1) . ' : ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_ТМ_Линия":
                try {
                    $tm = ProductTM::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($tm)) {
                        $tm = ProductTM::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($tm)) {
                        $tm = new ProductTM();
                    }
                    //check for parent id
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $tmParent = ProductTM::getByCode($values['#value']->Parent, ['limit' => 1]);
                        echo 'Dont empty Product TM ' . $values['#value']->Parent . PHP_EOL;
                        if (empty($tmParent)) {
                            echo 'Create parent Product TM ' . $values['#value']->Parent . PHP_EOL;
                            $tmParent = new ProductTM();
                            $tmParent->setKey($values['#value']->Parent)
                                ->setCode($values['#value']->Parent)
                                ->setPublished(true)
                                ->setParentId($_ENV['PRODUCT_TM']);
                            if ($tmParent->save()) {
                                echo 'Saved parent product for Product TM ' . $values['#value']->Parent . PHP_EOL;
                            }
                        } else {
                            echo 'Found parent TM : ' . $values['#value']->Parent . PHP_EOL;
                        }
                        $values['#value']->ParentFolderId = $tmParent->getId();
                    }

                    $productTM = (new ProductTM1C($values['#value'], $tm))->from1C();
                    if ($productTM->save()) {
                        echo 'Saved Product TM ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c Product TM: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_Производитель":
                try {
                    $pm = ProductManufacturer::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($pm)) {
                        $pm = ProductManufacturer::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($pm)) {
                        $pm = new ProductManufacturer();
                    }
                    $productManufacture = (new ProductManufacture1C($values['#value'], $pm))->from1C();
                    if ($productManufacture->save()) {
                        echo 'Saved Product Manufacture ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c Product Manufacture: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_Страна_Регион_Область":
                try {
                    $pg = ProductGeography::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => true]);
                    if (empty($pg)) {
                        $pg = ProductGeography::getByCode($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($pg)) {
                        $pg = new ProductGeography();
                    }
                    //check for parent id
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $tmGeography = ProductGeography::getByCode($values['#value']->Parent, ['limit' => 1]);
                        echo 'Dont empty Product Geography ' . $values['#value']->Parent . PHP_EOL;
                        if (empty($tmGeography)) {
                            echo 'Create parent Product Geography ' . $values['#value']->Parent . PHP_EOL;
                            $tmGeography = new ProductGeography();
                            $tmGeography->setKey($values['#value']->Parent)
                                ->setCode($values['#value']->Parent)
                                ->setPublished(true)
                                ->setParentId($_ENV['PRODUCT_GEOGRAPHY_ID']);
                            if ($tmGeography->save()) {
                                echo 'Saved parent for Product Geography ' . $values['#value']->Parent . PHP_EOL;
                            }
                        } else {
                            echo 'Found parent Product Geography : ' . $values['#value']->Parent . PHP_EOL;
                        }
                        $values['#value']->ParentFolderId = $tmGeography->getId();
                    }

                    $productGeography = (new ProductGeography1C($values['#value'], $pg))->from1C();
                    if ($productGeography->save()) {
                        echo 'Saved Product Geography ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c Product Geography: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_КлассификацияВнутриСтран":
                try {
                    $wineCountry = WineCountryClass::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($wineCountry)) {
                        $wineCountry = WineCountryClass::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($wineCountry)) {
                        $wineCountry = new WineCountryClass();
                    }
                    //check for parent id
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $parent = WineCountryHelper::checkIfWineCountryExist($values['#value']->Parent);
                        $values['#value']->ParentFolderId = $parent->getId();
                        $values['#value']->ParentObject = $parent;
                        echo 'Saved parent WineCountryClass. Folder id: ' . $parent->getId() . PHP_EOL;
                    }

                    $model = (new ProductWineCountry1C($values['#value'], $wineCountry))->from1C();
                    if ($model->save()) {
                        echo 'Saved WineCountryClass ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c WineCountryClass: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_ОбъединенныеПозицииАлкоголя":
                try {
                    $wineJoin = WineJoin::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($wineJoin)) {
                        $wineJoin = WineJoin::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($wineJoin)) {
                        $wineJoin = new WineJoin();
                    }
                    //check for parent id
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $parent = WineJoinHelper::checkIfWineExist($values['#value']->Parent);
                        $values['#value']->ParentFolderId = $parent->getId();
                        $values['#value']->ParentObject = $parent;
                        echo 'Saved parent WineJoin. Folder id: ' . $parent->getId() . PHP_EOL;
                    }

                    $model = (new ProductWineJoin1C($values['#value'], $wineJoin))->from1C();
                    if ($model->save()) {
                        echo 'Saved WineJoin ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c WineJoin: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_Сертификаты":
                try {
                    //check if folder flag option
                    if ((bool)$values['#value']->IsFolder) {
                        echo 'АУ_Сертификаты IsFolder flag detected. Skip functional' . PHP_EOL;
                        break;
                    }
                    $certificate = Certificates::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($certificate)) {
                        $certificate = Certificates::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($certificate)) {
                        $certificate = new Certificates();
                    }
                    //check for parent id
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $parent = CertificatesHelper::checkIfCertificateExist($values['#value']->Parent);
                        $values['#value']->ParentFolderId = $parent->getId();
                        $values['#value']->ParentObject = $parent;
                        echo 'Saved parent certificate. id: ' . $parent->getId() . PHP_EOL;
                    }

                    //check for agent
                    $values['#value']->AgentObject = null;
                    if (!empty($values['#value']->КемВыдан) && $values['#value']->КемВыдан !== $_ENV['EMPTY_REF']) {
                        $values['#value']->AgentObject = CertificatesHelper::checkIfAgentExist($values['#value']->КемВыдан);
                        echo 'Saved agent. Folder id: ' . $values['#value']->КемВыдан . PHP_EOL;
                    }

                    //check for certificate type
                    $values['#value']->CertTypeObject = null;
                    if (!empty($values['#value']->ВидСертификата) && $values['#value']->ВидСертификата !== $_ENV['EMPTY_REF']) {
                        $values['#value']->CertTypeObject = CertificatesHelper::checkIfCertTypeExist($values['#value']->ВидСертификата);
                        echo 'Saved certificate type. Folder id: ' . $values['#value']->ВидСертификата . PHP_EOL;
                    }

                    //check for country type
                    $values['#value']->CountryObject = null;
                    if (!empty($values['#value']->СтранаПроисхождения) && $values['#value']->СтранаПроисхождения !== $_ENV['EMPTY_REF']) {
                        $values['#value']->CountryObject = GeographyHelper::checkIfGeographyExist($values['#value']->СтранаПроисхождения);
                        echo 'Saved country type. Folder id: ' . $values['#value']->СтранаПроисхождения . PHP_EOL;
                    }

                    //check for supplier type
                    $values['#value']->SupplierObject = null;
                    if (!empty($values['#value']->КонтрагентОтбора) && $values['#value']->КонтрагентОтбора !== $_ENV['EMPTY_REF']) {
                        $values['#value']->SupplierObject = CertificatesHelper::checkIfAgentExist($values['#value']->КонтрагентОтбора);
                        echo 'Saved supplier type. Folder id: ' . $values['#value']->КонтрагентОтбора . PHP_EOL;
                    }

                    //check for producer type
                    $values['#value']->ProducerObject = null;
                    if (!empty($values['#value']->Производитель) && $values['#value']->Производитель !== $_ENV['EMPTY_REF']) {
                        $producerArr = (array)($values['#value']->Производитель);
                        $values['#value']->ProducerObject = CertificatesHelper::checkIfAgentExist($producerArr['#value']);
                        echo 'Saved producer. Folder id: ' . $producerArr['#value'] . PHP_EOL;
                    }
                    $model = (new ProductCertificate1C($values['#value'], $certificate))->from1C();
                    if ($model->save()) {
                        echo 'Saved certificate ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c certificate: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.Контрагенты":
                try {
                    $contractors = Contractors::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($contractors)) {
                        $contractors = Contractors::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($contractors)) {
                        $contractors = new Contractors();
                    }

                    $model = (new ProductContactors1C($values['#value'], $contractors))->from1C();
                    if ($model->save()) {
                        echo 'Saved productContactors ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c productContactors: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:InformationRegisterRecordSet.СертификатыНоменклатурыСКодамиТНВЭД":
                try {
                    $values['#value'] = $values['#value']->Record[0];
                    $code = CertificatesHelper::buildCodeValueForFEAC($values['#value']->Сертификат, $values['#value']->Номенклатура);
                    $codesFEAC = NomCertWithFEAC::getByCode($code, ['limit' => 1]);
                    if (empty($codesFEAC)) {
                        $codesFEAC = NomCertWithFEAC::getByCode($code, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($codesFEAC)) {
                        $codesFEAC = new NomCertWithFEAC();
                    }

                    //search by code FEA
                    $values['#value']->FEAObject = null;
                    if (!empty($values['#value']->КодТНВЭД) && $values['#value']->КодТНВЭД !== $_ENV['EMPTY_REF']) {
                        $values['#value']->FEAObject = CertificatesHelper::checkIfCodeFeaExist($values['#value']->КодТНВЭД);
                        echo 'Saved codeFeu. Folder id: ' . $values['#value']->КодТНВЭД . PHP_EOL;
                    }

                    //search by supplier
                    $values['#value']->SupplierObject = null;
                    if (!empty($values['#value']->Поставщик) && $values['#value']->Поставщик !== $_ENV['EMPTY_REF']) {
                        $values['#value']->SupplierObject = CertificatesHelper::checkIfAgentExist($values['#value']->Поставщик);
                        echo 'Saved supplier. Folder id: ' . $values['#value']->Поставщик . PHP_EOL;
                    }

                    //search by producer
                    $values['#value']->ProducerObject = null;
                    if (!empty($values['#value']->Производитель)) {
                        $producerArr = (array)$values['#value']->Производитель;
                        if ($producerArr['#value'] !== $_ENV['EMPTY_REF']) {
                            $values['#value']->ProducerObject = CertificatesHelper::checkIfAgentExist($producerArr['#value']);
                            echo 'Saved producer. Folder id: ' . $producerArr['#value'] . PHP_EOL;
                        }
                    }

                    //search by certificate
                    $values['#value']->CertificateObject = null;
                    if (!empty($values['#value']->Сертификат) && $values['#value']->Сертификат !== $_ENV['EMPTY_REF']) {
                        $values['#value']->CertificateObject = CertificatesHelper::checkIfCertificateExist($values['#value']->Сертификат);
                        echo 'Saved certificate. Folder id: ' . $values['#value']->Сертификат . PHP_EOL;
                    }

                    $model = (new ProductFEAC1C($values['#value'], $codesFEAC))->from1C();
                    if ($model->save()) {
                        echo 'Saved NomCertWithFEAC ' . $code . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c NomCertWithFEAC: ' . $exception->getMessage() . '---' . $exception->getLine()) . ' Ref ' . $code . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_КодыТНВЭД":
                try {
                    $codesFEAC = FTcode::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($codesFEAC)) {
                        $codesFEAC = FTcode::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($codesFEAC)) {
                        $codesFEAC = new FTcode();
                    }

                    //check for parent id
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $parent = CertificatesHelper::checkIfCodeFeaExist($values['#value']->Parent);
                        $values['#value']->ParentFolderId = $parent->getId();
                        $values['#value']->ParentObject = $parent;
                        echo 'Saved parent FTcode. id: ' . $parent->getId() . PHP_EOL;
                    }

                    $model = (new ProductFtCode1C($values['#value'], $codesFEAC))->from1C();
                    if ($model->save()) {
                        echo 'Saved FTcode ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c FTcode: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_АдресаПроизводственныхМощностей":
                try {
                    $facility = ProductFacilityAddress::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($facility)) {
                        $facility = ProductFacilityAddress::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($facility)) {
                        $facility = new ProductFacilityAddress();
                    }

                    //check for parent
                    $values['#value']->ParentObject = null;
                    if (!empty($values['#value']->Parent) && $values['#value']->Parent !== $_ENV['EMPTY_REF']) {
                        $parent = CertificatesHelper::checkIfProductFacilityAddressExist($values['#value']->Parent);
                        $values['#value']->ParentFolderId = $parent->getId();
                        $values['#value']->ParentObject = $parent;
                        echo 'Saved parent ProductFacilityAddress. id: ' . $parent->getId() . PHP_EOL;
                    }

                    //check for country
                    $values['#value']->CountryObject = null;
                    if (!empty($values['#value']->Страна) && $values['#value']->Страна !== $_ENV['EMPTY_REF']) {
                        $values['#value']->CountryObject = GeographyHelper::checkIfGeographyExist($values['#value']->Страна);
                        echo 'Saved country. Folder id: ' . $values['#value']->Страна . PHP_EOL;
                    }

                    //check for producer type
                    $values['#value']->ProducerObject = null;
                    if (!empty($values['#value']->Производитель) && $values['#value']->Производитель !== $_ENV['EMPTY_REF']) {
                        $values['#value']->ProducerObject = CertificatesHelper::checkIfAgentExist($values['#value']->Производитель);
                        echo 'Saved producer. Folder id: ' . $values['#value']->Производитель . PHP_EOL;
                    }

                    $model = (new ProductFacilityAddress1C($values['#value'], $facility))->from1C();
                    if ($model->save()) {
                        echo 'Saved ProductFacilityAddress ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c ProductFacilityAddress: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
            case "jcfg:CatalogObject.АУ_КлассификаторВидовСертификатов":
                try {
                    $certTypes = CertificatesType::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($certTypes)) {
                        $certTypes = CertificatesType::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($certTypes)) {
                        $certTypes = new CertificatesType();
                    }

                    $model = (new CertificateType1C($values['#value'], $certTypes))->from1C();
                    if ($model->save()) {
                        echo 'Saved CertificatesType ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c CertificatesType: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
                case "jcfg:CatalogObject.АссортиментныеМатрицы":
                try {
                    $amatrix = Amatrix::getByRef($values['#value']->Ref, ['limit' => 1]);
                    if (empty($amatrix)) {
                        $amatrix = Amatrix::getByRef($values['#value']->Ref, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($amatrix)) {
                        $amatrix = new Amatrix();
                    }

                    $model = (new Amatrix1C($values['#value'], $amatrix))->from1C();
                    if ($model->save()) {
                        echo 'Saved amatrix ' . $values['#value']->Ref . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c amatrix: ' . $exception->getMessage()) . ' Ref ' . $values['#value']->Ref . PHP_EOL;
                    die;
                }
                break;
                case "jcfg:InformationRegisterRecordSet.АссортиментныеМатрицы":
                try {
                    $values['#value'] = $values['#value']->Record[0];
                    $code = AmatrixHelper::buildRegAmatrixCode($values['#value']->Объект, $values['#value']->АссортиментнаяМатрица);
                    $recordAmatrix = RegAMatrix::getByCode($code, ['limit' => 1]);
                    if (empty($recordAmatrix)) {
                        $recordAmatrix = RegAMatrix::getByCode($code, ['limit' => 1, 'unpublished' => false]);
                    }
                    if (empty($recordAmatrix)) {
                        $recordAmatrix = new RegAMatrix();
                    }

                    //check for amatrix
                    $values['#value']->MatrixObject = null;
                    if (!empty($values['#value']->АссортиментнаяМатрица) && $values['#value']->АссортиментнаяМатрица !== $_ENV['EMPTY_REF']) {
                        $values['#value']->MatrixObject = AmatrixHelper::checkIfAmatrixExist($values['#value']->АссортиментнаяМатрица);
                        echo 'Saved amatrix. Folder id: ' . $values['#value']->АссортиментнаяМатрица . PHP_EOL;
                    }

                    //check for status nom
                    $values['#value']->StatusObject = null;
                    if (!empty($values['#value']->Значение) && $values['#value']->Значение !== $_ENV['EMPTY_REF']) {
                        $values['#value']->StatusObject = StatusNomHelper::checkIfStatusNomExist($values['#value']->Значение);
                        echo 'Saved status nom. Folder id: ' . $values['#value']->Значение . PHP_EOL;
                    }


                    $model = (new RegAmatrix1C($values['#value'], $recordAmatrix))->from1C();
                    if ($model->save()) {
                        echo 'Saved amatrix ' . PHP_EOL;
                    }
                } catch (\Exception $exception) {
                    echo ('Error on save 1c amatrix: ' . $exception->getMessage())  . PHP_EOL;
                    die;
                }
                break;
            default:
            {
                echo 'unknown type: ' . $values['#type'] . PHP_EOL;
            }
        }
    }

    /**
     * @param $dataToCheck
     * @param ProductNomClass1|ProductNomClass2|ProductNomClass3|ProductNomClass4 $objectToCheck
     * @param int $index
     * @throws \Exception
     */
    /* protected function handleNomObject($value, $objectToCheck, int $index)
     {
         echo 'start search nom #' . $index . PHP_EOL;
         $parent = $_ENV['PRODUCT_NOM_' . $index];
         if (!empty($value) && $value !== $_ENV['EMPTY_REF']) {
             $nom = $objectToCheck::getByCode($value, ['limit' => 1]);
             if (empty($nom)) {
                 echo 'Create new nom ' . $index . ' when handle product: ' . $value . PHP_EOL;
                 $nomParent = new $objectToCheck();
                 $nomParent
                     ->setParentId($parent)
                     ->setKey($value)
                     ->setCode($value)
                     ->setPublished(true);
                 if ($nomParent->save()) {
                     echo 'Saved new nom' . $index . ' when handle product ' . $value . PHP_EOL;
                 }
             } else {
                 echo 'Found nom ' . $index . ' when handle product : ' . $value . PHP_EOL;
             }
         }
     }*/
}
