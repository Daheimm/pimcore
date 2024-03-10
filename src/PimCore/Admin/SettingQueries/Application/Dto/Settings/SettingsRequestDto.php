<?php

namespace App\PimCore\Admin\SettingQueries\Application\Dto\Settings;

use Symfony\Component\Validator\Constraints as Assert;

class SettingsRequestDto
{
    #[Assert\NotBlank]
    private int $id;
    #[Assert\NotBlank]
    private string $xApiKey;
    #[Assert\NotBlank]
    private string $query;
    #[Assert\NotBlank]
    private string $text;

    #[Assert\NotBlank]
    private string $type;
    #[Assert\NotBlank]
    private string $endpoint;
    #[Assert\NotBlank]
    private string $path;

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getXApiKey(): string
    {
        return $this->xApiKey;
    }

    public function setXApiKey(string $xApiKey): void
    {
        $this->xApiKey = $xApiKey;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
