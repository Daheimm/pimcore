<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 31.08.2021 14:13
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Pimcore\Model\DataObject\CertificatesType;

class CertificateType1C extends CertificatesType
{
    /**
     * @var CertificatesType
     */
    protected $certificatesType;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, CertificatesType $CertificatesType)
    {
        $this->certificatesType = $CertificatesType;
        $this->raw = $raw;
    }

    public function from1C(): CertificatesType
    {
        $this->certificatesType->setParentId($_ENV['CERTIFICATE_TYPE_DIR']);

        if (!$this->certificatesType->isPublished()) {
            $this->certificatesType->setPublished(true);
        }

        $this->certificatesType->setRef($this->raw->Ref);
        $this->certificatesType->setKey($this->raw->Ref);
        $this->certificatesType->setCode($this->raw->Code);
        $this->certificatesType->setDeletionMark($this->raw->DeletionMark);
        $this->certificatesType->setName($this->raw->Description);
        $this->certificatesType->setNameEng($this->raw->КраткоеНаименованиеАнгл);
        $this->certificatesType->setNameFull($this->raw->НаименованиеПолное);
        $this->certificatesType->setDescription($this->raw->Описание);
        $this->certificatesType->setCert_supl($this->raw->СертификатПоставщика);
        $this->certificatesType->setPeriodic($this->raw->Периодический);
        $this->certificatesType->setActual($this->raw->Актуальный);
        $this->certificatesType->setPartitial($this->raw->Партийный);
        $this->certificatesType->setCert_cloud($this->raw->РаспространениеВидаСертификата);
        $this->certificatesType->setContractor_list($this->raw->СписокКонтрагентов);
        return $this->certificatesType;
    }
}
