<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 31.08.2021 8:33
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;

use Pimcore\Model\DataObject\Certificates;
use Pimcore\Model\DataObject\CertificatesType;
use Pimcore\Model\DataObject\Contractors;
use Pimcore\Model\DataObject\FTcode;
use Pimcore\Model\DataObject\ProductFacilityAddress;

class CertificatesHelper
{
    public static function checkIfCertificateExist(string $certificateCode)
    {
        $certificate = Certificates::getByRef($certificateCode, ['limit' => 1]);
        if (empty($certificate)) {
            echo 'Create new certificate when handle product: ' . $certificateCode . PHP_EOL;
            $certificate = new Certificates();
            $certificate
                ->setParentId($_ENV['CERTIFICATE_DIR'])
                ->setKey($certificateCode)
                ->setRef($certificateCode)
                ->setPublished(true);
            if ($certificate->save()) {
                echo 'Saved new certificate ' . $certificateCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product certificate : ' . $certificateCode . PHP_EOL;
        }
        return $certificate;
    }

    public static function checkIfAgentExist(string $agentCode)
    {
        $agent = Contractors::getByRef($agentCode, ['limit' => 1]);
        if (empty($agent)) {
            echo 'Create new agent when handle product: ' . $agentCode . PHP_EOL;
            $agent = new Contractors();
            $agent
                ->setParentId($_ENV['CONTRACTOR_DIR'])
                ->setKey($agentCode)
                ->setRef($agentCode)
                ->setPublished(true);
            if ($agent->save()) {
                echo 'Saved new agent when handle product ' . $agentCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product agent when handle product : ' . $agentCode . PHP_EOL;
        }
        return $agent;
    }

    public static function checkIfCertTypeExist(string $certTypeCode)
    {
        $certificatesType = CertificatesType::getByRef($certTypeCode, ['limit' => 1]);
        if (empty($certificatesType)) {
            echo 'Create new certificatesType when handle product: ' . $certTypeCode . PHP_EOL;
            $certificatesType = new CertificatesType();
            $certificatesType
                ->setParentId($_ENV['CERTIFICATE_TYPE_DIR'])
                ->setKey($certTypeCode)
                ->setRef($certTypeCode)
                ->setPublished(true);
            if ($certificatesType->save()) {
                echo 'Saved new certificatesType when handle product ' . $certTypeCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product certificatesType when handle product : ' . $certTypeCode . PHP_EOL;
        }
        return $certificatesType;
    }


    public static function checkIfCodeFeaExist(string $codeFea)
    {
        $ftCode = FTcode::getByRef($codeFea, ['limit' => 1]);
        if (empty($ftCode)) {
            echo 'Create new ftCode when handle product: ' . $codeFea . PHP_EOL;
            $ftCode = new FTcode();
            $ftCode
                ->setParentId($_ENV['FT_CODE_DIR'])
                ->setKey($codeFea)
                ->setRef($codeFea)
                ->setPublished(true);
            if ($ftCode->save()) {
                echo 'Saved new ftCode when handle product ' . $codeFea . PHP_EOL;
            }
        }
        else {
            echo 'Found product ftCode when handle product : ' . $codeFea . PHP_EOL;
        }
        return $ftCode;
    }

    public static function checkIfProductFacilityAddressExist(string $addressCode)
    {
        $productFacilityAddress = ProductFacilityAddress::getByRef($addressCode, ['limit' => 1]);
        if (empty($productFacilityAddress)) {
            echo 'Create new productFacilityAddress when handle product: ' . $addressCode . PHP_EOL;
            $productFacilityAddress = new ProductFacilityAddress();
            $productFacilityAddress
                ->setParentId($_ENV['PRODUCT_FACILITY_ADDRESS_DIR'])
                ->setKey($addressCode)
                ->setRef($addressCode)
                ->setPublished(true);
            if ($productFacilityAddress->save()) {
                echo 'Saved new productFacilityAddress when handle product ' . $addressCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product productFacilityAddress when handle product : ' . $addressCode . PHP_EOL;
        }
        return $productFacilityAddress;
    }

    public static function buildCodeValueForFEAC(string $certificateId, string $productId)
    {
        return md5($certificateId . $productId);
    }
}
