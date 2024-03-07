<?php

namespace App\PimCore\Products\Application\Dto;

class NameAndDescription
{
    private ?string $productName;
    private ?string $webProductName;
    private ?string $mobileProductName;
    private ?string $warehouse;

    private ?string $webDescription;
    private ?string $mobileDescription;

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(?string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }

    public function getWebProductName(): ?string
    {
        return $this->webProductName;
    }

    public function setWebProductName(?string $webProductName): self
    {
        $this->webProductName = $webProductName;
        return $this;
    }

    public function getMobileProductName(): ?string
    {
        return $this->mobileProductName;
    }

    public function setMobileProductName(?string $mobileProductName): self
    {
        $this->mobileProductName = $mobileProductName;
        return $this;
    }

    public function getWarehouse(): ?string
    {
        return $this->warehouse;
    }

    public function setWarehouse(?string $warehouse): self
    {
        $this->warehouse = $warehouse;
        return $this;
    }

    public function getWebDescription(): ?string
    {
        return $this->webDescription;
    }

    public function setWebDescription(?string $webDescription): self
    {
        $this->webDescription = $webDescription;
        return $this;
    }

    public function getMobileDescription(): ?string
    {
        return $this->mobileDescription;
    }

    public function setMobileDescription(?string $mobileDescription): self
    {
        $this->mobileDescription = $mobileDescription;
        return $this;
    }

}
