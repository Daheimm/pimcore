<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 05.10.2021 8:39
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Pimcore\Model\DataObject\Amatrix;

class Amatrix1C extends Amatrix
{
    /**
     * @var Amatrix
     */
    protected $amatrix;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, Amatrix $amatrix)
    {
        $this->amatrix = $amatrix;
        $this->raw = $raw;
    }

    public function from1C(): Amatrix
    {
        $this->amatrix->setParentId($_ENV['AMATRIX_DIR']);

        if (!$this->amatrix->isPublished()) {
            $this->amatrix->setPublished(true);
        }

        $this->amatrix->setRef($this->raw->Ref);
        $this->amatrix->setKey($this->raw->Ref);
        $this->amatrix->setDelMark($this->raw->DeletionMark);
        $this->amatrix->setName($this->raw->Description);
        return $this->amatrix;
    }
}
