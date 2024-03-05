<?php

namespace App\PimCore\Products\Application\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ProductPrepareForMagentoDto
{
    private int $id;

    private string $article;
    private Category $category;
    private General $general;

    private string $status;

    private float $price;

    private float $productSize;

    private string $packingType;

    public function getPackingType(): string
    {
        return $this->packingType;
    }

    public function setPackingType(string $packingType): self
    {
        $this->packingType = $packingType;
        return $this;
    }


    public function getProductSize(): float
    {
        return $this->productSize;
    }

    public function setProductSize(float $productSize): self
    {
        $this->productSize = $productSize;
        return $this;
    }


    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getGeneral(): General
    {
        return $this->general;
    }

    public function setGeneral(General $general): self
    {
        $this->general = $general;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }


    public function __construct()
    {
        $this->category = new Category();
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;
        return $this;
    }

}


