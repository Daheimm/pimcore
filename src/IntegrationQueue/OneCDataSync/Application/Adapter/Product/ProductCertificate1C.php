<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 31.08.2021 8:37
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Carbon\Carbon;
use Pimcore\Model\DataObject\Certificates;

class ProductCertificate1C extends Certificates
{
    /**
     * @var Certificates
     */
    protected $certificate;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, Certificates $certificates)
    {
        $this->certificate = $certificates;
        $this->raw = $raw;
    }

    public function from1C(): Certificates
    {
        $this->certificate->setParentId($_ENV['CERTIFICATE_DIR']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->certificate->setParentRef($this->raw->ParentObject);
            $this->certificate->setParentId($this->raw->ParentFolderId);
        }

        if (!$this->certificate->isPublished()) {
            $this->certificate->setPublished(true);
        }
        $this->certificate->setDeletionMark($this->raw->DeletionMark);
        $this->certificate->setKey($this->raw->Ref);
        $this->certificate->setRef($this->raw->Ref);
        $this->certificate->setDescription($this->raw->Description);
        $this->certificate->setCode($this->raw->Code);
        echo $this->raw->ДатаНачалаДействия . PHP_EOL;
        echo $this->raw->ДатаОкончанияДействия . PHP_EOL;
        $this->certificate->setDate_begin(new Carbon($this->raw->ДатаНачалаДействия));
        $this->certificate->setDate_finish(new Carbon($this->raw->ДатаОкончанияДействия));
        $this->certificate->setAgent($this->raw->AgentObject);
        $this->certificate->setCert_number($this->raw->НомерСертификата);
        $this->certificate->setCert_type($this->raw->CertTypeObject);
        $this->certificate->setOrder_id($this->raw->Заказ);
        $this->certificate->setCountry($this->raw->CountryObject);
        $this->certificate->setSupplier($this->raw->SupplierObject);
        $this->certificate->setActual($this->raw->Актуальный);
        $this->certificate->setCert_link($this->raw->СсылкаНаСертификат);
        $this->certificate->setProducer($this->raw->ProducerObject);
        return $this->certificate;
    }
}
