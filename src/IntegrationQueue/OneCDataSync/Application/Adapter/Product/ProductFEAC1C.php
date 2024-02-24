<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 01.09.2021 14:46
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use App\IntegrationQueue\OneCDataSync\Application\Helpers\CertificatesHelper;
use Carbon\Carbon;
use Pimcore\Model\DataObject\NomCertWithFEAC;

class ProductFEAC1C extends NomCertWithFEAC
{
    /**
     * @var NomCertWithFEAC
     */
    protected $nomCertWithFEAC;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, NomCertWithFEAC $NomCertWithFEAC)
    {
        $this->nomCertWithFEAC = $NomCertWithFEAC;
        $this->raw = $raw;
    }

    public function from1C(): NomCertWithFEAC
    {
        $ref = CertificatesHelper::buildCodeValueForFEAC($this->raw->Сертификат, $this->raw->Номенклатура);
        $this->nomCertWithFEAC->setParentId($_ENV['FEAC_DIR']);
        $this->nomCertWithFEAC->setCode($ref);
        $this->nomCertWithFEAC->setKey($ref);
        $this->nomCertWithFEAC->setProductId($this->raw->Номенклатура);
        $this->nomCertWithFEAC->setDate(new Carbon($this->raw->Period));
        $this->nomCertWithFEAC->setSupplier($this->raw->SupplierObject);
        $this->nomCertWithFEAC->setProducer($this->raw->ProducerObject);
        $this->nomCertWithFEAC->setCertificateId($this->raw->CertificateObject);
        $this->nomCertWithFEAC->setCodeFeu($this->raw->FEAObject);
        $this->nomCertWithFEAC->setDateFinish(new Carbon($this->raw->СрокДействия));


        if (!$this->nomCertWithFEAC->isPublished()) {
            $this->nomCertWithFEAC->setPublished(true);
        }
        return $this->nomCertWithFEAC;
    }
}
