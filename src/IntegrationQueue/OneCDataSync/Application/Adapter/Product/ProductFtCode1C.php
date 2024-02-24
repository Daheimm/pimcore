<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 31.08.2021 11:45
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Pimcore\Model\DataObject\FTcode;

class ProductFtCode1C extends FTcode
{
    /**
     * @var FTcode
     */
    protected $ftCode;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, FTcode $FTcode)
    {
        $this->ftCode = $FTcode;
        $this->raw = $raw;
    }

    public function from1C(): FTcode
    {
        $this->ftCode->setParentId($_ENV['FT_CODE_DIR']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->ftCode->setParentRef($this->raw->ParentObject);
            $this->ftCode->setParentId($this->raw->ParentFolderId);
        }
        $this->ftCode->setKey($this->raw->Ref);
        $this->ftCode->setRef($this->raw->Ref);
        $this->ftCode->setCode($this->raw->Code);
        $this->ftCode->setDeletionMark($this->raw->DeletionMark);
        $this->ftCode->setFullName($this->raw->НаименованиеПолное);
        $this->ftCode->setExcise($this->raw->ПодакцизныйТовар);
        $this->ftCode->setName($this->raw->Description);

        if (!$this->ftCode->isPublished()) {
            $this->ftCode->setPublished(true);
        }
        return $this->ftCode;
    }
}
