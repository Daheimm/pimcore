<?php

namespace App\PimCore\Products\Application\Dto;

class Category
{
    private ?array $rootCategory;
    private ?array $category;
    private ?array $variant;

    public function getRootCategory(): array
    {
        return $this->rootCategory;
    }

    public function setRootCategory(?array $rootCategory): Category
    {
        $this->rootCategory = $rootCategory;
        return $this;
    }

    public function getCategory(): ?array
    {
        return $this->category;
    }

    public function setCategory(?array $category): Category
    {
        $this->category = $category;
        return $this;
    }

    public function getVariant(): ?array
    {
        return $this->variant;
    }

    public function setVariant(?array $variant): Category
    {
        $this->variant = $variant;
        return $this;
    }
}
