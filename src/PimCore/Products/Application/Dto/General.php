<?php

namespace App\PimCore\Products\Application\Dto;

class General
{
    /**
     * @var array{nameAndDescriptions: array<string, NameAndDescription>}
     */
    private array $nameAndDescriptions = [];

    /**
     * @return array{nameAndDescriptions: array<string, NameAndDescription>}
     */
    public function getNameAndDescriptions(): array
    {
        return $this->nameAndDescriptions;
    }
    /**
     * @param string $locale
     * @param NameAndDescription $nameAndDescription
     * @return General
     */
    public function addNameAndDescription(string $locale, NameAndDescription $nameAndDescription): self
    {
        $this->nameAndDescriptions[$locale] = $nameAndDescription;
        return $this;
    }

}
