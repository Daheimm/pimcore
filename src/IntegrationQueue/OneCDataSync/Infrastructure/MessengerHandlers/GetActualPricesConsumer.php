<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 12.04.2021 14:27
 */

namespace App\IntegrationQueue\OneCDataSync\Infrastructure\MessengerHandlers;


use App\IntegrationQueue\OneCDataSync\Application\Adapter\Product\ActualPrice1C;
use App\IntegrationQueue\OneCDataSync\Application\Helpers\ActualPricesHelper;
use PhpAmqpLib\Message\AMQPMessage;
use Pimcore\Model\DataObject\ActualPrices;
use Pimcore\Model\DataObject\AMeasureUnits;
use Pimcore\Model\Version;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


class GetActualPricesConsumer
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
    /* public function execute(AMQPMessage $msg)
     {
         $startTime = -microtime(true);

         $data = json_decode($msg->getBody());
         $values = (array)$data;

         //disable versions for all inserts/updates
         Version::disable();

         switch ($values['#type']) {
             case "jcfg:InformationRegisterRecordSet.ТекущиеЦеныНоменклатуры":
                 try {
                     $categoryPrice = ActualPricesHelper::getValueFromFilters('КатегорияЦен', $values['#value']->Filter);
                     $priceFit = !empty($categoryPrice) && mb_strtoupper($categoryPrice) === mb_strtoupper($_ENV['ACTUAL_PRICE_CATEGORY_PRICE']);
                     $nomValue = ActualPricesHelper::getValueFromFilters('Номенклатура', $values['#value']->Filter);
                     $catPrice = ActualPricesHelper::getValueFromFilters('КатегорияЦен', $values['#value']->Filter);

                     if ($priceFit && !empty($values['#value']->Record)) {
                         echo 'price fit, start import, prices exist...' . PHP_EOL;
                         foreach ($values['#value']->Record as $onePrice) {
                             $code = ActualPricesHelper::buildCodeValueForPrice($onePrice->Номенклатура, $onePrice->КатегорияЦен);
                             $actualPrice = ActualPrices::getByCode($code, ['limit' => 1, 'unpublished' => true]);
                             if (empty($actualPrice)) {
                                 $actualPrice = ActualPrices::getByCode($code, ['limit' => 1, 'unpublished' => false]);
                             }
                             if (empty($actualPrice)) {
                                 $actualPrice = new ActualPrices();
                             }
                             //check AMeasureUnits
                             if (!empty($onePrice->ЕдиницаИзмерения) && $onePrice->ЕдиницаИзмерения !== $_ENV['EMPTY_REF']) {
                                 $unitModel = AMeasureUnits::getByRef($onePrice->ЕдиницаИзмерения, ['limit' => 1, 'unpublished' => true]);
                                 if (empty($unitModel)) {
                                     $unitModel = AMeasureUnits::getByRef($onePrice->ЕдиницаИзмерения, ['limit' => 1, 'unpublished' => false]);
                                 }
                                 if (empty($unitModel)) {
                                     echo 'AMeasureUnits not found, create new object ' . $onePrice->ЕдиницаИзмерения . PHP_EOL;
                                     $unitModel = new AMeasureUnits();
                                     $unitModel
                                         ->setParentId($_ENV['AMEASURE_UNIT_DIR'])
                                         ->setKey($onePrice->ЕдиницаИзмерения)
                                         ->setRef($onePrice->ЕдиницаИзмерения)
                                         ->setPublished(true);

                                     if ($unitModel->save()) {
                                         echo 'Saved new AMeasureUnits when handle price ' . $onePrice->ЕдиницаИзмерения . PHP_EOL;
                                     }
                                 } else {
                                     echo 'AMeasureUnits found in DB ' . $onePrice->ЕдиницаИзмерения . PHP_EOL;
                                 }
                             }

                             $actualPrice = (new ActualPrice1C($onePrice, $actualPrice))->from1C();
                             if ($actualPrice->save()) {
                                 echo 'Saved actual price, # ' . $onePrice->Номенклатура . PHP_EOL;
                             }
                         }
                     } elseif ($priceFit && empty($values['#value']->Record)) {
                         if (empty($nomValue) || empty($catPrice)) {
                             echo 'Номенклатура or КатегорияЦен empty values, cannot build hash code for searching price...';
                             break;
                         }
                         $code = ActualPricesHelper::buildCodeValueForPrice($nomValue, $catPrice);
                         $actualPrice = ActualPrices::getByCode($code, ['limit' => 1, 'unpublished' => true]);
                         if (empty($actualPrice)) {
                             $actualPrice = ActualPrices::getByCode($code, ['limit' => 1, 'unpublished' => false]);
                         }
                         if (!empty($actualPrice)) {
                             $actualPrice->delete();
                         }
                     }
                 } catch (\Exception $exception) {
                     echo ('Error on save actual price: ' . $exception->getMessage()) . PHP_EOL;
                 }
                 break;
         }
     }*/
}
