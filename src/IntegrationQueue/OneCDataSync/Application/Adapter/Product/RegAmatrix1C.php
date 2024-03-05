<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 05.10.2021 8:54
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use App\IntegrationQueue\OneCDataSync\Application\Helpers\AmatrixHelper;
use Carbon\Carbon;
use Pimcore\Model\DataObject\RegAMatrix;

class RegAmatrix1C extends RegAMatrix
{
    /**
     * @var RegAMatrix
     */
    protected $regAMatrix;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, RegAMatrix $regAMatrix)
    {
        $this->regAMatrix = $regAMatrix;
        $this->raw = $raw;
    }

    public function from1C(): RegAMatrix
    {
        $this->regAMatrix->setParentId($_ENV['REG_AMATRIX']);

        if (!$this->regAMatrix->isPublished()) {
            $this->regAMatrix->setPublished(true);
        }
        $ref = AmatrixHelper::buildRegAmatrixCode($this->raw->Объект, $this->raw->АссортиментнаяМатрица);
        $this->regAMatrix->setCode($ref);
        $this->regAMatrix->setKey($ref);
        $this->regAMatrix->setProduct($this->raw->Объект);
        $this->regAMatrix->setA_matrix($this->raw->MatrixObject);
        $this->regAMatrix->setA_status($this->raw->StatusObject);
        $this->regAMatrix->setA_satus_date( new Carbon($this->raw->ДатаДействияСтатуса));
        $this->regAMatrix->setA_change_date( new Carbon($this->raw->ДатаИзменения));
        $this->regAMatrix->setA_change_cause($this->raw->ПричинаИзменения);
        return $this->regAMatrix;
    }
}
