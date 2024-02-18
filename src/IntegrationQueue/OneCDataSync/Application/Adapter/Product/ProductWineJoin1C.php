<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 26.02.2021 15:22
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\WineJoin;

class ProductWineJoin1C extends WineJoin
{
    /**
     * @var WineJoin
     */
    protected $wineJoin;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, WineJoin $WineJoin)
    {
        $this->wineJoin = $WineJoin;
        $this->raw = $raw;
    }

    public function from1C(): WineJoin
    {
        $this->wineJoin->setParentId($_ENV['WINE_JOIN_ID']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->wineJoin->setParentRef($this->raw->ParentObject);
            $this->wineJoin->setParentId($this->raw->ParentFolderId);
        }

        if (!$this->wineJoin->isPublished()) {
            $this->wineJoin->setPublished(true);
        }
        $this->wineJoin->setDeletionMark($this->raw->DeletionMark);
        $this->wineJoin->setKey($this->raw->Ref);
        $this->wineJoin->setRef($this->raw->Ref);
        $this->wineJoin->setDescription($this->raw->Description);
        return $this->wineJoin;
    }
}
