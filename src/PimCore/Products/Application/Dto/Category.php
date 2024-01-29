<?php

namespace App\PimCore\Products\Application\Dto;

class Category
{
    private ?string $rootCategory;
    private ?string $category;
    private ?string $variant;

    public function getRootCategory(): string
    {
        return $this->rootCategory;
    }

    public function setRootCategory(?string $rootCategory): Category
    {
        $this->rootCategory = $rootCategory;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): Category
    {
        $this->category = $category;
        return $this;
    }

    public function getVariant(): ?string
    {
        return $this->variant;
    }

    public function setVariant(?string $variant): Category
    {
        $this->variant = $variant;
        return $this;
    }
}
