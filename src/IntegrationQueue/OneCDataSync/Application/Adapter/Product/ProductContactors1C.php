<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 31.08.2021 10:23
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Pimcore\Model\DataObject\Contractors;

class ProductContactors1C extends Contractors
{
    /**
     * @var Contractors
     */
    protected $contractors;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, Contractors $Contractors)
    {
        $this->contractors = $Contractors;
        $this->raw = $raw;
    }

    public function from1C(): Contractors
    {
        $this->contractors->setParentId($_ENV['CONTRACTOR_DIR']);

        if (!$this->contractors->isPublished()) {
            $this->contractors->setPublished(true);
        }
        $this->contractors->setDeletionMark($this->raw->DeletionMark);
        $this->contractors->setRef($this->raw->Ref);
        $this->contractors->setCode($this->raw->Code);
        $this->contractors->setName($this->raw->Description);
        $this->contractors->setFullName($this->raw->ПолноеНаименование);
        return $this->contractors;
    }
}
